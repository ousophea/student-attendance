<?php

/*
 * Created on Jan 27, 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class Administrations extends Controller {

    var $loading;

    function Administrations() {
        parent::Controller();
        $this->loading = '<span class="loading" style="display:none;border:0px !important;">' . img('global/images/loading.gif') . '</span>';
    }

    function index() {
        redirect("administrations/manager");
    }

    // panel page
    function manager() {
        $this->check_session();
        $data['title'] = 'Administrations';
        $this->load->view("master", $data);
    }
    function p_404(){
        $data['title']='Under Construction!';
        $this->load->view('master',$data);
    }

    function check_session() {
        if ($this->session->userdata("tea_name")) {
            return true;
        } else {
            redirect("home/login");
        }
    }

}