<?php 

/**
* 
*/
class Setting extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library("template");


	}

	public function index(){

	}
	public function role(){
		$data['query_jabatan'] = $this->db->get_where("apps_jabatan", array("is_deleted"));

		$this->db->group_by("module_name");
		$data['query_module'] = $this->db->get("apps_module");

		$data['page'] = "app_setting";
		$this->template->get($data);
	}
	public function render_api(){
		$jabatan_id 	= $this->input->post("jabatan_id");
		$module_name 	= $this->input->post("module_name");

		if ($module_name == "all") {
			$query1 = $this->db->get("apps_module");	
		}
		else{
			$query1 = $this->db->get_where("apps_module", array('module_name' => $module_name ));
		}
		$arr = [];
			foreach ($query1->result_array() as $key1 => $value1) {

				$module_id = $value1['module_id'];

				$query2 = $this->db->get_where("apps_role_access",array('module_id' =>$module_id,'jabatan_id' => $jabatan_id))->num_rows();
				if ($query2 > 0) {
					$mSt[] = "checked";
				}
				else{
					$mSt[] = "";	
				}
				$mId[] = $module_id;
				$mdName[] = $value1['module_role_name'];


			}
		echo json_encode(array("module_id" => $mId, "is_active" => $mSt,"module_name" => $mdName));

	}

	public function access_update(){
		$jabatan_id = $this->input->post("jabatan_id");
		$module_id 	= $this->input->post("module_id");
		$module_name 	= $this->input->post("module_name");


		if ($module_name == "all") {
			$array = array("jabatan_id" => $jabatan_id);
			$query_delete = $this->db->delete("apps_role_access",$array);
		}
		else{
			$q_d = $this->db->get_where("apps_module", array('module_name' => $module_name));

			foreach ($q_d->result_array() as $key_d => $value_d) {
				$array = array("jabatan_id" => $jabatan_id, "module_id" => $value_d['module_id']);
				$query_delete = $this->db->delete("apps_role_access",$array);
			}
		}


		if ($query_delete) {
			for ($i=0; $i < count($module_id) ; $i++) { 
				$query_insert = $this->db->insert("apps_role_access", array('module_id' => $module_id[$i],"jabatan_id" => $jabatan_id, "is_active" => 1));
			}
		}

		$arrayJson = array("status" => "success");

		echo json_encode($arrayJson);
	}


	


}