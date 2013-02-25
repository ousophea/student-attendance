<?php

/*
 * Created on Jan 27, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class Classes extends Controller {

    var $loading;

    function Classes() {
        parent::Controller();
        $this->check_session();
        //$this->jquery->add_library('admin_action.js');
        $this->jquery->add_library('assign.js');
        $this->jquery->add_library('popup.js');
        $this->load->model(array('mod_classes'));
        $this->loading = '<span class="loading" style="display:none;border:0px !important;">' . img('global/images/loading.gif') . '</span>';
    }

    function index() {
        redirect("classes/manager");
    }

    // panel page
    function manager() {
        $data['title'] = 'Classes';
        $data['obj']=$this;
        // pagination
        $config['base_url'] = base_url() . 'classes/manager';
        $config['prev_link'] = 'Previous';
        $config['next_link'] = 'Next';
        $config['per_page'] = ($this->input->post($this->dbf->cla_name))?'':'25';
        $config['total_rows'] = ($this->input->post($this->dbf->cla_name))?'':$this->db->where('cla_status','1')->count_all_results('tbl_classes'); // (!$this->input->post($this->dbf->cla_name) || $this->input->post($this->dbf->cla_name)=='')?$this->db->count_all('tbl_classes'):$this->mod_classes->get_classes(array($config['per_page'], $this->uri->segment(3)))->num_rows();
        $this->pagination->initialize($config);
        $data['query'] = $this->mod_classes->get_classes(array($config['per_page'], $this->uri->segment(3)));
        $this->load->view("master", $data);
    }
    function get_teacher_assegned($p){
        return $this->mod_classes->get_teacher_assigned($p);
    }

    // add new class
    function addnew() {
        $data['title'] = 'Add new calss';
        $db = new dbf(); // get field name of each table in database
        $this->form_validation->set_rules($db->cla_name, 'Class name', 'trim|callback_string|required|max_length[30]|callback_exist[tbl_classes-' . $db->cla_name . ']');
        $this->form_validation->set_rules($db->cla_age_leval, 'Age level', 'trim|required');
        $this->form_validation->set_rules($db->cla_time, 'Time', 'trim|required');
        $this->form_validation->set_rules($db->cla_gen_id, 'Generation', 'trim|required');
        //$this->form_validation->set_rules($db->cla_student_number, 'Student number', 'trim|numeric|max_length[10]');
        $this->form_validation->set_rules($db->cla_description, 'Description', 'trim|max_length[600]');
        $data['generation'] = $this->db->get('tbl_generations'); // select all generation
        $data['teacher']=$this->mod_classes->get_teacher();
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', 'Class could no save, please read instruction in the form bellow.');
            $this->load->view('master', $data);
        } else {
            // insert into db
            if ($this->mod_classes->addnew()) {
                $this->session->set_flashdata('success', 'Class save successfully');
                redirect('classes/manager');
            } else {
                $this->load->view('master', $data);
            }
        }
    }

    function edit() {

        $data['title'] = 'Edit class';
        $db = new dbf(); // get field name of each table in database
        $this->form_validation->set_rules($db->cla_name, 'Class name', 'trim|callback_string|required|max_length[30]|callback_exist[tbl_classes-' . $db->cla_name . '-' . $db->cla_id . '-' . $this->input->post($db->cla_id) . ']');
        $this->form_validation->set_rules($db->cla_age_leval, 'Age level', 'trim|required');
        $this->form_validation->set_rules($db->cla_time, 'Time', 'trim|required');
        $this->form_validation->set_rules($db->cla_gen_id, 'Generation', 'trim|required');
        //$this->form_validation->set_rules($db->cla_student_number, 'E-mail', 'trim|numeric|max_length[10]');
        $this->form_validation->set_rules($db->cla_description, 'Description', 'trim|max_length[600]');
        $data['generation'] = $this->db->get('tbl_generations'); // select all generation
        $data['query'] = $this->mod_classes->get_one_classes();
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', 'Class could no save, please read instruction in the form bellow.');
            $this->load->view('master', $data);
        } else {
            // insert into db
            if ($this->mod_classes->edit()) {
                $this->session->set_flashdata('success', 'Class save successfully');
                redirect('classes/manager');
            } else {
                $this->load->view('master', $data);
            }
        }
    }

    // assign teacher
    function assign(){
        if($this->uri->segment(3)=='assign'){
            $this->mod_classes->assign();
            $this->session->set_flashdata('success','Teacher assigned successfully');
            redirect('classes/manager');
        }
        $this->load->view('classes/assign');
    }
    // unassign
    function remove_teacher(){
        $this->mod_classes->remove_teacher();
        $this->session->set_flashdata('success','Teacher remove from class successfully');
        redirect('classes/manager');
    }

    // delete class
    function delete() {
        if ($this->mod_classes->delete()) {
            $this->session->set_flashdata('success', 'Class deleted successfully');
            redirect('classes/manager');
        } else {
            $this->session->set_flashdata('error', 'Class could not delete!.');
            redirect('classes/manager');
        }
    }

    // check permistion
    function check_session() {
        if (strtolower($this->session->userdata("tea_position")) == 'admin') {
            return true;
        } else {
            redirect("home/login");
        }
    }

    // validation username exist
    function exist($str, $key) {
        //echo $key;die();
        $db = explode("-", $key);
        if (isset($db[2]))
            $this->db->where($db[2] . ' != ', $db[3]);
        $this->db->where($db[1], $str); // field of table name
        $name = $this->db->get($db[0])->num_rows(); // table name

        if ($name == 1) {
            $this->form_validation->set_message('exist', '%s "' . $str . '" already exist');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    // validate string
    function string($str){
        if(preg_match ("/[^A-z0-9._\- ]/", $str )){
            $this->form_validation->set_message('string', '%s can allow specail character . _ -');
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    // count students in class
    function count_students($id){// $id is array
        return $this->mod_classes->count_students($id);
    }


}