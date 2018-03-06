<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
 
class Payment extends MX_Controller {
 
public function __construct() {
  	parent::__construct();
 	$this->load->library("template");
 	$this->load->model("payment_model");
  }
 
	public function index(){
  		$data['page'] = "payment";
    	$this->template->get($data);
	}
	public function view_all(){
		echo $this->payment_model->view_all();
	}
	public function add_payment(){
		$data['payment_name'] 	= $this->input->post("payment_name");
		$data['payment_id'] = $this->input->post("payment_id");
		$data['created_by'] 	= $this->session->userdata("user_session");
		$data['created'] 	= date("Y-m-d H:i:s");

		$msg_success = array('action' => 'refresh');
		
	
		$required =  array("Jenis Pembayaran" => $data['payment_name']);


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
			$query = $this->db->insert("pos_payment", $data);
			if ($query) {
				echo json_encode($msg_success);
			}

		}
	}

	public function delete_payment($id){
		
		$this->db->where("payment_id",$id);
		$query = $this->db->update("pos_payment", array('is_deleted' => 1));
		$json = array('msg' => 'Data Berhasil Di Hapus !');
		if ($query) {
			echo json_encode($json);
		}
	}
	public function update_payment(){
		$payment_id 	= $this->input->post("payment_id");
		$data['payment_name'] 	= $this->input->post("payment_name");
		$data['payment_id'] = $this->input->post("payment_id");




		$msg_success = array('action' => 'refresh');
		
	
			
		$required =  array("Jenis Pembayaran" => $data['payment_name']);



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
			$this->db->where("payment_id", $payment_id);
			$query = $this->db->update("pos_payment", $data);
			if ($query) {
				echo json_encode($msg_success);
			}

		}
	}

 	
}

?>