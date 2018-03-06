<?php 

/**
* 
*/
class User_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function view_all(){

		$requestData= $_REQUEST;
		$array = array('apps_users.is_deleted' => 0);
		$this->db->select("apps_users.* , pos_store.store_name , apps_jabatan.jabatan_name , apps_shift.shift_name");
		$this->db->join("pos_store","pos_store.store_id = apps_users.store_id","LEFT");
		$this->db->join("apps_shift","apps_shift.shift_id = apps_users.shift_id","LEFT");
		$this->db->join("apps_jabatan","apps_jabatan.jabatan_id = apps_users.jabatan_id","LEFT");
		$this->db->limit($requestData['length'],$requestData['start']);
		$ex =  $this->db->get_where("apps_users", $array);
		$query = $ex->result_array();

		$totalFiltered = $this->db->get_where("apps_users",$array)->num_rows();

		if( !empty($requestData['search']['value']) ) {

			$src = $requestData['search']['value'];
		    // if there is a search parameter
		    $this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("apps_users.first_name",$src);
		  
		  	$this->db->select("apps_users.* , pos_store.store_name , apps_jabatan.jabatan_name , apps_shift.shift_name");
			$this->db->join("pos_store","pos_store.store_id = apps_users.store_id","LEFT");
			$this->db->join("apps_shift","apps_shift.shift_id = apps_users.shift_id","LEFT");
			$this->db->join("apps_jabatan","apps_jabatan.jabatan_id = apps_users.jabatan_id","LEFT");
		    $d = $this->db->get_where("apps_users",$array);
		    $query = $d->result_array();
		    $totalFiltered = count($query);
		   
		    
		} 
		elseif( !empty($requestData['order'][0]['column']) ){    
		    $this->db->limit($requestData['length'],$requestData['start']);
			$this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
			
			$this->db->select("apps_users.* , pos_store.store_name , apps_jabatan.jabatan_name , apps_shift.shift_name");
			$this->db->join("pos_store","pos_store.store_id = apps_users.store_id","LEFT");
			$this->db->join("apps_shift","apps_shift.shift_id = apps_users.shift_id","LEFT");
			$this->db->join("apps_jabatan","apps_jabatan.jabatan_id = apps_users.jabatan_id","LEFT");


			$d = $this->db->get_where("apps_users",$array);
		    $query = $d->result_array();
		    
		}




		$data = array();
		foreach ($query as $key => $row) {
			$nestedData=array(); 
		    
			$i = $key+1;
			if ($requestData['start'] > 1) {

				$i = $requestData['length'] * $requestData['start'] + $key;
				
			}
	    	$nestedData[] = '<img style="width:50px;" class"img-fluid rounded-circle" src="'.base_url()."assets/img/".$row['avatar'].'">'.'<input class="avatar" type="hidden" value="'.$row['avatar'].'">'.'<input class="user_id" type="hidden" value="'.$row['user_id'].'">';
	    	$nestedData[] = $row['first_name'].'<input class="first_name" type="hidden" value="'.$row['first_name'].'">';
	    	$nestedData[] = $row['username'].'<input class="username" type="hidden" value="'.$row['username'].'">';
	    	$nestedData[] = $row['store_name'].'<input class="store_id" type="hidden" value="'.$row['store_id'].'">';
	    	$nestedData[] = $row['jabatan_name'].'<input class="jabatan_id" type="hidden" value="'.$row['jabatan_id'].'">';
	    	$nestedData[] = $row['shift_name'].'<input class="shift_id" type="hidden" value="'.$row['shift_id'].'">';
	    	$nestedData[] = '<button data-target="#modal2" data-toggle="modal" class="btn btn-info btn-sm btn-edit"><span class="glyphicon glyphicon-pencil"></span></button>

	    	<a href="'.base_url()."master/user/delete_user/".$row['user_id'].'" class="btn-delete"><button class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button></a>';
	    	
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
