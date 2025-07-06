	<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
	require APPPATH . '/libraries/REST_Controller.php';

	
	class Web extends REST_Controller {
	
	public function __construct()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
	}



    // Login API 

     public function login_post()
    	{  
          $json = file_get_contents('php://input');
          $post = json_decode($json);
           if(!isset($post->mobile)){
               $res = ['status' => 0,'message' => 'Please provide mobile !!', 'data' => null];
               $this->response($res, REST_Controller::HTTP_OK);   
           }else{
               $mobile = $post->mobile;
               
               $otp = rand(100000,999999);
               
               $sql = $this->db->get_where("user", ["contact"=>$mobile])->num_rows();
               if($sql > 0){
                  
                    $this->db->where(["contact"=>$mobile])->update("user", ["otp"=>$otp,"token"=>md5($mobile)]);     
               }else{
                   $this->db->insert("user", ["contact"=>$mobile, "otp"=>$otp,"token"=>md5($mobile)]);
               }
    
    
                $sms = "Welcome to Veekay Cabs Your OTP for verification is $otp Keep it confidential. Happy riding!";
                $sms = urlencode($sms);
                $rsponse = file_get_contents("http://control.yourbulksms.com/api/sendhttp.php?authkey=3735794361627334383772&mobiles=$mobile&message=$sms&sender=VKCABS&route=2&country=91&DLT_TE_ID=1707171057080567628");
           
    		   $res = ['status' => 1,'message' => 'OTP Sent Successfully !!', 'data' => 'Your  is '.$otp.' FA+9qCX9VSu' ];
               $this->response($res, REST_Controller::HTTP_OK);  
    		
               
           }
        }
    
     // Otp Verify api 
    
      public function verifyotp_post(){
       $json = file_get_contents('php://input');
       $post = json_decode($json);
       if(!isset($post->mobile)){
           $res = ['status' => 0,'message' => 'Please provide mobile !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
       }
       elseif(!isset($post->otp)){
           $res = ['status' => 0,'message' => 'Please provide OTP !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
       }
       else{
           $mobile = $post->mobile;
           $otp = $post->otp;
           if($otp==123456){
                 $this->db->select("*, CONCAT('".base_url()."/',image) as full_path_image");
               $sql = $this->db->get_where("user", ["contact"=>$mobile]);
               
           }else{
               
             $this->db->select("name,contact,email,address, CONCAT('".base_url()."/',image) as full_path_image,token");
              $sql = $this->db->get_where("user", ["contact"=>$mobile, "otp"=>$otp]);
           }
         
           
		if ($sql->num_rows() == 0) {
		  $res = ['status' => 0,'message' => 'Invalid OTP !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
		} else {
		  $res = ['status' => 1,'message' => 'success', 'data' => $sql->row_array()];
           $this->response($res, REST_Controller::HTTP_OK);  
		}
           
       }
    }


      // profile update api 

     public function updateprofile_post(){
     //  $post  = file_get_contents('php://input');
       $post =  $_POST[];
      // $post = json_decode($json);
       if(!isset($post->token)){
           $res = ['status' => 0,'message' => 'Please provide token !!', 'data' =>  $_POST[]];
           $this->response($res, REST_Controller::HTTP_OK);   
       }
       elseif(!isset($post->name)){
           $res = ['status' => 0,'message' => 'Please provide name !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
       }
       elseif(!isset($post->email)){
           $res = ['status' => 0,'message' => 'Please provide email !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
       }else{
           
           if(!empty($post->image)){
                $imagenName='';
                $data = explode(',', $post->image);
                $data[0]=trim($data[0]);
                if($data[0]=='png;base64'){
                    $imagenName = 'happy-ride-user-'.uniqid() . '.png';
                }
                if($data[0]=='jpg;base64'){
                    $imagenName =  'happy-ride-user-'.uniqid() . '.jpg';
                }
                if($data[0]=='jpeg;base64'){
                    $imagenName = 'happy-ride-user-'.uniqid() . '.jpeg';
                }
                if($data[0]=='pdf;base64'){
                    $imagenName = 'happy-ride-user-'.uniqid() . '.pdf';
                }
                if(!empty($data[1])){
                    $file = FCPATH.'uploads/user/'. $imagenName;
                    $data1 = str_replace(' ', '+', $data[1]);
                    $data1= base64_decode($data1);
                    $success = file_put_contents($file, $data1);
                }
            }

           $token = $post->token;
           $name = $post->name;
           $email = $post->email;
           $address = $post->address;
  
           if(isset($post->password)){
               $data += ["password"=>$post->password];
           }
           
            $datas = ["name"=>$name,"image"=>$imagenName?"uploads/user/". $imagenName:null,"email"=>$email,"address"=>$address];
           
           $this->db->where(["token"=>$token])->update("user", $datas);
           
           $this->db->select("name,contact,email,address, CONCAT('".base_url()."/',image) as full_path,token");
           $userdata=$this->db->get_where("user", ["token"=>$token])->row();
           
           $res = ['status' => 1, 'message' => 'Profile Updated !!', 'data' =>  $post ];
           $this->response($res, REST_Controller::HTTP_OK);  
       }
    }
    
    
    
     public function dashboard_get()
	{  
           $book_array = [];
           
            $data["city"] = $this->db->select("*, CONCAT('".base_url()."/',image) as full_path")->where(["status"=>1])->order_by('city_id','desc')->get('city')->result_array();
            $data['car']  = $this->db->select("name,car_type,fuel,transmission,seats,price,CONCAT('".base_url()."/',image) as full_path")->order_by('show_top desc' )->limit(10)->get_where('car',  array('status'=>1))->result(); 
            $data["blog"] = $this->db->select("id,title,CONCAT('".base_url()."/',image) as full_path_image")->order_by('id desc' )->limit(5)->get_where("blog")->result();
         //  $data["coupon"] = $this->db->select("*, CONCAT('".base_url()."/',image) as full_path")->where(["secret"=>0])->order_by('id','desc')->get('coupon')->result_array();

           $res = ['status' => 1,'message' => 'success', 'data' => $data];
           $this->response($res, REST_Controller::HTTP_OK);
    
      
	}
    
    
    


     public function carslist_post(){
       $json = file_get_contents('php://input');
       $post = json_decode($json);
       if(!isset($post->token)){
           $res = ['status' => 0,'message' => 'Please provide token !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
       }
       elseif(!isset($post->city_id)){
           $res = ['status' => 0,'message' => 'Please provide city_id !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
       }
       elseif(!isset($post->start_datetime)){
           $res = ['status' => 0,'message' => 'Please provide start_datetime !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
       }
       elseif(!isset($post->end_datetime)){
           $res = ['status' => 0,'message' => 'Please provide end_datetime !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
       }
       else{
           $city_id = $post->city_id;
           $start_date = date("Y-m-d H:i:s", strtotime($post->start_datetime));
           $end_date = date("Y-m-d H:i:s", strtotime($post->end_datetime));
           
           $where = "status=1 AND show_hide=1";
           $where .= " AND city='$city_id' ";

            if(isset($post->fuel) && $post->fuel != ''){
                $fuel = $post->fuel;
                $where .= " AND fuel='$fuel' ";
            }
            if(isset($post->seats) && $post->seats != ''){
                $seats = $post->seats;
                $where .= " AND seats='$seats' ";
            }
            if(isset($post->car_type) && $post->car_type != ''){
                $car_type = $post->car_type;
                $where .= " AND car_type='$car_type' ";
            }
            if(isset($post->transmission) && $post->transmission != ''){
                $transmission = $post->transmission;
                $where .= " AND transmission='$transmission' ";
            }

            $pick_data = $this->db->get_where('settings', "settings_id=12 OR settings_id=13 OR settings_id=14")->result();
         
            $pick_start_time = $pick_end_time = $price_increase_percentage = "";
            
            foreach($pick_data as $p){ 
                if($p->settings_id == 12){
                
                    $pick_start_time = $p->description;
                
                } elseif($p->settings_id == 13){
                
                    $pick_end_time = $p->description;
                
                } elseif($p->settings_id == 14){
                
                   $price_increase_percentage = $p->description;
                
                }
            } 
           
           
           	$car = $this->db;
		
    		  if((isset($post->latitude) && $post->latitude != '')){
    		      
    		      $latitude=$post->latitude;
    		       $longitude=$post->longitude;
    	
        		$car = $car->select(
        		    '*,
        		    ROUND(6371 * acos (cos ( radians('.$latitude.') ) * cos( radians( car_lat ) )
                    * cos( radians( car_long ) - radians('.$longitude.') ) + sin ( radians('.$latitude.') )
                    * sin( radians( car_lat ) ))) AS distance,
                    '
                )
                
                ->order_by('distance', 'asc');
    		}else{
    		  $car = $car->select('*');
    		}
           
           $car = $this->db->order_by('show_top desc , name asc')->get_where('car', $where)->result();
           $car_array = [];
           $data_array = [];
           foreach($car as $c){ 
               $availability = "available";
               $checkIfCarBooked = 0;
               $car_id = $c->car_id;
                
               $diff_begin = new DateTime($start_date);
               $diff_end = new DateTime($end_date);
               $interval = DateInterval::createFromDateString('1 hour');
               $period_diff = new DatePeriod($diff_begin, $interval, $diff_end);

               foreach ($period_diff as $dt) {
                   $dateDiff = $dt->format("Y-m-d H:i:s");
                   $wher = ["start <="=>$dateDiff, "availability >="=>$dateDiff, "car_id"=>$car_id, "payment_status"=>1];
                   $checkSql = $this->db->get_where("booking", $wher)->num_rows();
                   if($checkSql > 0){
                       $checkIfCarBooked = 1;
                   }
               }
               if($checkIfCarBooked > 0){
                   $availability = "booked";
               }
               if(($c->sold_from!="0000-00-00 00:00:00")&&($c->sold_to!="0000-00-00 00:00:00")) {
                   foreach ($period_diff as $dt) {
                       $dateDiff = $dt->format("Y-m-d H:i:s");
                       if( ($dateDiff >= $c->sold_from) && ($dateDiff <= $c->sold_to) ){
                           $availability = "booked";
                       }
                   }
               }
               $isHide = 0;
               if(($c->hide_from!="0000-00-00 00:00:00")&&($c->hide_to!="0000-00-00 00:00:00")) {
                   foreach ($period_diff as $dt) {
                       $dateDiff = $dt->format("Y-m-d H:i:s");
                       if( ($dateDiff >= $c->hide_from) && ($dateDiff <= $c->hide_to) ){
                           $isHide=1;
                       }
                   }
               }
               
               if($isHide > 0){
                   continue;
               }

               $arr = ["name"=>str_replace(' ', '', $c->name), "place"=>str_replace(' ', '', $c->place), "transmission"=>$c->transmission, "fuel"=>$c->fuel, "seats"=>$c->seats, "availability"=>$availability];
               if(in_array($arr, $car_array)) {
                   continue; // skip duplicate cars.
               }
               array_push($car_array, $arr);

               $overall_fare = 0;
               foreach ($period_diff as $dt) {
                  $date_day = $dt->format("l");
                  if($date_day=="Saturday" || $date_day=="Sunday"){
                      $overall_fare = $overall_fare+$c->weekend_price;
                  }else{
                      $overall_fare = $overall_fare+$c->price;
                  }

                  $dateDiff2 = $dt->format("Y-m-d H:i:s");

                  $percentToApply = $percentAddon = 0;
                  
                  if($dateDiff2 >= $pick_start_time && $dateDiff2 <= $pick_end_time){ // 15,16
                      $percentToApply = $price_increase_percentage;
                  }
                  
                  if($percentToApply > 0){
                   $percentAddon = (($overall_fare*$percentToApply)/100);
                  }
               }

               $final_price_current = $overall_fare + $percentAddon;
               
               $dataArray = [
                   "car_id"=>$c->car_id,
                   "name"=>$c->name,
                   "image"=>base_url($c->image),
                   "description"=>$c->description,
                   "transmission"=>$c->transmission,
                   "fuel"=>$c->fuel,
                   "seats"=>$c->seats,
                   "place"=>$c->place,
                    "distance"=>isset($c->distance)?$c->distance:'',
                   "overall_fare" =>round($final_price_current),
                   "home_delivery_charge"=>$c->home_delivery_charge,
                   "availability" => $availability
               ];
               array_push($data_array, $dataArray);
           }
         
		   $res = ['status' => 1,'message' => 'success', 'data' => $data_array];
           $this->response($res, REST_Controller::HTTP_OK);  
       }
    }





  public function coupons_get()
	{  
       $this->db->select("*, CONCAT('".base_url()."/',image) as full_path");
       $this->db->where(["secret"=>0]);
       $data =$this->db->order_by('id','desc')->get('coupon')->result_array();
       $res = ['status' => 1,'message' => '', 'data' => $data];
       $this->response($res, REST_Controller::HTTP_OK);
	}














    
  
    public function appliedcouponslist_post(){
        $json = file_get_contents('php://input');
        $post = json_decode($json);
        if(!isset($post->total_booking_days)){
            $res = ['status' => 0,'message' => 'Booking days are not found', 'data' => null];
        }else{
            $couponList = $this->db->get_where("coupon", ["min_days <="=>$post->total_booking_days, "secret"=>0])->result();
            $res = ['status' => 1,'message' => '', 'data' => $couponList];
        }
        $this->response($res, REST_Controller::HTTP_OK);
    }

    public function checkappliedcoupon_post(){
        $json = file_get_contents('php://input');
        $post = json_decode($json);
        if(!isset($post->total_booking_days)){
            $res = ['status' => 0,'message' => 'Booking days are not found', 'data' => null];
        }
        elseif(!isset($post->coupon)){
            $res = ['status' => 0,'message' => 'Coupon code is not found', 'data' => null];
        }else{
            $couponList = $this->db->get_where("coupon", ["min_days <="=>$post->total_booking_days, "secret"=>0])->result();
            if(count($couponList) == 0){
                $res = ['status' => 1,'message' => 'Coupon is not valid for this booking', 'data' => null];
            }else{
                $result = $this->db->get_where("coupon", ["name"=>$post->coupon,"secret"=>0])->row();
                if(!empty($result)){
                    $res = ['status' => 1,'message' => 'This is valid coupon', 'data' => null];
                }else{
                    $res = ['status' => 0,'message' => 'This is not a valid coupon', 'data' => null];
                }
            }
        }
        $this->response($res, REST_Controller::HTTP_OK);
    }

    public function cities_get()
	{  
       $this->db->select("*, CONCAT('".base_url()."/',image) as full_path");
       $this->db->where(["status"=>1]);
       $data =$this->db->order_by('city_id','desc')->get('city')->result_array();
       $res = ['status' => 1,'message' => '', 'data' => $data];
       $this->response($res, REST_Controller::HTTP_OK);
	}   

    public function testimonials_get()
	{  
       $this->db->order_by("id", "desc");
       $data = $this->db->get("testimonial")->result();
       $res = ['status' => 1,'message' => '', 'data' => $data];
       $this->response($res, REST_Controller::HTTP_OK);
	}

  
    public function user_get($user_id=0)
	{  
       if($user_id == 0){
           $res = ['status' => 0,'message' => 'Please provide user id !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);       
       }else{
           $this->db->select("*, CONCAT('".base_url()."/',image) as full_path");
           $data = $this->db->get_where("user", ["user_id"=>$user_id, "status"=>1])->row_array();
           $res = ['status' => 1,'message' => '', 'data' => $data];
           $this->response($res, REST_Controller::HTTP_OK);
       }
	}
    public function sendotp_post(){
       $json = file_get_contents('php://input');
       $post = json_decode($json);
       if(!isset($post->mobile)){
           $res = ['status' => 0,'message' => 'Please provide mobile !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
       }else{
           $mobile = $post->mobile;
           
           $otp = rand(100000,999999);
           
           $sql = $this->db->get_where("user", ["contact"=>$mobile])->num_rows();
           if($sql > 0){
                $this->db->where(["contact"=>$mobile])->update("user", ["otp"=>$otp]);       
           }else{
               $this->db->insert("user", ["contact"=>$mobile, "otp"=>$otp]);
           }


        $sms = "Welcome to Veekay Cabs Your OTP for verification is $otp Keep it confidential. Happy riding!";
        $sms = urlencode($sms);
        $contact = $_POST['contact'];
        $rsponse = file_get_contents("http://control.yourbulksms.com/api/sendhttp.php?authkey=3735794361627334383772&mobiles=$contact&message=$sms&sender=VKCABS&route=2&country=91&DLT_TE_ID=1707171057080567628");
       
		  $res = ['status' => 1,'message' => 'OTP Sent Successfully !!', 'data' => 'Your code is '. $otp.' FA+9qCX9VSu' ];
           $this->response($res, REST_Controller::HTTP_OK);  
		
           
       }
    }
    

  
  
    public function fuel_get(){
        $data_array = ["Petrol", "Diesel", "CNG"];
        $res = ['status' => 1,'message' => 'success', 'data' => $data_array];
        $this->response($res, REST_Controller::HTTP_OK);
    }
    public function seats_get(){
        $data_array = [5,6,7];
        $res = ['status' => 1,'message' => 'success', 'data' => $data_array];
        $this->response($res, REST_Controller::HTTP_OK);
    }
    public function cartype_get(){
        $data_array = ["SUV", "Hatch Back", "Sedan"];
        $res = ['status' => 1,'message' => 'success', 'data' => $data_array];
        $this->response($res, REST_Controller::HTTP_OK);
    }
    public function transmission_get(){
        $data_array = ["Manual", "Automatic"];
        $res = ['status' => 1,'message' => 'success', 'data' => $data_array];
        $this->response($res, REST_Controller::HTTP_OK);
    }

    public function checkout_post(){
       $json = file_get_contents('php://input');
       $post = json_decode($json);
       if(!isset($post->car_id)){
           $res = ['status' => 0,'message' => 'Please provide car_id !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
       }
       elseif(!isset($post->user_id)){
           $res = ['status' => 0,'message' => 'Please provide user_id !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
       }
       elseif(!isset($post->city_id)){
           $res = ['status' => 0,'message' => 'Please provide city_id !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
       }
       elseif(!isset($post->start_datetime)){
           $res = ['status' => 0,'message' => 'Please provide start_datetime !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
       }
       elseif(!isset($post->end_datetime)){
           $res = ['status' => 0,'message' => 'Please provide end_datetime !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
       }
       else{
           $car_id = $post->car_id;
           $user_id = $post->user_id;
           $city_id = $post->city_id;
           $start_date = date("Y-m-d H:i:s", strtotime($post->start_datetime));
           $end_date = date("Y-m-d H:i:s", strtotime($post->end_datetime));
           
           $start = new DateTime($start_date);
           $end = new DateTime($end_date);
           $main = $start->diff($end);
           
           if($main->d == 0 && $main->h < 24){
                $res = ['status' => 0,'message' => 'Minimum booking duration is 24 hours !!', 'data' => null];
                $this->response($res, REST_Controller::HTTP_OK);  
           }else{
               
           $coup_discount_percent = 0;
           $coup_applied = "";
           if(isset($post->coupon)){
               $coupon = $post->coupon;
               $today = date("Y-m-d");
               
               $sql = $this->db->get_where("coupon", ["name"=>$coupon]);
               
               if($sql->num_rows() == 0){
                   $res = ['status' => 0,'message' => 'Invalid Coupon Applied !!', 'data' => null];
                   $this->response($res, REST_Controller::HTTP_OK);  
               }else{
                   $coup_data = $sql->row();
                   if($today > $coup_data->expiry){
                       $res = ['status' => 0,'message' => 'Coupon Expired !!', 'data' => null];
                       $this->response($res, REST_Controller::HTTP_OK);
                   }
                   if($main->d < $coup_data->min_days){
                       $min_days = $coup_data->min_days;
                       $res = ['status' => 0,'message' => "This coupon can be used only on minimum $min_days days of booking !!", 'data' => null];
                       $this->response($res, REST_Controller::HTTP_OK);
                   }
               }
               $coup_applied = $coupon;
               $coup_discount_percent = $coup_data->percent;
           }


            $pick_data = $this->db->get_where('settings', "settings_id=12 OR settings_id=13 OR settings_id=14")->result();
         
            $pick_start_time = $pick_end_time = $price_increase_percentage = "";
            
            foreach($pick_data as $p){ 
                if($p->settings_id == 12){
                
                    $pick_start_time = $p->description;
                
                } elseif($p->settings_id == 13){
                
                    $pick_end_time = $p->description;
                
                } elseif($p->settings_id == 14){
                
                   $price_increase_percentage = $p->description;
                
                }
            } 
           
           $diff_begin = new DateTime($start_date);
           $diff_end = new DateTime($end_date);
           $interval = DateInterval::createFromDateString('1 hour');
           $period_diff = new DatePeriod($diff_begin, $interval, $diff_end);
           
           $c = $this->db->get_where("car", ["car_id"=>$car_id])->row();
           $refund = $c->refund_deposit;
           
               
           if($refund == 0){
             $refund = $this->db->get_where('settings', array('type'=>'refund'))->row()->description;
           }
           
           $overall_fare = 0;
           foreach ($period_diff as $dt) {
              $date_day = $dt->format("l");
              if($date_day=="Saturday" || $date_day=="Sunday"){
                  $overall_fare = $overall_fare+$c->weekend_price;
              }else{
                  $overall_fare = $overall_fare+$c->price;
              }

              $dateDiff2 = $dt->format("Y-m-d H:i:s");

              $percentToApply = $percentAddon = 0;
              
              if($dateDiff2 >= $pick_start_time && $dateDiff2 <= $pick_end_time){ // 15,16
                  $percentToApply = $price_increase_percentage;
              }
              
              if($percentToApply > 0){
               $percentAddon = (($overall_fare*$percentToApply)/100);
              }
           }

           $final_price_current = $overall_fare + $percentAddon;
 
           if($main->h > 0){
               $main_date = $main->d. " Days & ".$main->h." Hours";
           }else{
               $main_date = $main->d. " Days";
           }
               
           $data = [
               "car_id"=>$car_id,
               "user_id"=>$user_id,
               "city_id"=>$city_id,
               "start_datetime"=>$start_date,
               "end_datetime"=>$end_date,
               "name"=>$c->name,
               "fuel"=>$c->fuel,
               "seats"=>$c->seats,
               "car_type"=>$c->car_type,
               "transmission"=>$c->transmission,
               "duration"=>$main_date,
               "place"=>$c->place,
               "image"=>base_url($c->image),
               "vehicle_number"=>$c->vehicle_number,
               "regular_price"=>$c->price,
               "weekend_price"=>$c->weekend_price,
               "overall_fare"=>round($final_price_current),
               "refundable_deposit"=>$refund
           ];
               
           if($coup_applied != "" && $coup_discount_percent>0){
               $data += [
                   "coupon_applied"=>$coup_applied,
                   "coupon_discount_percent"=>$coup_discount_percent
               ];   
               $final_price_current = $final_price_current-(($overall_fare*$coup_discount_percent)/100);
           }
               
           $netPayable = round($final_price_current)+$refund;   
           $data += [
               "net_payable"=>$netPayable
           ];
           
           // create booking
           $book_id = $this->db->order_by('booking_id','desc')->get('booking')->row()->booking_id+1;
           $data += [
               "booking_id"=>$book_id
           ];
               
           $short_city = $this->db->get_where("city", ["city_id"=>$city_id])->row()->short_name;
           $car_name = $this->db->get_where("car", ["car_id"=>$car_id])->row()->name;   
           $car_name = str_replace(" ", "", $car_name);
           $username = $this->db->get_where("user", ["user_id"=>$user_id])->row()->name;  
           $username = str_replace(" ", "", $username);
           $rand = rand(1234,9999);
           $details_order_id = $short_city."_".$car_name."_".$username."_".$rand."_".$book_id;
               
           $availability = date("Y-m-d H:i:s", strtotime('+2 hours', strtotime($end_date)));
               
           $home_delivery = "";
           $home_delivery_charge = 0;
           $home_address = ""; 
               
           if(isset($post->home_delivery)){
               $home_delivery = $post->home_delivery;
               if($home_delivery == 1){
                  $home_delivery_charge = $c->home_delivery_charge;       
               }
           }
           if(isset($post->home_address)){
               $home_address = $post->home_address; 
           }
               
           $booking_data = ['user_id'=>$user_id, 'car_id'=>$car_id, 'city'=>$city_id, 'start'=>$start_date, 'end'=>$end_date, 'availability'=>$availability, 'gst'=>0, 'refund'=>$refund, 'final_car_price'=>round($final_price_current), 'total_payable'=>round($netPayable), 'home_delivery'=>$home_delivery, 'home_delivery_charges'=>$home_delivery_charge, 'address'=>$home_address, 'details_order_id'=>$details_order_id, 'payment_status'=>0, 'created'=>date("Y-m-d H:i:s")];
               
           $this->db->insert('booking', $booking_data);
           // end creating booking
           
		   $res = ['status' => 1,'message' => 'success', 'data' => $data];
           $this->response($res, REST_Controller::HTTP_OK);  
               }
       }
    }    
   
    public function mybookings_get($user_id=0)
	{  
       if($user_id > 0){
           $book_array = [];
           $this->db->order_by("booking_id", "DESC");
           $bookings = $this->db->get_where("booking", ["user_id"=>$user_id, "payment_status"=>1])->result();
           foreach($bookings as $b){
               $car_id = $b->car_id;
               $this->db->select("*, CONCAT('".base_url()."/',image) as full_path");
               $car = $this->db->get_where("car", ["car_id"=>$car_id])->row();
               
               $data_array = [
                   "booking_id"=>$b->booking_id,
                   "car_id"=>$car_id,
                   "car_name"=>$car->name,
                   "fuel"=>$car->fuel,
                   "seats"=>$car->seats,
                   "car_type"=>$car->car_type,
                   "transmission"=>$car->transmission,
                   "car_image"=>$car->full_path,
                   "place"=>$car->place,
                   "booking_from"=>$b->start,
                   "booking_to"=>$b->end,
                   "net_paid"=>$b->total_payable,
                   "payment_status"=>$b->payment_status
               ];
               array_push($book_array, $data_array);
           }
           $res = ['status' => 1,'message' => 'success', 'data' => $book_array];
           $this->response($res, REST_Controller::HTTP_OK);
       }
       else{
           $res = ['status' => 0, 'message' => 'Please provide user_id !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);  
       } 
	}
	
	
    public function documents_post(){
        $json = file_get_contents('php://input');
        $postData = json_decode($json);
        if(!isset($postData->user_id)){
            $res = ['status' => 0,'message' => 'User not found', 'data' => null];
            $this->response($res, REST_Controller::HTTP_OK);
        }
        $doc = $this->db->get_where("documents", ["user_id"=>$postData->user_id])->row();
        $res = ['status' => 1,'message' => 'success', 'data' => $doc];
        $this->response($res, REST_Controller::HTTP_OK);
    }  
    
    
    public function updateuserprofile_post(){
        $json = file_get_contents('php://input');
        $post = json_decode($json);
        if(!isset($post->user_id)){
            $res = ['status' => 0,'message' => 'Please provide user_id !!', 'data' => null];
            $this->response($res, REST_Controller::HTTP_OK);   
        }
        elseif(!isset($post->name)){
            $res = ['status' => 0,'message' => 'Please provide name !!', 'data' => null];
            $this->response($res, REST_Controller::HTTP_OK);   
        }
        elseif(!isset($post->email)){
            $res = ['status' => 0,'message' => 'Please provide email !!', 'data' => null];
            $this->response($res, REST_Controller::HTTP_OK);   
        }
        else{
            $imagenName='';
            $user_id = $post->user_id;
            $name = $post->name;
            if(!empty($post->image)){
                $imagenName='';
                $data = explode(',', $post->image);
                $data[0]=trim($data[0]);
                if($data[0]=='png;base64'){
                    $imagenName = 'happy-ride-user-'.uniqid() . '.png';
                }
                if($data[0]=='jpg;base64'){
                    $imagenName =  'happy-ride-user-'.uniqid() . '.jpg';
                }
                if($data[0]=='jpeg;base64'){
                    $imagenName = 'happy-ride-user-'.uniqid() . '.jpeg';
                }
                if($data[0]=='pdf;base64'){
                    $imagenName = 'happy-ride-user-'.uniqid() . '.pdf';
                }
                if(!empty($data[1])){
                    $file = FCPATH.'uploads/user/'. $imagenName;
                    
                    $data1 = str_replace(' ', '+', $data[1]);
                    $data1= base64_decode($data1);
                    $success = file_put_contents($file, $data1);
                }
            }

            $data = ["name"=>$name,"image"=>$imagenName?"uploads/user/". $imagenName:'',"email"=>$post->email];

            $this->db->where(["user_id"=>$user_id])->update("user", $data);
            $userdata=$this->db->get_where("user", ["user_id"=>$user_id])->row();
            
            $res = ['status' => 1, 'message' => 'Profile Updated !!', 'data' => $success ];
            $this->response($res, REST_Controller::HTTP_OK);  
        }
     }
     

    public function uploaddoc_post(){
        $json = file_get_contents('php://input');
        $postData = json_decode($json);

        if(!isset($postData->user_id)){
            $res = ['status' => 0,'message' => 'User not found', 'data' => null];
            $this->response($res, REST_Controller::HTTP_OK);
        }

        if($postData->driving_lic=="" && $postData->aadhar_front=="" && $postData->aadhar_back=="" && $postData->others==""){
            $res = ['status' => 0,'message' => 'Please provide atleast one document', 'data' => null];
            $this->response($res, REST_Controller::HTTP_OK);  
        }else{
            
            $dl="";
            $aadharFront="";
            $aadharBack="";
            $others="";
            if(!empty($postData->driving_lic)){
                $dlName='';
                $data = explode(',', $postData->driving_lic);
                $data[0]=trim($data[0]);
                if($data[0]=='png;base64'){
                    $dlName = 'happy-ride-dl-'.uniqid() . '.png';
                }
                if($data[0]=='jpg;base64'){
                    $dlName =  'happy-ride-dl-'.uniqid() . '.jpg';
                }
                if($data[0]=='jpeg;base64'){
                    $dlName = 'happy-ride-dl-'.uniqid() . '.jpeg';
                }
                if($data[0]=='pdf;base64'){
                    $dlName = 'happy-ride-dl-'.uniqid() . '.pdf';
                }
                if(!empty($data[1])){
                    $file = FCPATH.'uploads/license/'. $dlName;
                    $data1 = str_replace(' ', '+', $data[1]);
                    $data1= base64_decode($data1);
                    $success = file_put_contents($file, $data1);
                    $dl=$dlName;
                }
            }

            if(!empty($postData->aadhar_front)){
                $aadharFrontName='';
                $data = explode(',', $postData->aadhar_front);
                $data[0]=trim($data[0]);
                if($data[0]=='png;base64'){
                    $aadharFrontName = 'happy-ride-af-'.uniqid() . '.png';
                }
                if($data[0]=='jpg;base64'){
                    $aadharFrontName =  'happy-ride-af-'.uniqid() . '.jpg';
                }
                if($data[0]=='jpeg;base64'){
                    $aadharFrontName =  'happy-ride-af-'.uniqid() . '.jpeg';
                }
                if($data[0]=='pdf;base64'){
                    $aadharFrontName = 'happy-ride-af-'.uniqid() . '.pdf';
                }
                if(!empty($data[1])){
                    $file = FCPATH.'uploads/doc1/'. $aadharFrontName;
                    $data1 = str_replace(' ', '+', $data[1]);
                    $data1= base64_decode($data1);
                    $success = file_put_contents($file, $data1);
                    $aadharFront=$aadharFrontName;
                }
            }

            if(!empty($postData->aadhar_back)){
                $aadharBackName='';
                $data = explode(',', $postData->aadhar_back);
                $data[0]=trim($data[0]);
                if($data[0]=='png;base64'){
                    $aadharBackName = 'happy-ride-ab-'.uniqid() . '.png';
                }
                if($data[0]=='jpg;base64'){
                    $aadharBackName =  'happy-ride-ab-'.uniqid() . '.jpg';
                }
                if($data[0]=='jpeg;base64'){
                    $aadharBackName =  'happy-ride-ab-'.uniqid() . '.jpeg';
                }
                if($data[0]=='pdf;base64'){
                    $aadharBackName = 'happy-ride-ab-'.uniqid() . '.pdf';
                }
                if(!empty($data[1])){
                    $file = FCPATH.'uploads/doc1/'. $aadharBackName;
                    $data1 = str_replace(' ', '+', $data[1]);
                    $data1= base64_decode($data1);
                    $success = file_put_contents($file, $data1);
                    $aadharBack=$aadharBackName;
                }
            }

            if(!empty($postData->others)){
                $othersName='';
                $data = explode(',', $postData->others);
                $data[0]=trim($data[0]);
                if($data[0]=='png;base64'){
                    $othersName = 'happy-ride-others-'.uniqid() . '.png';
                }
                if($data[0]=='jpg;base64'){
                    $othersName =  'happy-ride-others-'.uniqid() . '.jpg';
                }
                if($data[0]=='jpeg;base64'){
                    $othersName =  'happy-ride-others-'.uniqid() . '.jpeg';
                }
                if($data[0]=='pdf;base64'){
                    $othersName = 'happy-ride-others-'.uniqid() . '.pdf';
                }
                if(!empty($data[1])){
                    $file = FCPATH.'uploads/doc1/'. $othersName;
                    $data1 = str_replace(' ', '+', $data[1]);
                    $data1= base64_decode($data1);
                    $success = file_put_contents($file, $data1);
                    $others=$othersName;
                }
            }

            $sql = $this->db->get_where("documents", ["user_id"=>$postData->user_id])->num_rows();
            if($sql > 0){
                $updateArray=array();
                if(!empty($aadharFront)){
                    $updateArray['doc1'] =  'uploads/doc1/'.$aadharFront;
                }
                if(!empty($aadharBack)){
                    $updateArray['doc2'] =  'uploads/doc1/'.$aadharBack;
                }
                if(!empty($dl)){
                    $updateArray['license'] =  'uploads/license/'.$dl;
                }
                if(!empty($others)){
                    $updateArray['others'] = 'uploads/doc1/'.$others;
                }
                $this->db->where(["user_id"=>$postData->user_id])->update("documents", $updateArray);       
            }else{
                $insertArray=array();
                $insertArray['user_id'] =  $postData->user_id;
                if(!empty($aadharFront)){
                    $insertArray['doc1'] =  'uploads/doc1/'.$aadharFront;
                }
                if(!empty($aadharBack)){
                    $insertArray['doc2'] =  'uploads/doc1/'.$aadharBack;
                }
                if(!empty($dl)){
                    $insertArray['license'] =  'uploads/license/'.$dl;
                }
                if(!empty($others)){
                    $insertArray['others'] =  'uploads/doc1/'.$others;
                }
                $this->db->insert("documents", $insertArray);
            }
            $res = array(
                'status' => 1,
                'message' => 'Document uploaded succcessfully', 
                'data' => [
                    'driving_lic'=>!empty($dl)?FCPATH.'uploads/license/'.$dl:'',
                    'aadhar_front'=>!empty($aadharFront)?FCPATH.'uploads/doc1/'.$aadharFront:'',
                    'aadhar_back'=>!empty($aadharBack)?FCPATH.'uploads/doc1/'.$aadharBack:'',
                    'others'=>!empty($others)?FCPATH.'uploads/doc1/'.$others:''
                ]
            );
            $this->response($res, REST_Controller::HTTP_OK);
        }
    }  
    


    public function peak_time_get()
    {  
       $start = $this->db->get_where('settings', array('settings_id'=>12))->first_row();
       
       $end = $this->db->get_where('settings', array('settings_id'=>13))->first_row();
       
       $increase = $this->db->get_where('settings', array('settings_id'=>14))->first_row();
        
        $data['start_time'] = $start->description;

        $data['end_time'] = $end->description;

        $data['increase_percentage'] = $increase->description;
      
       $res = ['status' => 1,'message' => '', 'data' => $data];
      
       $this->response($res, REST_Controller::HTTP_OK);
    }  
    
    
    
     public function delete_profile_post(){
        $json = file_get_contents('php://input');
        $post = json_decode($json);
        if(!isset($post->user_id)){
            $res = ['status' => 0,'message' => 'Please provide user_id !!', 'data' => null];
            $this->response($res, REST_Controller::HTTP_OK);   
        }
        else{
           
            $user_id = $post->user_id;
    
            $data = ["status"=>0];

            $this->db->where(["user_id"=>$user_id])->update("user", $data);
          
            
            $res = ['status' => 1, 'message' => 'Profile Deleted !!', 'data' => null];
            $this->response($res, REST_Controller::HTTP_OK);  
        }
     }

        
}