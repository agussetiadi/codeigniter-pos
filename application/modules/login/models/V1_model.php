<?php 


/**
* 
*/
class V1_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function validate($param){
		$username = $param['username'];
		$password = $param['password'];

		$required =  array("Username" => $username, 'Password' => $password);
		/*
		Validasi input
		*/
		foreach ($required as $key => $value) {
			if (empty($value)) {
				$set_required[] = $key;
			}
		}

		if (!empty($set_required)) {
			$msg_validate = array('status' => 'validate', 'message' =>  $set_required);
		}
		else{

			$array =  array('username' =>$username , 'password' => $password,'is_deleted' => 0);
			$query = $this->db->get_where("apps_users", $array);

			$num = $query->num_rows();

			if ($num > 0) {

				$result = $query->row_array();
				$user_id = $result['user_id'];
				$store_id = $result['store_id'];
				$first_name = $result['first_name'];
				$jabatan_id = $result['jabatan_id'];
				$login_date = date("Y-m-d");
				$login_time = date("H:i:s");


				
				$this->session->set_userdata("user_id",$user_id);
				$this->session->set_userdata("user_session",$username);
				$this->session->set_userdata("first_name", $first_name);
				$this->session->set_userdata("store_id", $store_id);
				
				$array_insert = array("user_id" => $user_id, 
										"store_id" => $store_id,
										"login_date" => $login_date,
										"login_time" => $login_time
										);

				

				

				$this->db->join("apps_active_login","apps_jabatan.active_login_id = apps_active_login.active_login_id","LEFT");
				$q_jabatan = $this->db->get_where("apps_jabatan", array("apps_jabatan.jabatan_id" => $jabatan_id))->row_array();
				$active_login_id = $q_jabatan['active_login_id'];


				if ($active_login_id == 1) {
					$path = base_url();
					$msg_validate = array('status' => 'success','redirect' => $path);
					$query_insert = $this->db->insert("apps_login", $array_insert);
				}
				else{
					$path = base_url().$q_jabatan['login_link_2'];
					$msg_validate = array('status' => 'success','continue' => $path);	
				}

			}	
			else{
				$msg_validate = array('status' => 'failed','message' => 'Username atau password tidak sesuai');
			}		
		}

		return json_encode($msg_validate);

	}


}