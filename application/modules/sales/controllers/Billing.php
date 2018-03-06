<?php 

/**
* 
*/
class Billing extends MX_Controller
{
	
	private $billing_id;
	private $billing_no;
	function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->model("billing_model");
		date_default_timezone_set("Asia/jakarta");
	}
	public function index(){
		$data['trx'] = $this->input->get("trx") ? $this->input->get("trx") : "";
		$data['page'] = 'billing';
		$data['query'] = $this->db->get_where("apps_printer",  array('is_deleted' => 0));
		$data['query2'] = $this->db->get_where("pos_unit",  array('is_deleted' => 0));
		$data['query3'] = $this->db->get_where("pos_bank",  array('is_deleted' => 0));
		$this->template->get($data);
	}

	public function view_all(){
		echo $this->billing_model->view_all();
	}

	public function get_table(){
		echo $this->billing_model->get_table();
	}
	public function add_detail(){
		$billing_id 	= $this->input->post("billing_id");
		$item_id 		= $this->input->post("item_id");
		$order_qty 		= $this->input->post("order_qty");
		$item_price 	= $this->input->post("item_price");
		$discount 		= $this->input->post("discount_percent");
		$discount_price = $this->input->post("discount_price");


		$created_by = $this->session->userdata("first_name");
		$user_id = $this->session->userdata("user_id");
		$date_created 	= date("Y-m-d");
		$time_created 	= date("H:i:s");
		

		if (empty($billing_id)) {
			$this->db->order_by("billing_id", "DESC");
			$get_billing = $this->db->get("pos_billing", 1,0)->row_array();
			$billing_id = $get_billing['billing_id'] + 1;
			$billing_no = "INV/".date("y")."/".date("m")."/".date("d").'/'.$billing_id;
			$tax_percent 	= 0;

			$arr_bill = array('billing_id' =>$billing_id,
							'billing_no'=>$billing_no,
							'billing_status' => 'temp',
							'created_by' => $created_by,
							'user_id' => $user_id,
							'date_created' => $date_created,
							'time_created' => $time_created
							);
			$insert_billing = $this->db->insert("pos_billing", $arr_bill);
			
		}
		else{
			$getBilling = $this->db->get_where("pos_billing", array('billing_id' => $billing_id ))->row_array();
			$tax_percent 	= $getBilling['tax_percent'];
		}


		/*get row item*/
		$get_item	 = $this->db->get_where("pos_item", array('item_id' => $item_id))->row_array();
		$item_hpp = $get_item['item_hpp'];
		$item_total_hpp = $get_item['item_hpp'] * $order_qty;
		$unit_id = $get_item['unit_id'];

		//$discount_price = ceil(($item_price * $discount) / 100);

		$discount_total = $discount_price * $order_qty;

		$tax_price = ceil(($item_price * $tax_percent) / 100);
		$tax_total = $tax_price * $order_qty;		

		$subtotal 	= $item_price * $order_qty;
		$total 		= $subtotal - $discount_total + $tax_total;

		$dataInsertDetail =  array('billing_id' => $billing_id,
								  'item_id' => $item_id,
								  'order_qty' => $order_qty,
								  'item_price' => $item_price,
								  'item_price_hpp' => $item_hpp,
								  'item_total_hpp' => $item_total_hpp,
								  'discount_percent' => $discount,
								  'discount_price' => $discount_price,
								  'discount_total' => $discount_total,
								  'tax_percent' => $tax_percent,
								  'tax_price' => $tax_price,
								  'tax_total' => $tax_total,
								  'created_by' => $created_by,
								  'unit_id' => $unit_id,
								  'date_created' => $date_created,
								  'time_created' => $time_created,
								  'subtotal' => $subtotal,
								  'total' => $total);

		$insert_billing_detail = $this->db->insert("pos_billing_detail",$dataInsertDetail);


	$getTotal = $this->get_total($billing_id);

	$this->db->where('billing_id', $billing_id);
	$this->db->update('pos_billing',[
						'discount_total' => $getTotal['discount_total'],
						'tax_total' 	=> $getTotal['tax_total'],
						'total_billing' => $getTotal['total_billing'],
						'grand_total' 	=> $getTotal['grand_total'],
						'total_hpp' 	=> $getTotal['total_hpp']
					]);

	$json = array('status' => 'ok',
				'billing_id' => $billing_id
	);

	echo json_encode($json);

	}

	public function get_item(){
		$item_id = $this->input->post('item_id');

		$queryItem = $this->db->get_where('pos_item', ['item_id' => $item_id])->row_array();
		echo json_encode(['status' => 'ok','data' => $queryItem]);
	}

	public function get_total($billing_id){

		$getBilling = $this->db->get_where("pos_billing_detail", array('billing_id' => $billing_id));


		$discount_total = 0;
		$tax_total = 0;
		$total_billing = 0;
		$total = 0;
		$total_hpp = 0;
		
		foreach ($getBilling->result_array() as $key => $value) {
			$discount_total += $value['discount_total'];
			$tax_total += $value['tax_total'];
			$total_billing += $value['subtotal'];
			$total += $value['total'];
			$total_hpp += $value['item_total_hpp'];
		}

		$queryBill 		= $this->db->get_where('pos_billing',['billing_id' => $billing_id])->row_array();
		$biaya_lain 	= $queryBill['biaya_lain'];
		$discount_percent_bill = $queryBill['discount_percent_bill'];
		$discount_price_bill = $queryBill['discount_price_bill'];

		$discount_total = $discount_price_bill + $discount_total;
		$grand_total 	= $total_billing + $tax_total - $discount_total + $biaya_lain;

		return ['discount_total' => $discount_total, 
				'tax_total' => $tax_total, 
				'total_billing' => $total_billing,
				'grand_total' => $grand_total,
				'total_hpp' => $total_hpp
				];
	}
	public function get_edit_detail(){
		$billing_detail_id = $this->input->post('billing_detail_id');
		$queryDetail = $this->db->get_where('pos_billing_detail', ['billing_detail_id' => $billing_detail_id])->row_array();
		echo json_encode(['status' => 'ok','data' => $queryDetail]);
	}

	public function edit_detail(){
		$billing_id 	= $this->input->post("billing_id");
		$billing_detail_id 	= $this->input->post("billing_detail_id");
		$item_id 		= $this->input->post("item_id");
		$order_qty 		= $this->input->post("order_qty");
		$item_price 	= $this->input->post("item_price");
		$discount 		= $this->input->post("discount_percent");
		$discount_price	= $this->input->post("discount_price");

		$updated_by = $this->session->userdata("first_name");
		$user_id = $this->session->userdata("user_id");
		$update_at 	= date("Y-m-d H:i:s");

		//$discount_price = ceil(($item_price * $discount) / 100);
		$discount_total = $discount_price * $order_qty;

		$getBilling = $this->db->get_where('pos_billing', ['billing_id' => $billing_id])->row_array();
		$tax_percent = $getBilling['tax_percent'];

		$tax_price = ceil(($item_price * $tax_percent) / 100);
		$tax_total = $tax_price * $order_qty;

		$subtotal 	= $item_price * $order_qty;
		$total 		= $subtotal - $discount_total + $tax_total;

		$dataUpdate = ['item_price' => $item_price,
						'order_qty' => $order_qty,
						'discount_percent' => $discount,
						'discount_price' => $discount_price,
						'discount_total' => $discount_total,
						'tax_percent' => $tax_percent,
						'tax_price' => $tax_price,
						'tax_total' => $tax_total,
						'subtotal' => $subtotal,
						'total' => $total
						];
		$this->db->where('billing_detail_id',$billing_detail_id);
		$queryUpdateDetail = $this->db->update('pos_billing_detail', $dataUpdate);

		$getTotal = $this->get_total($billing_id);
		$this->db->where('billing_id', $billing_id);
		$queryUpdate = $this->db->update('pos_billing',[
						'discount_total' => $getTotal['discount_total'],
						'tax_total' 	=> $getTotal['tax_total'],
						'total_billing' => $getTotal['total_billing'],
						'grand_total' 	=> $getTotal['grand_total'],
						'total_hpp' 	=> $getTotal['total_hpp'],
						'updated_by' 	=> $updated_by,
						'updated_at' 	=> date('Y-m-d H:i:s')
					]);
		if ($queryUpdate) {
			echo json_encode(['status' => 'ok','data' => ['billing_id' => $billing_id]]);
		}
	}

	public function get_detail(){
		$billing_id = $this->input->post("billing_id");
		echo $this->billing_model->get_detail($billing_id);
	}
	public function get_detail2(){
		$billing_id = $this->input->post("billing_id");
		echo $this->billing_model->get_detail2($billing_id);
	}
	public function delete_billing_detail(){
		$billing_id = $this->input->post("billing_id");
		$billing_detail_id = $this->input->post('billing_detail_id');
		$this->db->where('billing_detail_id',$billing_detail_id);
		$queryDelete = $this->db->delete('pos_billing_detail');

		$getTotal = $this->get_total($billing_id);
		$this->db->where('billing_id', $billing_id);
		$queryUpdate = $this->db->update('pos_billing',[
							'discount_total' => $getTotal['discount_total'],
							'tax_total' 	=> $getTotal['tax_total'],
							'total_billing' => $getTotal['total_billing'],
							'grand_total' 	=> $getTotal['grand_total'],
							'total_hpp' 	=> $getTotal['total_hpp']
						]);
		if ($queryUpdate) {
			echo json_encode(['status' => 'ok']);
		}
	}
	public function get_billing_detail(){
		$billing_detail_id = $this->input->post("billing_detail_id");



		$array = array('billing_detail_id' => $billing_detail_id);

		$query =  $this->db->get_where("pos_billing_detail", $array);

		$result 		= $query->row_array();

		$arr['billing_detail_id'] 	= $billing_detail_id;
		$arr['printer_id'] 	= $result['printer_id'];
		$arr['item_id'] 	= $result['item_id'];
		$arr['item_price'] 	= $result['item_price'];
		$arr['order_qty'] 	= $result['order_qty'];
		
		$arr['discount_percent'] = $result['discount_percent'];
		$arr['tax_percent'] = $result['tax_percent'];
		$arr['ket'] 		= $result['ket'];

		echo json_encode($arr);


	}

	public function save_paid(){
		$billing_id 	= $this->input->post('billing_id');
		$billing_notes 	= $this->input->post('billing_notes');
		$customer_id 	= $this->input->post('customer_id');
		$total_cash 	= $this->input->post('total_cash');
		$credit_card_total 	= $this->input->post('credit_card_total');
		$credit_card_bank = $this->input->post('credit_card_bank');
		$credit_card_trx = $this->input->post('credit_card_trx');
		$debit_card_total 	= $this->input->post('debit_card_total');
		$debit_card_bank = $this->input->post('debit_card_bank');
		$debit_card_trx = $this->input->post('debit_card_trx');

		$queryBill = $this->db->get_where('pos_billing', ['billing_id' => $billing_id])->row_array();
		$grand_total = $queryBill['grand_total'];
		$total_paid = $total_cash + $credit_card_total + $debit_card_total;

		/*get return */
		if ($total_paid > $grand_total) {
			$total_return = $total_paid - $grand_total;
			$less_paid = 0;
			$pembulatan = $this->pembulatan($total_paid);
		}
		else{
			$total_return = 0;	
			$less_paid = $grand_total - $total_paid;
			$pembulatan = 0;
		}
		

		$dataUpdate = ['billing_notes' => $billing_notes,
						'customer_id' => $customer_id,
						'total_cash' => $total_cash, 
						'credit_card_total' => $credit_card_total, 
						'credit_card_bank' => $credit_card_bank,
						'credit_card_trx' => $credit_card_trx,
						'debit_card_total' => $debit_card_total, 
						'debit_card_bank' => $debit_card_bank,
						'debit_card_trx' => $debit_card_trx,
						'total_paid' => $total_paid,
						'total_return' => $total_return,
						'less_paid' => $less_paid,
						'total_pembulatan' => $pembulatan,
						'billing_status' => 'done'
						];

		$this->db->where('billing_id', $billing_id);
		$queryUpdate = $this->db->update('pos_billing', $dataUpdate);
		if ($queryUpdate) {
			echo json_encode(['status' => 'ok']);
		}

	}

	public function list_order(){
		$data['page'] = "list";
		$store_id = $this->session->userdata("store_id");
		$store = $this->billing_model->get_store($store_id);
		$data['store_name'] = $store['store_name'];
		$data['q_store'] = $this->db->get_where("pos_store", array("is_deleted" => 0));
		$data['store_id'] = $store_id;
		$data['jabatan'] = $this->db->get_where("apps_jabatan", array("is_deleted" => 0));
		$this->template->get($data);
	}

	public function add_spk(){
		$store_id = $this->session->userdata("store_id");
		$date_in = date("Y-m-d H:i:s");
		$billing_id = $this->input->post("billing_id");
		$jabatan_id = $this->input->post("jabatan_id");
		$status = "pending";


		$query = $this->db->insert("pos_spk", array("billing_id" => $billing_id,
							"date_in" => $date_in,
							"status" => $status ,
							"jabatan_id" => $jabatan_id ,
							"store_id" => $store_id));

		if ($query) {
			echo json_encode(array("status" => "success"));
		}

	}

	public function get_list(){
		echo $this->billing_model->get_list();
	}

	public function render_retur(){
		$retur_id = $this->input->post("retur_id");
		$query = $this->db->get_where("pos_retur", array("retur_id" => $retur_id))->row_array();
		echo json_encode($query);


	}

	public function cancel_billing(){
		$billing_id = $this->input->post("billing_id");

		$this->db->where("billing_id",$billing_id);
		$this->db->update("pos_billing", array("billing_status" => "cancel"));

		$arrJson = array("status"=>"success");
		echo json_encode($arrJson);

	}

	public function get_billing(){
		$billing_id = $this->input->post('billing_id');
		$queryBilling = $this->db->get_where('pos_billing', ['billing_id' => $billing_id])->row_array();
		echo json_encode(array('status' => 'ok', 'data' => $queryBilling));
	}

	public function set_tax(){
		$billing_id = $this->input->post('billing_id');
		$tax_percent = $this->input->post('tax_percent');

		$queryBillingDetail = $this->db->get_where('pos_billing_detail', ['billing_id' => $billing_id]);

		foreach ($queryBillingDetail->result_array() as $key => $value) {

			$item_price = $value['item_price'];
			$order_qty = $value['order_qty'];

			$discount_total = $value['discount_total'];

			$tax_price = ceil(($item_price * $tax_percent) / 100);
			$tax_total = $tax_price * $order_qty;		

			$subtotal 	= $value['subtotal'];
			$total 		= $subtotal - $discount_total + $tax_total;

			$dataUpdate = ['tax_percent' => $tax_percent,
							'tax_total' => $tax_total,
							'total' => $total];
			$this->db->where('billing_detail_id', $value['billing_detail_id']);
			$this->db->update('pos_billing_detail', $dataUpdate);
		}

		$getTotal = $this->get_total($billing_id);

		$this->db->where('billing_id', $billing_id);
		$queryUpdateDetail = $this->db->update('pos_billing',[
							'tax_percent' => $tax_percent,
							'tax_total' 	=> $getTotal['tax_total'],
							'grand_total' 	=> $getTotal['grand_total']
							
						]);
		if ($queryUpdateDetail) {
			echo json_encode(['status' => 'ok']);
		}
	}

	public function set_discount(){
		$billing_id = $this->input->post('billing_id');
		$discount_percent_bill = $this->input->post('discount_percent_bill');
		$discount_price_bill = $this->input->post('discount_price_bill');

		$this->db->where('billing_id', $billing_id);
		$queryUpdateDetail = $this->db->update('pos_billing',[
							'discount_percent_bill' => $discount_percent_bill,
							'discount_price_bill' => $discount_price_bill
						]);

		$getTotal2 = $this->get_total($billing_id);
		$discount_total = $getTotal2['discount_total'] + $discount_price_bill;
		$this->db->where('billing_id', $billing_id);
		$queryUpdateDetail = $this->db->update('pos_billing',[
							'grand_total' => $getTotal2['grand_total'],
							'discount_total' => $discount_total,
						]);
		if ($queryUpdateDetail) {
			echo json_encode(['status' => 'ok']);
		}
	}

	public function stock_action(){

		$first_name = $this->session->userdata("first_name");
		$billing_id = $this->billing_id;
		$billing_no = $this->billing_no;
		$store_id = $this->store_id;
		$date 		= date("Y-m-d");
		$time 		= date("H:i:s");

		$this->db->order_by("ref_id", "DESC");
		$get_f = $this->db->get("pos_stock_flow", 1,0)->row_array();
		$ref_id = intval($get_f['ref_id']) + 1;
		$ref_data = "OT".time();
		$array_ref = array("ref_id" => $ref_id,
							"ref_data" => $billing_no,
							"store_id" => $store_id,
							"trx_type" => "out",
							"date_input" => $date,
							"time_input" => $time,
							"created_by" => $first_name
							);
		
		
		$get_detail = $this->db->get_where("pos_billing_detail", array("billing_id" => $billing_id));
		foreach ($get_detail->result_array() as $key => $value) {
			$item_id 	= $value['item_id'];
			$store_id 	= $value['store_id'];
			$trx_nominal= $value['item_price'];
			$unit_id	= $value['unit_id'];
			$trx_hpp	= $value['item_price_hpp'];
			$trx_type 	= 'out';


			$order_qty 	= $value['order_qty'];

			$this->db->order_by("sr_id","DESC");
			$check_stock = $this->db->get_where("pos_stock_rekap", array("store_id" => $store_id,
												"trx_date" => $date,"item_id" => $item_id),1,0);
			

			if ($check_stock->num_rows() > 0) {
				$q_stock 	= $check_stock->row_array();
				$sr_id 		= $q_stock['sr_id'];
				$stock_old 	= $q_stock['total_stock'];
				$total_stock  = $stock_old - $order_qty;
				$stock_out	= $q_stock['total_stock_out'] + $order_qty;
				$array = array("total_stock" => $total_stock,"total_stock_out" => $stock_out);
				$this->db->where("sr_id",$sr_id);
				$this->db->update("pos_stock_rekap", $array);
			}
			else{
				$this->db->order_by("sr_id","DESC");
				$check_stock = $this->db->get_where("pos_stock_rekap", array("store_id" => $store_id,"item_id" => $item_id),1,0);
				$q_stock 	= $check_stock->row_array();
				$sr_id 		= $q_stock['sr_id'];
				$stock_old 	= $q_stock['total_stock'];
				$total_stock  = $stock_old - $order_qty;
				$stock_out = $order_qty;
				$array = array("item_id" => $item_id,
								"total_stock" => $total_stock,
								"total_stock_out" => $stock_out,
								"store_id" => $store_id,
								"unit_id" => $unit_id,
								"trx_date" => $date);
				$this->db->insert("pos_stock_rekap", $array);
			}




			$arraySt = array("item_id" => $item_id ,
							"store_id" => $store_id ,
							"trx_hpp" => $trx_hpp,
							"trx_nominal" => $trx_nominal,
							"trx_date" => $date,
							"trx_time" => $time,
							"trx_qty" => $order_qty,
							"unit_id" => $unit_id,
							"ref_id" => $ref_id);
			$this->db->insert("pos_stock", $arraySt);
		}
		$this->db->insert("pos_stock_flow", $array_ref);
		return true;
	}

	public function pembulatan($value){
		$getData = substr($value, -2);
		$getData = intval($getData);

		$result = 100 - $getData;
		if ($result == 100) {
			$result = 0;
		}

		return $result;

	}

	public function piutang(){

		$store_id = $this->session->userdata("store_id");
		$store = $this->billing_model->get_store($store_id);
		$data['store_name'] = $store['store_name'];

		$data['q_store'] = $this->db->get_where("pos_store", array("is_deleted" => 0));
		$data['query3'] = $this->db->get_where("pos_bank", array("is_deleted" => 0));
		$data['page'] = "piutang";
		$data['store_id'] = $store_id;
		$this->template->get($data);
	}

	public function get_list_piutang(){
		echo $this->billing_model->get_list_piutang();
	}

	public function paid(){
		$store_id = $this->session->userdata("store_id");
		$store = $this->billing_model->get_store($store_id);
		$data['store_name'] = $store['store_name'];

		$data['q_store'] = $this->db->get_where("pos_store", array("is_deleted" => 0));
		$data['query3'] = $this->db->get_where("pos_bank", array("is_deleted" => 0));
		$data['page'] = "paid";
		$data['store_id'] = $store_id;
		$this->template->get($data);
	}

	public function list_paid(){
		echo $this->billing_model->list_paid();	
	}

	public function detail($billing_id){
		$data['page'] = "detail";

		$array = array("billing_id" => $billing_id);
		$this->db->select("pos_billing.* , pos_store.store_name ,apps_shift.shift_name");
		$this->db->join("pos_store","pos_store.store_id = pos_billing.store_id","LEFT");
		$this->db->join("apps_shift","apps_shift.shift_id = pos_billing.shift_id","LEFT");
		$data['query1'] =  $this->db->get_where("pos_billing", $array)->row_array();

		$this->template->get($data);
	}

	public function print_retur($retur_id){
		$this->db->join("pos_store","pos_store.store_id = pos_retur.store_id","LEFT");
		$data['query1'] = $this->db->get_where("pos_retur", array('retur_id' => $retur_id))->row_array();

		$this->db->select("pos_retur_detail.* , apps_printer.printer_name , pos_unit.unit_name, pos_item.item_name");
		$this->db->join("apps_printer","apps_printer.printer_id = pos_retur_detail.printer_id","LEFT");
		$this->db->join("pos_unit","pos_unit.unit_id = pos_retur_detail.unit_id","LEFT");
		$this->db->join("pos_item","pos_item.item_id = pos_retur_detail.item_id","LEFT");
		$data['query2'] = $this->db->get_where("pos_retur_detail", array("retur_id" => $retur_id));

		$this->load->view("print_retur",$data);

	}

	public function print_billing($billing_id){

		$array = array("billing_id" => $billing_id);
		$this->db->select("pos_billing.* , pos_store.store_name ,apps_shift.shift_name");
		$this->db->join("pos_store","pos_store.store_id = pos_billing.store_id","LEFT");
		$this->db->join("apps_shift","apps_shift.shift_id = pos_billing.shift_id","LEFT");
		$data['query1'] =  $this->db->get_where("pos_billing", $array)->row_array();


		$array = array('pos_billing_detail.billing_id' => $billing_id);

		$this->db->select("pos_billing_detail.* , apps_printer.printer_name , pos_unit.unit_name,pos_item.item_name");
		$this->db->join("apps_printer","pos_billing_detail.printer_id = apps_printer.printer_id" ,"LEFT");
		$this->db->join("pos_unit","pos_billing_detail.unit_id = pos_unit.unit_id" ,"LEFT");
		$this->db->join("pos_item","pos_billing_detail.item_id = pos_item.item_id" ,"LEFT");
		$data['query_detail'] =  $this->db->get_where("pos_billing_detail", $array);



		$this->load->view("print_billing", $data);
	}


	public function paid_detail(){
		echo $this->billing_model->paid_detail();
	}


	public function retur(){
		$data['page'] = "retur";

		$store_id = $this->session->userdata("store_id");
		$store = $this->billing_model->get_store($store_id);
		$data['store_name'] = $store['store_name'];
		$data['q_store'] = $this->db->get_where("pos_store", array("is_deleted" => 0));
		$data['store_id'] = $store_id;


		$this->template->get($data);
	}

	public function get_retur(){
		echo $this->billing_model->get_retur();
	}

	public function retur_add(){

		if ($this->input->get("trx")) {
			$data['retur_id'] = $this->input->get("trx");
		}
		else{
			$data['retur_id'] = "";	
		}

		$data['query'] = $this->db->get_where("apps_printer", array("is_deleted" => 0));
		$data['page'] = "retur_add";
		$this->template->get($data);
	}
	public function add_detail_retur(){
		$retur_id 	= $this->input->post("retur_id");
		$item_id 		= $this->input->post("item_id");
		$printer_id 	= $this->input->post("printer_id");
		
		$retur_qty 		= $this->input->post("retur_qty");
		$item_price 	= $this->input->post("item_price");


		$store_id = $this->session->userdata("store_id") ? : "";
		$shift_id = $this->session->userdata("shift_id") ? : "";
		

		$query_item = $this->db->get_where("pos_item", array("item_id" => $item_id))->row_array();
		$unit_id = $query_item['unit_id'];
		$item_price_hpp = $query_item['item_hpp'];

		$subtotal = intval($retur_qty) * intval($item_price);
		$total = $subtotal;

		$date_created = date("Y-m-d");
		$time_created = date("H:i:s");



		if (empty($retur_id)) {
			$this->db->order_by("retur_id","DESC");
			$query_rtr = $this->db->get("pos_retur",1,0)->row_array();

			$retur_id = intval($query_rtr['retur_id']) + 1;

			$first_name = $this->session->userdata("first_name") ? : "";

			$no_trx = "RTR".$retur_id;
			$arrayRtr = array(	"retur_id" => $retur_id,
								"no_trx" => $no_trx,
								"store_id" => $store_id,
								"shift_id" => $shift_id,
								"date_retur" => $date_created,
								"time_retur" => $time_created,
								"created_by" => $first_name,
								"subtotal" => $subtotal,
								"total" => $total
								);
			$this->db->insert("pos_retur", $arrayRtr);
		}
		else{
			$query_retur = $this->db->get_where("pos_retur", array("retur_id" => $retur_id))->row_array();
			$no_trx = $query_retur['no_trx'];
			$first_name = $query_retur['created_by'];
		}






		$dataInsert = array("item_id" => $item_id,
					"retur_id" => $retur_id,
					"unit_id" => $unit_id,
					"printer_id" => $printer_id,
					
					"retur_qty" => $retur_qty,
					"item_price" => $item_price,
					"item_price_hpp" => $item_price_hpp,
					"created_by" => $first_name,
					"date_created" => $date_created,
					"time_created" => $time_created,
					"subtotal" => $subtotal,
					"total" => $total
					);

		$this->db->insert("pos_retur_detail", $dataInsert);


		$upR = $this->update_retur($retur_id);



		$arrayJson = array("status" => "success",
							"no_trx" => $no_trx,
							"retur_id" => $retur_id,
							"subtotal" => $upR['subtotal'],
							"created_by" => $first_name,
							"total" => $upR['total']
							);
		echo json_encode($arrayJson);
	}

	public function get_detail_retur(){
		echo $this->billing_model->get_retur_detail();
	}

	public function delete_retur_detail(){
		$retur_detail_id = $this->input->post("retur_detail_id");
		$retur_id = $this->input->post("retur_id");


		$query = $this->db->delete("pos_retur_detail", array("retur_detail_id" => $retur_detail_id));

		$upRtr = $this->update_retur($retur_id);

		if ($query) {
			$arrayJson = array("status"=>"success" , "subtotal" => $upRtr['subtotal'] , "total" => $upRtr['total']);
			echo json_encode($arrayJson);
		}
	}

	public function update_retur($retur_id){
		$query_detail = $this->db->get_where("pos_retur_detail", array("retur_id" => $retur_id));
		$subtotalRtr = 0;
		$totalRtr = 0;
		foreach ($query_detail->result_array() as $key => $value) {
			$subtotalRtr += intval($value['subtotal']);
			$totalRtr += intval($value['total']);
		}

		$arrupdate = array("subtotal" => $subtotalRtr,"total" => $totalRtr);
		$this->db->where("retur_id",$retur_id);
		$this->db->update("pos_retur", $arrupdate);
		$arr_return = array('subtotal' => $subtotalRtr , 'total' => $totalRtr );
		return $arr_return;
	}


	public function update_detail_retur(){
		$retur_id 		= $this->input->post("retur_id");
		$retur_detail_id= $this->input->post("retur_detail_id");
		$item_id 		= $this->input->post("item_id");
		$printer_id 	= $this->input->post("printer_id");
		
		$retur_qty 		= $this->input->post("retur_qty");
		$item_price 	= $this->input->post("item_price");

		$query_item = $this->db->get_where("pos_item", array("item_id" => $item_id))->row_array();
		$unit_id = $query_item['unit_id'];
		$item_price_hpp = $query_item['item_hpp'];

		$subtotal = $retur_qty * $item_price;
		$total = $subtotal;


		$arrayUpdate = array("item_id" => $item_id,
							"printer_id" => $printer_id,
							
							"retur_qty" => $retur_qty,
							"item_price" => $item_price,
							"unit_id" => $unit_id,
							"item_price_hpp" => $item_price_hpp,
							"subtotal" => $subtotal,
							"total" => $total
							);

		$this->db->where("retur_detail_id",$retur_detail_id);
		$query = $this->db->update("pos_retur_detail", $arrayUpdate);

		$upRtr = $this->update_retur($retur_id);

		if ($query) {
			$arrayJson = array("status"=>"success" , "subtotal" => $upRtr['subtotal'] , "total" => $upRtr['total']);
			echo json_encode($arrayJson);
		}

	}

	public function retur_item_detail(){
		$retur_detail_id = $this->input->post("retur_detail_id");

		$query 		= $this->db->get_where("pos_retur_detail", array("retur_detail_id" => $retur_detail_id)) -> row_array();
		$arr['item_id'] 	= $query['item_id'];
		
		$arr['retur_qty'] 	= $query['retur_qty'];
		$arr['item_price'] 	= $query['item_price'];
		$arr['item_price_hpp'] = $query['item_price_hpp'];
		$arr['printer_id'] 	= $query['printer_id'];

		echo json_encode($arr);

	}

	public function retur_status(){

		if (!empty($this->input->post("no_trx"))) {
			$arr['no_trx'] = $this->input->post("no_trx");
		}

		$retur_id = $this->input->post("retur_id");
		$arr['customer_name'] = $this->input->post("customer_name");
		$arr['phone'] = $this->input->post("phone");
		$arr['info'] = $this->input->post("info");
		
		$arr['tunai'] = $this->input->post("tunai");
		$arr['rtr_status'] = "done";

		$this->db->where("retur_id", $retur_id);
		$query = $this->db->update("pos_retur", $arr);

		if ($query) {
			echo json_encode(array("status" => "success"));
		}

	}

	public function load_customer(){
		echo $this->billing_model->load_customer();
	}
	public function add_customer(){
		$data['customer_name'] 	= $this->input->post("customer_name");
		$data['customer_phone'] 	= str_replace(" ", "", $this->input->post("customer_phone"));
		$data['customer_address'] 	= $this->input->post("customer_address");

		$msg_success = array('action' => 'refresh');
		
	
		$required =  array("Nama Pelanggan" => $data['customer_name']);

		/*
		Validasi input
		*/
		foreach ($required as $key => $value) {
			if (empty($value)) {
				$set_required[] = $key;
			}
		}

		if (!empty($set_required)) {
			$msg_validate = array('msg' => 'Validate', 'required' =>  array($set_required));
			echo json_encode($msg_validate);
		}
		else{

			$this->db->order_by("customer_id","DESC");
			$q_code = $this->db->get('pos_customer',1,0)->row_array();
			$data['customer_code'] = "PLG-".intval($q_code['customer_id'] + 1);

			$data['created_by'] = $this->session->userdata('first_name');
			$data['created'] = date("Y-m-d");
			$query = $this->db->insert("pos_customer", $data);
			if ($query) {
				echo json_encode($msg_success);
			}

		}
	}

	public function set_biaya_lain(){
		$billing_id = $this->input->post('billing_id');
		$biaya_lain = $this->input->post('biaya_lain');



		$this->db->where('billing_id', $billing_id);
		$queryUpdate1 = $this->db->update('pos_billing', ['biaya_lain' => $biaya_lain]);


		$getTotal = $this->get_total($billing_id);
		$grand_total = $getTotal['grand_total'];
		$this->db->where('billing_id', $billing_id);
		$queryUpdate2 = $this->db->update('pos_billing', ['grand_total' => $grand_total]);
		if ($queryUpdate2) {
			echo json_encode(['status' => 'ok']);
		}

	}

	public function render_customer(){
		$customer_id = $this->input->post("customer_id");
		$query = $this->db->get_where("pos_customer", array("customer_id" => $customer_id));
		$rowData = $query->row_array();
		if ($query->num_rows() > 0) {
			$arrayData = array("status" => 'success','data' => $rowData);
		}
		else{
			$arrayData = array("status" => 'failed');	
		}
		echo json_encode($arrayData);
	}

}