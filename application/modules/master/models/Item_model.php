<?php 

/**
* 
*/
class Item_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function view_all(){

		$requestData= $_REQUEST;
		$array = array('pos_item.is_deleted' => 0);
		$this->db->order_by("pos_item.item_id","DESC");
		$this->db->limit($requestData['length'],$requestData['start']);
		$this->db->join("pos_unit","pos_item.unit_id = pos_unit.unit_id", "left");
		$this->db->join("pos_category","pos_item.category_id = pos_category.category_id", "left");
		$ex =  $this->db->get_where("pos_item", $array);
		$query = $ex->result_array();

		$totalFiltered = $this->db->get_where("pos_item",$array)->num_rows();

		if( !empty($requestData['search']['value']) ) {

			$src = $requestData['search']['value'];
		    // if there is a search parameter
		    $this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("item_name",$src);
		    $this->db->or_like("item_code",$src);
		    $this->db->join("pos_unit","pos_item.unit_id = pos_unit.unit_id", "left");
		    $this->db->join("pos_category","pos_item.category_id = pos_category.category_id", "left");
		    $d = $this->db->get_where("pos_item",$array);
		    $query = $d->result_array();
		    $totalFiltered = count($query);
		   
		    
		} 
		elseif( !empty($requestData['order'][0]['column']) ){    
		    $this->db->limit($requestData['length'],$requestData['start']);
			$this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
			$this->db->join("pos_unit","pos_item.unit_id = pos_unit.unit_id", "left");
			$this->db->join("pos_category","pos_item.category_id = pos_category.category_id", "left");
			$d = $this->db->get_where("pos_item",$array);
		    $query = $d->result_array();
		    
		}




		$data = array();
		foreach ($query as $key => $row) {
			$nestedData=array(); 
		    
			$i = $key+1;
			if ($requestData['start'] > 1) {

				$i = $requestData['length'] * $requestData['start'] + $key;
				
			}
	    	$nestedData[] = $i.'<input class="item_id" type="hidden" value="'.$row['item_id'].'">';;
	    	$nestedData[] = $row['item_name'].'<input class="item_name" type="hidden" value="'.$row['item_name'].'">';
	    	$nestedData[] = $row['unit_name'].'<input class="unit_id" type="hidden" value="'.$row['unit_id'].'">';
	    	$nestedData[] = $row['category_name'].'<input class="item_code" type="hidden" value="'.$row['item_code'].'">'.'<input class="category_id" type="hidden" value="'.$row['category_id'].'">';
	    	$nestedData[] = $row['item_desc'].'<input class="item_desc" type="hidden" value="'.$row['item_desc'].'">';
	    	$nestedData[] = $row['item_price'].'<input class="item_price" type="hidden" value="'.$row['item_price'].'">';
	    	$nestedData[] = $row['item_hpp'].'<input class="item_hpp" type="hidden" value="'.$row['item_hpp'].'">';
	    	$nestedData[] = '<button data-target="#modal2" data-toggle="modal" class="btn btn-info btn-sm btn-edit"><span class="glyphicon glyphicon-pencil"></span></button>

	    	<a href="'.base_url()."master/item/delete_item/".$row['item_id'].'" class="btn-delete"><button class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button></a>';
	    	
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
