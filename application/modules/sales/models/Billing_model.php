<?php 


/**
* 
*/
class Billing_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}


	public function view_all(){

		
	}


	public function get_table(){

		$requestData = $_REQUEST;


		$array = array('pos_item.is_deleted' => 0);

		



		if( !empty($requestData['search']['value']) ) {

			$src = $requestData['search']['value'];
		    // if there is a search parameter
		    $this->db->select("pos_item.* , pos_unit.unit_name , pos_category.category_id , pos_category.category_name");
		    $this->db->like("item_name",$src);
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->join("pos_unit","pos_item.unit_id = pos_unit.unit_id", "left");
		    $this->db->join("pos_category","pos_item.category_id = pos_category.category_id", "left");
			$query = $this->db->get_where("pos_item",$array)->result_array();



			$this->db->select("pos_item.* , pos_unit.unit_name , pos_category.category_id , pos_category.category_name");
		    $this->db->like("item_name",$src);
		    $this->db->join("pos_unit","pos_item.unit_id = pos_unit.unit_id", "left");
		    $this->db->join("pos_category","pos_item.category_id = pos_category.category_id", "left");
		    $this->db->like("unit_name",$src);
		    $totalFiltered = $this->db->get_where("pos_item",$array)->num_rows();
		    
		}
		else{
			$this->db->select("pos_item.* , pos_unit.unit_name , pos_category.category_id , pos_category.category_name");
			$this->db->join("pos_unit","pos_item.unit_id = pos_unit.unit_id", "left");
			$this->db->join("pos_category","pos_item.category_id = pos_category.category_id", "left");
			$this->db->limit($requestData['length'],$requestData['start']);
			$query = $this->db->get_where("pos_item",$array)->result_array();

			$this->db->select("pos_item.* , pos_unit.unit_name , pos_category.category_id , pos_category.category_name");
			$this->db->join("pos_unit","pos_item.unit_id = pos_unit.unit_id", "left");
			$this->db->join("pos_category","pos_item.category_id = pos_category.category_id", "left");
			$totalFiltered = $this->db->get_where("pos_item",$array)->num_rows();
		}



		$data = [];
		foreach ($query as $key => $value) {
			$nested = [];

			$this->db->order_by("trx_date","DESC");
			$qItem = $this->db->get_where("pos_stock_rekap", array("trx_date <" => date("Y-m-d"),"item_id" => $value['item_id'],"store_id" => $this->session_data->store_id()),1)->row_array();

			$nested[] = $key + 1;
			$nested[] = $value['item_name'];
			$nested[] = $qItem['total_stock'];
			$nested[] = $value['category_name'];
			$nested[] = $value['item_desc'];
			$nested[] = $value['item_price'];
			$nested[] = $value['unit_name'];
			$nested[] = '<button class="btn btn-primary btn-sm act-pilih" data-value="'.$value['item_id'].'">Pilih</button>';

			$data[] = $nested;
		}

		$json_data = array(
	        "draw"            => intval( $requestData['draw'] ),
	        "recordsTotal"    => intval( $totalFiltered ),
	        "recordsFiltered" => intval( $totalFiltered ),
	        "data"            => $data
        );


		return json_encode($json_data);

	}



	public function get_detail($billing_id){
		$requestData = $_REQUEST;


		$array = array('pos_billing_detail.billing_id' => $billing_id);

		$this->db->select("pos_billing_detail.* , pos_unit.unit_name,pos_item.item_name");
		$this->db->join("pos_unit","pos_billing_detail.unit_id = pos_unit.unit_id" ,"LEFT");
		$this->db->join("pos_item","pos_billing_detail.item_id = pos_item.item_id" ,"LEFT");
		$ex =  $this->db->get_where("pos_billing_detail", $array);
		$query = $ex->result_array();

		$totalFiltered = $this->db->get_where("pos_billing_detail",$array)->num_rows();	



		$data = [];
		foreach ($query as $key => $value) {
			$nested = [];

			$nested[] = $key + 1;
			$nested[] = $value['item_name'];
			//$nested[] = $value['ukuran'];
			$nested[] = number_format($value['item_price']);
			$nested[] = $value['order_qty'];
			$nested[] = $value['unit_name'];
			$nested[] = $value['discount_percent']." %";
			$nested[] = number_format($value['discount_price']);
			$nested[] = number_format($value['total']);
			$nested[] = '<button data-value="'.$value['billing_detail_id'].'" class="btn btn-sm btn-primary btn-edit-bill"><span class="fa fa-pencil"></span></button> <button class="btn btn-sm btn-danger btn-delete-bill" data-value="'.$value['billing_detail_id'].'"><span class="fa fa-trash"></span></button>';

			$data[] = $nested;
		}

		$json = array('data' => $data,'total' => $totalFiltered);
		return json_encode($json);
	}


	
	public function get_list(){
		$requestData = $_REQUEST;

		if ($requestData['chk'] == "true") {
			$chk = "pending";
			$btn = '<button class="btn btn-success btn-sm btn-pilih">Pilih</button> <button class="btn btn-danger btn-sm">Hapus</button>';
		}
		else{
			$chk = "done";	
			$btn = '<button class="btn btn-success btn-sm btn-spk" data-toggle="modal" data-target="#modal1">Kirim SPK</button>';
		}

		$store_id = $requestData['store_id'];
		$array = array("billing_status" => $chk, "store_id" => $store_id);

		$this->db->order_by("billing_id","DESC");
		$this->db->limit($requestData['length'],$requestData['start']);
		$ex =  $this->db->get_where("pos_billing", $array);
		$query = $ex->result_array();

		$totalFiltered = $this->db->get_where("pos_billing", $array)->num_rows();	

		if( !empty($requestData['search']) ) {

			$src = $requestData['search'];
		    // if there is a search parameter
		    $this->db->order_by("billing_id","DESC");
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("customer_name",$src);
		    
		    $d = $this->db->get_where("pos_billing", $array);
		    $query = $d->result_array();
		    $totalFiltered = count($query); 
		} 


		$data = [];
		foreach ($query as $key => $value) {

			$check_spk = $this->db->get_where("pos_spk",array('billing_id' => $value['billing_id']));
			if ($check_spk->num_rows() > 0) {
				$ms = '<p style="font-size : 12px">Sudah dikirim';
			}
			else{
				$ms = "";
			}


			$nested = [];

			
			$nested[] = '<a class="ref_id" href="'.base_url()."sales/billing?trx=".$value['billing_id'].'"></a>'.$value['billing_no'].'<input class="billing_id" type="hidden" value="'.$value['billing_id'].'">';
			$nested[] = $value['date_created']." ".$value['time_created'];
			$nested[] = $value['customer_name'];
			$nested[] = $value['billing_notes'];
			$nested[] = number_format($value['grand_total']);
			$nested[] = $value['no_loket'];
			$nested[] = $value['created_by'];
			$nested[] = $btn.$ms;

			
			$data[] = $nested;
		}

		$json = array('data' => $data,'total' => $totalFiltered,'start' => $requestData['start']);
		return json_encode($json);
	}

	public function get_store($store_id){
		$query = $this->db->get_where("pos_store", array("store_id" => $store_id));
		return $query->row_array();
	}

	public function get_list_piutang(){
		$requestData = $_REQUEST;

		$store_id = $requestData['store_id'];
		$array = array("pos_piutang.paid_status" => "progress", "pos_piutang.store_id" => $store_id);

		



			

		if( !empty($requestData['search']) ) {

			$src = $requestData['search'];
		    // if there is a search parameter
		    $this->db->select("pos_piutang.* , pos_store.store_name , apps_shift.shift_name");
			$this->db->order_by("piutang_id","DESC");
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->join("pos_store","pos_store.store_id = pos_piutang.store_id","LEFT");
			$this->db->join("apps_shift","apps_shift.shift_id = pos_piutang.shift_id","LEFT");
		    $this->db->like("customer_name",$src);
		    
		    $d = $this->db->get_where("pos_piutang", $array);
		    $query = $d->result_array();
		    $totalFiltered = count($query); 
		} 
		else{
			$this->db->select("pos_piutang.* , pos_store.store_name , apps_shift.shift_name");
			$this->db->order_by("piutang_id","DESC");
			$this->db->limit($requestData['length'],$requestData['start']);
			$this->db->join("pos_store","pos_store.store_id = pos_piutang.store_id","LEFT");
			$this->db->join("apps_shift","apps_shift.shift_id = pos_piutang.shift_id","LEFT");
			$ex =  $this->db->get_where("pos_piutang", $array);
			$query = $ex->result_array();


			$this->db->select("pos_piutang.* , pos_store.store_name , apps_shift.shift_name");
			$this->db->join("pos_store","pos_store.store_id = pos_piutang.store_id","LEFT");
			$this->db->join("apps_shift","apps_shift.shift_id = pos_piutang.shift_id","LEFT");
			$totalFiltered = $this->db->get_where("pos_piutang", $array)->num_rows();
		}


		$data = [];
		foreach ($query as $key => $value) {
			$nested = [];

			
			
			$nested[] = $value['customer_name'].'<input type="hidden" class="sisa" value="'.$value['sisa'].'">'.'<input type="hidden" class="billing_id" value="'.$value['billing_id'].'">'.'<input type="hidden" class="piutang_id" value="'.$value['piutang_id'].'">';
			
			$nested[] = number_format($value['total']);
			$nested[] = number_format($value['paid']);
			$nested[] = number_format($value['sisa']);
			$nested[] = $value['created'];
			$nested[] = $value['created_by'];
			$nested[] = $value['store_name'];
			$nested[] = $value['shift_name'];
			$nested[] = '<button class="btn btn-primary btn-sm btn-edit btn-view-piutang">Lihat</span></button>';
			

			
			$data[] = $nested;
		}

		$json = array('data' => $data,'total' => $totalFiltered,'start' => $requestData['start']);
		return json_encode($json);
	}

	public function list_paid(){
		$requestData = $_REQUEST;

		$store_id = $requestData['store_id'];
		$startF = $requestData['startF'];
		$endF = $requestData['endF'];

		$array = array("pos_billing.billing_status" => "done", "pos_billing.store_id" => $store_id, "pos_billing.paid_off" => 1);
		if (!empty($startF) && !empty($endF)) {
			$array = array("pos_billing.billing_status" => "done", 
							"pos_billing.store_id" => $store_id,
							"pos_billing.date_created >=" => $startF,
							"pos_billing.date_created <=" => $endF,
							 "pos_billing.paid_off" => 1
							);
		}


		if( !empty($requestData['search']) ) {

			$src = $requestData['search'];
		    // if there is a search parameter
		    $this->db->order_by("billing_id","DESC");
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("customer_name",$src);
		    $this->db->join("pos_store","pos_store.store_id = pos_billing.store_id","LEFT");
			$this->db->join("apps_shift","apps_shift.shift_id = pos_billing.shift_id","LEFT");
		    $d = $this->db->get_where("pos_billing", $array);
		    $query = $d->result_array();
		    $totalFiltered = count($query); 
		} 
		else{
			$this->db->select("pos_billing.* , pos_store.store_name ,apps_shift.shift_name");
			$this->db->order_by("billing_id","DESC");
			$this->db->limit($requestData['length'],$requestData['start']);
			$this->db->join("pos_store","pos_store.store_id = pos_billing.store_id","LEFT");
			$this->db->join("apps_shift","apps_shift.shift_id = pos_billing.shift_id","LEFT");
			$ex =  $this->db->get_where("pos_billing", $array);
			$query = $ex->result_array();

			$this->db->join("pos_store","pos_store.store_id = pos_billing.store_id","LEFT");
			$this->db->join("apps_shift","apps_shift.shift_id = pos_billing.shift_id","LEFT");
			$totalFiltered = $this->db->get_where("pos_billing", $array)->num_rows();	
		}


		$data = [];
		foreach ($query as $key => $value) {
			$nested = [];

			if ($value['is_dp'] == 1) {
				$dp = "Ya";
			}
			else{
				$dp = "Tidak";	
			}

			$nested[] = $value['customer_name'].'<input class="billing_id" type="hidden" value="'.$value['billing_id'].'">';
			$nested[] = $value['billing_no'];
			
			$nested[] = $value['shift_name'];
			$nested[] = $dp;
			$nested[] = $value['date_created']." ".$value['time_created'];
			$nested[] = $value['created_by'];
			$nested[] = number_format($value['grand_total'])." ,-";
			$nested[] = '<button class="btn btn-primary btn-sm btn-edit btn-view-piutang">Lihat</span></button>';


			
			$data[] = $nested;
		}

		$json = array('data' => $data,'total' => $totalFiltered,'start' => $requestData['start']);
		return json_encode($json);
	}



	public function get_detail2($billing_id){
		$requestData = $_REQUEST;


		$array = array('pos_billing_detail.billing_id' => $billing_id);

		$this->db->select("pos_billing_detail.* , apps_printer.printer_name , pos_unit.unit_name,pos_item.item_name");
		$this->db->join("apps_printer","pos_billing_detail.printer_id = apps_printer.printer_id" ,"LEFT");
		$this->db->join("pos_unit","pos_billing_detail.unit_id = pos_unit.unit_id" ,"LEFT");
		$this->db->join("pos_item","pos_billing_detail.item_id = pos_item.item_id" ,"LEFT");
		$ex =  $this->db->get_where("pos_billing_detail", $array);
		$query = $ex->result_array();

		$totalFiltered = $this->db->get_where("pos_billing_detail",$array)->num_rows();	



		$data = [];
		foreach ($query as $key => $value) {
			$nested = [];

			$nested[] = $key + 1;
			$nested[] = $value['item_name'];
			$nested[] = $value['printer_name'];
			
			$nested[] = number_format($value['item_price']);
			$nested[] = $value['order_qty'];
			$nested[] = $value['unit_name'];
			$nested[] = number_format($value['discount_price']);
			$nested[] = number_format($value['tax_price']);
			$nested[] = number_format($value['total']);

			$data[] = $nested;
		}

		$json = array('data' => $data,'total' => $totalFiltered);
		return json_encode($json);
	}

	public function paid_detail(){
		$requestData = $_REQUEST;

		$billing_id = $requestData['billing_id'];

		$array = array('pos_paid_detail.billing_id' => $billing_id);
		$this->db->join("pos_bank","pos_bank.bank_id = pos_paid_detail.bank_id" ,"LEFT");
		$this->db->join("pos_payment","pos_payment.payment_id = pos_paid_detail.payment_id" ,"LEFT");
		$ex =  $this->db->get_where("pos_paid_detail", $array);
		$query = $ex->result_array();


		$this->db->join("pos_bank","pos_bank.bank_id = pos_bank.bank_id" ,"LEFT");
		$this->db->join("pos_payment","pos_payment.payment_id = pos_paid_detail.payment_id" ,"LEFT");
		$totalFiltered = $this->db->get_where("pos_paid_detail",$array)->num_rows();	

		$data = [];
		foreach ($query as $key => $value) {
			$nested = [];

			
			$nested[] = $value['payment_name'];
			$nested[] = $value['bank_name'] ? : "<i>None</i>";
			$nested[] = $value['trx_info'];
			
			$nested[] = $value['date_trx'];
			$nested[] = $value['time_trx'];
			$nested[] = number_format($value['paid_detail_total']);
			

			$data[] = $nested;
		}

		$json = array('data' => $data,'total' => $totalFiltered);
		return json_encode($json);
	}


	public function get_retur(){

		$requestData = $_REQUEST;

		$store_id = $requestData['store_id'];
		$array = array("pos_retur.store_id" => $store_id , "rtr_status" => "done");

		if( !empty($requestData['search']) ) {

			$src = $requestData['search'];
		    // if there is a search parameter
		    $this->db->select("pos_retur.* , pos_store.store_name ,apps_shift.shift_name");
		    $this->db->order_by("retur_id","DESC");
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("customer_name",$src);
		    $this->db->join("pos_store","pos_store.store_id = pos_retur.store_id","LEFT");
			$this->db->join("apps_shift","apps_shift.shift_id = pos_retur.shift_id","LEFT");
			
		    $d = $this->db->get_where("pos_retur", $array);
		    $query = $d->result_array();
		    $totalFiltered = count($query); 
		} 
		else{
			$this->db->select("pos_retur.* , pos_store.store_name ,apps_shift.shift_name");
			$this->db->order_by("retur_id","DESC");
			$this->db->limit($requestData['length'],$requestData['start']);
			$this->db->join("pos_store","pos_store.store_id = pos_retur.store_id","LEFT");
			$this->db->join("apps_shift","apps_shift.shift_id = pos_retur.shift_id","LEFT");
			
			$ex =  $this->db->get_where("pos_retur", $array);
			$query = $ex->result_array();

			$this->db->join("pos_store","pos_store.store_id = pos_retur.store_id","LEFT");
			$this->db->join("apps_shift","apps_shift.shift_id = pos_retur.shift_id","LEFT");
			
			$totalFiltered = $this->db->get_where("pos_retur", $array)->num_rows();	
		}


		$data = [];
		foreach ($query as $key => $value) {
			$nested = [];


			$nested[] = $value['no_trx'];
			$nested[] = $value['customer_name'].'<input class="retur_id" type="hidden" value="'.$value['retur_id'].'">';
			$nested[] = $value['shift_name'];
			$nested[] = $value['date_retur'];
			$nested[] = $value['time_retur'];
			$nested[] = $value['info'];
			$nested[] = number_format($value['total'])." ,-";
			$nested[] = '<button class="btn btn-sm btn-primary btn-go">Lihat</button>';


			
			$data[] = $nested;
		}

		$json = array('data' => $data,'total' => $totalFiltered,'start' => $requestData['start']);
		return json_encode($json);
	}
	public function get_retur_detail(){
		$requestData = $_REQUEST;

		$retur_id = $requestData['retur_id'];
		$array = array("pos_retur_detail.retur_id" => $retur_id);

		
		$this->db->select("pos_retur_detail.*,
							pos_item.item_name,
							pos_unit.unit_name,
							apps_printer.printer_name
							");

		$this->db->join("apps_printer","apps_printer.printer_id = pos_retur_detail.printer_id","LEFT");
		$this->db->join("pos_unit","pos_unit.unit_id = pos_retur_detail.unit_id","LEFT");
		$this->db->join("pos_item","pos_item.item_id = pos_retur_detail.item_id","LEFT");
		
		$ex =  $this->db->get_where("pos_retur_detail", $array);
		$query = $ex->result_array();

		$this->db->join("apps_printer","apps_printer.printer_id = pos_retur_detail.printer_id","LEFT");
		$this->db->join("pos_unit","pos_unit.unit_id = pos_retur_detail.unit_id","LEFT");
		$this->db->join("pos_item","pos_item.item_id = pos_retur_detail.item_id","LEFT");
		
		$totalFiltered = $this->db->get_where("pos_retur_detail", $array)->num_rows();	


		$data = [];
		foreach ($query as $key => $value) {
			$nested = [];

			$nested[] = $key+1;
			$nested[] = $value['item_name'];
			$nested[] = $value['printer_name'].'<input class="retur_detail_id" type="hidden" value="'.$value['retur_detail_id'].'">'.'<input class="detail_item_id" type="hidden" value="'.$value['item_id'].'">';
			
			$nested[] = $value['item_price'];
			$nested[] = $value['retur_qty'];
			$nested[] = $value['unit_name'];
			$nested[] = $value['total'];
			$nested[] = '<button class="btn btn-primary btn-edit-retur-detail btn-sm">Edit</button> <a class="b-delete cursor-hover"><button class="btn btn-danger btn-sm">Delete</button></a>';


			$data[] = $nested;
		}

		$json = array('data' => $data);
		return json_encode($json);
	}
	
	public function load_customer(){


		$requestData 	= $_REQUEST;


		/*Required Dont change*/
		$field 		= $requestData['field'];
		$sort 			= $requestData['sort'];

		$search 		= $requestData['search'];

		$length 		= $requestData['length'];
		$start 			= $requestData['start'];
		/*Required Dont change*/



		


		if( !empty($search) ) {

		    // if there is a search parameter

		    $this->db->order_by($field,$sort);
		    $this->db->limit($length,$start);
		    $this->db->like("customer_name",$search);
		    $d = $this->db->get_where("pos_customer", array("is_deleted" => 0));
		    $query = $d->result_array();


		    $this->db->like("customer_name",$search);
		   	$totalFiltered = $this->db->get_where("pos_customer", array("is_deleted" => 0))->num_rows();
		    
		} 
		else{
			$this->db->order_by($field,$sort);
			$this->db->limit($length,$start);

			$ex =  $this->db->get_where("pos_customer", array("is_deleted" => 0));
			$query = $ex->result_array();

			$totalFiltered = $this->db->get_where("pos_customer", array("is_deleted" => 0))->num_rows();	
		}



		$data = [];
		foreach ($query as $key => $value) {
			$nested = [];

			$nested[] = $value['customer_code'];
			$nested[] = $value['customer_name'];
			$nested[] = $value['customer_phone'];
			$nested[] = $value['customer_address'];
			$nested[] = '<button class="btn btn-info btn-sm btn-cust" data-value="'.$value['customer_id'].'">Pilih</button>';
			

			$data[] = $nested;
		}

		$json = array('data' => $data,'total' => $totalFiltered);
		return json_encode($json);
	}

}


