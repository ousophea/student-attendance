<?php
class Home extends Controller {

    function Home() {

        parent::Controller();
        $this->load->model(array("mod_login"));
    }

    function index() {
		if($this->check_session()){
			redirect("administrations/manager");
		}
		else{
			$this->load->view("login");
		}

	}
	//login
	function login(){
		
		$this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
		if($this->check_session() || $this->mod_login->_login($this->input->post("username"),$this->input->post("password"))){
				redirect("administrations/manager");
				//echo 1;
		} 
		else if ($this->form_validation->run() == false) {
			$this->load->view("login");
		}
		else
		{
				$this->session->set_userdata("ms","Invalid Account!");
				$this->index();
		}
	}

	// Sign out
	function signout(){
		$this->session->sess_destroy();
		redirect('home');
	}

	function check_session() {
        if ($this->session->userdata("tea_name")) {
            return true;
        } else {
           return false;
        }
    }
}