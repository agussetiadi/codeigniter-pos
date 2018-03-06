<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
 
class Shift extends MX_Controller {
 
public function __construct() {
  	parent::__construct();
 	$this->load->library("template");
 	$this->load->model("shift_model");
  }
 
	public function index(){
  		$data['page'] = "shift";
    	$this->template->get($data);
	}
	public function view_all(){
		echo $this->shift_model->view_all();
	}
	public function add_shift(){
		$data['shift_name'] 	= $this->input->post("shift_name");
		$data['created_by'] = $this->session->userdata("user_session");
		$data['created'] 	= date("Y-m-d H:i:s");

		$msg_success = array('action' => 'refresh');
		
	
		$required =  array("Waktu Shit" => $data['shift_name']);


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
			$query = $this->db->insert("apps_shift", $data);
			if ($query) {
				echo json_encode($msg_success);
			}

		}
	}

	public function delete_shift($id){
		echo $is;
		$this->db->where("shift_id",$id);
		$query = $this->db->update("apps_shift", array('is_deleted' => 1));
		$json = array('msg' => 'Data Berhasil Di Hapus !');
		if ($query) {
			echo json_encode($json);
		}
	}
	public function update_shift(){
		$shift_id 			= $this->input->post("shift_id");
		$data['shift_name'] = $this->input->post("shift_name");
		$data['created_by'] = $this->session->userdata("user_session");
		$data['created'] 	= date("Y-m-d H:i:s");



		$msg_success = array('action' => 'refresh');
		
	
			
		$required =  array("Waktu Shit" => $data['shift_name']);


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
			$this->db->where("shift_id", $shift_id);
			$query = $this->db->update("apps_shift", $data);
			if ($query) {
				echo json_encode($msg_success);
			}

		}
	}

 	
}

?>