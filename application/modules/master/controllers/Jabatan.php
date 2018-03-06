<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
 
class Jabatan extends MX_Controller {
 
public function __construct() {
  	parent::__construct();
 	$this->load->library("template");
 	$this->load->model("jabatan_model");
  }
 
	public function index(){
  		$data['page'] = "jabatan";
    	$this->template->get($data);
	}
	public function view_all(){
		echo $this->jabatan_model->view_all();
	}
	public function add_jabatan(){
		$data['jabatan_name'] 	= $this->input->post("jabatan_name");
		$data['created_by'] = $this->session->userdata("user_session");
		$data['created'] 	= date("Y-m-d H:i:s");

		$msg_success = array('action' => 'refresh');
		
	
		$required =  array("Nama Divisi" => $data['jabatan_name']);


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
			$query = $this->db->insert("apps_jabatan", $data);
			if ($query) {
				echo json_encode($msg_success);
			}

		}
	}

	public function delete_jabatan($id){
		
		$this->db->where("jabatan_id",$id);
		$query = $this->db->update("apps_jabatan", array('is_deleted' => 1));
		$json = array('msg' => 'Data Berhasil Di Hapus !');
		if ($query) {
			echo json_encode($json);
		}
	}
	public function update_jabatan(){
		$jabatan_id 			= $this->input->post("jabatan_id");
		$data['jabatan_name'] = $this->input->post("jabatan_name");



		$msg_success = array('action' => 'refresh');
		
	
			
		$required =  array("Nama Divisi" => $data['jabatan_name']);


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
			$this->db->where("jabatan_id", $jabatan_id);
			$query = $this->db->update("apps_jabatan", $data);
			if ($query) {
				echo json_encode($msg_success);
			}

		}
	}

 	
}

?>