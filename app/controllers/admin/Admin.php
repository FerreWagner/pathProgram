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
        
    }
    
	public function index()
	{
		$this->load->view('admin/index.html');
	}
	
	public function elements()
	{
	    $this->load->view('admin/elements.html');
	}
	
	public function charts()
	{
	    $this->load->view('admin/chart.html');
	}
	
	public function tabs()
	{
	    $this->load->view('admin/tabs.html');
	}
	
	public function table()
	{
	    $this->load->view('admin/table.html');
	}
	
	public function form()
	{
	    $this->load->view('admin/form.html');
	}
	
	public function empti()
	{
	    $this->load->view('admin/empti.html');
	}
}
