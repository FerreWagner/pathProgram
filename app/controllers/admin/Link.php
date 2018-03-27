<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Link extends CI_Controller 
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        
        //加载公共主题
        $this->load->model('Link_model');
    }
    
    /**
     * link add页
     */
    public function link_add()
    {
        //cate数据
        $data['cate_list'] = $this->Link_model->cate_list();
        //非post请求显示添加页
        $this->load->view('admin/link_add.html', $data);
    }
    
    /**
     * link 增逻辑
     */
    public function link_add_data()
    {
        $redirect = 'http://'.base_url('admin/admin/link');    //link错误跳转页
        
        if (IS_POST){
            //表单验证库
            $this->load->library('form_validation');
               //TIPS：TODO 调用规则写在config/form_validation.php里
//             $this->form_validation->set_rules('title', '标题', 'required|is_unique[link.title]');
//             $this->form_validation->set_rules('url',   '链接', 'required|is_unique[link.url]');
//             $this->form_validation->set_rules('sort',  '排序', 'required');
//             $this->form_validation->set_rules('pid',   '分类', 'required');

            //TODO unique显示为英文,配置将：system/language/englishform_validation.php拷贝一份至application/language/english下，并且对语言包进行修改即可为显示unique错误信息
            $this->form_validation->set_message('required', '<span style="color: red;">{field} 必须填写</span>');
            
            if ($this->form_validation->run() == FALSE){
                //cate数据
                $data['cate_list'] = $this->Link_model->cate_list();
                //提交失败 重新加载表单部分
                $this->load->view('admin/link_add.html', $data);
            }else {
                $result = $this->Link_model->link_adds();
                if (!$result){
                    die('添加失败,请返回');
                }
                redirect($redirect);
            }

        }
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
	    //cate数据
	    $data['cate_list'] = $this->Link_model->cate_list();
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
