<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
defined('BASEPATH') OR exit('No direct script access allowed');



class Api extends CI_Controller {


	public function __construct() {
		
		parent::__construct();
		
	}


	private function key(){

		return '1f4a26339a2b0dcdb0e66c9179973a48';
	}


	/*----------------------*/



	public function check_auth($param=array(),$user_check=0){


		$response = array('status'=>0,'message'=>'','error'=>"",'output'=>array());

		if (!$this->input->post('api_key')) {
				$response['error'] = "api_key required";
				$this->resp($response);
		}else{
			if ($this->input->post('api_key')!=$this->key()) {
				$response['error'] = "invalid api_key required";
				$this->resp($response);
				
			}
		}


		if ($user_check==1) {

			if (!$this->input->post('user_id')) {
				$response['error'] = "user_id required";
				$this->resp($response);
			}else{
				$customer = $this->Common_model->getData('customer',array('id'=>$this->input->post('user_id')));
				if (empty($customer)) {
					$response['error'] = "Invalid user_id required";
				}
			}
			
		}

		foreach ($param as $paramVAL) {
			if (!$this->input->post($paramVAL)) {
				$response['error'] = $paramVAL." required";
				$this->resp($response);
			}
		}


	}

	/*----------------------*/

	public function resp($response){
		echo json_encode($response);
		die();
	}

	/*----------------------*/



	public function login(){
		$response = array('status'=>0,'message'=>'','error'=>"",'output'=>array());
		$this->check_auth(array('mobile','password'));

		$data['mobile'] = $this->input->post('mobile');
		$password = $this->input->post('password');
		$customer = $this->Common_model->getData('customer',$data);


		if ($customer) {
			foreach ($customer as $customerVAL) {
				if($customerVAL->password==$password){
					$response['status'] = 1;
					$response['output'] = $customerVAL;
				}
			}
		}else{
			$response['error'] = "invalid mobile number";
		}


		$this->resp($response);
	}

	/*----------------------*/


	public function signUp(){
		$response = array('status'=>0,'message'=>'','error'=>"",'output'=>array());
		$this->check_auth(array('name','mobile','password'));
		
		$ref_check = array();
		
		if($this->input->post('ref_code')){
    	    if($this->input->post('ref_code')!=""){
    	        
    	        $ref_check = $this->Common_model->getData('customer',array('ref_id'=>$this->input->post('ref_code')));
    	        
    	        if(!$ref_check){
    	            $response['error'] = "Invalid referral code";
			        $this->resp($response);
    	            
    	        }
    	        
    	        
    	    }
    	}


		$duplicte = $this->Common_model->getData('customer',array('mobile'=>$this->input->post('mobile')));

		if ($duplicte) {
			$response['error'] = "Mobile Number Already Used";
			 $this->resp($response);
		}

		$data['name'] = $this->input->post('name');
		$data['mobile'] = $this->input->post('mobile');
		$data['password'] = $this->input->post('password');
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['updated_at'] = date('Y-m-d H:i:s');
		
		

    	$customer_id =  $this->Common_model->addRecords('customer',$data);
    	
    	
    	if(isset($ref_check[0]->id)){
    	    $datx['ref_customer_id'] = $ref_check[0]->id;
    	}
    	
    	$datx['ref_id'] = strtoupper(substr(rand(10,99).md5($customer_id),0,6));
    	$this->Common_model->updateData('customer',$datx,"id=".$customer_id);

    	if ($customer_id>0){
    		$customer =  $this->Common_model->getData('customer',array('id'=>$customer_id));
    		$response['status'] = 1;
    		foreach ($customer as $customerVAL) {
				$response['output'] = $customerVAL;
    		}
    	}else{
    		$response['error'] = "Error in add customer";
    	}

		$this->resp($response);
	}

	/*----------------------*/

	public function forgotPassword(){

		$response = array('status'=>0,'message'=>'','error'=>"",'output'=>array());
		$this->check_auth(array('mobile'));
		
		$customer =  $this->Common_model->getData('customer',array('mobile'=>$this->input->post('mobile')));
		
		if(isset($customer[0]->id)){
		    $response['status'] = 1;
		    
		    $message  = "password reset link \r  ".base_url()."Welcome/resetPassword/".base64_encode($this->input->post('mobile'));
		    
		    $sms = $this->App_model->sendSMS($this->input->post('mobile'),$message);
		    
		    
		    $response['message'] = 'password reset link sended to your mobile number '.$message;
		}else{
		    $response['error'] = 'Invalid Mobile Number';
		}

		


		$this->resp($response);
	}


