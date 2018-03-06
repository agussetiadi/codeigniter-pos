<?php

/**
* 
*/
class Template extends MX_Controller
{
	public function get($data){
		if (empty($this->session->userdata("user_session"))) {
			redirect(base_url()."login/");
		}
		$this->load->view("../templates/header");
	    $this->load->view("../templates/body", $data);
	    $this->load->view("../templates/footer");
	}

	
}

