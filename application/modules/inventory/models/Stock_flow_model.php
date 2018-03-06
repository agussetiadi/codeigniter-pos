<?php 

/**
* 
*/
class Stock_flow_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function get_item_in(){

		$requestData = $_REQUEST;

		$store_id = $requestData['store_id'];
		$trx_date = $requestData['trx_date'];

		if (!empty($trx_date)) {

			$array = array('pos_stock_flow.trx_type' => 'in' , "pos_stock_flow.store_id" => $store_id, "pos_stock_flow.date_input" => $trx_date);
			
		}
		else{
			$array = array('pos_stock_flow.trx_type' => 'in' , "pos_stock_flow.store_id" => $store_id);
		}



		if( !empty($requestData['search']) ) {

			$src = $requestData['search'];
		    // if there is a search parameter
		    $this->db->order_by("pos_stock_flow.ref_id","DESC");
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("pos_stock_flow.ref_data",$src);
			$this->db->join("pos_store","pos_store.store_id = pos_stock_flow.store_id","LEFT");
			$d =  $this->db->get_where("pos_stock_flow", $array);
		    $query = $d->result_array();


		    $this->db->like("pos_stock_flow.ref_data",$src);
			$this->db->join("pos_store","pos_store.store_id = pos_stock_flow.store_id","LEFT");
		    $totalFiltered = $this->db->get_where("pos_stock_flow", $array)->num_rows();
		} 
		else{
			$this->db->order_by("pos_stock_flow.ref_id","DESC");
			$this->db->join("pos_store","pos_store.store_id = pos_stock_flow.store_id","LEFT");
			$this->db->limit($requestData['length'],$requestData['start']);
			$ex =  $this->db->get_where("pos_stock_flow", $array);
			$query = $ex->result_array();

			$totalFiltered = $this->db->get_where("pos_stock_flow", $array)->num_rows();
		}


		$data = [];
		foreach ($query as $key => $value) {
			$nested = [];



			$nested[] = $value['ref_data'];
	    	$nested[] = $value['date_input']." ".$value['time_input'];
	    	
	    	$nested[] = $value['store_name'];
	    	$nested[] = $value['trx_type'];
	    	$nested[] = $value['created_by'].'<input type="hidden" class="init" value="'.$value['ref_id'].'">'.'<input type="hidden" class="init2" value="'.$value['ref_data'].'">';;
			
			$data[] = $nested;
		}

