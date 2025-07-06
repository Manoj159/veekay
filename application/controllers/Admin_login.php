<?php


class Admin_login extends CI_Controller 
{

    function __construct() {
        parent::__construct();

		$this->load->database();
		$this->load->library('session');

        $this->load->model('login_model');
            error_reporting(E_ALL);
            error_reporting(-1);
            ini_set('error_reporting', E_ALL);
    }

	public function index()
	{
      //  echo "oko"; die;
        if($this->session->userdata("admin_login") == 1) redirect(base_url().'admin/', 'refresh');
       
        $this->load->view('admin/login');
	}

	public function checkUserLogin()
    {
        $login = $this->login_model->mdlcheckUserLogin();

        $user_login = $this->session->userdata('admin_login');

        if($login != 1)
        {
            $this->session->set_flashdata('login_falied','Please Check your Email and Password');
            redirect(base_url().'Admin_login','refresh');
        }
        else if($user_login == 1)
        {
            $this->session->set_flashdata('flash_message', '');
            redirect(base_url().'admin','refresh');
        }
    }


    public function logout()
    {
        session_destroy();

        $this->login_model->update_status();
        redirect(base_url().'Admin_login', 'refresh');
    }

}