<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function index()
	{
		$this->load->view('web/header');
		$this->load->view('web/register');
		$this->load->view('web/footer');
	}
}
