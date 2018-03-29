<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
        
    }
    
	public function index()
	{
	    
	    $this->load->model('Home_model');
	    $input_id = $this->uri->segment(4, 1);
	    
	    $data['cate_data'] = $this->Home_model->get_cate();
	    $data['links']     = $this->Home_model->get_link($input_id);
// 	    $data['color']     = $this->rand_color();

		$this->load->view('home/index.html', $data);
	}
	
	/**
	 * 生成随机浅色系颜色
	 */
// 	public function rand_color()
// 	{
// 	    $color = '';
// 	    $num = ['9', 'a', 'b', 'c', 'd', 'e', 'f'];
// 	    for ($i = 0; $i < 6; $i ++){
// 	        $color .= $num[array_rand($num, 1)];
// 	    }
// 	    return $color;
// 	}
	
}
