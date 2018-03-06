<?php
/**
* 
*/
class Stock_card_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function get_stock(){
		$requestData = $_REQUEST;

		$store_id = $requestData['store_id'];
		$trx_date = $requestData['trx_date'];

		if (!empty($trx_date)) {

			$array = array("pos_stock_rekap.store_id" => $store_id, "pos_stock_rekap.trx_date" => $trx_date);
			
		}
		else{
			$array = array("pos_stock_rekap.store_id" => $store_id);
		}




		if( !empty($requestData['search']) ) {

			$src = $requestData['search'];
		    // if there is a search parameter
		    $this->db->order_by("sr_id","DESC");
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("pos_item.item_name",$src);
		    $this->db->join("pos_item","pos_stock_rekap.item_id = pos_item.item_id", "LEFT");
			$this->db->join("pos_store","pos_store.store_id = pos_stock_rekap.store_id", "LEFT");
			$this->db->join("pos_unit","pos_unit.unit_id = pos_stock_rekap.unit_id", "LEFT");
		    $d = $this->db->get_where("pos_stock_rekap", $array);
		    $query = $d->result_array();

		    
		    $this->db->like("pos_item.item_name",$src);
		    $this->db->join("pos_item","pos_stock_rekap.item_id = pos_item.item_id", "LEFT");
			$this->db->join("pos_store","pos_store.store_id = pos_stock_rekap.store_id", "LEFT");
			$this->db->join("pos_unit","pos_unit.unit_id = pos_stock_rekap.unit_id", "LEFT");
		    $totalFiltered = $this->db->get_where("pos_stock_rekap", $array)->num_rows();
		} 
		else{
			$this->db->order_by("pos_stock_rekap.sr_id","DESC");
			$this->db->join("pos_item","pos_stock_rekap.item_id = pos_item.item_id", "LEFT");
			$this->db->join("pos_store","pos_store.store_id = pos_stock_rekap.store_id", "LEFT");
			$this->db->join("pos_unit","pos_unit.unit_id = pos_stock_rekap.unit_id", "LEFT");
			$this->db->limit($requestData['length'],$requestData['start']);
			$ex =  $this->db->get_where("pos_stock_rekap", $array);
			$query = $ex->result_array();
			
			$totalFiltered = $this->db->get_where("pos_stock_rekap", $array)->num_rows();
		}


		$data = [];
		foreach ($query as $key => $value) {
			$nested = [];

			
			
			$nested[] = $value['item_name'];
			$nested[] = $value['store_name'];
			$nested[] = $value['trx_date'];
			$nested[] = $value['total_stock_in'];
			$nested[] = $value['total_stock_out'];
			$nested[] = $value['total_stock'];
			$nested[] = $value['unit_name'].'<a class="init" href="'.base_url()."inventory/stock_card/detail?init_date=".$value['trx_date']."&init_store=".$value['store_id'].'&get_item_name='.$value['item_name'].'">';

			
			$data[] = $nested;
		}

		$json = array('data' => $data,'total' => $totalFiltered,'start' => $requestData['start']);
		return json_encode($json);
	}


	public function get_detail(){
		$requestData = $_REQUEST;

		$store_id = $requestData['store_id'];
		$trx_date = $requestData['trx_date'];

		if (!empty($trx_date)) {

			$array = array("pos_stock.store_id" => $store_id, "pos_stock.trx_date" => $trx_date, "pos_stock_flow.is_temp" => 0);
			
		}
		else{
			$array = array("pos_stock.store_id" => $store_id , "pos_stock_flow.is_temp" => 0);
		}

			


		if( !empty($requestData['search']) ) {

			$src = $requestData['search'];
		    // if there is a search parameter
		    $this->db->order_by("stock_id","DESC");
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("pos_item.item_name",$src);
		    $this->db->join("pos_item","pos_stock.item_id = pos_item.item_id", "LEFT");
			$this->db->join("pos_store","pos_store.store_id = pos_stock.store_id", "LEFT");
			$this->db->join("pos_unit","pos_unit.unit_id = pos_stock.unit_id", "LEFT");
			$this->db->join("pos_stock_flow","pos_stock_flow.ref_id = pos_stock.ref_id", "RIGHT");
		    $d = $this->db->get_where("pos_stock", $array);
		    $query = $d->result_array();

		    $this->db->like("pos_item.item_name",$src);
		    $this->db->join("pos_item","pos_stock.item_id = pos_item.item_id", "LEFT");
			$this->db->join("pos_store","pos_store.store_id = pos_stock.store_id", "LEFT");
			$this->db->join("pos_unit","pos_unit.unit_id = pos_stock.unit_id", "LEFT");
			$this->db->join("pos_stock_flow","pos_stock_flow.ref_id = pos_stock.ref_id", "RIGHT");
			$totalFiltered = $this->db->get_where("pos_stock", $array)->num_rows();

		    
		}else{
			$this->db->order_by("pos_stock.stock_id","DESC");
			$this->db->join("pos_item","pos_stock.item_id = pos_item.item_id", "LEFT");
			$this->db->join("pos_store","pos_store.store_id = pos_stock.store_id", "LEFT");
			$this->db->join("pos_unit","pos_unit.unit_id = pos_stock.unit_id", "LEFT");
			$this->db->join("pos_stock_flow","pos_stock_flow.ref_id = pos_stock.ref_id", "RIGHT");
			$this->db->limit($requestData['length'],$requestData['start']);
			$ex =  $this->db->get_where("pos_stock", $array);
			$query = $ex->result_array();


			$this->db->join("pos_item","pos_stock.item_id = pos_item.item_id", "LEFT");
			$this->db->join("pos_store","pos_store.store_id = pos_stock.store_id", "LEFT");
			$this->db->join("pos_unit","pos_unit.unit_id = pos_stock.unit_id", "LEFT");
			$this->db->join("pos_stock_flow","pos_stock_flow.ref_id = pos_stock.ref_id", "RIGHT");
			$totalFiltered = $this->db->get_where("pos_stock", $array)->num_rows();
		}


		$data = [];
		foreach ($query as $key => $value) {
			$nested = [];

			
			
			$nested[] = $value['store_name'];
			$nested[] = $value['item_name'];
			$nested[] = $value['trx_qty'];
			$nested[] = $value['trx_date']." ".$value['trx_time'];
			$nested[] = $value['trx_nominal'];
			$nested[] = $value['trx_hpp'];
			$nested[] = $value['trx_type'];;
			$nested[] = $value['ref_data'];
		

			
			$data[] = $nested;
		}

		$json = array('data' => $data,'total' => $totalFiltered,'start' => $requestData['start']);
		return json_encode($json);
	}


}