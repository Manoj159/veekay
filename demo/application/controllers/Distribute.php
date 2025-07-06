<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distribute extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        if(empty($_SESSION['user_id']))
        {
            // print($_SESSION['user_id']);die;
            // print(base_url('/'));die;
            redirect(base_url('login'));
        }
    }
    
	public function index()
	{
        // print('index');die;
        
		$data['car'] = $this->db->get_where('car', array('car_id'=>$this->session->userdata('car_id')))->row();

		$this->load->view('web/header');
		$this->load->view('web/distribute', $data);
		$this->load->view('web/footer');
	}
}
