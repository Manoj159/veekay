<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms extends CI_Controller {

	public function index()
	{
        $meta_data["meta"] = $this->db->get_where("meta", ["pages"=>"Terms and Conditions"])->row();
		$this->load->view('web/header', $meta_data);
		$this->load->view('web/terms');
		$this->load->view('web/footer');
	}
    public function privacy()
	{
        $meta_data["meta"] = $this->db->get_where("meta", ["pages"=>"Privacy policy"])->row();
		$this->load->view('web/header', $meta_data);
		$this->load->view('web/privacy_policy');
		$this->load->view('web/footer');
	}
    public function refund()
	{
        $meta_data["meta"] = $this->db->get_where("meta", ["pages"=>"Cancellation and Refund policy"])->row();
		$this->load->view('web/header', $meta_data);
		$this->load->view('web/refund_policy');
		$this->load->view('web/footer');
	}
}
