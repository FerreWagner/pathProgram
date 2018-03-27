<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        
        //加载公共主题
        
    }
    
	public function index()
	{
		$this->load->view('admin/login.html');
	}
}
