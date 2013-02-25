<?php

class Mod_teachers extends Model {
    
    function Mod_teachers() {
        parent::Model();
        
    }

    // get teachers list
    function get_teachers($p=null) { // $p is array
        if ($this->input->post($this->dbf->tea_name) && $this->input->post($this->dbf->tea_name) != '')
            $this->db->like($this->dbf->tea_name, $this->input->post($this->dbf->tea_name));
        $this->db->limit($p[0], $p[1]);
        $this->db->where('tea_status',1);
        $this->db->order_by('tea_id','desc');
        return $this->db->get('tbl_teachers');
    }
    function get_one_teachers(){
        $this->db->where($this->dbf->tea_id, $this->uri->segment(3));
        return $this->db->get('tbl_teachers');
    }

    // Add new teacher by admin position
    function addnew() {
        $db= $this->dbf;
        $key_name = array(
            $db->tea_name => $this->input->post($db->tea_name),
            $db->tea_sex => $this->input->post($db->tea_sex),
            $db->tea_phone => $this->input->post($db->tea_phone),
            $db->tea_address => $this->input->post($db->tea_address),
            $db->tea_position => $this->input->post($db->tea_position),
            $db->tea_email => $this->input->post($db->tea_email),
//            $db->tea_status => $this->input->post($db->tea_status),
            $db->tea_description => $this->input->post($db->tea_description)
        );
        $key_name[$db->tea_password]=md5($this->input->post($db->tea_password));
        return $this->db->insert('tbl_teachers',$key_name);
    }
    function edit() {
        $db= $this->dbf;
        $this->db->where($db->tea_id,  $this->input->post($db->tea_id));
        $key_name = array(
            $db->tea_name => $this->input->post($db->tea_name),
            $db->tea_sex => $this->input->post($db->tea_sex),
            $db->tea_phone => $this->input->post($db->tea_phone),
            $db->tea_address => $this->input->post($db->tea_address),
            $db->tea_position => $this->input->post($db->tea_position),
            $db->tea_email => $this->input->post($db->tea_email),
//            $db->tea_status => $this->input->post($db->tea_status),
            $db->tea_description => $this->input->post($db->tea_description)
        );
        $key_name[$db->tea_password]=md5($this->input->post($db->tea_password));
        return $this->db->update('tbl_teachers',$key_name);
    }
    // delete teachers
    function delete(){
        $db= $this->dbf;
        $this->db->where($db->tea_id,  $this->uri->segment(3));
        $data=array('tea_status'=>0);
        $this->db->update('tbl_teachers',$data);
        return TRUE;
    }

}

?>