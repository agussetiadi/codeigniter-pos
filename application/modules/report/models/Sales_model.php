<?php 

/**
* 
*/
class Sales_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();

	}

	public function sales_report_api(){

		$requestData	= $_REQUEST;
			
		$store_id = $requestData['store_id'];
		$search = $requestData['search'];



		$array = [];
		if (!empty($requestData['dateStart'])) {
			$array = array("pos_billing.date_created >" => $requestData['dateStart'],"pos_billing.date_created <" => $requestData['dateEnd']);
		}


		if ($store_id != 0) {
			$array['pos_billing.store_id'] = $store_id;
		}
		


		$this->db->join("pos_store", "pos_store.store_id = pos_billing.store_id","INNER");
		$this->db->limit($requestData['length'],$requestData['start']);
		$this->db->order_by("pos_billing.billing_id","DESC");
		$ex =  $this->db->get_where("pos_billing", $array);
		$query = $ex->result_array();

		$totalFiltered = $this->db->get_where("pos_billing",$array)->num_rows();

		if( !empty($requestData['search']) ) {

			$src = $requestData['search'];
		    
		    $this->db->join("pos_store", "pos_store.store_id = pos_billing.store_id","INNER");
		    $this->db->limit($requestData['length'],$requestData['start']);
		  	$this->db->like("billing_no", $src);
		  	$this->db->or_like("customer_name", $src);
		  	$this->db->order_by("pos_billing.billing_id","DESC");
		  	
		    $d = $this->db->get_where("pos_billing",$array);
		    $query = $d->result_array();
		    $totalFiltered = count($query);
		   
		    
		} 




		$data = array();
		foreach ($query as $key => $row) {
			$nestedData = [];
		    	
		    	if ($row['is_dp'] == 1) {
		    		$dp = "Ya";
		    	}
		    	else{
		    		$dp = "Tidak";
		    	}

		    	if ($row['paid_off'] == 1) {
		    		$paid_off = "Lunas";
		    	}
		    	else{
		    		$paid_off = "Belum Lunas";
		    	}


		    $nestedData[] = $row['billing_no'];
		    $nestedData[] = $row['store_name'];
	    	$nestedData[] = $row['customer_name'];
	    	$nestedData[] = $dp;
	    	$nestedData[] = $paid_off;
	    	$nestedData[] = $row['total_hpp'];
	    	$nestedData[] = $row['grand_total'];
	    	$nestedData[] = $row['created_by'];
	    	$nestedData[] = "";
	    	
		    /*
			End
		    */

		    $data[] = $nestedData;
			}



				
			$json = array('data' => $data,'total' => $totalFiltered);
			return json_encode($json);
	}
}