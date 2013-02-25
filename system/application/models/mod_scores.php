<?php

class Mod_scores extends Model {

    function Mod_scores() {
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
        // check permision for teacher
        if (strtolower($this->session->userdata($db->tea_position)) == 'teacher') {
            $this->db->where($db->wor_tea_id, $this->session->userdata($db->tea_id));
            $this->db->join($db->tbl_workloads, $db->cla_id . '=' . $db->wor_cla_id);
        }
        return $this->db->get();
    }

    // get student to list score
    function get_students($p=null) {
        $db = new Dbf();
        $cla_id = $this->uri->segment(3);
        $gen_id = $this->uri->segment(4);
        $ter_id = $this->uri->segment(5);
        $this->db->where($db->stu_status,1);
        $this->db->where($db->cla_id, $cla_id);
        $this->db->where($db->cla_gen_id, $gen_id);
        $this->db->from($db->tbl_students);
        $this->db->join($db->tbl_classes, $db->stu_cla_id . '=' . $db->cla_id);

        if ($p['type'] == 'edit') {
            $this->db->select("($db->sco_effort + $db->sco_pe + $db->sco_progress) AS total, tbl_students.*,tbl_scores.*,tbl_classes.*,tbl_terms.*,tbl_ngos.*,tbl_generations.*");
            $this->db->order_by('total', 'desc');
            $this->db->join($db->tbl_scores, $db->stu_id . '=' . $db->sco_stu_id);
            $this->db->join($db->tbl_generations, $db->gen_id . '=' . $db->cla_gen_id);
            $this->db->join($db->tbl_terms, $db->ter_id . '=' . $db->sco_ter_id);
            $this->db->join($db->tbl_ngos, $db->ngo_id . '=' . $db->stu_ngo_id);
            $this->db->where($db->sco_ter_id, $ter_id);
        }
        else if ($p['type'] == 'edit') {
            $this->db->join($db->tbl_generations, $db->gen_id . '=' . $db->cla_gen_id);
            $this->db->join($db->tbl_terms, $db->gen_id . '=' . $db->ter_gen_id);
        }
        return $this->db->get();
    }

    function check_score($p) {
        $db = new Dbf();
        $cla_id = $p[$db->cla_id];
        $gen_id = $p[$db->gen_id];
        $ter_id = $p[$db->ter_id];
        $this->db->where($db->cla_id, $cla_id);
        $this->db->where($db->cla_gen_id, $gen_id);
        $this->db->from($db->tbl_students);
        $this->db->join($db->tbl_classes, $db->stu_cla_id . '=' . $db->cla_id);
        $this->db->join($db->tbl_scores, $db->stu_id . '=' . $db->sco_stu_id);
        $this->db->where($db->sco_ter_id, $ter_id);
        return $this->db->get();
    }

    // remove score from each class each ter,
    function remove_score() {
        $db = new Dbf();
        $cla_id = $this->uri->segment(3);
        $gen_id = $this->uri->segment(4);
        $ter_id = $this->uri->segment(5);
        $this->db->where($db->cla_id, $cla_id);
        $this->db->where($db->cla_gen_id, $gen_id);
        $this->db->from($db->tbl_students);
        $this->db->join($db->tbl_classes, $db->stu_cla_id . '=' . $db->cla_id);
        $this->db->join($db->tbl_scores, $db->stu_id . '=' . $db->sco_stu_id);
        $this->db->where($db->sco_ter_id, $ter_id);
        $data = $this->db->get();
        foreach ($data->result() as $row) {
            $this->db->where($db->sco_stu_id, $row->stu_id);
            $this->db->where($db->sco_ter_id, $row->sco_ter_id);
            $this->db->delete($db->tbl_scores);
        }
        return TRUE;
    }

