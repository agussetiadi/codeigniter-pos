<?php 

/**
* 
*/
class Stock_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();

	}

	public function stock_report_api(){

		$requestData	= $_REQUEST;
			
		$store_id = $requestData['store_id'];
		$search = $requestData['search'];



		$array = [];
		
		$array['pos_item.is_deleted'] = 0;



		$this->db->limit($requestData['length'],$requestData['start']);
		
		$ex =  $this->db->get_where("pos_item", $array);
		$query = $ex->result_array();

		$this->db->limit($requestData['length'],$requestData['start']);
		$totalFiltered = $this->db->get_where("pos_item",$array)->num_rows();

		if( !empty($requestData['search']) ) {

			$src = $requestData['search'];
		    
			$this->db->limit($requestData['length'],$requestData['start']);
		  	$this->db->like("pos_item.item_name", $src);
		  	$this->db->order_by("pos_item.item_id","DESC");
		  	
		    $d = $this->db->get_where("pos_item",$array);
		    $query = $d->result_array();
		    $totalFiltered = count($query);
		   
		    
		} 



		if (!empty($requestData['date'])) {

			$array2['pos_stock_rekap.trx_date <='] = $requestData['date'];
			
		}

		if ($requestData['store_id'] != 0) {

			$array2['pos_stock_rekap.store_id'] = $requestData['store_id'];
		}



		$data = array();
		foreach ($query as $key => $row) {
			$nestedData = [];

			$array2['item_id'] = $row['item_id'];

			
			$this->db->limit(1,0);
			$this->db->order_by("sr_id","DESC");
			$nm = $this->db->get_where("pos_stock_rekap", $array2);
			$row2 = $nm->row_array();
			$totalStock = $row2['total_stock'];
			if (empty($row2)) {
				$totalStock = 0;
			}

			$row_store = $this->db->get_where("pos_store",array("store_id" => $requestData['store_id']))->row_array();

		    	
		    $nestedData[] = $row_store['store_name'];
		    $nestedData[] = $row['item_name'];
	    	$nestedData[] = $row['item_code'];
	    	$nestedData[] = $row['category_id'];
	    	$nestedData[] = $row['item_price'];
	    	$nestedData[] = $row['item_hpp'];
	    	$nestedData[] = $totalStock;
	    	
		    /*
			End
		    */

		    $data[] = $nestedData;
			}



				
			$json = array('data' => $data,'total' => $totalFiltered);
			return json_encode($json);
	}
}