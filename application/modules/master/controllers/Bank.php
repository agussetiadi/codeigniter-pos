<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
 
class Bank extends MX_Controller {
 
public function __construct() {
  	parent::__construct();
 	$this->load->library("template");
 	$this->load->model("bank_model");
  }
 
	public function index(){
  		$data['page'] = "bank";
  		$data['query'] = $this->db->get_where("pos_payment",  array('is_deleted' => 0 ));
    	$this->template->get($data);
	}
	public function view_all(){
		echo $this->bank_model->view_all();
	}
	public function add_bank(){
		$data['bank_name'] 	= $this->input->post("bank_name");
		
		$data['created_by'] 	= $this->session->userdata("user_session");
		$data['created'] 	= date("Y-m-d H:i:s");

		$msg_success = array('action' => 'refresh');
		
	
		$required =  array("Nama Bank" => $data['bank_name']);


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
			$query = $this->db->insert("pos_bank", $data);
			if ($query) {
				echo json_encode($msg_success);
			}

		}
	}

	public function delete_bank($id){
		
		$this->db->where("bank_id",$id);
		$query = $this->db->update("pos_bank", array('is_deleted' => 1));
		$json = array('msg' => 'Data Berhasil Di Hapus !');
		if ($query) {
			echo json_encode($json);
		}
	}
	public function update_bank(){
		$bank_id 	= $this->input->post("bank_id");
		$data['bank_name'] 	= $this->input->post("bank_name");
		
		$data['created_by'] 	= $this->session->userdata("user_session");
		$data['created'] 	= date("Y-m-d H:i:s");




		$msg_success = array('action' => 'refresh');
		
	
			
		$required =  array("Nama Bank" => $data['bank_name']);


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
			$this->db->where("bank_id", $bank_id);
			$query = $this->db->update("pos_bank", $data);
			if ($query) {
				echo json_encode($msg_success);
			}

		}
	}

 	
}

?>