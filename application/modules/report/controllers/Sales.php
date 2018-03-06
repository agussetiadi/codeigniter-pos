<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

 
class Sales extends MX_Controller {
 
public function __construct() {
  parent::__construct();
 	$this->load->library("template");
  $this->load->model("sales_model");
  }
 
  public function index(){

  $data['query'] = $this->db->get_where("pos_store",array('is_deleted' => 0));

	$data['page'] = 'sales_home';
  $this->template->get($data);     

  }
  public function sales(){

  	$data['pages'] = 'sales';
  	$this->template->get($data);
  }

  public function sales_report_api(){
    echo $this->sales_model->sales_report_api();
  }

  public function print_report(){

    $requestData  = $_REQUEST;
      
    $store_id = $requestData['store'];



    $array = [];
    if (!empty($requestData['dateStart'])) {
      $array = array("pos_billing.date_created >" => $requestData['dateStart'],"pos_billing.date_created <" => $requestData['dateEnd']);
    }


    if ($store_id != 0) {
      $array['pos_billing.store_id'] = $store_id;
    }
    


    $this->db->join("pos_store", "pos_store.store_id = pos_billing.store_id","INNER");
    $ex =  $this->db->get_where("pos_billing", $array);
    $query = $ex->result_array();

    $totalFiltered = $this->db->get_where("pos_billing",$array)->num_rows();

    $omset = 0;
    $hpp = 0;
    foreach ($query as $key => $value) {
      $omset += $value['grand_total'];
      $hpp += $value['total_hpp'];
    }

    $data['omset']  = $omset;
    $data['hpp']  = $hpp;

    $data['dateStart']  = $requestData['dateStart'];
    $data['dateEnd']    = $requestData['dateEnd'];


    if ($requestData['store'] == 0) {
        $data['store_name'] = 'Semua Cabang'; 
    }
    else{
        $data['store_name'] = $ex->row_array()['store_name'];
    }

    $data['query'] = $query;
    $data['num'] = $totalFiltered;
    $this->load->view('print_report',$data);

  }
  
 
}