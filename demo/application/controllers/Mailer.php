<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailer extends CI_Controller {

	public function __construct(){
        parent::__construct();
	}
    
	public function booking_success()
	{
        if(isset($_GET["bid"])){
            $bid = $_GET["bid"];
            
            $data["book"] = $this->db->get_where("booking", ["booking_id"=>$bid])->row();
            $user_id = $data["book"]->user_id; 
            $car_id = $data["book"]->car_id;
            
            $data["user"] = $this->db->get_where("user", ["user_id"=>$user_id])->row();
            $data["car"] = $this->db->get_where("car", ["car_id"=>$car_id])->row();
            
            $this->load->view('web/mailer_booking_success', $data);
        }
	}
    
}