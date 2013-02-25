<?php

class Mod_login extends Model {

    function Mod_login() {
        parent::Model();
    }

    //login
    function _login($username, $password) {
        $this->db->select("*");
        $this->db->from("tbl_teachers");
        $this->db->where("tea_name", $username);
        $this->db->where("tea_password", md5($password));
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $this->session->set_userdata('tea_name', $row->tea_name);
                $this->session->set_userdata('tea_position', $row->tea_position);
                $this->session->set_userdata('tea_id', $row->tea_id);
            }
            return true;
        }
        else
            return false;
    }

}

?>