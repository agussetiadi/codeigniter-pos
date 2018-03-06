<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
 
class Store extends MX_Controller {
 
public function __construct() {
  	parent::__construct();
 	$this->load->library("template");
 	$this->load->model("store_model");
  }
 
	public function index(){
  		$data['page'] = "store";
  		$data['query'] = $this->db->get_where("pos_store", array("is_deleted" => 0));
    	$this->template->get($data);
	}
	public function view_all(){
		echo $this->store_model->view_all();
	}
	public function add_store(){
		$data['store_name']	= $this->input->post("store_name");
		$data['store_contact'] = $this->input->post("store_contact");
		$data['store_address'] = $this->input->post("store_address");
		$data['is_main'] = $this->input->post("is_main");

		$msg_success = array('action' => 'refresh');
		
	
		$required =  array("Nama Toko" => $data['store_name'],
							"Contact Toko" => $data['store_contact'],
							"Alamat Toko" => $data['store_address'],
							"Status" => $data['is_main']);


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
			$query = $this->db->insert("pos_store", $data);
			if ($query) {
				echo json_encode($msg_success);
			}

		}
	}

	public function delete_store($id){
		$this->db->where("store_id",$id);
		$query = $this->db->update("pos_store", array('is_deleted' => 1));
		$json = array('msg' => 'Data Berhasil Di Hapus !');
		if ($query) {
			echo json_encode($json);
		}
	}
	public function update_store(){
		$data['store_name']	= $this->input->post("store_name");
		$store_id	= $this->input->post("store_id");
		$data['store_contact'] = $this->input->post("store_contact");
		$data['store_address'] = $this->input->post("store_address");
		$data['is_main'] = $this->input->post("is_main");



		$msg_success = array('action' => 'refresh');
		
	
		$required =  array("Nama Toko" => $data['store_name'],
					"Contact Toko" => $data['store_contact'],
					"Alamat Toko" => $data['store_address'],
					"Status" => $data['is_main']);


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
			$this->db->where("store_id", $store_id);
			$query = $this->db->update("pos_store", $data);
			if ($query) {
				echo json_encode($msg_success);
			}

		}
	}

	public function get_data(){
		$query = $this->db->get_where("pos_unit", "is_deleted");

	}

 	
}

?>