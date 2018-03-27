<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Link extends CI_Controller 
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        
        //加载公共主题
        $this->load->model('Link_model');
    }
    
    /**
     * link add
     */
    public function link_add()
    {
        $redirect = 'http://'.base_url('admin/admin/link');    //link错误跳转页
        
        if (IS_POST){
            $result = $this->Link_model->link_adds();
            if (!$result){
                die('添加失败,请返回');
            }
        }
        redirect($redirect);
        
    }
    
    /**
     * link edit view && link update
     */
	public function link_update()
	{
	    $redirect = 'http://'.base_url('admin/admin/link');    //link错误跳转页
	    
	    if (IS_POST){
	        
	        $result = $this->Link_model->link_updates();
	        if (!$result){
	            die('修改失败,请返回');
	        }
	        
	        redirect($redirect);
	    }
	    
	    $input_id = $this->uri->segment(5, 0);
	    //数据验证
	    if ($input_id == 0) redirect($redirect);
	    
	    //get data
	    $data['link_edit'] = $this->Link_model->link_edit($input_id);
	    $data['link_edit'] = $data['link_edit'][0];
	    
	    $this->load->view('admin/link_edit.html', $data);
	}
	
	public function link_delete()
	{
	    $redirect = 'http://'.base_url('admin/admin/link');    //link错误跳转页
	    	  
	    $input_id = $this->uri->segment(5, 0);
	    //数据验证
	    if ($input_id == 0) redirect($redirect);
	    //model delete
	    $result = $this->Link_model->link_deletes($input_id);
	    if (!$redirect) die('数据删除失败');
	    
	    redirect($redirect);
	}
	
}
