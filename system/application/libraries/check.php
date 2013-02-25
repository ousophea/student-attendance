<?php

class Check {

    function Check() {
        $obj = & get_instance();
        $obj->load->helper(array('html'));
		//$obj->load->library(array('database'));
		$obj->load->library('database');
    }
	
	//check exist data
	function data_exist(){
		$argnames= func_get_args();
		$obj->db->select("*");
		$obj->db->where("ngo_id","4");
		$obj->db->from("tbl_ngos");
		if($obj->db->from("tbl_ngos")->$num_rows>0) return true;
		else return false;
	}
	function a(){return true;}

}
?>