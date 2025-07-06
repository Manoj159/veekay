<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH."libraries/razorpay-php/Razorpay.php");

use Razorpay\Api\Api;

use Razorpay\Api\Errors\SignatureVerificationError;

class Admin_payment extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('data_model');
    }


    public function do_payment()
    {
      $this->data_model->car_booking();
      redirect('Admin_payment/before_payment');
    }


    public function before_payment()
    {
        $this->pay();
    }


  private function pay()
  {
    $amount = $this->session->userdata('final_amount');

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

     $this->load->view('admin/pay/rezorpays',array('data' => $data));
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
      redirect(base_url().'Admin_payment/success?order_id='.$unique_order_id);
    }
    else {
      redirect(base_url().'Admin_payment/paymentFailed?order_id='.$unique_order_id);
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
    
    $razorpay_order_id = $_SESSION['razorpay_order_id'];

    $book = $this->db->get_where('booking', array('booking_id'=>$unique_order_id))->row();

    $data = array('booking_id'=>$unique_order_id,'details_order_id'=>$book->details_order_id,'user_id'=>$book->user_id,'final_amount'=>$amount,'razorpay_order_id'=>$razorpay_order_id,'razorpay_payment_id'=>$razorpay_payment_id,'razorpay_signature'=>$razorpay_signature);

    $this->db->insert('payment', $data);

    $data2 = array('remaining'=>'');

    $this->db->where('booking_id',$unique_order_id)->update('booking', $data2);

    $data3 = array('payment_status'=>1);

    $this->db->where('booking_id',$unique_order_id)->update('booking_modify', $data3);
  }
 


  public function success()
  { 
      if($this->session->userdata("unique_order_id") != null)
      {
        $unique_order_id = $this->session->userdata("unique_order_id");
        $data['payment_status']  = 1;

        $this->db->where('booking_id',$unique_order_id)->update('booking',$data);
        
        $this->session->unset_userdata(array('email','name','contact','final_amount','unique_order_id','user_id'));

      }
      else
      {
          $unique_order_id = $_GET['unique_order_id'];
          $data['payment_status']  = 1;

          $this->db->where('booking_id',$unique_order_id)->update('booking',$data);
          $this->session->unset_userdata(array('email','name','contact','final_amount','unique_order_id','user_id'));
      }

     redirect(base_url().'Admin_payment/message','refresh');
  }

  
  public function message()
  {
    $this->session->set_flashdata('success_message','Payment Paid Successfully!');
    redirect(base_url().'Admin/booking_list','refresh');
  }
 

  public function paymentFailed()
  {
    $this->session->set_flashdata('error_message', ucwords('Payment Failed!'));
    redirect(base_url().'Admin/booking_list','refresh');
  }  


}