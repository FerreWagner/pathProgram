<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends CI_Controller {

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
        $this->load->model('Home_model');
    }
    
	public function index()
	{
	    $input_id = $this->uri->segment(4, 1);
	     
	    $data['cate_data'] = $this->Home_model->get_cate();
	    $data['links']     = $this->Home_model->get_link($input_id);
		$this->load->view('home/index.html', $data);
	}
}