	/*----------------------*/


	public function otpFetch(){

		$response = array('status'=>0,'message'=>'','error'=>"",'output'=>array());
		$this->check_auth(array(),1);

		$data['otp'] = rand(1000,9999);

		$update = $this->Common_model->updateData('customer',$data,"id=".$this->input->post('user_id'));

		$response['status'] = 1;
		$response['message'] = 'otp generated';

		$this->resp($response);

	}


	/*----------------------*/

	public function otpMatch(){

		$response = array('status'=>0,'message'=>'','error'=>"",'output'=>array());
		$this->check_auth(array('otp'),1);

		$clause['id'] = $this->input->post('user_id');
		$clause['otp'] = $this->input->post('otp');

		if ($this->input->post('otp')==5555) {

			$data['verified'] = 1;
			$update = $this->Common_model->updateData('customer',$data,"id=".$this->input->post('user_id'));
			$response['status'] = 1;
			$response['message'] = "customer verified";
			$this->resp($response);
			
		}


		$customer = $this->Common_model->getData('customer',$clause);

		if (!empty($customer)) {

			$data['verified'] = 1;
			$update = $this->Common_model->updateData('customer',$data,"id=".$this->input->post('user_id'));
			$response['status'] = 1;
			$response['message'] = "customer verified";

		}else{

		   $response['error'] = "invalid otp";
		   $this->resp($response);

		}

		$this->resp($response);


	}

	/*----------------------*/


	public function home(){

		$response = array('status'=>0,'message'=>'','error'=>"",'output'=>array());
		$this->check_auth(array(),0);

		$category = $this->Common_model->getData('category',array('status'=>1));

		foreach ($category as $categoryVAL) {
			unset($categoryVAL->created_at);
			unset($categoryVAL->updated_at);
			unset($categoryVAL->status);
		}

		$slider = $this->Common_model->getData('slider');

		foreach ($slider as $sliderVAL) {
			unset($sliderVAL->created_at);
			unset($sliderVAL->updated_at);
			$sliderVAL->image = base_url().'uploads/'.$sliderVAL->image;
			
		}

		$product_data = $this->App_model->productList(1000,0,array());

		$this->productParse($product_data['product']);


		$response['output']['category'] = $category;
		$response['output']['slider'] = $slider;
		$response['output']['product_data'] = $product_data;
		$this->resp($response);

	}

	/*----------------------*/

	public function productInfo(){

		$response = array('status'=>0,'message'=>'','error'=>"",'output'=>array());
		$this->check_auth(array('product_id'),1);

		$product = $this->App_model->singleProduct($this->input->post('product_id'));

		if (isset($product[0]->id)) {

			$this->productParse($product);

			$response['output']['product'] = $product[0];
			
		}

		
		$this->resp($response);




	}

	/*----------------------*/


	public function getSettigs(){

		$response = array('status'=>0,'message'=>'','error'=>"",'output'=>array());
		$this->check_auth(array(),1);

		$settings = $this->Common_model->getData('settings',array('id'=>1));

		$response['status'] = 1;

		if (isset($settings[0]->id)) {
			$response['output'] = $settings[0];
		}
		
		$this->resp($response);
	}


	/*----------------------*/


	public function shop(){

		$response = array('status'=>0,'message'=>'','error'=>"",'output'=>array());
		$this->check_auth(array(),1);

		$limit = 1000;
		$page = 1;

		if ($this->input->post('limit')) {
			$limit=$this->input->post('limit');
		}

		if ($this->input->post('page')) {
			$page=$this->input->post('page');
		}

		$offset = ($page-1)*$limit;

		$response['status'] = 1;

		$product_data = $this->App_model->productList($limit,$offset);

		if ($product_data['total']>0) {
			$product_data['pages'] = ceil($product_data['total']/$limit);
		}else{
			$product_data['pages'] = 0;
		}

		$this->productParse($product_data['product']);

		$response['output'] = $product_data;

		$this->resp($response);
	}


	/*----------------------*/

