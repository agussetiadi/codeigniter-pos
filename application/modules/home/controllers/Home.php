<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

 
class Home extends MX_Controller {
 
public function __construct() {
  	parent::__construct();
 	$this->load->library('template');
 	$this->load->model("home_model");
  }
 
  public function index(){

  	$query = $this->db->get_where("pos_store", array("is_deleted" => 0));

  	$store = [];
  	$online_users = [];
  	foreach ($query->result_array() as $key => $value) {
  		$store_id = $value['store_id'];

  		$num = $this->db->get_where("apps_users", array("store_id" => $store_id,"status" => "online"))->num_rows();

  		$store[] = $value['store_name'];
  		$online_users[] = $num;
  	}

  	$day = date("d")-3;
  	$date = date("Y-m-").$day;
  	$this->db->select_sum("paid_detail_total");
  	$query_sum = $this->db->get_where("pos_paid_detail", array("date_trx >" => $date))->row_array();

  	$this->db->select_sum("order_qty");
  	$query_item = $this->db->get_where("pos_billing_detail", array("date_created >" => $date))->row_array();

  	$data['query_sum'] = $query_sum;
  	$data['query_item'] = $query_item;
  	$data['store_name'] = $store;
  	$data['online_users'] = $online_users;
  	$data['query'] = $query;

  	$data['page'] = "vhome";
   	$this->template->get($data);
  }

  public function home_state_api(){
    $min = 7;
  	$day = date("d")-$min;
  	$date = date("Y-m-").$day;


  	$query_store = $this->db->get_where("pos_store", array("is_deleted" => 0));

  	$store = [];

  	foreach ($query_store->result_array() as $key => $value) {
  		$store_id = $value['store_id'];
      $num = [];
      $cate = [];
      for ($i=1; $i <= $min ; $i++) { 

        $m = $min-$i;
        $init_date = date("Y-m-d", strtotime("-".$m.' days'));

        $num[] = $this->db->get_where("pos_billing", array("store_id" => $store_id,"date_created" => $init_date))->num_rows();
        $cate[] = $init_date;
      }

  		$store[] = array("name" => $value['store_name'], "data" => $num);


    }


    echo json_encode(array('data' => $store,'categories' => $cate));

  }
 
}