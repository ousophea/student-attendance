<?php
class Student extends Controller {
    function Student() {
        parent::Controller();
        $this->jquery->add_library('popup.js');
		$this->jquery->add_library('datepicker.js');
        $this->load->model(array("mod_student"));
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
			$config['base_url'] = base_url() . 'student/manager';
			$this->input->post("txt_stuName")==true?$config['per_page'] = '2500':$config['per_page'] = '25';
			$config['total_rows'] = $this->mod_student->getNum();
			$this->pagination->initialize($config);
			//call model
			$data['all_ngo'] = $this->mod_student->getStudent($config['per_page'], $this->uri->segment(3));
			$data["title"]="Student Manager";
			$this->load->view("master",$data);
		}else{
			redirect("home/login");
		}
	}
	//add new ngo
	function addnew(){
		if($this->check_session()==false){ redirect("home/login"); exit();}
		$this->load->helper("mgpage");
		$data["title"]="New Student";
		//get ngo
		$data['ngos']=$this->mod_student->getNgo();
		//get classes
		$data['clas']=$this->mod_student->getCla();
		//validate field
		$this->form_validation->set_rules('dro_stuclaid', 'Class', 'required|trim');
		$this->form_validation->set_rules('txt_stufirst', 'Firstname', 'required|trim|max_length[50]');
		$this->form_validation->set_rules('txt_stulast', 'Lastname', 'required|trim|max_length[50]');
		$this->form_validation->set_rules('txt_stukhmer', 'Name(KH)', 'required|trim|max_length[50]');
		$this->form_validation->set_rules('dro_stusex', 'Sex', 'required|trim');
		$this->form_validation->set_rules('txt_stuage', 'Age', 'trim|required|integer');
		$this->form_validation->set_rules('dro_stungoid', 'Ngo', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view("master",$data);
		}else{
			if($this->upload_file() && $this->mod_student->addnew()){
				$this->session->set_userdata("ms_success","Data Saved!");
				$this->session->unset_userdata("filename");
				redirect("student/manager");
			}
			else{
				//error
				$this->session->set_userdata("ms_error","Data Not Saved!");
				$this->session->unset_userdata("filename");
				$this->load->view("master",$data);
			}
		}
	}
	//edit ngo
	function edit(){
		if($this->check_session()==false){ redirect("home/login"); exit();}
		$this->load->helper("mgpage");
		$data["title"]="Edit";
		//get ngo
		$data['ngos']=$this->mod_student->getNgo();
		//get classes
		$data['clas']=$this->mod_student->getCla();
		//get student info
		$data['con']=$this->uri->segment(3);
		$data['stu']=$this->mod_student->getStu($data['con']);
		//validate field
		$this->form_validation->set_rules('dro_stuclaid', 'Class', 'required|trim');
		$this->form_validation->set_rules('txt_stufirst', 'Firstname', 'required|trim|max_length[50]');
		$this->form_validation->set_rules('txt_stulast', 'Lastname', 'required|trim|max_length[50]');
		$this->form_validation->set_rules('txt_stukhmer', 'Name(KH)', 'required|trim|max_length[50]');
		$this->form_validation->set_rules('dro_stusex', 'Sex', 'required|trim');
		$this->form_validation->set_rules('txt_stuage', 'Age', 'trim|required|integer');
		$this->form_validation->set_rules('dro_stungoid', 'Ngo', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view("master",$data);
		}else{
			if($this->upload_file() && $this->mod_student->update($data['con'])){
				$this->session->set_userdata("ms_success","Data Update!");
				$this->session->unset_userdata("filename");
				redirect("student/manager");
			}
			else{
				//error
				$this->session->set_userdata("ms_error","Data Not Update!");
				$this->session->unset_userdata("filename");
				$this->load->view("master",$data);
			}
		}
	}
	//delete student
	function delete(){
		if($this->check_session()==false){ redirect("home/login"); exit();}
		if($this->uri->segment(3)!="" && gettype((int)$this->uri->segment(3))=="integer" && $this->mod_student->delete($this->uri->segment(3))){
			$this->session->set_userdata("ms_success","Data Deleted!");
			redirect("student/manager");
		}else {
			$this->session->set_userdata("ms_error","Can not Delete!");
			redirect("student/manager");
		}
	}
	//upload file
	function upload_file()
	{
		$this->load->library('image_lib');
		$sizes=array(300);
		$folder=array("stu_photo");
		$path="";
		//upload
		$config['upload_path'] = './stu_photo/';
		$config['max_size']	= 50000000;//kb
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$this->load->library('upload', $config);
		
		$i=0;
		//if no file upload
		$data=$_FILES['txt_photo']['name'];
		if($data==""){
			$filename="default.png";
			$this->session->set_userdata("filename",$filename);
			return true;
		}
		//if have file upload
		if($this->upload->do_upload('txt_photo')){
			$filename=$this->upload->data();
			$this->session->set_userdata("filename",$filename['file_name']);
			$oldw=$filename['image_width'];
			$oldh=$filename['image_height'];
			foreach($sizes as $size){
				//resize
				$neww=0;
				$newh=0;
				$i++;
				$config['image_library'] = 'gd2';
				$config['source_image'] = './stu_photo/'.$filename['file_name'];
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = TRUE;
				$config['new_image'] ='./stu_photo/'.$filename['file_name'];
				//if width > height
				if($oldw>=$size  && $oldw>$oldh){
					$neww=$size;
					$newh=($neww*$oldh)/$oldw;
				}else if($oldh>=$size  && $oldh>$oldw){//if width <= height
					$newh=$size;
					$neww=($newh*$oldw)/$oldh;
				}else{//if widht or height < $size 
					$neww=$oldw;
					$newh=$oldh;
				}
				$config['width'] = $neww;
				$config['height'] = $newh;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
			}
			return true;
		}
		else{
			return false;
		}
	}
	//check session
	function check_session(){
        if ($this->session->userdata("tea_name") && strtolower($this->session->userdata("tea_position"))==="admin") {
            return true;
        } else {
           return false;
        }
    }
}