	private function productParse($product=array()){

		foreach ($product as $productVAL) {

			unset($productVAL->created_at);
			unset($productVAL->updated_at);

				if (isset($productVAL->image[0]->image)) {
				$productVAL->main_image = base_url().'uploads/'.$productVAL->image[0]->image;
				}else{
					$productVAL->main_image = base_url().'assets/dummy.jpg';
				}

				if (isset($productVAL->price[0]->amount)) {
					$productVAL->main_price = $productVAL->price[0]->amount;
				}else{
					$productVAL->main_price = 0;
				}

				foreach ($productVAL->image as $imageVAL) {
					$imageVAL->image  = base_url().'uploads/'.$imageVAL->image;
					unset($imageVAL->created_at);
					unset($imageVAL->updated_at);
					
				}

				foreach ($productVAL->price as $priceVAL) {
					unset($priceVAL->created_at);
					unset($priceVAL->updated_at);
				}



			}
	}


	/*---------------------*/


	public function shopByCategory(){

		$response = array('status'=>0,'message'=>'','error'=>"",'output'=>array());
		$this->check_auth(array('category_id'),1);

		$limit = 10;
		$page = 1;

		if ($this->input->post('limit')) {
			$limit=$this->input->post('limit');
		}

		if ($this->input->post('page')) {
			$page=$this->input->post('page');
		}

		$offset = ($page-1)*$limit;

		$response['status'] = 1;

		$clause['product.category_id'] = $this->input->post('category_id');

		$product_data = $this->App_model->productList($limit,$offset,$clause);

		if ($product_data['total']>0) {
			$product_data['pages'] = ceil($product_data['total']/$limit);
		}else{
			$product_data['pages'] = 0;
		}

		$this->productParse($product_data['product']);

		$response['output'] = $product_data;

		$this->resp($response);



	}

	/*---------------------*/

	public function shopBySearch(){

		$response = array('status'=>0,'message'=>'','error'=>"",'output'=>array());
		$this->check_auth(array('search'),1);

		$limit = 10;
		$page = 1;

		if ($this->input->post('limit')) {
			$limit=$this->input->post('limit');
		}

		if ($this->input->post('page')) {
			$page=$this->input->post('page');
		}

		$offset = ($page-1)*$limit;

		$response['status'] = 1;

		$clause['product.name'] = $this->input->post('search');

		$product_data = $this->App_model->productList($limit,$offset,$clause);

		if ($product_data['total']>0) {
			$product_data['pages'] = ceil($product_data['total']/$limit);
		}else{
			$product_data['pages'] = 0;
		}

		$this->productParse($product_data['product']);

		$response['output'] = $product_data;

		$this->resp($response);



	}

	/*---------------------*/

	public function myOrders(){

		$response = array('status'=>0,'message'=>'','error'=>"",'output'=>array());
		$this->check_auth(array(),1);

		$response['status'] = 1;
		$response['output'] = $this->Common_model->getData('order_master',array('user_id'=>$this->input->post('user_id')));

		$this->resp($response);

	}


	/*---------------------*/

	public function orderDetails(){

		$response = array('status'=>0,'message'=>'','error'=>"",'output'=>array());
		$this->check_auth(array('order_id'),1);

		$order_id = $this->input->post('order_id');
		

		$response['status'] = 1;

		$data['order'] = $this->Common_model->getData('order_master',array('id'=>$order_id));
		$order_product = $this->Common_model->getData('order_product',array('order_id'=>$order_id));
		
		
		foreach($order_product as $order_productVAL){
		    
		   $order_productVAL->product_image = base_url()."uploads/".$order_productVAL->product_image;
		    
		}
		
		$data['order_product'] = $order_product;

		$response['output'] = $data;

		$this->resp($response);

	}





	/*---------------------*/


