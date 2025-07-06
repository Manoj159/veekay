<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Details extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('user_model');
    }

	public function index()
	{
		$this->load->view('web/header');
		$this->load->view('web/details');
		$this->load->view('web/footer');
	}


	public function register()
	{
	     
		$response = $this->user_model->register_user();

		if($response == true){
			$this->session->unset_userdata('otp');

			$response = $this->db->get_where('user', array('user_id'=>$this->session->userdata('user_id')));

			if($response->num_rows() > 0){

				$user = $response->row();

				$this->session->set_userdata('user_id',$user->user_id);
				$this->session->set_userdata('contact',$user->contact);
				$this->session->set_userdata('email',$user->email);
				$this->session->set_userdata('name',$user->name);
			}

			$this->session->set_flashdata('success_message','User Login Successfully!');
			if($this->session->userdata('search_url') != '')
			{
				redirect($this->session->userdata('search_url'));
			}
			else{
				redirect(base_url().'Book');
			}
			
		}else{
			redirect(base_url().'Details');
		}
	}
}
