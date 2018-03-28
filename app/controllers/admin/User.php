<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        
        //加载公共主题
        
    }
    
    /**
     * 登录页
     */
	public function login()
	{
		$this->load->view('admin/login.html');
	}
	
	public function admin()
	{
	    $this->load->model('User_model');
	    $data['user_list'] = $this->User_model->get_user_list();
	    $this->load->view('admin/user.html', $data);
	}
	
}
