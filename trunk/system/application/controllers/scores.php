<?php

/*
 * Created on Jan 27, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class Scores extends Controller {

    var $loading;

    function Scores() {
        parent::Controller();
        $this->check_session();
        //$this->jquery->add_library('admin_action.js');
        //$this->jquery->add_library('assign.js');
        $this->jquery->add_library('popup.js');
        $this->jquery->add_library('score_validation.js');
        
        $this->load->model(array('mod_scores'));
        $this->loading = '<span class="loading" style="display:none;border:0px !important;">' . img('global/images/loading.gif') . '</span>';
    }

    function index() {
        redirect("scores/manager");
    }

    // panel page
    function manager() {
        $data['title'] = 'scores';
        $data['obj'] = $this;
        // pagination
        
        $config['prev_link'] = 'Previous';
        $config['next_link'] = 'Next';
        $config['per_page'] = ($this->input->post($this->dbf->cla_name)) ? '' : '25';
        $config['total_rows'] = ($this->input->post($this->dbf->cla_name)) ? '' : $this->db->where('cla_status', '1')->count_all_results('tbl_classes'); // (!$this->input->post($this->dbf->cla_name) || $this->input->post($this->dbf->cla_name)=='')?$this->db->count_all('tbl_classes'):$this->mod_scores->get_classes(array($config['per_page'], $this->uri->segment(3)))->num_rows();
        
        if($this->uri->segment(3)=='reports'){
            $config['uri_segment'] = 4;
            $uri = $this->uri->segment(4);
            $config['base_url'] = base_url() . 'scores/manager/'.$this->uri->segment(3);
        }
        else{
            $uri = $this->uri->segment(3);  
            $config['base_url'] = base_url() . 'scores/manager';
        }
        
        
        $this->pagination->initialize($config);
        
        $data['query'] = $this->mod_scores->get_classes(array($config['per_page'],$uri ));
        $this->load->view("master", $data);
    }

    function get_teacher_assegned($p) {
        return $this->mod_scores->get_teacher_assigned($p);
    }

    function get_attendance($p) {
        return $this->mod_scores->get_attendance($p);
    }
    function get_couse_number($term_id,$class_id){
        return $this->mod_scores->count_couse($term_id,$class_id);
    }

    // add new class
    function input_score() {
        $data['obj'] = $this;
        $data['title'] = 'Input score';
        $db = new dbf(); // get field name of each table in database

        $data['students'] = $this->mod_scores->get_students(array('type' => 'add'));
        if ($data['students']->num_rows() > 0) {
            foreach ($data['students']->result() as $row) {
                $this->form_validation->set_rules($db->sco_effort . $row->stu_id, 'Effort', 'trim|callback_nb[0-10]|required|numeric|max_length[2]');
                $this->form_validation->set_rules($db->sco_pe . $row->stu_id, 'P+E', 'trim|callback_nb[0-10]|required|numeric|max_length[2]');
                $this->form_validation->set_rules($db->sco_progress . $row->stu_id, 'Progress', 'trim|callback_nb[0-10]|required|numeric|max_length[2]');
//                $this->form_validation->set_rules($db->sco_unfocused . $row->stu_id, 'Unfocused', 'required');
//                $this->form_validation->set_rules($db->sco_discruptive . $row->stu_id, 'Discruptive', 'required');
//                $this->form_validation->set_rules($db->sco_withdrawn . $row->stu_id, 'Withdrwan', 'required');
//                $this->form_validation->set_rules($db->sco_improve . $row->stu_id, 'Improve', 'required');
                $this->form_validation->set_rules($db->sco_comment . $row->stu_id, 'Comment', 'trim|max_length[250]');
            }
        }
        if ($this->form_validation->run() == false) {
//            if ($this->input->post($db->sco_effort . $row->stu_id))
//                $this->session->set_flashdata('error', 'Class could no save, please read instruction in the form bellow.');
            $this->load->view('master', $data);
        } else {
            // insert into db
            if ($this->mod_scores->input_scores()) {
                $this->session->set_flashdata('success', 'Scores save successfully');
                redirect('scores/manager');
            } else {
                $this->load->view('master', $data);
            }
        }
    }

// Edit class
    function edit_score() {
        $data['obj'] = $this;
        $data['title'] = 'Edit score';
        $db = new dbf(); // get field name of each table in database

        $data['students'] = $this->mod_scores->get_students(array('type' => 'edit'));
        if ($data['students']->num_rows() > 0) {
            foreach ($data['students']->result() as $row) {
                $this->form_validation->set_rules($db->sco_effort . $row->stu_id, 'Effort', 'trim|callback_nb[0-10]|required|numeric|max_length[2]');
                $this->form_validation->set_rules($db->sco_pe . $row->stu_id, 'P+E', 'trim|callback_nb[0-10]|required|numeric|max_length[2]');
                $this->form_validation->set_rules($db->sco_progress . $row->stu_id, 'Progress', 'trim|callback_nb[0-10]|required|numeric|max_length[2]');
//                $this->form_validation->set_rules($db->sco_unfocused . $row->stu_id, 'Unfocused', 'required');
//                $this->form_validation->set_rules($db->sco_discruptive . $row->stu_id, 'Discruptive', 'required');
//                $this->form_validation->set_rules($db->sco_withdrawn . $row->stu_id, 'Withdrwan', 'required');
//                $this->form_validation->set_rules($db->sco_improve . $row->stu_id, 'Improve', 'required');
                $this->form_validation->set_rules($db->sco_comment . $row->stu_id, 'Comment', 'trim|max_length[250]');
            }
        }
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', 'Class could no save, please read instruction in the form bellow.');
            $this->load->view('master', $data);
        } else {
            // insert into db
            if ($this->mod_scores->edit_scores()) {
                $this->session->set_flashdata('success', 'Scores save successfully');
                redirect('scores/manager');
            } else {
                $this->load->view('master', $data);
            }
        }
    }

// View report
    function report() {
        $data['title'] = 'View report';
        $data['obj'] = $this;
        $db = new dbf(); // get field name of each table in database

        $data['students'] = $this->mod_scores->get_students(array('type' => 'edit'));
        $this->load->view('master', $data);
    }
    function print_report() {
        $data['title'] = 'View report';
        $data['obj'] = $this;
        $db = new dbf(); // get field name of each table in database

        $data['students'] = $this->mod_scores->get_students(array('type' => 'edit'));
        $this->load->view('scores/report', $data);
    }

    // check permistion
    function check_session() {
        if (strtolower($this->session->userdata("tea_position")) == 'admin' || strtolower($this->session->userdata("tea_position")) == 'teacher') {
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

    function nb($str, $key) {
        //echo $key;die();
        $data = explode("-", $key);
        if ($str < $data[0] || $str > $data[1]) {
            $this->form_validation->set_message('nb', '%s "' . $str . '" not in rang ' . $data[0] . ' to ' . $data[1]);
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // validate string
    function string($str) {
        if (preg_match("/[^A-z0-9._\- ]/", $str)) {
            $this->form_validation->set_message('string', '%s can allow specail character . _ -');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // count students in class
    function count_students($id) {// $id is array
        return $this->mod_scores->count_students($id);
    }

    // check score each terms
    function check_score($p) {
        return $this->mod_scores->check_score($p);
    }

    // remove score from each class each ter,
    function remove_score() {
        if ($this->mod_scores->remove_score()) {
            $this->session->set_userdata('success', 'Score have been removed');
        } else {
            $this->session->set_userdata('error', 'Score could not remove,because system coould not connect database');
        }
        redirect('scores/manager');
    }

}