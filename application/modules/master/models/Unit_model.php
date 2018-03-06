<?php 

/**
* 
*/
class Unit_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function view_all(){

		$requestData= $_REQUEST;
		$array = array('is_deleted' => 0);
		$this->db->order_by("unit_id","DESC");
		$this->db->limit($requestData['length'],$requestData['start']);
		$ex =  $this->db->get_where("pos_unit", $array);
		$query = $ex->result_array();

		$totalFiltered = $this->db->get_where("pos_unit",$array)->num_rows();

		if( !empty($requestData['search']['value']) ) {

			$src = $requestData['search']['value'];
		    // if there is a search parameter
		    $this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("unit_name",$src);
		  
		    $d = $this->db->get_where("pos_unit",$array);
		    $query = $d->result_array();
		    $totalFiltered = count($query);
		   
		    
		} 
		elseif( !empty($requestData['order'][0]['column']) ){    
		    $this->db->limit($requestData['length'],$requestData['start']);
			$this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
	
			$d = $this->db->get_where("pos_unit",$array);
		    $query = $d->result_array();
		    
		}




		$data = array();
		foreach ($query as $key => $row) {
			$nestedData=array(); 
		    
			$i = $key+1;
			if ($requestData['start'] > 1) {

				$i = $requestData['length'] * $requestData['start'] + $key;
				
			}
	    	$nestedData[] = $i.'<input class="unit_id" type="hidden" value="'.$row['unit_id'].'">';;
	    	$nestedData[] = $row['unit_name'].'<input class="unit_name" type="hidden" value="'.$row['unit_name'].'">';
	    	$nestedData[] = $row['created_by'].'<input class="created_by" type="hidden" value="'.$row['created_by'].'">';
	    	$nestedData[] = $row['created'].'<input class="created" type="hidden" value="'.$row['created'].'">';
	    	$nestedData[] = '<button data-target="#modal2" data-toggle="modal" class="btn btn-info btn-sm btn-edit"><span class="glyphicon glyphicon-pencil"></span></button>

	    	<a href="'.base_url()."master/unit/delete_unit/".$row['unit_id'].'" class="btn-delete"><button class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button></a>';
	    	
		    /*
			End
		    */

		    $data[] = $nestedData;
			}


		    $json_data = array(
            "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal"    => intval( $totalFiltered ),  // total number of records
            "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );


			return json_encode($json_data);  // send data as json format
	}



}
