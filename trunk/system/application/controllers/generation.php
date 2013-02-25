<?php
/*
	********************** How to validate date ****************
	1/ check library MY_Form_Validation.php(appication/libraries/MY_Form_Validation.php)
	2/ use function bigDate for End date
	3/ use function smallDate for Start date
*/
class Generation extends Controller {
    function Generation() {
        parent::Controller();
		$this->jquery->add_library('popup.js');
		//$this->jquery->add_library('validate.js');
		$this->jquery->add_library('datepicker.js');
		$this->jquery->add_library('tableInputGenerator.js');		
        $this->load->model(array("mod_generation"));
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
			//clear session if exist
			$this->session->unset_userdata('gen_year');
			$this->session->unset_userdata('gen_numterm');
			$this->session->unset_userdata('gen_des');
			$this->session->unset_userdata('ter_id');
			$this->session->unset_userdata('gen_id');
			$this->load->helper("mgpage");
			$data['obj']=$this;
			//pagination
			$config['base_url'] = base_url() . 'generation/manager';
			$this->input->post("txt_search1")==true?$config['per_page'] = '250000':$config['per_page'] = '25';
			$config['total_rows'] = $this->mod_generation->getNum();
			$this->pagination->initialize($config);
			//call model
			$data['all_gen'] = $this->mod_generation->getGen($config['per_page'], $this->uri->segment(3));
			$data["title"]="Generation Manager";
			$this->load->view("master",$data);
		}else{
			redirect("home/login");
		}
	}
	//add new ngo
	function addnew(){
		if($this->check_session()==false){ redirect("home/login"); exit();}
		$this->load->helper("mgpage");
		$data["title"]="New Generation Step 1";
		
		$this->form_validation->set_rules('txt_genyear', 'Year', 'required|trim|max_length[50]');
		$this->form_validation->set_rules('txt_gennumterm', 'Address', 'required|trim|max_length[50]|integer');
		if ($this->form_validation->run() == false) {
			$this->load->view("master",$data);
		}else{
			$this->session->set_userdata('gen_year',$this->input->post('txt_genyear'));
			$this->session->set_userdata('gen_numterm',$this->input->post('txt_gennumterm'));
			$this->session->set_userdata('gen_des',$this->input->post('txt_gendes'));
			redirect("generation/addnew1");
		}
	}
		//add new 1
	function addnew1(){
		if($this->check_session()==false){ redirect("home/login"); exit();}
		$this->load->helper("mgpage");
		$this->load->library(array('MY_Form_validation'));
		$data["title"]="New Generation Step 1";
		$num=$this->session->userdata('gen_numterm');
		for($i=1; $i<=$num; $i++){
			//$this->form_validation->set_rules('txt_terName'.$i, 'Term', 'required|trim|max_length[50]');
			$i>1?$first_con='|callback_smallDate[txt_terEDate'.($i-1) .']':$first_con='';
			$this->form_validation->set_rules('txt_terSDate'.$i, 'Start Date '.$i, 'required|trim|max_length[50]|valid_date[yyyy-mm-dd,-]'.$first_con);
			$this->form_validation->set_rules('txt_terEDate'.$i, 'End Date '.$i, 'required|trim|max_length[50]|valid_date[yyyy-mm-dd,-]|callback_bigDate[txt_terSDate'.$i.']');
		}
		if ($this->form_validation->run() == false) {
			$this->load->view("master",$data);
		}else{
			if($this->mod_generation->addnew()){
				$this->session->set_userdata("ms_success","Data Saved!");
				redirect("generation/manager");
			}
			else{
				$this->session->set_userdata("ms_error","Data can not Saved!");
				$this->load->view("master",$data);
			}
		}
	}
	//get term
	function getTerm($genId){
		//get term
		return $this->mod_generation->getTerm($genId);
	}
	//edit term
	function editTerm(){
		if($this->check_session()==false){ redirect("home/login"); exit();}
		$data['title']='Edit term';
		//get term
		$this->session->userdata('ter_id')?'':$this->session->set_userdata('ter_id',$this->uri->segment(3));
		$this->session->userdata('gen_id')?'':$this->session->set_userdata('gen_id',$this->uri->segment(4));
		$data['getOneTer']=$this->mod_generation->getOneTerm($this->session->userdata('ter_id'));
		$this->form_validation->set_rules('txt_tersdate', 'Start Date ', 'required|trim|max_length[50]|valid_date[yyyy-mm-dd,-]');
		$this->form_validation->set_rules('txt_teredate', 'End Date ', 'required|trim|max_length[50]|valid_date[yyyy-mm-dd,-]|callback_bigDate[txt_tersdate]');
		if ($this->form_validation->run() == false) {
			$this->load->view('master',$data);
		}
		else{
			
			if($this->mod_generation->editTerm($this->session->userdata('ter_id'))){
				$this->session->set_userdata("ms_success","Data Saved!");
				redirect("generation/manager");
			}
			else{
				$this->load->view('master',$data);
				//error
			}
		}
	}
	//add term to generation
	function addTerm(){
		if($this->check_session()==false){ redirect("home/login"); exit();}
		$data['title']='Add term';
		//get term
		$this->session->userdata('ter_id')?'':$this->session->set_userdata('ter_id',$this->uri->segment(3));
		$this->session->userdata('gen_id')?'':$this->session->set_userdata('gen_id',$this->uri->segment(4));
		$data['getOneTer']=$this->mod_generation->getOneTerm($this->session->userdata('ter_id'));
		$this->form_validation->set_rules('txt_tersdate', 'Start Date ', 'required|trim|max_length[50]|valid_date[yyyy-mm-dd,-]');
		$this->form_validation->set_rules('txt_teredate', 'End Date ', 'required|trim|max_length[50]|valid_date[yyyy-mm-dd,-]|callback_bigDate[txt_tersdate]');
		if ($this->form_validation->run() == false) {
			$this->load->view('master',$data);
		}
		else{
			
			if($this->mod_generation->addTerm($this->session->userdata('ter_id'),$this->session->userdata('gen_id'))){
				$this->session->set_userdata("ms_success","Data Saved!");
				redirect("generation/manager");
			}
			else{
				$this->load->view('master',$data);
				//error
			}
		}
	}
	//delete term
	function deleteTerm(){
		if($this->check_session()==false){ redirect("home/login"); exit();}
		if($this->uri->segment(3)!="" && gettype((int)$this->uri->segment(3))=="integer" && $this->mod_generation->deleteTerm($this->uri->segment(3))){
			$this->session->set_userdata("ms_success","Data Deleted!");
			redirect("generation/manager");
		}else {
			$this->session->set_userdata("ms_error","Can not Delete!");
			redirect("generation/manager");
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
	//================not use============
	//edit ngo
	function edit(){
		if($this->check_session()==false){ redirect("home/login"); exit();}
		$this->load->helper("mgpage");
		$data["title"]="Edit Generation";
		//condition for edit
		if($this->uri->segment(3)){
			$this->session->set_userdata("condition",$this->uri->segment(3));
		}
		//get generation
		$data['oneGen']=$this->mod_generation->getOneGen($this->session->userdata("condition"));
		$this->form_validation->set_rules('txt_genyear', 'Year', 'required|trim|max_length[50]');
		$this->form_validation->set_rules('txt_gendes', 'Descripton', 'max_length[500]');
		if ($this->form_validation->run() == false) {
			//get generation
			$this->load->view("master",$data);
		}else{
			if($this->mod_generation->update($this->session->userdata("condition"))){
				$this->session->set_userdata("ms_success","Data Saved!");
				$this->session->unset_userdata("condition");
				redirect("generation/manager");
			}
			else{
				$this->load->view("master",$data);
				//error
			}
		}
	}
	//validate date
	function bigDate($str, $params){
		$e=1000 * strtotime($str);
		$s=1000 * strtotime($this->input->post($params));
		$re=$this->input->post($params);
		if($s>$e){
			$this->form_validation->set_message('bigDate','Must >= '.$re);
			return false;
		}else return true;
	}
	//validate date
	function smallDate($str, $params){
		$s=1000 * strtotime($str);
		$e=1000 * strtotime($this->input->post($params));
		$re=$this->input->post($params);
		if($s<$e){
			$this->form_validation->set_message('smallDate','Must >= '.$re);
			return false;
		}else return true;
	}
	//delete ngo
	function delete(){
		if($this->check_session()==false){ redirect("home/login"); exit();}
		if($this->uri->segment(3)!="" && gettype((int)$this->uri->segment(3))=="integer" && $this->mod_generation->delete($this->uri->segment(3))){
			$this->session->set_userdata("ms_success","Data Deleted!");
			redirect("generation/manager");
		}else {
			$this->session->set_userdata("ms_error","Can not Delete!");
			redirect("generation/manager");
		}
	}

}