<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

 
class Stock extends MX_Controller {
 
public function __construct() {
  parent::__construct();
 	$this->load->library("template");
  $this->load->model("stock_model");
  }
 
  public function index(){

  $data['query'] = $this->db->get_where("pos_store",array('is_deleted' => 0));

	$data['page'] = 'stock';
  $this->template->get($data);     

  }

  public function stock_report_api(){
    echo $this->stock_model->stock_report_api();
  }

  public function print_report(){

    $requestData  = $_REQUEST;
      
    $store_id = $requestData['store'];

    $array = [];
    
    $array['pos_item.is_deleted'] = 0;
    
    $ex =  $this->db->get_where("pos_item", $array);
    $query = $ex->result_array();
    $totalFiltered = $this->db->get_where("pos_item",$array)->num_rows();

  

    if (!empty($requestData['initDate'])) {

      $array2['pos_stock_rekap.trx_date <='] = $requestData['initDate'];
      
    }

    if ($requestData['store'] != 0) {

      $array2['pos_stock_rekap.store_id'] = $requestData['store'];
    }



    $data = array();
    foreach ($query as $key => $row) {
      $nestedData = [];

      $array2['item_id'] = $row['item_id'];

      
      $this->db->limit(1,0);
      $this->db->order_by("sr_id","DESC");
      $nm = $this->db->get_where("pos_stock_rekap", $array2);
      $row2 = $nm->row_array();


      if (empty($row2)) {
        $totalStock[] = 0;
      }
      else{
        $totalStock[] = $row2['total_stock'];
      }

      }


    $data['row_store'] = $this->db->get_where("pos_store",array("store_id" => $requestData['store']))->row_array();

    $data['query'] = $query;
    $data['totalFiltered'] = $totalFiltered;
    $data['date'] = $requestData['initDate'];

    $data['totalStock'] = $totalStock;

    $this->load->view('print_report_stock',$data);

  }
    



 
}