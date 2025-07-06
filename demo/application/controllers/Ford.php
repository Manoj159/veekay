<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ford extends CI_Controller {

	public function index()
	{
		@$this->session->set_userdata('search_url','https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		@$this->session->set_userdata('car_id',$_GET['car_id']);
		@$this->session->set_userdata('city',$_GET['city']);
		@$this->session->set_userdata('start',$_GET['start']);
		@$this->session->set_userdata('end',$_GET['end']);

		$data['c'] = @$this->db->get_where('car', array('car_id'=>$_GET['car_id']))->row();
         //print_r($data['car'] ); die;
		$this->load->view('web/header');
		$this->load->view('web/ford', $data);
		$this->load->view('web/footer');
	}
    
    public function apply_coupon(){
        $this->session->unset_userdata("coupon_discount");
        $this->session->unset_userdata("coupon_name");
        if(isset($_POST["name"])){
            extract($_POST);
            
            $today = date("Y-m-d");
            $checkCoupon = $this->db->get_where("coupon", ["name"=>$name]);
            
            if($checkCoupon->num_rows() > 0){
                $coupon = $checkCoupon->row();
                $expiry = $coupon->expiry;    
                $percent = $coupon->percent;    
                $min_days = $coupon->min_days;    
                
                if($today < $expiry){
                    
                    if($total_days < $min_days){
                        $this->session->set_flashdata("coupon_error", "This coupon is available for minimum $min_days days of booking !!");        
                    }else{
                        $this->session->set_userdata("coupon_discount", $percent);
                        $this->session->set_userdata("coupon_name", $name);   
                        $this->session->set_userdata("coupon_total_days", $total_days);   
                    }
                    
                }else{
                    $this->session->set_flashdata("coupon_error", "This coupon is expired !!");    
                }
                
            }else{
                $this->session->set_flashdata("coupon_error", "Inavlid coupon entered !!");
            }
        }
        redirect($_SERVER["HTTP_REFERER"]);
    }
}
