<?php

/*
 * Created on Jan 27, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class Teachers extends Controller {

    var $loading;

    function Teachers() {
        parent::Controller();
        $this->check_session();
        $this->load->model(array('mod_teachers'));
        $this->loading = '<span class="loading" style="display:none;border:0px !important;">' . img('global/images/loading.gif') . '</span>';
    }

    function index() {
        redirect("teachers/manager");
    }

    // panel page
    function manager() {
        $data['title'] = 'Teachers';
        // pagination
        $config['base_url'] = base_url() . 'teachers/manager';
        $config['prev_link'] = 'Previous';
        $config['next_link'] = 'Next';
        $config['per_page'] = ($this->input->post($this->dbf->tea_name))?'':'25';
        $config['total_rows'] = ($this->input->post($this->dbf->tea_name))?'':$this->db->where('tea_status',1)->count_all_results('tbl_teachers'); // (!$this->input->post($this->dbf->tea_name) || $this->input->post($this->dbf->tea_name)=='')?$this->db->count_all('tbl_teachers'):$this->mod_teachers->get_teachers(array($config['per_page'], $this->uri->segment(3)))->num_rows();
        $this->pagination->initialize($config);
        $data['teachers'] = $this->mod_teachers->get_teachers(array($config['per_page'], $this->uri->segment(3)));
        $this->load->view("master", $data);
    }

    // add new teacher
    function addnew() {
        $data['title'] = 'Add new teacher';
        $db = new dbf(); // get field name of each table in database
        $this->form_validation->set_rules($db->tea_name, 'Username', 'trim|callback_string|required|max_length[30]|callback_exist[tbl_teachers-' . $db->tea_name . ']');
        $this->form_validation->set_rules($db->tea_password, 'Password', 'trim|required|min_length[5]|max_length[30]');
        $this->form_validation->set_rules('tea_passwordc', 'Password Confirm', 'trim|required|min_length[5]|max_length[30]|matches[tea_password]');
        $this->form_validation->set_rules($db->tea_sex, 'Sex', 'trim|required');
        $this->form_validation->set_rules($db->tea_position, 'Position', 'trim|required');
        $this->form_validation->set_rules($db->tea_email, 'E-mail', 'trim|valid_email|max_length[30]');
        $this->form_validation->set_rules($db->tea_phone, 'Phone', 'trim|max_length[30]');
        $this->form_validation->set_rules($db->tea_address, 'Address', 'trim|max_length[600]');
        $this->form_validation->set_rules($db->tea_description, 'Description', 'trim|max_length[600]');
        if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('error', 'Teacher could no save, please read instruction in the form bellow.');
            $this->load->view('master', $data);
        } else {
            // insert into db
            if ($this->mod_teachers->addnew()) {
                $this->session->set_flashdata('success', 'Teacher save successfully');
                redirect('teachers/manager/success');
            } else {
                $this->load->view('master', $data);
            }
        }
    }

    function edit() {
        $data['title'] = 'Edit teacher';
        $db = new dbf(); // get field name of each table in database
        $this->form_validation->set_rules($db->tea_name, 'Username', 'trim|callback_string|required|max_length[30]|callback_exist[tbl_teachers-' . $db->tea_name . '-tea_id-' . $this->uri->segment(3) . ']');
        $this->form_validation->set_rules($db->tea_password, 'Password', 'trim|required|min_length[5]|max_length[30]');
        $this->form_validation->set_rules('tea_passwordc', 'Password Confirm', 'trim|required|min_length[5]|matches[tea_password]');
        $this->form_validation->set_rules($db->tea_sex, 'Sex', 'trim|required');
        $this->form_validation->set_rules($db->tea_position, 'Position', 'trim|required');
        $this->form_validation->set_rules($db->tea_email, 'E-mail', 'trim|valid_email|max_length[30]');
        $this->form_validation->set_rules($db->tea_phone, 'Phone', 'trim|max_length[30]');
        $this->form_validation->set_rules($db->tea_address, 'Address', 'trim|max_length[600]');
        $this->form_validation->set_rules($db->tea_description, 'Description', 'trim|max_length[600]');
        $data['teachers'] = $this->mod_teachers->get_one_teachers();
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', 'Teacher could no save, please read instruction in the form bellow.');
            $this->load->view('master', $data);
        } else {
            // insert into db
            if ($this->mod_teachers->edit()) {
                $this->session->set_flashdata('success', 'Teacher save successfully');
                redirect('teachers/manager');
            } else {
                $this->load->view('master', $data);
            }
        }
    }

    // delete teacher
    function delete(){
        if($this->mod_teachers->delete()){
            $this->session->set_flashdata('success', 'Teacher deleted successfully');
                redirect('teachers/manager');
        }
        else{
            $this->session->set_flashdata('error', 'Teacher could not delete!.');
            redirect('teachers/manager');
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

}