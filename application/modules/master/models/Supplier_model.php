<?php 

/**
* 
*/
class Supplier_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function view_all(){

		$requestData= $_REQUEST;
		$array = array('is_deleted' => 0);
		
		
		$this->db->limit($requestData['length'],$requestData['start']);
		$ex =  $this->db->get_where("pos_supplier", $array);
		$query = $ex->result_array();

		$totalFiltered = $this->db->get_where("pos_supplier",$array)->num_rows();

		if( !empty($requestData['search']['value']) ) {

			$src = $requestData['search']['value'];
		    // if there is a search parameter
		    
			
		    $this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("supplier_name",$src);
		  
		    $d = $this->db->get_where("pos_supplier",$array);
		    $query = $d->result_array();
		    $totalFiltered = count($query);
		   
		    
		} 
		elseif( !empty($requestData['order'][0]['column']) ){    
			
			
		    $this->db->limit($requestData['length'],$requestData['start']);
			$this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
	
			$d = $this->db->get_where("pos_supplier",$array);
		    $query = $d->result_array();
		    
		}




		$data = array();
		foreach ($query as $key => $row) {
			$nestedData=array(); 
		    
			$i = $key+1;
			if ($requestData['start'] > 1) {

				$i = $requestData['length'] * $requestData['start'] + $key;
				
			}
	    	$nestedData[] = $i.'<input class="supplier_id" type="hidden" value="'.$row['supplier_id'].'">';;
	    	$nestedData[] = $row['supplier_name'].'<input class="supplier_name" type="hidden" value="'.$row['supplier_name'].'">';
	    	$nestedData[] = $row['supplier_contact'].'<input class="supplier_contact" type="hidden" value="'.$row['supplier_contact'].'">';
	    	$nestedData[] = $row['supplier_address'].'<input class="supplier_address" type="hidden" value="'.$row['supplier_address'].'">';
	    	$nestedData[] = $row['supplier_phone'].'<input class="supplier_phone" type="hidden" value="'.$row['supplier_phone'].'">';
	    	$nestedData[] = $row['supplier_fax'].'<input class="supplier_fax" type="hidden" value="'.$row['supplier_fax'].'">';
	    	$nestedData[] = '<button data-target="#modal2" data-toggle="modal" class="btn btn-info btn-sm btn-edit"><span class="glyphicon glyphicon-pencil"></span></button>

	    	<a href="'.base_url()."master/supplier/delete_supplier/".$row['supplier_id'].'" class="btn-delete"><button class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button></a>';
	    	
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
