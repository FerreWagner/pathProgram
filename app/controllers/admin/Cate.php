<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cate extends CI_Controller 
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        
        //加载公共主题
        
    }
    
	public function cate_update()
	{
	    $this->load->model('Cate_model');
	    $redirect = 'http://'.base_url('admin/admin/cate');    //cate错误跳转页
	    
	    if (strtolower($_SERVER["REQUEST_METHOD"]) == 'post'){
	        
	        $result = $this->Cate_model->cate_updates();
	        if (!$result){
	            die('修改失败,请返回');
	        }
	        
	        redirect($redirect);
	    }
	    
	    $input_id = $this->uri->segment(5, 0);
	    //数据验证
	    if ($input_id == 0) redirect($redirect);;
	    
	    //get data
	    $data['cate_edit'] = $this->Cate_model->cate_edit($input_id);
	    $data['cate_edit'] = $data['cate_edit'][0];
	    
	    $this->load->view('admin/cate_edit.html', $data);
	}
	
}
