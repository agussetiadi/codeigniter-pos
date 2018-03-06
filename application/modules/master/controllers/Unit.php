<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
 
class Unit extends MX_Controller {
 
public function __construct() {
  	parent::__construct();
 	$this->load->library("template");
 	$this->load->model("unit_model");
  }
 
	public function index(){
  		$data['page'] = "unit";
  		$data['query'] = $this->db->get_where("pos_unit", array("is_deleted" => 0));
    	$this->template->get($data);
	}
	public function view_all(){
		echo $this->unit_model->view_all();
	}
	public function add_unit(){
		$data['unit_name'] 	= $this->input->post("unit_name");
		$data['created_by'] = "Administrator";
		$data['created'] 	= date("Y-m-d H:i:s");

		$msg_success = array('action' => 'refresh');
		
	
		$required =  array("Jenis Satuan" => $data['unit_name']);


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
			$query = $this->db->insert("pos_unit", $data);
			if ($query) {
				echo json_encode($msg_success);
			}

		}
	}

	public function delete_unit($id){
		echo $is;
		$this->db->where("unit_id",$id);
		$query = $this->db->update("pos_unit", array('is_deleted' => 1));
		$json = array('msg' => 'Data Berhasil Di Hapus !');
		if ($query) {
			echo json_encode($json);
		}
	}
	public function update_unit(){
		$data['unit_name'] 	= $this->input->post("unit_name");
		$unit_id 	= $this->input->post("unit_id");
		$data['created_by'] = "Administrator";
		$data['created'] 	= date("Y-m-d H:i:s");



		$msg_success = array('action' => 'refresh');
		
	
		$required =  array("Jenis Satuan" => $data['unit_name']);


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
			$this->db->where("unit_id", $unit_id);
			$query = $this->db->update("pos_unit", $data);
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