<?php 

/**
* 
*/
class Stock_flow extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library("template");
		$this->load->model("stock_flow_model");
	}

	public function index(){
		
	}
	public function item_in(){
		$data['item'] = $this->db->get_where("pos_item", array("is_deleted" => 0));
		$data['unit'] = $this->db->get_where("pos_unit", array("is_deleted" => 0));
		$data['sesi'] = $this->input->get("init_store") ? : $this->session->userdata("store_id");
		$data['get_store'] = $this->db->get_where("pos_store", array("is_deleted"=> "0"));
		$data['page']	= 'item_in';
		$this->template->get($data);
	}
	public function item_out(){
		$data['item'] = $this->db->get_where("pos_item", array("is_deleted" => 0));
		$data['unit'] = $this->db->get_where("pos_unit", array("is_deleted" => 0));
		$data['sesi'] = $this->input->get("init_store") ? : $this->session->userdata("store_id");
		$data['get_store'] = $this->db->get_where("pos_store", array("is_deleted"=> "0"));
		$data['page']	= 'item_out';
		$this->template->get($data);
	}

	public function get_item_in(){
		echo $this->stock_flow_model->get_item_in();
	}
	public function get_item_out(){
		echo $this->stock_flow_model->get_item_out();
	}
	public function add(){
		$data['sesi'] = $this->input->get("store") ? : "1";
		$data['get_store'] = $this->db->get_where("pos_store", array("is_deleted"=> "0"));
		$data['init'] = $this->input->get("init") ? : "out";
		$data['page'] = 'stock_flow_add';
		$this->template->get($data);
	}

	public function get_detail(){
		echo $this->stock_flow_model->get_detail();
	}

	public function get_item(){

		echo $this->stock_flow_model->get_item();
	}

	public function add_stock_detail(){
		$item_id = $this->input->post("item_id");
		$trx_qty = $this->input->post("trx_qty");
		$ref_id = $this->input->post("ref_id");
		$store_id = $this->input->post("store_id");

		$ref_data = $this->input->post("ref_data");
		if (empty($ref_data)) {

			$trx_type = $this->input->post("trx_type");
			if ($trx_type == "out") {
				$ref_data = "OT".time();
			}
			else{
				$ref_data = "IN".time();	
			}
			
		}


		if (empty($ref_id)) {
			$trx_date = date("Y-m-d");
			$trx_time = date("H:i:s");
			$this->db->order_by("ref_id","DESC");
			$query = $this->db->get("pos_stock_flow",1,0) -> row_array();

			$ref_id = $query['ref_id'] + 1;

			$ref_data = $ref_data;

			$this->db->insert("pos_stock_flow", array("ref_id" => $ref_id , 
							"date_input" => $trx_date , 
							"time_input" => $trx_time , 
							"ref_data" => $ref_data ,
							"is_temp" => 1 , 
							"created_by" => $this->session->userdata("first_name")));
		}
		else{
			$q_flow = $this->db->get_where("pos_stock_flow", array("ref_id" => $ref_id))->row_array();
			$ref_data = $q_flow['ref_data'];

		}




		$query_item = $this->db->get_where("pos_item", array("item_id" => $item_id))->row_array();
		$item_hpp = $query_item['item_hpp'];
		$trx_hpp = $query_item['item_hpp'];
		$trx_date = date("Y-m-d");
		$trx_time = date("H:i:s");
		$unit_id  = $query_item['unit_id'];

		$array_input = array("item_id" => $item_id,
							"trx_hpp" => $trx_hpp,
							"trx_date" => $trx_date,
							"trx_time" => $trx_time,
							"trx_qty" => $trx_qty,
							"unit_id" => $unit_id,
							"ref_id" => $ref_id,
							"store_id" => $store_id
				 			);

		$query_input = $this->db->insert("pos_stock", $array_input);

		if ($query_input) {
			$arrayJson = array("status" => "success", "ref_id" => $ref_id , "ref_data" => $ref_data);
			echo json_encode($arrayJson);
		}
	}

	public function stock_delete(){
		$stock_id = $this->input->post("stock_id");

		$ref_id = $this->input->post("ref_id");

		$check_temp = $this->db->get_where("pos_stock_flow", array('ref_id' =>$ref_id ))->row_array();

		$status_temp = $check_temp['is_temp'];

		if ($status_temp == 1) {

			$query = $this->db->delete("pos_stock", array("stock_id" => $stock_id));

			if ($query) {
				$jsonData = array("status" => "success");
			}
			
		}
		else{
			$jsonData = array("status" => "success");
		}

		echo json_encode($jsonData);





	}

	public function save_trx(){
		$store_id = $this->input->post("store_id");
		$ref_id = $this->input->post("ref_id");
		$trx_type = $this->input->post("trx_type");
		$ref_data = $this->input->post("ref_data");
		$date_modified = date("Y-m-d");
		$time_modified = date("H:i:s");
		$is_temp = 0;


		/*if ($trx_type == "out") {
			$ref_data = "OT".time();
			$artm = "-";
		}
		else{
			$ref_data = "IN".time();
		}*/


		$array_update = array("store_id" => $store_id , 
							  "trx_type" => $trx_type,
							  "date_modified" => $date_modified,
							  "time_modified" => $time_modified,
							  "is_temp" => $is_temp,
							  "trx_type" => $trx_type,
							  "ref_data" => $ref_data,
							  );
		$this->db->where("ref_id", $ref_id);
		$this->db->update("pos_stock_flow", $array_update);

		$get_stock = $this->db->get_where("pos_stock", array("ref_id" => $ref_id));

		foreach ($get_stock->result_array() as $key => $value) {
			$item_id = $value['item_id'];
			$trx_qty = $value['trx_qty'];
			$unit_id = $value['unit_id'];

			$check_stock = $this->db->get_where("pos_stock_rekap", array("store_id" => $store_id,
									"trx_date" => $date_modified,"item_id" => $item_id),1,0);


			if ($check_stock->num_rows() > 0) {
				$q_stock 	= $check_stock->row_array();
				$sr_id 		= $q_stock['sr_id'];
				$stock_old 	= $q_stock['total_stock'];


				if ($trx_type == "out") {
					$total_stock  = $stock_old - $trx_qty;
					$stock_out	= $q_stock['total_stock_out'] + $trx_qty;
					$array = array("total_stock" => $total_stock,"total_stock_out" => $stock_out);
				}
				else{
					$total_stock  = $stock_old + $trx_qty;
					$stock_in	= $q_stock['total_stock_in'] + $trx_qty;
					$array = array("total_stock" => $total_stock,"total_stock_in" => $stock_in);
				}

				$this->db->where("sr_id",$sr_id);
				$this->db->update("pos_stock_rekap", $array);
			}
			else{
				$this->db->order_by("sr_id","DESC");
				$check_stock = $this->db->get_where("pos_stock_rekap", array("store_id" => $store_id,"item_id" => $item_id),1,0);
				$q_stock 	= $check_stock->row_array();
				$sr_id 		= $q_stock['sr_id'];
				$stock_old 	= $q_stock['total_stock'];


				if ($trx_type == "out") {
					$total_stock  = $stock_old - $trx_qty;
					$stock_out = $trx_qty;
					$stock_in = 0;

					
				}
				else{
					$total_stock  = $stock_old + $trx_qty;
					$stock_out = 0;
					$stock_in = $trx_qty;
				}

				$array = array("item_id" => $item_id,
								"total_stock" => $total_stock,
								"total_stock_out" => $stock_out,
								"total_stock_in" => $stock_in,
								"store_id" => $store_id,
								"unit_id" => $unit_id,
								"trx_date" => $date_modified);
				$this->db->insert("pos_stock_rekap", $array);
			}


		}







	}


}