<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function index()
	{
	    if($_POST)
	    {
	          
	          $name =  (explode(" ",$_POST['fname']));
	           ;
	          $insert['fname'] = $name[0];
	          if( count($name)>1)
	          {
	             $insert['lname'] =  $name[1];
	          }
	          $insert['email'] = $_POST['email'];
	          $insert['message'] = $_POST['message'];
	          
	          $this->db->insert('contact',$_POST);
	          $this->session->set_flashdata('success_message','Thanks to contact us');
	          redirect('/contact');exit;
	    }
        $data["meta"] = $this->db->get_where("meta", ["pages"=>"Contact Us"])->row();
		$this->load->view('web/header', $data);
		$this->load->view('web/contact');
		$this->load->view('web/footer');
	}
}
