<?php

class Mod_classes extends Model {

    function Mod_classes() {
        parent::Model();
    }

    // get classes list
    function get_classes($p=null) { // $p is array
        $db = new Dbf();
        if ($this->input->post($this->dbf->cla_name) && $this->input->post($this->dbf->cla_name) != '')
            $this->db->like($this->dbf->cla_name, $this->input->post($this->dbf->cla_name));
        $this->db->limit($p[0], $p[1]);
        $this->db->where($db->cla_status, 1);
        $this->db->order_by($db->cla_id, 'desc');
        $this->db->from($db->tbl_classes);
        $this->db->join($db->tbl_generations, 'gen_id=cla_gen_id');
        return $this->db->get();
    }

    function get_one_classes() {
        $this->db->where($this->dbf->cla_id, $this->uri->segment(3));
        return $this->db->get($this->dbf->tbl_classes);
    }

    function get_teacher() {
        $db = new Dbf();
        $this->db->where($db->tea_status, 1);
        $this->db->order_by($db->tea_name, 'asc');
        return $this->db->get($db->tbl_teachers);
    }
    // get teacher who ready assigned
    function get_teacher_assigned($p) {
        $db = new Dbf();
        $this->db->where($db->tea_status, 1);
        $this->db->where($db->cla_id, $p[$db->cla_id]);
        $this->db->order_by($db->tea_name, 'asc');
        $this->db->from($db->tbl_workloads);
        $this->db->join($db->tbl_classes, $db->cla_id . '=' . $db->wor_cla_id);
        $this->db->join($db->tbl_teachers, $db->tea_id . '=' . $db->wor_tea_id);

        return $this->db->get();
    }

    // Add new class by admin position
    function addnew() {
        $db = new Dbf();
        $key_name = array(
            $db->cla_name => $this->input->post($db->cla_name),
            $db->cla_student_number => $this->input->post($db->cla_student_number),
            $db->cla_time => $this->input->post($db->cla_time),
            $db->cla_age_leval => $this->input->post($db->cla_age_leval),
            $db->cla_gen_id => $this->input->post($db->cla_gen_id),
            $db->cla_description => $this->input->post($db->cla_description),
        );
        $this->db->insert('tbl_classes', $key_name);
        $cla_id = mysql_insert_id();
        if ($cla_id > 0) {
            for ($k = 0; $k < count($_POST['teacher']); $k++) {
                $tea_id = $_POST['teacher'][$k];
                $this->db->insert($db->tbl_workloads, array($db->wor_tea_id => $tea_id, $db->wor_cla_id => $cla_id));
            }
            return TRUE;
        }
        return FALSE;
    }

    function edit() {
        $db = $this->dbf;
        $this->db->where($db->cla_id, $this->input->post($db->cla_id));
        $key_name = array(
            $db->cla_name => $this->input->post($db->cla_name),
            $db->cla_student_number => $this->input->post($db->cla_student_number),
            $db->cla_time => $this->input->post($db->cla_time),
            $db->cla_age_leval => $this->input->post($db->cla_age_leval),
            $db->cla_gen_id => $this->input->post($db->cla_gen_id),
            $db->cla_description => $this->input->post($db->cla_description),
        );
        return $this->db->update('tbl_classes', $key_name);
    }

    function assign(){
        $db= new Dbf();
        $this->db->insert($db->tbl_workloads, array($db->wor_tea_id => $this->uri->segment(5), $db->wor_cla_id => $this->uri->segment(4)));
        return TRUE;
    }

    // delete classes
    function delete() {
        $db = $this->dbf;
        $this->db->where($db->cla_id, $this->uri->segment(3));
        $data = array('cla_status' => 0);
        $this->db->update('tbl_classes', $data);
        return TRUE;
    }
    function remove_teacher(){
        $db = new Dbf();
        $this->db->where(array(
                $db->wor_cla_id=>$this->uri->segment(3),
                $db->wor_tea_id=>$this->uri->segment(4),
                ));
        $this->db->delete($db->tbl_workloads);
        return TRUE;
    }
    // count students each class
    function count_students($id){
        $db = new Dbf();
        $this->db->where($db->cla_status, 1);
        $this->db->where($db->stu_status, 1);
        $this->db->where($db->cla_id,$id[$db->cla_id]);
        $this->db->where($db->cla_gen_id,$id[$db->cla_gen_id]);

        $this->db->from($db->tbl_classes);
        $this->db->join($db->tbl_students,$db->cla_id.'='.$db->stu_cla_id);
        $this->db->join($db->tbl_generations, $db->gen_id.'='.$db->cla_gen_id);
        return $this->db->get()->num_rows();
    }

}