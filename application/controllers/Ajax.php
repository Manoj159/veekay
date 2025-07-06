<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function index()
	{
        $data["meta"] = $this->db->get_where("meta", ["pages"=>"Login"])->row();
	//	$data["meta"]->h1_tag='Login';
		$this->load->view('web/header', $data);
		$this->load->view('web/login');
		$this->load->view('web/footer');
	}

	public function check_coupon(){
	    
	    $this->session->unset_userdata("coupon_discount");
        $this->session->unset_userdata("coupon_name");
        
	    if($_POST)
	    {
	        extract($_POST);
	        $coupondata =   $this->db->where(['name'=>$coupan])->get('coupon')->first_row();
	        if($coupondata)
	        {
	            $expiry = $coupondata->expiry;    
                $percent = $coupondata->percent;    
                $min_days = $coupondata->min_days; 
                
                if($today < $expiry){
                    
                    if($total_days < $min_days){
                        echo json_encode(['status'=>'error','mgs'=>" This coupon is available for minimum $min_days days of booking !!"]);exit;
                           
                    }
                
	                $this->session->set_userdata('coupon_name',$coupondata->name);
    	            $this->session->set_userdata('coupon_discount',$coupondata->percent);
    	             $this->session->set_userdata("coupon_total_days", $total_days);   
    	            echo json_encode(['status'=>'success','mgs'=>'Appied']);exit;
                }else{
                    echo json_encode(['status'=>'error','mgs'=>'please enter vaild coupon']);exit;
                }
	        }else{
	            echo json_encode(['status'=>'error','mgs'=>'please enter vaild coupon']);exit;
	        }
	        
	    }else{
	        echo json_encode(['status'=>'error','mgs'=>'please enter vaild coupon']);exit;
	    }
	}
	
	
	public function removeCoupon(){
	    $this->session->unset_userdata("coupon_discount");
        $this->session->unset_userdata("coupon_name");
        echo json_encode(['status'=>'success','mgs'=>'Appied']);exit;
	}
	
   public function save_address(){
	    
	  
	    if($_POST)
	    {
	        extract($_POST);
	          $this->session->set_userdata('address',$address);
	           $this->session->set_userdata('home_delivery',1);
	    
	       
	        
	    }else{
	        echo json_encode(['status'=>'error','mgs'=>'please enter vaild coupon']);exit;
	    }
	}
	
	public function save_session(){
	   
	     if($_POST)
	    {
	        extract($_POST);
	           $this->session->set_userdata('token_amount',$token);
	           $this->session->set_userdata('total_payable',$final);
	           $this->session->set_userdata('home_delivery',$honedelevary);
	    
	       
	        
	    }else{
	        echo json_encode(['status'=>'error','mgs'=>'please enter vaild coupon']);exit;
	    }
	  
	}
	
}
