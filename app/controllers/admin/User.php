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
	
	/**
	 * user edit view && user update
	 */
	public function user_update()
	{
	    $redirect = 'http://'.base_url('admin/user/admin');    //user错误跳转页
	    
	    if (IS_POST){
	         
	        $result = $this->User_model->user_updates();
	        if (!$result){
	            die('修改失败,请返回');
	        }
	         
	        redirect($redirect);
	    }
	     
	    //数据验证
	    $input_id = $this->uri->segment(5, 0);
	    if ($input_id == 0) redirect($redirect);
	     
	    //get data
	    $data['user_edit'] = $this->User_model->user_edit($input_id);
	    $data['user_edit'] = $data['user_edit'][0];
	     
	    $this->load->view('admin/user_edit.html', $data);
	}
	
	public function user_delete()
	{
	    $redirect = 'http://'.base_url('admin/user/admin');    //user错误跳转页
	
	    $input_id = $this->uri->segment(5, 0);
	    //数据验证
	    if ($input_id == 0) redirect($redirect);
	    //model delete
	    $result = $this->User_model->user_deletes($input_id);
	    if (!$redirect) die('数据删除失败');
	     
	    redirect($redirect);
	}
	
}
