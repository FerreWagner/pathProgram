<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        
        //加载公共主题
        $this->load->model('User_model');
        
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
	
	/**
	 * user add
	 */
	public function user_add()
	{
	    $redirect = 'http://'.base_url('admin/user/admin');    //user错误跳转页
	
	    if (IS_POST){
	        $result = $this->User_model->user_adds();
	        if (!$result){
	            die('添加失败,请返回');
	        }
	        redirect($redirect);
	    }
	
	}
	
}
