<?php

/**
* 
*/
class Session_data extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function store_id(){
		$result = $this->input->get("store") ? : $this->session->userdata("store_id");
		return $result;
	}

	public function user_id(){
		$result = $this->session->userdata("user_id");
		return $result;
	}
	public function no_loket(){
		$result = $this->session->userdata("no_loket");
		return $result;
	}
	public function get_user($field){
		$user_id = $this->user_id();

		$this->db->select("apps_users.*, apps_jabatan.jabatan_name");
		$this->db->join("apps_jabatan","apps_jabatan.jabatan_id = apps_users.jabatan_id","INNER");
		$query = $this->db->get_where("apps_users", array("apps_users.user_id" => $user_id))->row_array();
		return $query[$field];
	}




}