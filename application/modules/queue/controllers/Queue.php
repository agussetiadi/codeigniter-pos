<?php 

/**
* 
*/
class Queue extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library("template");
	}
	public function index(){

	}
	public function display(){
		$store_id = $this->session_data->store_id();

		$data['queryQ'] = $this->db->get_where("apps_users", array("store_id"=>$store_id,"status" => "online"));
		$data['query_store'] = $this->db->get_where("pos_store", array("is_deleted"=>0));

		$get_queue = $this->db->get_where("apps_master_queue", array("is_deleted" => 0));

		$data['store_id'] = $store_id;

		$data['get_queue'] = $get_queue;


		$data['page'] = "display";
		$this->template->get($data);
	}
	public function print_q(){
		$store_id = $this->session_data->store_id();
		$get_queue = $this->db->get_where("apps_master_queue", array("is_deleted" => 0));
		$data['query_store'] = $this->db->get_where("pos_store", array("is_deleted"=>0));
	
		$data['get_queue'] = $get_queue;


		$data['query'] = $get_queue;
		$data['page'] = "print_q";
		$this->template->get($data);	
	}

	public function calling(){
		$store_id = $this->session_data->store_id();
		$data['query_store'] = $this->db->get_where("pos_store", array("is_deleted"=>0));
		$data['get_queue'] = $this->db->get_where("apps_master_queue", array("is_deleted" => 0));

		$data['page'] = "calling";
		$this->template->get($data);
	}

	public function get_num(){
		$store_id = $this->input->post("store_id");
		$m_queue_id = $this->input->post("m_queue_id");

		if (empty($m_queue_id)) {
			$get_m = $this->db->get_where("apps_master_queue", array("is_deleted"))->row_array();
			$m_queue_id = $get_m['m_queue_id'];
		}


		$get_queue = $this->db->get_where("apps_master_queue", array("is_deleted" => 0));
		$fetch = [];
		foreach ($get_queue->result_array() as $key => $value) {

			$query2 = $this->db->get_where("apps_queue", array("store_id"=>$store_id,"m_queue_id" => $value['m_queue_id'],"is_done" => 0))->num_rows();

			$queue_name[] = $value['queue_name'];

			$jml[] = $query2;
		}

		$this->db->order_by("queue_id","ASC");
		$getQueue = $this->db->get_where("apps_queue", array('m_queue_id' => $m_queue_id, "store_id" => $store_id,"is_done" => 0)) -> row_array();


		$data =  array("queue_name" => $queue_name,"queue_num" => $jml, "rows" => $getQueue );

		echo json_encode($data);

	}

	public function execute_print(){
		$number = $this->input->get("number");
		$data['number'] = $number;
		$this->load->view("execute_print",$data);
	}



}