		$json = array('data' => $data,'total' => $totalFiltered,'start' => $requestData['start']);
		return json_encode($json);

	}


	public function get_item_out(){

		$requestData = $_REQUEST;

		$store_id = $requestData['store_id'];
		$trx_date = $requestData['trx_date'];

		if (!empty($trx_date)) {

			$array = array('pos_stock_flow.trx_type' => 'out' , "pos_stock_flow.store_id" => $store_id, "pos_stock_flow.date_input" => $trx_date ,"pos_stock_flow.is_temp" => 0);
			
		}
		else{
			$array = array('pos_stock_flow.trx_type' => 'out' , "pos_stock_flow.store_id" => $store_id, "pos_stock_flow.is_temp" => 0);
		}



		if( !empty($requestData['search']) ) {

			$src = $requestData['search'];
		    // if there is a search parameter
		    $this->db->order_by("pos_stock_flow.ref_id","DESC");
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("pos_stock_flow.ref_data",$src);
			$this->db->join("pos_store","pos_store.store_id = pos_stock_flow.store_id","LEFT");
			$d =  $this->db->get_where("pos_stock_flow", $array);
		    $query = $d->result_array();

		    $this->db->like("pos_stock_flow.ref_data",$src);
			$this->db->join("pos_store","pos_store.store_id = pos_stock_flow.store_id","LEFT");
		    $totalFiltered = $this->db->get_where("pos_stock_flow", $array)->num_rows();
		} 
		else{
			$this->db->order_by("pos_stock_flow.ref_id","DESC");
			$this->db->join("pos_store","pos_store.store_id = pos_stock_flow.store_id","LEFT");
			$this->db->limit($requestData['length'],$requestData['start']);
			$ex =  $this->db->get_where("pos_stock_flow", $array);
			$query = $ex->result_array();

			$totalFiltered = $this->db->get_where("pos_stock_flow", $array)->num_rows();
		}


		$data = [];
		foreach ($query as $key => $value) {
			$nested = [];



			$nested[] = $value['ref_data'];
	    	$nested[] = $value['date_input']." ".$value['time_input'];
	    	
	    	$nested[] = $value['store_name'];
	    	$nested[] = $value['trx_type'];
	    	$nested[] = $value['created_by'].'<input type="hidden" class="init" value="'.$value['ref_id'].'">'.'<input type="hidden" class="init2" value="'.$value['ref_data'].'">';
			
			$data[] = $nested;
		}

		$json = array('data' => $data,'total' => $totalFiltered,'start' => $requestData['start']);
		return json_encode($json);

	}

	public function get_item(){
		$requestData = $_REQUEST;

		$store_id = $requestData['store_id'];

		$array = array('pos_item.is_deleted' => 0);

		$this->db->select("pos_item.* , pos_unit.unit_name , pos_category.category_id , pos_category.category_name");
		$this->db->join("pos_unit","pos_item.unit_id = pos_unit.unit_id", "left");
		$this->db->join("pos_category","pos_item.category_id = pos_category.category_id", "left");


		$ex =  $this->db->get_where("pos_item", $array);
		$query = $ex->result_array();

		$totalFiltered = $this->db->get_where("pos_item",$array)->num_rows();	


		if( !empty($requestData['search']) ) {

			$src = $requestData['search'];
		    // if there is a search parameter
		    $this->db->select("pos_item.* , pos_unit.unit_name , pos_category.category_id , pos_category.category_name");
		    $this->db->like("item_name",$src);
		    $this->db->join("pos_unit","pos_item.unit_id = pos_unit.unit_id", "left");
		    $this->db->join("pos_category","pos_item.category_id = pos_category.category_id", "left");
		    $d = $this->db->get_where("pos_item",$array);
		    $query = $d->result_array();
		    $totalFiltered = count($query);
		   
		    
		} 



		$data = [];
		foreach ($query as $key => $value) {
			$this->db->order_by("sr_id","DESC");
			$get_stock = $this->db->get_where("pos_stock_rekap",array("item_id" => $value['item_id'] , "store_id" => $store_id), 1,0)->row_array();

			$nested = [];

			$nested[] = $key + 1;
			$nested[] = $value['item_name'].'<input type="hidden" class="item_id" value="'.$value['item_id'].'">';;
			$nested[] = $value['category_name'];
			$nested[] = $get_stock['total_stock'] ? : 0;
			$nested[] = $value['unit_name'];
			$nested[] = '<button data-target="#modal2" data-toggle="modal" class="btn btn-default btn-sm act-pilih">Pilih</button>';

			$data[] = $nested;
		}

		$json = array('data' => $data,'total' => $totalFiltered);
		return json_encode($json);
	}

	public function get_detail(){
		$requestData = $_REQUEST;

		$ref_id = $requestData['ref_id'];

		$array = array('pos_stock.ref_id' => $ref_id);

		$this->db->join("pos_unit","pos_stock.unit_id = pos_unit.unit_id", "left");
		$this->db->join("pos_item","pos_stock.item_id = pos_item.item_id", "left");

		$ex =  $this->db->get_where("pos_stock", $array);
		$query = $ex->result_array();

		$totalFiltered = $this->db->get_where("pos_stock",$array)->num_rows();	


		$data = [];
		foreach ($query as $key => $value) {

			$nested = [];

			$nested[] = $key+1;
			$nested[] = $value['item_name'].'<input type="hidden" class="stock_id" value="'.$value['stock_id'].'">';
			$nested[] = $value['trx_nominal'];
			$nested[] = $value['trx_hpp'];
			$nested[] = $value['trx_qty'];
			$nested[] = $value['unit_name'];
			$nested[] = '<a class="cursor-hover b-delete">Delete</a>';


			$data[] = $nested;
		}

		$json = array('data' => $data,'total' => $totalFiltered);
		return json_encode($json);
	}



}