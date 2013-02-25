<?php
class Attendant extends Controller {

    function Attendant() {
        parent::Controller();
		$this->jquery->add_library('popup.js');
		$this->jquery->add_library('datepicker.js');
        $this->load->model(array("mod_attendant"));
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
			$data['obj']=$this;
			$this->load->helper("mgpage");
			$this->session->unset_userdata('num_stu');
			//clear session
			$this->session->unset_userdata('cla_id');
			$this->session->unset_userdata('gen_id');
			$this->session->unset_userdata('ter_id');
			$this->session->unset_userdata('att_date');
			
			$data['all_cla']=$this->mod_attendant->getAllCla();
			$data["title"]="Attendant Manager";
			$this->load->view("master",$data);
		}else{
			redirect("home/login");
		}
	}
	//get class in term
	function getClaInTer($genId,$terId){
		return $this->mod_attendant->getClaInTer($genId, $terId);
	}
	//get ngo
	function addAtt(){
		$data['title']="Add Attendant";
		if($this->check_session()==false){ redirect("home/login"); exit();}
		if(!$this->session->userdata('gen_id')){//check to create session
			$this->session->set_userdata('gen_id',$this->uri->segment(3));
			$this->session->set_userdata('cla_id',$this->uri->segment(4));
			$this->session->set_userdata('ter_id',$this->uri->segment(5));
		}
		//check date for attendant
		$terInfo=$this->mod_attendant->checkDateTerm($this->session->userdata('gen_id'),$this->session->userdata('ter_id'));
		if($terInfo->num_rows>0){
			foreach($terInfo->result() as $row){
				//if(strtotime($row->ter_start_date)*1000 > strtotime(mdate("%Y-%m-%d"))*1000 || strtotime($row->ter_end_date)*1000 < strtotime(mdate("%Y-%m-%d"))*1000 ){
				if(strtotime($row->ter_start_date)*1000 > strtotime(mdate("%Y-%m-%d"))*1000){
					$this->session->set_userdata("ms_error","Today is out of duration of this term");
					redirect('attendant/manager');
				}
			}
		}else {
			$this->session->set_userdata("ms_error","No term in this generation!");
			redirect('attendant/manager');
		}
		$this->form_validation->set_rules('txt_attDate', 'Date', 'required|trim|callback_checkDate');
		if ($this->form_validation->run() == false){
			$this->load->view('master',$data);
		}else{
			//check date if it is over 
			foreach($terInfo->result() as $row){
				//if(strtotime($row->ter_start_date)*1000 > strtotime($this->input->post('txt_attDate'))*1000 || strtotime($row->ter_end_date)*1000 < strtotime($this->input->post('txt_attDate'))*1000){
				if(strtotime($row->ter_start_date)*1000 > strtotime($this->input->post('txt_attDate'))*1000 || strtotime($row->ter_end_date)*1000 < strtotime($this->input->post('txt_attDate'))*1000){
					$this->session->set_userdata("ms_error","This date is out of duration of this term!");
					$this->load->view('master',$data);
				}else{
					$this->session->set_userdata('att_date',$this->input->post('txt_attDate'));
					redirect('attendant/addnew');
				}
			}
			
		}
	}
	
	//add new ngo
	function addnew(){
		if($this->check_session()==false){ redirect("home/login"); exit();}
		$this->load->helper("mgpage");
		$data["title"]="Attendant";
		//get generation
		$data['gens']=$this->mod_attendant->getGen($this->session->userdata('gen_id'));
		//get generation
		$data['clas']=$this->mod_attendant->getCla($this->session->userdata('cla_id'));
		//get generation
		$data['ters']=$this->mod_attendant->getTer($this->session->userdata('ter_id'));
		//get student where
		$data['some_stu']=$this->mod_attendant->getSomeStu();
		//if exist attendant for that date
		if($data['some_stu']->num_rows > 0){}
		// if not exist
		else{
			//get student
			$data['all_stu']=$this->mod_attendant->getStu();
		}
		
		if (!$this->input->post('hid')) {
			$this->load->view("master",$data);
		}else{
			if($this->input->post('hid')=='add' && $this->mod_attendant->addnew()){
				$this->session->set_userdata("ms_success","Data Saved!");
				redirect("attendant/manager");
			}
			else if($this->input->post('hid')=='edit' && $this->mod_attendant->update()){
				$this->session->set_userdata("ms_success","Data Saved!");
				redirect("attendant/manager");
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
		$data["oneNgo"]=$this->mod_attendant->getOneNgo($this->session->userdata("condition"));
		if ($this->form_validation->run() == false) {
			$this->load->view("master",$data);
		}else{
			if($this->mod_attendant->update()){
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
		if($this->uri->segment(3)!="" && gettype((int)$this->uri->segment(3))=="integer" && $this->mod_attendant->delete($this->uri->segment(3))){
			$this->session->set_userdata("ms_success","Data Deleted!");
			redirect("ngo/manager");
		}else {
			$this->session->set_userdata("ms_error","Can not Delete!");
			redirect("ngo/manager");
		}
	}
	//check date
	function checkDate($data){
		//echo 10;die();
		$datestring = "%Y-%m-%d";
		if ($data > mdate($datestring))
		{
			$this->form_validation->set_message('checkDate', 'The %s field is over than '.mdate($datestring));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	//check session
	function check_session() {
        if ($this->session->userdata("tea_name") && (strtolower($this->session->userdata("tea_position"))==="admin" || strtolower($this->session->userdata("tea_position"))==="teacher")) {
            return true;
        } else {
           return false;
        }
    }
}