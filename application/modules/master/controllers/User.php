<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
 
class User extends MX_Controller {
 
public function __construct() {
  	parent::__construct();
 	$this->load->library("template");
 	$this->load->model("user_model");
  }
 
	public function index(){
  		$data['page'] = "user";
  		$data['query1'] = $this->db->get_where("pos_store",  array('is_deleted' => 0));
  		$data['query2'] = $this->db->get_where("apps_jabatan",  array('is_deleted' => 0));
  		$data['query3'] = $this->db->get_where("apps_shift",  array('is_deleted' => 0));
    	$this->template->get($data);
	}
	public function view_all(){
		echo $this->user_model->view_all();
	}
	public function add_user(){
		$data['avatar']		= "male.jpg";
		$data['username']	= $this->input->post("username");
		$data['first_name'] = ucfirst($this->input->post("first_name"));
		$data['password'] = $this->input->post("password");
		$data['store_id'] = $this->input->post("store_id");
		$data['jabatan_id'] = $this->input->post("jabatan_id");
		$data['shift_id'] = $this->input->post("shift_id");
		$data['created'] = date("Y-m-d H:i:s");
		$data['created_by'] = $this->session->userdata("user_session");

		$msg_success = array('action' => 'refresh');
		
	
		$required =  array("Username" => $data['username'],
							"Nama Pengguna" => $data['first_name'],
							"Password" => $data['password'],
							"Cabang/Toko" => $data['store_id'],
							"Jabatan" => $data['jabatan_id'],
							"Shift" => $data['shift_id']
							);


		/*
		Validasi input
		*/
		foreach ($required as $key => $value) {
			if (empty($value)) {
				$set_required[] = $key;
			}
		}

		if (!empty($set_required)) {
			$msg_validate = array('msg' => 'Validate', 'required' =>  array($set_required));
			echo json_encode($msg_validate);
		}
		else{


			/*Check username sudah ada atau belum */

			$check_user = $this->db->get_where("apps_users", array('username' => $data['username'],'is_deleted' => 0));
			if ($check_user->num_rows() == 0) {

				$query = $this->db->insert("apps_users", $data);
				if ($query) {
					echo json_encode($msg_success);
				}
				
			}
			else{
				$msg_username = array('msg_username' => 'Username '.$data['username'].' Sudah Terdaftar, Coba Username Yang Lain !!');
				echo json_encode($msg_username);
			}

		}
	}

	public function delete_user($id){
		$this->db->where("user_id",$id);
		$query = $this->db->update("apps_users", array('is_deleted' => 1));
		$json = array('msg' => 'Data Berhasil Di Hapus !');
		if ($query) {
			echo json_encode($json);
		}
	}
	public function update_user(){
		$user_id			= $this->input->post("user_id");
		$data['username']	= $this->input->post("username");
		$data['first_name'] = ucfirst($this->input->post("first_name"));
		$data['store_id'] = $this->input->post("store_id");
		$data['jabatan_id'] = $this->input->post("jabatan_id");
		$data['shift_id'] = $this->input->post("shift_id");



		$msg_success = array('action' => 'refresh');
		
	
	
		$required =  array("Username" => $data['username'],
							"Nama Pengguna" => $data['first_name'],
							"Cabang/Toko" => $data['store_id'],
							"Jabatan" => $data['jabatan_id'],
							"Shift" => $data['shift_id']
							);


		/*
		Validasi input
		*/
		foreach ($required as $key => $value) {
			if (empty($value)) {
				$set_required[] = $key;
			}
		}

		if (!empty($set_required)) {
			$msg_validate = array('msg' => 'Validate', 'required' =>  array($set_required));
			echo json_encode($msg_validate);
		}
		else{

			$check_user = $this->db->get_where("apps_users", array('username' => $data['username'],'user_id !=' => $user_id,'is_deleted' => 0));

			if ($check_user->num_rows() == 0) {

				$this->db->where("user_id", $user_id);
				$query = $this->db->update("apps_users", $data);
				if ($query) {
					echo json_encode($msg_success);
				}
			}
			else{
				$msg_username = array('msg_username' => 'Username '.$data['username'].' Sudah Terdaftar, Coba Username Yang Lain !!');
				echo json_encode($msg_username);
			}

		}
	}

	public function get_data(){
		$query = $this->db->get_where("pos_unit", "is_deleted");

	}

 	
}

?>