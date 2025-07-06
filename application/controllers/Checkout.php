<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH."libraries/razorpay-php/Razorpay.php");

use Razorpay\Api\Api;

use Razorpay\Api\Errors\SignatureVerificationError;

class Checkout extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

	
  	public function index()
  	{   
  		    $this->load->view('checkout');
  	}

    public function do_payment()
    {
      //echo"<pre>"; print_r($_POST);exit;
        
      $this->user_model->book_car($_POST);
      
      $this->session->set_userdata('only_security_amount', 0);
      
      if( $_POST['only_security_amount'] === 1 )
      {
          $this->session->set_userdata('only_security_amount', 1);
      }
      redirect('Checkout/before_payment');
    }


    public function before_payment()
    {
        //$this->pay();
        $this->pay_u();
    }

    private function pay_u(){
        
        //echo"<pre>"; print_r($this->session->userdata()); exit;
        $amount = $this->session->userdata('total_payable');
        
        if( $this->session->userdata('only_security_amount') === 1)
        {
            $amount = $this->session->userdata('refund');
        }
        
        // print($amount);
        // die;
        
        
        $name = $this->session->userdata('name');
        $email = $this->session->userdata('email');
        $contact = $this->session->userdata('contact');
        $details_order_id = $this->session->userdata('details_order_id');
        $unique_order_id = $this->session->userdata('unique_order_id');
        
        //$furl = base_url().'Checkout/paymentFailed?order_id='.$unique_order_id;
        $furl = base_url().'Account/history';
        //$furl = "https://apiplayground-response.herokuapp.com/";
        $surl = base_url().'Checkout/success?order_id='.$unique_order_id;
        
        $data = ["productinfo"=>$details_order_id, "amount"=>$amount, "email"=>$email, "firstname"=>$name, "lastname"=>"", "surl"=>$surl, "furl"=>$furl, "phone"=>$contact, "unique_order_id"=>$unique_order_id];
        
        $this->load->view('web/pay/payu', $data);
    }

  private function pay()
  {
    $amount = $this->session->userdata('total_payable');

    $keyId = RAZOR_KEY_ID;
    $secret = RAZOR_KEY_SECRET;
    $api = new Api($keyId, $secret);
    /**
     * You can calculate payment amount as per your logic
     * Always set the amount from backend for security reasons
     */
    $_SESSION['payable_amount'] = $amount;
    $razorpayOrder = $api->order->create(array(
      'receipt'         => rand(),
      'amount'          => $_SESSION['payable_amount'] * 100, // 2000 rupees in paise
      'currency'        => 'INR',
      'payment_capture' => 1 // auto capture
    ));
    $amount = $razorpayOrder['amount'];
    $razorpayOrderId = $razorpayOrder['id'];
    $_SESSION['razorpay_order_id'] = $razorpayOrderId;
    $data = $this->prepareData($amount,$razorpayOrderId);
    $this->load->view('web/pay/rezorpay',array('data' => $data));
  }
  /**
   * This function verifies the payment,after successful payment
   */
  public function verify()
  { 

    $keyId = RAZOR_KEY_ID;
    $secret = RAZOR_KEY_SECRET;

    $success = true;
    $error = "payment_failed";
    if (empty($_POST['razorpay_payment_id']) === false) {
      $api = new Api($keyId, $secret);
    try {
        $attributes = array(
          'razorpay_order_id' => $_SESSION['razorpay_order_id'],
          'razorpay_payment_id' => $_POST['razorpay_payment_id'],
          'razorpay_signature' => $_POST['razorpay_signature']
        );
        $api->utility->verifyPaymentSignature($attributes);
      } catch(SignatureVerificationError $e) {
        $success = false;
        $error = 'Razorpay_Error : ' . $e->getMessage();
      }
    }

    $unique_order_id = $this->session->userdata("unique_order_id");

    if ($success === true) {
      /**
       * Call this function from where ever you want
       * to save save data before of after the payment
       */

        $razorpay_payment_id = $this->input->post('razorpay_payment_id');
        $razorpay_signature = $this->input->post('razorpay_signature');

      $this->setRegistrationData($unique_order_id,$razorpay_payment_id,$razorpay_signature);
      redirect(base_url().'Checkout/success?order_id='.$unique_order_id);
    }
    else {
      redirect(base_url().'Checkout/paymentFailed?order_id='.$unique_order_id);
    }
  }
  /**
   * This function preprares payment parameters
   * @param $amount
   * @param $razorpayOrderId
   * @return array
   */
  public function prepareData($amount,$razorpayOrderId)
  {
    $name =  $this->session->userdata('name');

    $data = array(
      "key" => 'rzp_test_c8mzdPISx2gNQQ',
      "amount" => $amount,
      "name" => "VeekayCabs",
      "description" => $name,
      "image" => base_url()."assets/img/he-logo.png",
      "prefill" => array(
        "name"  => $name,
        "email"  => $this->session->userdata('email'),
        "contact" => $this->session->userdata('contact'),
      ),
      "notes"  => array(
        "merchant_order_id" => rand(),
      ),
      "theme"  => array(
        "color"  => "#000"
      ),
      "order_id" => $razorpayOrderId,
    );
    return $data;
  }
  /**
   * This function saves your form data to session,
   * After successfull payment you can save it to database
   */
  public function setRegistrationData($unique_order_id,$razorpay_payment_id,$razorpay_signature)
  {
    $name = $this->session->userdata('name');
    $email = $this->session->userdata('email');
    $contact = $this->session->userdata('contact');
    $amount = $_SESSION['payable_amount'];
    $registrationData = array(
      'order_id' => $_SESSION['razorpay_order_id'],
      'name' => $name,
      'email' => $email,
      'contact' => $contact,
      'amount' => $amount,
    );

    $unique_order_id = $unique_order_id;
    $razorpay_order_id = $_SESSION['razorpay_order_id'];
    $details_order_id = $_SESSION['details_order_id'];
    $user_id          = $_SESSION['user_id'];

    $data = array('booking_id'=>$unique_order_id,'details_order_id'=>$details_order_id,'user_id'=>$user_id,'final_amount'=>$amount,'razorpay_order_id'=>$razorpay_order_id,'razorpay_payment_id'=>$razorpay_payment_id,'razorpay_signature'=>$razorpay_signature);

    $this->db->insert('payment', $data);
    
  }
 


  public function success()
  { 

      if($this->session->userdata("unique_order_id") != null)
      {
        $unique_order_id = $this->session->userdata("unique_order_id");
        $data['payment_status']  = 1;

        $this->db->where('booking_id',$unique_order_id)->update('booking',$data);
        session_destroy();
      }
      else
      {
          $unique_order_id = $_GET['order_id'];
          $data['payment_status']  = 1;

          $this->db->where('booking_id',$unique_order_id)->update('booking',$data);
          
          session_destroy();
      }

     $this->message($unique_order_id);
  }

 public function message($unique_order_id)
  {
    redirect(base_url().'Thankyou?booking_id='.base64_encode($unique_order_id),'refresh');
  }
 

  public function paymentFailed()
  {
    $booking_id = $_GET['booking_id'];
    $this->db->where('booking_id',base64_decode($booking_id))->delete('booking');
    $this->load->view( base_url());
  }  
  
  
  public function pay_razor(){
      $data["amount_type"] = $this->input->get("is_full") == 1 ? "full" : "token";
      $this->load->view('web/razorpay', $data);
  }
  
  
  
  public function pay_razor_success(){
      
      $razorpay_payment_id = $_POST['id'] ?? $_GET["id"];
      $key_id = 'rzp_live_sXpBhpkf76P5V4';
      $key_secret = '8hXif0wfrPwOW8Fv6wZWts5c';
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "https://api.razorpay.com/v1/payments/$razorpay_payment_id");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_USERPWD, "$key_id:$key_secret");
      $response = curl_exec($ch);
      $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);
      
      if ($http_status === 200) {
          $pd = json_decode($response, true);
          if($pd["status"] == "authorized"){
              $data['only_security_amount'] = $this->input->get("only_security");
              $this->user_model->book_car($data);
              echo json_encode(["status"=>"success", "message"=>"Payment has completed !"]); exit;
          }else{
              echo json_encode(["status"=>"error", "message"=>"payment is not completed, try again !"]); exit;
          }
      } else {
          echo "Failed to fetch payment details. HTTP Status Code: $http_status";
      }
  }
  
  
  public function makeCOD(){
      $this->user_model->book_car_by_cod($data);
      redirect("/account/thankyou?order=".$this->session->userdata('unique_order_id'));
  }


}