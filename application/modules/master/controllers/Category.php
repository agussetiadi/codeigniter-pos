<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
 
class Category extends MX_Controller {
 
public function __construct() {
  	parent::__construct();
 	$this->load->library("template");
 	$this->load->model("category_model");
  }
 
	public function index(){
  		$data['page'] = "category";
    	$this->template->get($data);
	}
	public function view_all(){
		echo $this->category_model->view_all();
	}
	public function add_category(){
		$data['category_name'] 	= $this->input->post("category_name");
		$data['created_by'] = $this->session->userdata("user_session");
		$data['created'] 	= date("Y-m-d H:i:s");

		$msg_success = array('action' => 'refresh');
		
	
		$required =  array("Jenis Kategori" => $data['category_name']);


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
			$query = $this->db->insert("pos_category", $data);
			if ($query) {
				echo json_encode($msg_success);
			}

		}
	}

	public function delete_category($id){
		echo $is;
		$this->db->where("category_id",$id);
		$query = $this->db->update("pos_category", array('is_deleted' => 1));
		$json = array('msg' => 'Data Berhasil Di Hapus !');
		if ($query) {
			echo json_encode($json);
		}
	}
	public function update_category(){
		$category_id 			= $this->input->post("category_id");
		$data['category_name'] = $this->input->post("category_name");
		$data['created_by'] = $this->session->userdata("user_session");
		$data['created'] 	= date("Y-m-d H:i:s");



		$msg_success = array('action' => 'refresh');
		
	
			
		$required =  array("Jenis Kategori" => $data['category_name']);


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
			$this->db->where("category_id", $category_id);
			$query = $this->db->update("pos_category", $data);
			if ($query) {
				echo json_encode($msg_success);
			}

		}
	}

 	
}

?>