<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
        $data["meta"] = $this->db->get_where("meta", ["pages"=>"Login"])->row();
	//	$data["meta"]->h1_tag='Login';
		$this->load->view('web/header', $data);
		$this->load->view('web/login');
		$this->load->view('web/footer');
	}

	public function user_login(){

		extract($_POST);

		$data = array('email'=>$email);

		$exist = $this->db->get_where('user', $data);

		if($exist->num_rows() > 0){

			$data += array('password'=>$password);

			$response = $this->db->get_where('user', $data);

			if($response->num_rows() > 0){

				$user = $response->row();

				$this->session->set_userdata('user_id',$user->user_id);
				$this->session->set_userdata('contact',$user->contact);
				$this->session->set_userdata('email',$user->email);
				$this->session->set_userdata('name',$user->name);

				$this->input->set_cookie('user_id',$user->user_id, time() + (60*60*24*10));
				$this->input->set_cookie('contact',$user->contact, time() + (60*60*24*10));
				$this->input->set_cookie('email',$user->email, time() + (60*60*24*10));
				$this->input->set_cookie('name',$user->name, time() + (60*60*24*10));

				if($this->session->userdata('search_url') != ''){
					$this->session->set_flashdata('success_message','Log in successful !');
					//redirect($this->session->userdata('search_url'));
					redirect($_SERVER['HTTP_REFERER']);
				}else{
					$this->session->set_flashdata('success_message','Log in successful !');
					redirect(base_url().'Account');
				}

				

			}else{
				$this->session->set_flashdata('error_message','Please Check your Email & Password!');
				redirect(base_url().'Login');
			}

		}else{
				$this->session->set_flashdata('error_message','Please Register your Self!');
				redirect(base_url().'Login');
			}
	}
}
