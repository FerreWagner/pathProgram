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
        //加载登录检验类库
        $this->load->library('myapp');
        
    }
    
    /**
     * 登录页
     */
	public function login()
	{
	    $redirect = 'http://'.base_url('admin/user/login');    //user错误跳转页
	    
	    //验证登录逻辑
	    if (IS_POST){
	        
	        $input_data = $this->input->post();
	        $res = $this->User_model->user_data($input_data['username'], $input_data['password']);
	        
	        //1用户名错误;2用户名密码正确;3密码错误
	        if ($res == 1 || $res == 3){
	            redirect($redirect);
	        }else {
	            $user_session   = array(
	                'username'  => $input_data['username'],
	                'password'  => $input_data['password'],
	                'logged_in' => TRUE
	            );
	            
	            //写入session
	            $this->load->library('session');
	            $this->session->set_userdata($user_session);
	            
	            $redirect = 'http://'.base_url('admin/admin/index');
	            redirect($redirect);
	        }
	    }
	    
		$this->load->view('admin/login.html');
	}
	
	public function logout()
	{
	    //销毁session
	    $this->load->library('session');
	    $this->session->unset_userdata(['username', 'password', 'logged_in']);
	    $this->myapp->session_check();
	}
	
	public function admin()
	{
	    //加载登录检验类库
	    $this->myapp->session_check();
	    
	    $this->load->model('User_model');
	    $data['user_list'] = $this->User_model->get_user_list();
	    $this->load->view('admin/user.html', $data);
	}
	
	/**
	 * user add
	 */
	public function user_add()
	{
	    //加载登录检验类库
	    $this->myapp->session_check();
	    
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
	    //加载登录检验类库
	    $this->myapp->session_check();
	    
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
	    //加载登录检验类库
	    $this->myapp->session_check();
	    
	    $redirect = 'http://'.base_url('admin/user/admin');    //user错误跳转页
	
	    $input_id = $this->uri->segment(5, 0);
	    //数据验证
	    if ($input_id == 0) redirect($redirect);
	    //model delete
	    $result = $this->User_model->user_deletes($input_id);
	    if (!$redirect) die('数据删除失败');
	     
	    redirect($redirect);
	}
	
	
	/*
	 * 管理员日志
	 */
	public function log_list()
	{
	    //分页设置
	    $this->load->library('pagination');
	    
	    $config['base_url']   = 'http://'.base_url('admin/user/log_list').'/page/';
	    $config['total_rows'] = $this->User_model->log_count();
	    $config['per_page']   = 10;
	    
	    $this->pagination->initialize($config);                    //加载配置信息
	    $data = array('page'=>$this->pagination->create_links());  //要显示到界面的分页信息
	    
	    $page_id = $this->uri->segment(5, 1);  //默认页码为1
	    
	    
	    $this->load->model('User_model');
	    $data['log_list'] = $this->User_model->get_log_list($config['per_page']*($page_id - 1), $config['per_page']);
	    $this->load->view('admin/log.html', $data);
	}
	
}
