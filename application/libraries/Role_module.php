<?php

/**
* 
*/
class Role_module extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function get($module_id){
		if ($module_id != NULL) {
			
			$user_id = $this->session_data->user_id();

			$query = $this->db->get_where("apps_users", array('user_id' => $user_id))->row_array();

			$jabatan_id = $query['jabatan_id'];

			$query2 = $this->db->get_where("apps_role_access", array("jabatan_id" => $jabatan_id,"module_id" => $module_id))->num_rows();

				if ($query2 > 0) {
					return true;
				}
				else{
					return false;
				}
		}
		else{
			return false;
		}
	}


}