<?php 

/**
* 
*/
class Login extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function index(){
		$query = $this->db->get_where("apps_active_login", array("is_active" => 1));
		if ($query->num_rows() > 0) {
			$query = $query->row_array();
			$login_link_1 = $query['login_link_1'];
			redirect(base_url().$login_link_1);
		}else{
			die("Access Forbidden");
		}
	}
}