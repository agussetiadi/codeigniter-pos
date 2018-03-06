<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
 
class Supplier extends MX_Controller {
 
public function __construct() {
  	parent::__construct();
 	$this->load->library("template");
 	$this->load->model("supplier_model");
  }
 
	public function index(){
  		$data['page'] = "supplier";
    	$this->template->get($data);
	}
	public function view_all(){
		echo $this->supplier_model->view_all();
	}
	public function add_supplier(){
		$data['supplier_name'] = $this->input->post("supplier_name");
		$data['supplier_contact'] = $this->input->post("supplier_contact");
		$data['supplier_address'] = $this->input->post("supplier_address");
		$data['supplier_phone'] = $this->input->post("supplier_phone");
		$data['supplier_fax'] = $this->input->post("supplier_fax");
		$data['created_by'] 	= $this->session->userdata("user_session");
		$data['created'] 	= date("Y-m-d H:i:s");

		$msg_success = array('action' => 'refresh');
		
	
		$required =  array("Nama Supplier" => $data['supplier_name']);


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
			$query = $this->db->insert("pos_supplier", $data);
			if ($query) {
				echo json_encode($msg_success);
			}

		}
	}

	public function delete_supplier($id){
		
		$this->db->where("supplier_id",$id);
		$query = $this->db->update("pos_supplier", array('is_deleted' => 1));
		$json = array('msg' => 'Data Berhasil Di Hapus !');
		if ($query) {
			echo json_encode($json);
		}
	}
	public function update_supplier(){
		$supplier_id = $this->input->post("supplier_id");
		$data['supplier_name'] = $this->input->post("supplier_name");
		$data['supplier_contact'] = $this->input->post("supplier_contact");
		$data['supplier_address'] = $this->input->post("supplier_address");
		$data['supplier_phone'] = $this->input->post("supplier_phone");
		$data['supplier_fax'] = $this->input->post("supplier_fax");
		$data['created_by'] 	= $this->session->userdata("user_session");
		$data['created'] 	= date("Y-m-d H:i:s");

		$msg_success = array('action' => 'refresh');
		
	
		$required =  array("Nama Supplier" => $data['supplier_name']);



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
			$this->db->where("supplier_id", $supplier_id);
			$query = $this->db->update("pos_supplier", $data);
			if ($query) {
				echo json_encode($msg_success);
			}

		}
	}

 	
}

?>