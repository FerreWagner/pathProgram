<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        
        //加载公共主题
        //加载登录检验类库
        $this->load->library('myapp');
        $this->myapp->session_check();
    }
    
    /**
     * 游客用户数据
     */
	public function index()
	{
	    $this->load->model('User_model');
	    $data['log_count'] = $this->User_model->user_log_count();
	    $data['browser']   = $this->User_model->user_type();
	    $data['user_new']  = $this->User_model->user_new();
	    
		$this->load->view('admin/index.html', $data);
	}
	
	/**
	 * 项目大小原因,list都写在admin里
	 */
	public function cate()
	{
	    $this->load->model('Cate_model');
	    $data['cate_list'] = $this->Cate_model->get_cate_list();
	    $this->load->view('admin/cate.html', $data);
	}
	
	public function link()
	{
	    $this->load->model('Link_model');
	    //分页设置
	    $this->load->library('pagination');
	    
	    $config['base_url']   = 'http://'.base_url('admin/admin/link').'/page/';
	    $config['total_rows'] = $this->Link_model->link_count();
	    $config['per_page']   = 10;
	    
	    $this->pagination->initialize($config);                    //加载配置信息
// 	    $data = array('page'=>$this->pagination->create_links());  //要显示到界面的分页信息
	    
	    $page_id = $this->uri->segment(5, 1);  //默认页码为1
	    
	    $data['link_list'] = $this->Link_model->get_link_list($page_id, $config['per_page']);
// 	    var_dump($this->db->last_query());die;
	    $this->load->view('admin/link.html', $data);
	}
	
}