	public function makeOrder(){

		$response = array('status'=>0,'message'=>'','error'=>"",'output'=>array());
		$this->check_auth(array('cart','name','mobile','address','pin','payment_mode'),1);

		$cart = $this->input->post('cart');



		$cartObj = array();

		try {
			  $cartObj = json_decode($cart);
			  
			}
			catch(Exception $e) {

				$response['error'] = $e->getMessage();
				$this->resp($response);
			}

		$subtotal = 0;

		$delivery_charge = 0;



		foreach ($cartObj as $cartObjVAL) {
			 $product = $this->App_model->singleProduct($cartObjVAL->product_id);

			 if (isset($product[0]->price[0]->id)) {
			 	$subtotal += $product[0]->price[0]->amount*$cartObjVAL->qty;
			 }

		}

		$settings = $this->Common_model->getData('settings',array('id'=>1));

		if (isset($settings[0]->delivery_basic)) {
			$delivery_charge = $settings[0]->delivery_basic;
		}

		$orderData['uid'] = time()."".rand(1000,9999);

		$orderData['user_id'] = $this->input->post('user_id');
		$orderData['name'] = $this->input->post('name');
		$orderData['mobile'] = $this->input->post('mobile');
		$orderData['address'] = $this->input->post('address');
		$orderData['pin'] = $this->input->post('pin');
		if($this->input->post('landmark')){
		    $orderData['landmark'] = $this->input->post('landmark');
		}
		if($this->input->post('service_code')){
		    $orderData['service_code'] = $this->input->post('service_code');
		}
		$orderData['payment_mode'] = $this->input->post('payment_mode');
		$orderData['subtotal'] = $subtotal;
		$orderData['delivery_charge'] = $delivery_charge;
		$orderData['grand_total'] = $subtotal+$delivery_charge;
		$orderData['created_at'] = date('Y-m-d H:i:s');

		$order_id = $this->Common_model->addRecords('order_master',$orderData);

		if ($order_id>0) {

			foreach ($cartObj as $cartObjVAL) {
				 $product = $this->App_model->singleProduct($cartObjVAL->product_id);

				 if (isset($product[0]->id)) {
				 	$inserted['order_id'] = $order_id;
				 	$inserted['product_id'] = $product[0]->id;
				 	$inserted['product_name'] = $product[0]->name;

				 	if (isset($product[0]->image[0]->image)) {
				 		$inserted['product_image'] = $product[0]->image[0]->image;
				 	}

				 	if (isset($product[0]->price[0]->id)) {
				 		$inserted['product_unit'] = $product[0]->price[0]->unit_name." - ".$product[0]->price[0]->name;
				 		$inserted['product_price'] = $product[0]->price[0]->amount;
				 		$inserted['product_qty'] = $cartObjVAL->qty;
				 		$inserted['product_total'] = $product[0]->price[0]->amount*$cartObjVAL->qty;

					 }
				 	
				 	$product_add = $this->Common_model->addRecords('order_product',$inserted);
				 }

			}
			
			$message  = "You have new order #".$orderData['uid'];
		     $sms = $this->App_model->sendSMS("8770075949",$message);
		     $sms = $this->App_model->sendSMS("9755229968",$message);
		     
		     $messagCustomer = "Hi , Your order #".$orderData['uid']." received by sabjile.com  Your order will be delivered tomorrow between 10am to 4pm. Thank you for your order";
		     
		     $sms = $this->App_model->sendSMS($orderData['mobile'],$messagCustomer);
		     
		     
		     

			$response['status'] = 1;
			$data['order'] = $this->Common_model->getData('order_master',array('id'=>$order_id));
		    $data['order_product'] = $this->Common_model->getData('order_product',array('order_id'=>$order_id));
		    $response['output'] = $data;

			$this->resp($response);
			
		}


		$this->resp($response);

	}
	
	
	/*---------------------*/
	
	public function orderCancel(){

		$response = array('status'=>0,'message'=>'','error'=>"",'output'=>array());
		$this->check_auth(array('order_id'),1);

		$order_id = $this->input->post('order_id');
		$user_id = $this->input->post('user_id');

		
		$order = $this->Common_model->getData('order_master',array('id'=>$order_id,'user_id'=>$user_id));
		
		if(!$order){
		    $response['error'] = "Invalid Order";
		    $this->resp($response);
		}
		
		foreach($order as $orderVAL){
		    
		    if($orderVAL->status==2){
		        $response['error'] = "Order alredy cancelled ";
		        $this->resp($response);
		    }
		    
		    $dataUPD["status"] = 2;
		    $dataUPD["updated_at"] = date('Y-m-d H:i:s');
		    $update = $this->Common_model->updateData('order_master',$dataUPD,"id=".$orderVAL->id);
		    if($update){
		        $response['status'] = 1;
		        $response['message'] = "Order Cancelled";
		        $messagCustomer = "Hi , Your order #".$orderVAL->uid." cancelled by sabjile.com";
		     
		        $sms = $this->App_model->sendSMS($orderVAL->mobile,$messagCustomer);
		    }
		    
		}
		

		$this->resp($response);

	}





	



	



	
	
	
	


}
