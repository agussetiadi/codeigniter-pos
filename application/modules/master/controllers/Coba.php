<?php 

/**
* 
*/
class Coba extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index(){
		$field = array("item_id","item_name","item_code","unit_id","category_id");

		$requestData 	= $_REQUEST;

		$getField 		= $requestData['field'];
		$sort 			= $requestData['sort'];

		$search 		= $requestData['search'];

		$length 		= $requestData['length'];
		$start 			= $requestData['start'];

		$this->db->order_by($field[$getField],$sort);
		$this->db->limit($length,$start);

		$ex =  $this->db->get("pos_item");
		$query = $ex->result_array();

		$totalFiltered = $this->db->get("pos_item")->num_rows();	


		if( !empty($search) ) {

		    // if there is a search parameter

		    $this->db->order_by($field[$getField],$sort);
		    $this->db->limit($length,$start);
		    $this->db->like("item_name",$search);
		    $d = $this->db->get("pos_item");
		    $query = $d->result_array();
		    $this->db->like("item_name",$search);
		   	$totalFiltered = $this->db->get("pos_item")->num_rows();
		    
		} 



		$data = [];
		foreach ($query as $key => $value) {
			$nested = [];

			$nested[] = $key + 1;
			$nested[] = $value['item_name'];
			$nested[] = $value['item_code'];
			$nested[] = $value['unit_id'];
			$nested[] = $value['category_id'];
			

			$data[] = $nested;
		}

		$json = array('data' => $data,'total' => $totalFiltered);
		echo json_encode($json);

	}

}

?>