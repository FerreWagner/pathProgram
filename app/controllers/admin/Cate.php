<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cate extends CI_Controller 
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        
        //加载公共主题
        $this->load->model('Cate_model');
        //加载登录检验类库
        $this->load->library('myapp');
        $this->myapp->session_check();
    }
    
    /**
     * cate add
     */
    public function cate_add()
    {
        $redirect = 'http://'.base_url('admin/admin/cate');    //cate错误跳转页
        
        if (IS_POST){
            $result = $this->Cate_model->cate_adds();
            if (!$result){
                die('添加失败,请返回');
            }
            redirect($redirect);
        }
        
    }
    
    /**
     * cate edit view && cate update
     */
	public function cate_update()
	{
	    $redirect = 'http://'.base_url('admin/admin/cate');    //cate错误跳转页
	    
	    if (IS_POST){
	        
	        $result = $this->Cate_model->cate_updates();
	        if (!$result){
	            die('修改失败,请返回');
	        }
	        
	        redirect($redirect);
	    }
	    
	    $input_id = $this->uri->segment(5, 0);
	    //数据验证
	    if ($input_id == 0) redirect($redirect);
	    
	    //get data
	    $data['cate_edit'] = $this->Cate_model->cate_edit($input_id);
	    $data['cate_edit'] = $data['cate_edit'][0];
	    
	    $this->load->view('admin/cate_edit.html', $data);
	}
	
	public function cate_delete()
	{
	    $redirect = 'http://'.base_url('admin/admin/cate');    //cate错误跳转页
	    	  
	    $input_id = $this->uri->segment(5, 0);
	    //数据验证
	    if ($input_id == 0) redirect($redirect);
	    //model delete
	    $result = $this->Cate_model->cate_deletes($input_id);
	    if (!$redirect) die('数据删除失败');
	    
	    redirect($redirect);
	}
	
}