    // save score for students each class add new
    function input_scores() {
        $db = new Dbf();
        $data = $this->get_students();
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $this->db->where($db->stu_id, $row->stu_id);
                $field = array(
                    $db->sco_stu_id => $this->input->post($db->stu_id . $row->stu_id),
                    $db->sco_ter_id => $this->input->post($db->sco_ter_id),
                    $db->sco_effort => $this->input->post($db->sco_effort . $row->stu_id),
                    $db->sco_pe => $this->input->post($db->sco_pe . $row->stu_id),
                    $db->sco_progress => $this->input->post($db->sco_progress . $row->stu_id),

                    $db->sco_unfocused => ($this->input->post($db->sco_unfocused . $row->stu_id)=='')?2:$this->input->post($db->sco_unfocused . $row->stu_id),
                    $db->sco_discruptive =>($this->input->post($db->sco_discruptive . $row->stu_id)=='')?2: $this->input->post($db->sco_discruptive . $row->stu_id),
                    $db->sco_withdrawn => ($this->input->post($db->sco_withdrawn . $row->stu_id)=='')?2:$this->input->post($db->sco_withdrawn . $row->stu_id),
                    $db->sco_improve => ($this->input->post($db->sco_improve . $row->stu_id)=='')?2:$this->input->post($db->sco_improve . $row->stu_id),

                    $db->sco_comment => $this->input->post($db->sco_comment . $row->stu_id),
                );
                $this->db->insert($db->tbl_scores, $field);
                $field = null;
            }
            return TRUE;
        }
        return FALSE;
    }

    // save score for students each class edit
    function edit_scores() {
        $db = new Dbf();
        $data = $this->get_students();
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $this->db->where($db->sco_stu_id, $row->stu_id);
                $field = array(
                    $db->sco_effort => $this->input->post($db->sco_effort . $row->stu_id),
                    $db->sco_pe => $this->input->post($db->sco_pe . $row->stu_id),
                    $db->sco_progress => $this->input->post($db->sco_progress . $row->stu_id),

                    $db->sco_unfocused => ($this->input->post($db->sco_unfocused . $row->stu_id)=='')?2:$this->input->post($db->sco_unfocused . $row->stu_id),
                    $db->sco_discruptive =>($this->input->post($db->sco_discruptive . $row->stu_id)=='')?2: $this->input->post($db->sco_discruptive . $row->stu_id),
                    $db->sco_withdrawn => ($this->input->post($db->sco_withdrawn . $row->stu_id)=='')?2:$this->input->post($db->sco_withdrawn . $row->stu_id),
                    $db->sco_improve => ($this->input->post($db->sco_improve . $row->stu_id)=='')?2:$this->input->post($db->sco_improve . $row->stu_id),

                    $db->sco_comment => $this->input->post($db->sco_comment . $row->stu_id),
                );
                $this->db->update($db->tbl_scores, $field);
                $field = null;
            }
            return TRUE;
        }
        return FALSE;
    }

    // count students each class
    function count_students($id) {
        $db = new Dbf();
        $this->db->where($db->cla_status, 1);
        $this->db->where($db->stu_status, 1);
        $this->db->where($db->cla_id, $id[$db->cla_id]);
        $this->db->where($db->cla_gen_id, $id[$db->cla_gen_id]);

        $this->db->from($db->tbl_classes);
        $this->db->join($db->tbl_students, $db->cla_id . '=' . $db->stu_cla_id);
        $this->db->join($db->tbl_generations, $db->gen_id . '=' . $db->cla_gen_id);
        return $this->db->get()->num_rows();
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

    // get attendence
    function get_attendance($p) {
        $db = new Dbf();
        //echo $p[$db->stu_id].'-'.$p[$db->cla_id].'-'.$p[$db->ter_id].'-'.$p[$db->gen_id];die();
        $this->db->where($db->att_ter_id, $p[$db->ter_id] );
        $this->db->where($db->stu_id, $p[$db->stu_id]);
        $this->db->where($db->cla_id, $p[$db->cla_id]);
        $this->db->where($db->gen_id, $p[$db->gen_id]);
        
        
        $this->db->from($db->tbl_attendances);
        $this->db->join($db->tbl_students, $db->stu_id . '=' . $db->att_stu_id);
        
        $this->db->join($db->tbl_classes, $db->cla_id . '=' . $db->stu_cla_id);
        $this->db->join($db->tbl_generations, $db->gen_id . '=' . $db->cla_gen_id);

        if($this->uri->segment(2)!='input_score'){
            $this->db->join($db->tbl_scores, $db->stu_id . '=' . $db->sco_stu_id);
            $this->db->where($db->sco_ter_id, $p[$db->ter_id]);
        }
        else if($this->uri->segment(2)=='input_score'){
            $this->db->join($db->tbl_terms, $db->ter_gen_id . '=' . $db->gen_id);
            $this->db->where($db->ter_id, $p[$db->ter_id]);
        }
        $data = $this->db->get();
        $atten = 0;
        $absent = 0;
        if ($data->num_rows() > 0) {
            foreach ($data->result_array() as $row) {
                if ($row[$db->att_attended] == 1)
                    $atten = $atten + $row[$db->att_attended];
                if ($row[$db->att_absent] == 1)
                    $absent = $absent + $row[$db->att_absent];
            }
        }
        return $atten . '_' . $absent.'_'.$data->num_rows();
    }
    
    function count_couse($term_id,$class_id){
        $db = new Dbf();
        $this->db->where($db->att_ter_id, $term_id );
        $this->db->where($db->cla_id, $class_id );
        $this->db->select('count(att_date) as total');
        $this->db->group_by('att_stu_id');
        $this->db->join($db->tbl_students, $db->stu_id . '=' . $db->att_stu_id);
        $this->db->join($db->tbl_classes, $db->cla_id . '=' . $db->stu_cla_id);
        $data = $this->db->get('tbl_attendances',1);
//        if ($data->num_rows() > 0) {
           foreach ($data->result_array() as $row) {
                return $row['total'];
           }
    }

}