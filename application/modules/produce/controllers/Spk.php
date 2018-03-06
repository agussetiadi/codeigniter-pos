<?php 

/**
* 
*/
class Spk extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library("template");
		$this->load->model("spk_model");
	}
	public function index(){
		$store_id = $this->session->userdata("store_id");
		$store = $this->get_store($store_id);
		$data['store_name'] = $store['store_name'];
		$data['q_store'] = $this->db->get_where("pos_store", array("is_deleted" => 0));
		$data['store_id'] = $store_id;
		$data['jabatan'] = $this->db->get_where("apps_jabatan", array("is_deleted" => 0));
		$data['page'] = "list_come";
		$this->template->get($data);
	}

	private function get_store($store_id){
		$query = $this->db->get_where("pos_store", array("store_id" => $store_id));
		return $query->row_array();
	}

	public function list_come_server(){
		echo $this->spk_model->list_come_server();
	}

	public function status_update(){
		$spk_id = $this->input->post("spk_id");
		$array = array("status" => "done");
		$this->db->where("spk_id",$spk_id);
		$query = $this->db->update("pos_spk", $array);
		if ($query) {
			echo json_encode(array("status" => "success"));
		}

	}

	public function get_detail(){
		
	}

}


?>