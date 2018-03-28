<?php
class Myapp
{
    public function session_check()
    {
        $CI =& get_instance();
        $CI->load->library('session');
        $res_user = $CI->session->has_userdata('username');
        $res_logd = $CI->session->has_userdata('logged_in');
        if (!$res_user || !$res_logd){
            die('sad');
        }
    }
}