<?php
class Myapp
{
    
    /**
     * 判断登录方法
     * 置于admin模块各类构造方法中
     */
    public function session_check()
    {
        $CI =& get_instance();
        $CI->load->library('session');
        $res_user = $CI->session->has_userdata('username');
        $res_logd = $CI->session->has_userdata('logged_in');
        if (!$res_user || !$res_logd){
            redirect('http://'.base_url('admin/user/login').'');
        }
    }
    
    /**
     * 判断已经登录方法
     * 置于login方法中
     */
    public function login_aleardy()
    {
        $CI =& get_instance();
        $CI->load->library('session');
        $res_user = $CI->session->has_userdata('username');
        $res_logd = $CI->session->has_userdata('logged_in');
        if ($res_user && $res_logd){
            redirect('http://'.base_url('admin/admin/index').'');
        }
    }
    
}