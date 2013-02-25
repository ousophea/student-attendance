<?php
class Ngo extends Controller {

    function Ngo() {

        parent::Controller();
		$this->jquery->add_library('datepicker.js');
        $this->load->model(array("mod_ngo"));
    }

    function index() {
		if($this->check_session()){
			redirect("administrations/manager");
		}
		else{
			$this->load->view("login");
		}

	}
	//mager page
	function manager(){
		if($this->check_session()){
			$this->load->helper("mgpage");
			//pagination
			$config['base_url'] = base_url() . 'ngo/manager';
			$config['per_page'] = '25';
			$config['total_rows'] = $this->mod_ngo->getNum();
			$this->pagination->initialize($config);
			//call model
			$data['all_ngo'] = $this->mod_ngo->getNgo($config['per_page'], $this->uri->segment(3));
			$data["title"]="NGO Manager";
			$this->load->view("master",$data);
		}else{
			redirect("home/login");
		}
	}
	
	//add new ngo
	function addnew(){
		if($this->check_session()==false){ redirect("home/login"); exit();}
		$this->load->helper("mgpage");
		$data["title"]="New Organization";
		
		$this->form_validation->set_rules('txt_ngoname', 'NGO Name', 'required|trim|max_length[50]');
		$this->form_validation->set_rules('txt_ngoadd', 'Address', 'required|trim|max_length[50]');
		$this->form_validation->set_rules('txt_ngocontact', 'Contact', 'required|trim|max_length[50]');
		$this->form_validation->set_rules('txt_ngoemail', 'Email', 'required|trim|valid_email|max_length[50]');
		$this->form_validation->set_rules('txt_ngourl', 'Url', 'max_length[40]');
		if ($this->form_validation->run() == false) {
			$this->load->view("master",$data);
		}else{
			if($this->mod_ngo->addnew()){
				$this->session->set_userdata("ms_success","Data Saved!");
				redirect("ngo/manager");
			}
			else{
				$this->load->view("master",$data);
				//error
			}
		}
	}
	
	//edit ngo
	function edit(){
		if($this->check_session()==false){ redirect("home/login"); exit();}
		$this->load->helper("mgpage");
		$data["title"]="Edit Organization";
		
		$this->form_validation->set_rules('txt_ngoname', 'NGO Name', 'required|trim|max_length[50]');
		$this->form_validation->set_rules('txt_ngoadd', 'Address', 'required|trim|max_length[50]');
		$this->form_validation->set_rules('txt_ngocontact', 'Contact', 'required|trim|max_length[50]');
		$this->form_validation->set_rules('txt_ngoemail', 'Email', 'required|trim|valid_email|max_length[50]');
		$this->form_validation->set_rules('txt_ngourl', 'Url', 'max_length[40]');
		//get one ngo
		if($this->uri->segment(3)){
			$this->session->set_userdata("condition",$this->uri->segment(3));
		}
		$data["oneNgo"]=$this->mod_ngo->getOneNgo($this->session->userdata("condition"));
		if ($this->form_validation->run() == false) {
			$this->load->view("master",$data);
		}else{
			if($this->mod_ngo->update()){
				$this->session->set_userdata("ms_success","Data Saved!");
				$this->session->unset_userdata("condition");
				redirect("ngo/manager");
			}
			else{
				$this->load->view("master",$data);
				//error
			}
		}
	}
	
	//delete ngo
	function delete(){
		if($this->check_session()==false){ redirect("home/login"); exit();}
		if($this->uri->segment(3)!="" && gettype((int)$this->uri->segment(3))=="integer" && $this->mod_ngo->delete($this->uri->segment(3))){
			$this->session->set_userdata("ms_success","Data Deleted!");
			redirect("ngo/manager");
		}else {
			$this->session->set_userdata("ms_error","Can not Delete!");
			redirect("ngo/manager");
		}
	}
	//check session
	function check_session() {
        if ($this->session->userdata("tea_name") && strtolower($this->session->userdata("tea_position"))==="admin") {
            return true;
        } else {
           return false;
        }
    }
}