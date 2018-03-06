<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
 
class Printer extends MX_Controller {
 
public function __construct() {
  	parent::__construct();
 	$this->load->library("template");
 	$this->load->model("printer_model");
  }
 
	public function index(){
  		$data['page'] = "printer";
    	$this->template->get($data);
	}
	public function view_all(){
		echo $this->printer_model->view_all();
	}
	public function add_printer(){
		$data['printer_name'] 	= $this->input->post("printer_name");
		$data['created_by'] = $this->session->userdata("user_session");
		$data['created'] 	= date("Y-m-d H:i:s");

		$msg_success = array('action' => 'refresh');
		
	
		$required =  array("Waktu Shit" => $data['printer_name']);


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
			$query = $this->db->insert("apps_printer", $data);
			if ($query) {
				echo json_encode($msg_success);
			}

		}
	}

	public function delete_printer($id){
		echo $is;
		$this->db->where("printer_id",$id);
		$query = $this->db->update("apps_printer", array('is_deleted' => 1));
		$json = array('msg' => 'Data Berhasil Di Hapus !');
		if ($query) {
			echo json_encode($json);
		}
	}
	public function update_printer(){
		$printer_id 			= $this->input->post("printer_id");
		$data['printer_name'] = $this->input->post("printer_name");
		$data['created_by'] = $this->session->userdata("user_session");
		$data['created'] 	= date("Y-m-d H:i:s");



		$msg_success = array('action' => 'refresh');
		
	
			
		$required =  array("Waktu Shit" => $data['printer_name']);


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
			$this->db->where("printer_id", $printer_id);
			$query = $this->db->update("apps_printer", $data);
			if ($query) {
				echo json_encode($msg_success);
			}

		}
	}

 	
}

?>