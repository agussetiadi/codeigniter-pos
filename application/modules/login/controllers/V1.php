<?php 

/**
* 
*/
class V1 extends MX_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("v1_model");
	}
	public function index(){
		$data['query'] = $this->db->get_where("apps_shift", array('is_deleted' => 0));

		$this->load->view("v1", $data);
	}

	public function validate(){
		$username = $this->input->post("username");
		$password = $this->input->post("password");
/*		$no_loket = $this->input->post("no_loket");
		$shift_id = $this->input->post("shift_id");*/
		$param =  array("username" => $username, 'password' => $password);
		echo $this->v1_model->validate($param);
	}

	public function loket(){
		$no_loket = $this->input->post("no_loket");
		$shift_id = $this->input->post("shift_id");

		if (empty($this->session->userdata("user_session"))) {
			die("Access Forbidden");
		}

		$user_id = $this->session->userdata("user_id");
		


		$this->session->set_userdata("no_loket",$no_loket);
		$this->session->set_userdata("shift_id", $shift_id);

		$this->db->select("apps_users.* , apps_jabatan.jabatan_id");
		
		$this->db->join("apps_jabatan","apps_jabatan.jabatan_id = apps_users.jabatan_id","INNER");
		$query = $this->db->get_where("apps_users",array("apps_users.user_id" => $user_id))->row_array();

		$jabatan_id = $query['jabatan_id'];
		$store_id = $query['store_id'];



		$login_date = date("Y-m-d");
		$login_time = date("H:i:s");

		$array_update = array(
						"shift_id" => $shift_id,
						"no_loket" => $no_loket
						);
		$this->db->where("user_id" , $user_id);
		$query_update = $this->db->update("apps_users", $array_update);
		$path = base_url();
		$msg_validate = array('status' => 'success','redirect' => $path);
		if ($query_update) {
		echo json_encode($msg_validate);
			
		}

	}

}