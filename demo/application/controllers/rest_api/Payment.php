<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH."libraries/razorpay-php/Razorpay.php");

use Razorpay\Api\Api;

use Razorpay\Api\Errors\SignatureVerificationError;

class Payment extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }
	
    public function pay_u_money($booking_id=0){
        if($booking_id > 0){
            $sql = $this->db->get_where("booking", ["booking_id"=>$booking_id]);
            
            if($sql->num_rows() == 0){
                $arr = ["status"=>0, "message"=>"Invalid booking_id !!"];
                echo json_encode($arr);
            }else{
                $booking = $sql->row();
                $user = $this->db->get_where("user", ["user_id"=>$booking->user_id])->row();

                $amount = $booking->total_payable;
                if($booking->home_delivery == 1 && $booking->home_delivery_charges > 0){
                    $amount = $booking->total_payable+$booking->home_delivery_charges;
                }
                $name = $user->name;
                $email = $user->email;
                $contact = $user->contact;
                $details_order_id = $booking->details_order_id;
                $unique_order_id = $booking_id;

                //$furl = base_url().'Checkout/paymentFailed?order_id='.$unique_order_id;
                $furl = base_url().'rest_api/Payment/payment_failed';
                //$furl = "https://apiplayground-response.herokuapp.com/";
                $surl = base_url().'rest_api/Payment/payment_success/'.$unique_order_id;

                $data = ["productinfo"=>$details_order_id, "amount"=>$amount, "email"=>$email, "firstname"=>$name, "lastname"=>"", "surl"=>$surl, "furl"=>$furl, "phone"=>$contact, "unique_order_id"=>$unique_order_id];

                $this->load->view('web/pay/payu', $data);
            }
        }else{
            $arr = ["status"=>0, "message"=>"Please provide booking_id !!"];
            echo json_encode($arr);
        }
    }
    public function payment_success($booking_id=0){
        if($booking_id > 0){
            $this->db->where(["booking_id"=>$booking_id])->update("booking", ["payment_status"=>1]);
            $arr = ["status"=>0, "message"=>"Transaction Successful"];
            echo json_encode($arr);
        }
    }
    public function payment_failed(){
        $arr = ["status"=>0, "message"=>"Transaction Failed, Please try again"];
        echo json_encode($arr);
    }


}