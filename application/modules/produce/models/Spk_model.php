<?php 

/**
* 
*/
class Spk_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}

	private $row;

	public function get_user(){
		$user_id = $this->session_data->user_id();
		$row = $this->db->get_where("apps_users",array('user_id' => $user_id))->row_array();
		$this->row = $row;
	}

	public function list_come_server(){

		$this->get_user();
		$jabatan_id = $this->row['jabatan_id'];

		$requestData = $_REQUEST;

		

		$store_id = $requestData['store_id'];
		$chk = $requestData['chk'];

		if ($chk == "true") {
			$status = "pending";
		}
		else{
			$status = "done";	
		}


		$array = array("pos_spk.status" => $status, "pos_spk.store_id" => $store_id,"jabatan_id" => $jabatan_id);


			

		if( !empty($requestData['search']) ) {

			$src = $requestData['search'];
		    // if there is a search parameter
		    $this->db->order_by("billing_id","DESC");
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("customer_name",$src);
		    
		    $this->db->select("pos_spk.* ,pos_billing.customer_name , pos_billing.billing_notes , pos_billing.created_by,pos_billing.no_loket");
			$this->db->join("pos_billing", "pos_spk.billing_id = pos_billing.billing_id");
		    $d = $this->db->get_where("pos_spk", $array);
		    $query = $d->result_array();
		    $totalFiltered = count($query); 
		} 
		else{
			$this->db->order_by("billing_id","DESC");
			$this->db->limit($requestData['length'],$requestData['start']);
			$this->db->select("pos_spk.* ,pos_billing.customer_name , pos_billing.billing_notes , pos_billing.created_by,pos_billing.no_loket");
			$this->db->join("pos_billing", "pos_spk.billing_id = pos_billing.billing_id","LEFT");
			$ex =  $this->db->get_where("pos_spk", $array);
			$query = $ex->result_array();

			$this->db->select("pos_spk.* ,pos_billing.customer_name , pos_billing.billing_notes");
			$this->db->join("pos_billing", "pos_spk.billing_id = pos_billing.billing_id");
			$totalFiltered = $this->db->get_where("pos_spk", $array)->num_rows();
		}

		if ($status == "pending") {
			$btn = '<button class="btn btn-info btn-sm btn-edit btn-process-spk">Proses</span></button> <button class="btn btn-primary btn-sm btn-edit btn-view-spk">Lihat</span></button>';
		}
		else{
			$btn = '<button class="btn btn-primary btn-sm btn-edit btn-view-spk">Lihat</span></button>';
		}


		$data = [];

		foreach ($query as $key => $value) {

			

			$nested = [];

			
			$nested[] = $value['customer_name'].'<input type="hidden" class="spk_id" value="'.$value['spk_id'].'">';
			$nested[] = $value['date_in'];
			$nested[] = $value['billing_notes'];
			$nested[] = $value['no_loket'];
			$nested[] = $value['created_by'];
			
			$nested[] = $btn;

			
			$data[] = $nested;
		}

		$json = array('data' => $data,'total' => $totalFiltered,'start' => $requestData['start']);
		return json_encode($json);
	}


}