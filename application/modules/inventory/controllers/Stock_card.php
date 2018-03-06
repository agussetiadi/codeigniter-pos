<?php

/**
* 
*/
class Stock_card extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library("template");
		$this->load->model("stock_card_model");
	}
	public function index(){
		$data['get_item'] = $this->db->get_where("pos_item", array("is_deleted" => "0"));
		$data['get_store'] = $this->db->get_where("pos_store", array("is_deleted"=> "0"));
		$data['page'] = 'stock_card';
		$data['dateNow'] = date("Y-m-d");
		$data['sesi'] = $this->session->userdata("user_session");
		$this->template->get($data);

	}
	public function get_stock(){
		echo $this->stock_card_model->get_stock();
	}
	public function detail(){


		$data['get_item_name'] = $this->input->get("get_item_name") ? : "";
		$data['get_item'] = $this->db->get_where("pos_item", array("is_deleted" => "0"));
		$data['get_store'] = $this->db->get_where("pos_store", array("is_deleted"=> "0"));
		$data['dateNow'] = $this->input->get("init_date") ? : "";
		$data['page']	= 'stock_flow';

		$data['sesi'] = $this->input->get("init_store") ? : $this->session->userdata("user_session");
		$this->template->get($data);
	}
	public function get_detail(){
		echo $this->stock_card_model->get_detail();	
	}

}	