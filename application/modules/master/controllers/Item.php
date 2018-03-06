<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
 
class Item extends MX_Controller {
 
public function __construct() {
  	parent::__construct();
 	$this->load->library("template");
 	$this->load->model("item_model");
  }
 
	public function index(){
  		$data['page'] = "item";
  		$data['query2'] = $this->db->get_where("pos_category", array("is_deleted" => 0));
  		$data['query'] = $this->db->get_where("pos_unit", array("is_deleted" => 0));
    	$this->template->get($data);
	}
	public function view_all(){
		echo $this->item_model->view_all();
	}
	public function add_item(){
		$data['item_name'] 	= $this->input->post("item_name");
		$data['category_id'] 	= $this->input->post("category_id");
		$data['unit_id'] 	= $this->input->post("unit_id");
		$data['item_code'] 	= $this->input->post("item_code");
		$data['item_desc'] 	= $this->input->post("item_desc");
		$data['item_price'] = $this->input->post("item_price");
		$data['item_hpp'] 	= $this->input->post("item_hpp");



		$msg_success = array('action' => 'refresh');
		
	
		$required =  array("Nama" => $data['item_name'],"Satuan" => $data['unit_id'], "Harga Item" => $data['item_price'],"Harga HPP"=>$data['item_hpp'], "Kategori Item"=>$data['category_id']);


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
			$query = $this->db->insert("pos_item", $data);
			if ($query) {
				echo json_encode($msg_success);
			}

		}
	}

	public function delete_item($id){
		echo $is;
		$this->db->where("item_id",$id);
		$query = $this->db->update("pos_item", array('is_deleted' => 1));
		$json = array('msg' => 'Data Berhasil Di Hapus !');
		if ($query) {
			echo json_encode($json);
		}
	}
	public function update_item(){
		$data['item_id'] 	= $this->input->post("item_id");
		$data['category_id'] 	= $this->input->post("category_id");
		$data['item_name'] 	= $this->input->post("item_name");
		$data['unit_id'] 	= $this->input->post("unit_id");
		$data['item_code'] 	= $this->input->post("item_code");
		$data['item_desc'] 	= $this->input->post("item_desc");
		$data['item_price'] = $this->input->post("item_price");
		$data['item_hpp'] 	= $this->input->post("item_hpp");



		$msg_success = array('action' => 'refresh');
		
	
	
		$required =  array("Nama" => $data['item_name'],"Satuan" => $data['unit_id'], "Harga Item" => $data['item_price'],"Harga HPP"=>$data['item_hpp'], "Kategori Item"=>$data['category_id']);


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
			$this->db->where("item_id", $data['item_id']);
			$query = $this->db->update("pos_item", $data);
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