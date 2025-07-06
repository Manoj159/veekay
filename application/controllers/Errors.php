<?php 

class Errors extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->helper('url');
        $this->load->dbforge();
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->library('zip');
    }

	public function index()
	{
        $data['page'] 	   = 'errors';
        $data['page_name'] = 'errors';

		$this->load->view('dashboard/css');
		$this->load->view('dashboard/error', $data);
		$this->load->view('dashboard/js');
	}
	
 
  
}