<?php

class Create {

    function Create() {
        $obj = & get_instance();
//    $CI =& get_instance();
//
//    $CI->load->helper('url');
//    $CI->load->library('session');
//    $CI->config->item('base_url');
    }

    function security($str) {
        return mysql_real_escape_string(htmlspecialchars($str));
    }

}

?>