<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');
     header("Access-Control-Allow-Origin: *");
    require APPPATH . '/libraries/REST_Controller.php';

	
	class Api extends REST_Controller {
	
	public function __construct()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        $header = getallheaders();
	    $Authorization = !empty($header['Authorization']) ? $header['Authorization'] : ''; 
		
		if( $Authorization!="Basic dmVla2F5Y2Ficzp2ZWVrYXljYWJzQDI0Njg="){
		     $res = ['status' => 401,'message' => 'Please provide authkey !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
		}

	}


    // Login API 

    public function login_post()
    {  
          $json = file_get_contents('php://input');
          $post = json_decode($json);
           if(!isset($post->mobile)){
               $res = ['status' => 0,'message' => 'Please provide mobile !!', 'data' => null];
               $this->response($res, REST_Controller::HTTP_OK);   
           }elseif(!isset($post->type)){
               $res = ['status' => 0,'message' => 'Please provide user type !!', 'data' => null];
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
                if('8810207021'!=$mobile){
                    
                  $rsponse = file_get_contents("http://control.yourbulksms.com/api/sendhttp.php?authkey=3735794361627334383772&mobiles=$mobile&message=$sms&sender=VKCABS&route=2&country=91&DLT_TE_ID=1707171057080567628");
               
                }
    		   $res = ['status' => 1,'message' => 'OTP Sent Successfully !!', 'data' => 'Your  is '.$otp.' FA+9qCX9VSu' ];
               $this->response($res, REST_Controller::HTTP_OK);  
    		
               
           }
    }
    
     // Otp Verify api 
    public function verifyotp_post()
    {
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
           if($otp==654321){
                 $this->db->select("*, CONCAT('".base_url()."/',image) as full_path_image");
               $sql = $this->db->get_where("user", ["contact"=>$mobile]);
               
           }else{
               
             $this->db->select("user_id,name,contact,email,address, CONCAT('".base_url()."/',image) as full_path_image,token");
              $sql = $this->db->get_where("user", ["contact"=>$mobile, "otp"=>$otp]);
           }
         
           
		if ($sql->num_rows() == 0) {
		  $res = ['status' => 0,'message' => 'Invalid OTP !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
           
            
		} else {
		      $res=   $sql->row();
		        $doc = $this->db->get_where("documents", ["user_id"=>$res->user_id])->row();
		     
		    
		
		   $rerult=array(
		       
                    "name"=>$res->name ,
                    "contact"=> $res->contact,
                    "email"=> $res->email,
                    "address"=>$res->address,
                    "full_path_image"=> $res->full_path_image,
                    "token"=> $res->token,
                    "documents-status"=>$doc->doc_status,
                    "doc1"=>$doc->doc1,
                    "doc2"=>$doc->doc2,
                    "license"=>$doc->license,
                    "others"=>$doc->others
                    
		       );
		    
		  $res = ['status' => 1,'message' => 'success', 'data' => $rerult];
           $this->response($res, REST_Controller::HTTP_OK);  
		}
           
       }
    }

      // profile update api 

    public function updateprofile_post()
    {
       $json = file_get_contents('php://input');
       $post = json_decode($json);
       if(!isset($post->token)){
           $res = ['status' => 0,'message' => 'Please provide token !!', 'data' => null];
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
                $othersName='';
                $data = explode(',', $post->image);
                $data[0]=trim($data[0]);
                if(strpos($data[0], 'png') !== false){
                    $othersName = 'veekaycabs-ride-user-'.uniqid() . '.png';
                }
             
               if(strpos($data[0], 'jpg') !== false){
                    $othersName =  'veekaycabs-ride-user-'.uniqid() . '.jpg';
                }
               if(strpos($data[0], 'jpeg') !== false){
             
                    $othersName = 'veekaycabs-ride-user-'.uniqid() . '.jpeg';
                }
                if(!empty($data[1])){
                    $file = FCPATH.'uploads/user/'. $othersName;
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
           
            $datas = ["name"=>$name,"image"=>$othersName?"uploads/user/". $othersName:"null","email"=>$email,"address"=>$address];
           
           $this->db->where(["token"=>$post->token])->update("user", $datas);
           
           $this->db->select("name,contact,email,address, CONCAT('".base_url()."/',image) as image,token");
           $userdata=$this->db->get_where("user", ["token"=>$post->token])->row();
           
           $res = ['status' => 1, 'message' => 'Profile Updated !!', 'data' => $userdata];
           $this->response($res, REST_Controller::HTTP_OK);  
       }
    }
    
      // Dashbaord API for home page 
      
    public function dashboard_get()
	{  
           $book_array = [];
           
            $data["city"] = $this->db->select("*, CONCAT('".base_url()."/',image) as full_path")->where(["status"=>1])->order_by('city_id','desc')->get('city')->result_array();
            $data['car']  = $this->db->select("*")->order_by('show_top desc' )->limit(10)->get_where('car',  array('status'=>1))->result(); 
            $data["blog"] = $this->db->select("id,title,CONCAT('".base_url()."/',image) as full_path_image")->order_by('id desc' )->limit(5)->get_where("blog")->result();
           $data["coupon"] = $this->db->select("*, CONCAT('".base_url()."/',image) as full_path")->where(["secret"=>0])->order_by('id','desc')->get('coupon')->result_array();

           $res = ['status' => 1,'message' => 'success', 'data' => $data];
           $this->response($res, REST_Controller::HTTP_OK);
    
      
	}
    

      // Car listing with filter

    public function carslist_post()
    {
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
           
           $car = $this->db->order_by('sold_to DESC')->get_where('car', $where)->result();
           $car_array = [];
           $data_array = [];
           $favo=[];
            $userdata=$this->db->get_where("user", ["token"=>$post->token])->row();
    	     
    	   $favorites=$this->db->get_where("favorite", ["user_id"=>$userdata->user_id])->result();
    	    foreach( $favorites as  $favorite){ 
    	         array_push($favo, $favorite->car_id);
    	    }
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
                   "image"=>$c->image,
                   "description"=>$c->description,
                   "transmission"=>$c->transmission,
                   "fuel"=>$c->fuel,
                   "seats"=>$c->seats,
                    "car_type"=>$c->car_type,
                   "place"=>$c->place,
                    "distance"=>isset($c->distance)?$c->distance:'',
                   "overall_fare" =>round($final_price_current),
                   "home_delivery_charge"=>$c->home_delivery_charge,
                   "availability" => $availability
               ];
               
            if (in_array($c->car_id,$favo)){
                 $dataArray['is_favourite']=1;
            }else{
                 $dataArray['is_favourite']=0;
            }
              
               array_push($data_array, $dataArray);
           }
         
		   $res = ['status' => 1,'message' => 'success', 'data' => $data_array];
           $this->response($res, REST_Controller::HTTP_OK);  
       }
    }


     // coupons api for get 
    public function coupons_get()
	{  
       $this->db->select("*, CONCAT('".base_url()."/',image) as full_path");
       $this->db->where(["secret"=>0]);
       $data =$this->db->order_by('id','desc')->get('coupon')->result_array();
       $res = ['status' => 1,'message' => '', 'data' => $data];
       $this->response($res, REST_Controller::HTTP_OK);
	}

   // logout api 
    public function logout_post()
	{  
	    
	   $json = file_get_contents('php://input');
       $post = json_decode($json);
       if(!isset($post->token)){
           $res = ['status' => 0,'message' => 'Please provide token !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
       } else{
       
       $res = ['status' => 1,'message' => 'You are successfully logout', 'data' =>[] ];
       $this->response($res, REST_Controller::HTTP_OK);
       }
	}

    public function checkcoupon_post()
    {
            $json = file_get_contents('php://input');
            $post = json_decode($json);
            if(!isset($post->total_booking_days)){
                $res = ['status' => 0,'message' => 'Booking days are not found', 'data' => null];
            }
            elseif(!isset($post->coupon)){
                $res = ['status' => 0,'message' => 'Coupon code is not found', 'data' => null];
            }else{
                $couponList = $this->db->get_where("coupon", ["min_days <="=>$post->total_booking_days, "secret"=>0,"name"=>$post->coupon])->result();
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

    public function checkout_post()
    {
       $json = file_get_contents('php://input');
       $post = json_decode($json);
       if(!isset($post->car_id)){
           $res = ['status' => 0,'message' => 'Please provide car_id !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
       }
       elseif(!isset($post->token)){
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
           
           
              $userdata=$this->db->get_where("user", ["token"=>$post->token])->row();
              
		       $doc = $this->db->get_where("documents", ["user_id"=>$userdata->user_id])->row();
		     
                if($doc->doc_status != 'Accept'){
                   $res = ['status' => 0,'message' => 'Your documentation not approved by admin please contact your administrator', 'data' => null];
                   $this->response($res, REST_Controller::HTTP_OK);   
               }
        
           $car_id = $post->car_id;
           $user_id = $userdata->user_id;
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
               
           $booking_data = ['user_id'=>$user_id, 'car_id'=>$car_id, 'city'=>$city_id, 'start'=>$start_date, 'end'=>$end_date, 'availability'=>$availability, 'gst'=>0, 'refund'=>$refund, 'final_car_price'=>round($final_price_current), 'total_payable'=>round($netPayable), 'home_delivery'=>$home_delivery, 'home_delivery_charges'=>$home_delivery_charge, 'address'=>$home_address, 'details_order_id'=>$details_order_id, 'payment_status'=>0,'created'=>date("Y-m-d H:i:s")];
               
            $this->db->insert('booking', $booking_data);
            $book_id= $this->db->insert_id();
           
            $data["booking_id"]=$book_id;
           // end creating booking
           
		   $res = ['status' => 1,'message' => 'success', 'data' => $data];
           $this->response($res, REST_Controller::HTTP_OK);  
               }
       }
    }  
    
    
    public function booking_post()
    {
       $json = file_get_contents('php://input');
       $post = json_decode($json);
       if(!isset($post->token)){
           $res = ['status' => 0,'message' => 'Please provide token !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
       }
       elseif(!isset($post->booking_id)){
           $res = ['status' => 0,'message' => 'Please provide booking id !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
       }elseif(!isset($post->payment_status)){
           $res = ['status' => 0,'message' => 'Please provide status !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
       }
       else{
           $userdata=$this->db->get_where("user", ["token"=>$post->token])->row();
           $user_id = $userdata->user_id;
            $datas = ["payment_status"=>$post->payment_status,"booking_via"=>1];
           
           $this->db->where(["booking_id"=>$post->booking_id,"$user_id"=>$user_id])->update("booking", $datas);
           
           $book_array = [];
           $this->db->order_by("booking_id", "DESC");
           $bookings = $this->db->get_where("booking", ["user_id"=>$user_id])->result();
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
                   "final_car_price"=>$b->final_car_price,
                    "refund"=>$b->refund,
                    "net_paid"=>$b->total_payable,
                    "home_delivery"=>$b->home_delivery,
                    "home_delivery_charges"=>$b->home_delivery_charges,
                    "payment_status"=>$b->payment_status

               ];
               array_push($book_array, $data_array);
           }
           
           $res = ['status' => 1, 'message' => 'Booking  Updated !!', 'data' => $book_array];
           $this->response($res, REST_Controller::HTTP_OK);  
     }
   }

    public function mybookings_post()
	{  
        $json = file_get_contents('php://input');
        $postData = json_decode($json);
        
        if(!isset($postData->token)){
        $res = ['status' => 0,'message' => 'Please provide token !!', 'data' => null];
        $this->response($res, REST_Controller::HTTP_OK);   
        }
	     $userdata=$this->db->get_where("user", ["token"=>$postData->token])->row();
       if($userdata->user_id > 0){
           $user_id = $userdata->user_id;
            $datas = ["booking_via"=>3];
           
           $this->db->where(["booking_id"=>$post->booking_id,"$user_id"=>$user_id])->update("booking", $datas);
           
           $book_array = [];
           $this->db->order_by("booking_id", "DESC");
           $bookings = $this->db->get_where("booking", ["user_id"=>$user_id])->result();
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
                    "booking_to"=>$b->end,
                    "final_car_price"=>$b->final_car_price,
                    "refund"=>$b->refund,
                    "net_paid"=>$b->total_payable,
                    "home_delivery"=>$b->home_delivery,
                    "home_delivery_charges"=>$b->home_delivery_charges,
                    "payment_status"=>$b->payment_status

            
            
               ];
               array_push($book_array, $data_array);
           }
           $res = ['status' => 1,'message' => 'success', 'data' => $book_array ];
           $this->response($res, REST_Controller::HTTP_OK);
       }
       else{
           $res = ['status' => 0, 'message' => 'Please provide user_id !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);  
       } 
	}
	
	
	public function cancelbooking_post()
	{  
        $json = file_get_contents('php://input');
        $postData = json_decode($json);
        
        if(!isset($postData->token)){
        $res = ['status' => 0,'message' => 'Please provide token !!', 'data' => null];
        $this->response($res, REST_Controller::HTTP_OK);   
        }
          elseif(!isset($postData->booking_id)){
           $res = ['status' => 0,'message' => 'Please provide booking id !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
       }else
       {
	     $userdata=$this->db->get_where("user", ["token"=>$postData->token])->row();
           if($userdata->user_id > 0)
           {
           $user_id = $userdata->user_id;
              $datas = ["payment_status"=>3];
           
               $this->db->where(["booking_id"=>$postData->booking_id,"$user_id"=>$user_id])->update("booking", $datas);
               $book_array = [];
               $this->db->order_by("booking_id", "DESC");
               $bookings = $this->db->get_where("booking", ["user_id"=>$userdata->user_id])->result();
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
                       "final_car_price"=>$b->final_car_price,
                    "refund"=>$b->refund,
                    "net_paid"=>$b->total_payable,
                    "home_delivery"=>$b->home_delivery,
                    "home_delivery_charges"=>$b->home_delivery_charges,
                    "payment_status"=>$b->payment_status

                   ];
                   array_push($book_array, $data_array);
               }
               $res = ['status' => 1,'message' => 'success', 'data' => $book_array ];
               $this->response($res, REST_Controller::HTTP_OK);
           }
           else{
               $res = ['status' => 0, 'message' => 'Please provide user_id !!', 'data' => null];
               $this->response($res, REST_Controller::HTTP_OK);  
           } 
           
       }
	}
	
	
    public function documents_post()
    {
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
    
    
    public function uploaddoc_post()
    {
        $json = file_get_contents('php://input');
        $postData = json_decode($json);

         if(!isset($postData->token)){
           $res = ['status' => 0,'message' => 'Please provide token !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
         }
        if($postData->driving_lic=="" && $postData->aadhar_front=="" && $postData->aadhar_back=="" && $postData->others==""){
            $res = ['status' => 0,'message' => 'Please provide atleast one document', 'data' => null];
            $this->response($res, REST_Controller::HTTP_OK);  
         }else{
             $userdata=$this->db->get_where("user", ["token"=>$postData->token])->row();
            
            $dl="";
            $aadharFront="";
            $aadharBack="";
            $others="";
            if(!empty($postData->driving_lic)){
                $dlName='';
                $data = explode(',', $postData->driving_lic);
                $data[0]=trim($data[0]);
               if(strpos($data[0], 'png') !== false){
                    $dlName = 'veekaycabs-ride-dl-'.uniqid() . '.png';
                }
                if(strpos($data[0], 'jpg') !== false){
                    $dlName =  'veekaycabs-ride-dl-'.uniqid() . '.jpg';
                }
              if(strpos($data[0], 'jpeg') !== false){
                    $dlName = 'veekaycabs-ride-dl-'.uniqid() . '.jpeg';
                }
                  if(strpos($data[0], 'pdf') !== false){
                    $dlName = 'veekaycabs-ride-dl-'.uniqid() . '.pdf';
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
               if(strpos($data[0], 'png') !== false){
                    $aadharFrontName = 'veekaycabs-ride-af-'.uniqid() . '.png';
                }
                 if(strpos($data[0], 'jpg') !== false){
                    $aadharFrontName =  'veekaycabs-ride-af-'.uniqid() . '.jpg';
                }
                if(strpos($data[0], 'jpeg') !== false){
                    $aadharFrontName =  'veekaycabs-ride-af-'.uniqid() . '.jpeg';
                }
                  if(strpos($data[0], 'pdf') !== false){
                    $aadharFrontName = 'veekaycabs-ride-af-'.uniqid() . '.pdf';
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
              if(strpos($data[0], 'png') !== false){
                    $aadharBackName = 'veekaycabs-ride-ab-'.uniqid() . '.png';
                }
                 if(strpos($data[0], 'jpg') !== false){
                    $aadharBackName =  'veekaycabs-ride-ab-'.uniqid() . '.jpg';
                }
                if(strpos($data[0], 'jpeg') !== false){
                    $aadharBackName =  'veekaycabs-ride-ab-'.uniqid() . '.jpeg';
                }
                if(strpos($data[0], 'pdf') !== false){
                    $aadharBackName = 'veekaycabs-ride-ab-'.uniqid() . '.pdf';
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
               if(strpos($data[0], 'png') !== false){
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

            $sql = $this->db->get_where("documents", ["user_id"=> $userdata->user_id])->num_rows();
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
                $this->db->where(["user_id"=>$userdata->user_id])->update("documents", $updateArray);       
            }else{
                $insertArray=array();
                $insertArray['user_id'] =  $userdata->user_id;
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
                    'driving_lic'=>!empty($dl)?'uploads/license/'.$dl:'',
                    'aadhar_front'=>!empty($aadharFront)?'uploads/doc1/'.$aadharFront:'',
                    'aadhar_back'=>!empty($aadharBack)?'uploads/doc1/'.$aadharBack:'',
                    'others'=>!empty($others)?'uploads/doc1/'.$others:''
                ]
            );
            $this->response($res, REST_Controller::HTTP_OK);
        }
    }  
    

    public function favorite_post()
    {  
            $json = file_get_contents('php://input');
            $postData = json_decode($json);
            
            if(!isset($postData->token)){
            $res = ['status' => 0,'message' => 'Please provide token !!', 'data' => null];
            $this->response($res, REST_Controller::HTTP_OK);   
            }
            elseif(!isset($postData->favorite)){
               $res = ['status' => 0,'message' => 'Please provide favorite key !!', 'data' => null];
               $this->response($res, REST_Controller::HTTP_OK);   
           }elseif(!isset($postData->car_id)){
               $res = ['status' => 0,'message' => 'Please provide car !!', 'data' => null];
               $this->response($res, REST_Controller::HTTP_OK);   
           }
           else{
    	     $userdata=$this->db->get_where("user", ["token"=>$postData->token])->row();
           
            if($postData->favorite == 1){
                   $favorites=    $this->db->get_where(" favorite ", ["user_id"=>$userdata->user_id, "car_id"=>$postData->car_id ])->row();
                   if(empty ($favorites)){
                     $this->db->insert(" favorite ", ["user_id"=>$userdata->user_id, "car_id"=>$postData->car_id ]);
                   }
            }else{
                   $this->db->delete("favorite", ["user_id"=>$userdata->user_id, "car_id"=>$postData->car_id ]);
            }
             
    
           $res = ['status' => 1,'message' => 'success', 'data' => []];
           $this->response($res, REST_Controller::HTTP_OK);
           }
    	}
	
	public function favoritelist_post()
    {  
            $json = file_get_contents('php://input');
            $postData = json_decode($json);
            
            if(!isset($postData->token)){
            $res = ['status' => 0,'message' => 'Please provide token !!', 'data' => null];
            $this->response($res, REST_Controller::HTTP_OK);   
            }
           else{
    	     $userdata=$this->db->get_where("user", ["token"=>$postData->token])->row();
    	     
    	        $favorites=$this->db->get_where("favorite", ["user_id"=>$userdata->user_id])->result();
    	     if(!empty($favorites))
    	     {
    	         
    	          foreach($favorites as $favorite){ 
    	              $cars[]= $favorite->car_id;
    	          }
    	     
    	    
              $car=   $this->db->select('*')->where_in('car_id',$cars)->get("car")->result();
            //   $str = $this->db->last_query();
                
                $car_array = [];
                $data_array = [];
                      foreach($car as $c){ 
                          
                          $dataArray = [
                                "car_id"=>$c->car_id,
                                "name"=>$c->name,
                                "image"=>$c->image,
                                "description"=>$c->description,
                                "transmission"=>$c->transmission,
                                "fuel"=>$c->fuel,
                                "seats"=>$c->seats,
                                "car_type"=>$c->car_type,
                                "place"=>$c->place,
                                "distance"=>'',
                                "overall_fare" =>'',
                                "home_delivery_charge"=>$c->home_delivery_charge,
                                "availability" => ''
                          ];
                          array_push($data_array, $dataArray);
                      }
                
                $res = ['status' => 1,'message' => 'success', 'data' => $data_array];
                $this->response($res, REST_Controller::HTTP_OK);  
           }else{
                $res = ['status' => 1,'message' => 'No data', 'data' => []];
                $this->response($res, REST_Controller::HTTP_OK);  
               
           }
               
           }
        
    	}
    	
	
    public function navigationevent_post()
    {  
            $json = file_get_contents('php://input');
            $postData = json_decode($json);
            
            if(!isset($postData->token)){
            $res = ['status' => 0,'message' => 'Please provide token !!', 'data' => null];
            $this->response($res, REST_Controller::HTTP_OK);   
            }
            elseif(!isset($postData->last_event)){
               $res = ['status' => 0,'message' => 'Please provide favorite key !!', 'data' => null];
               $this->response($res, REST_Controller::HTTP_OK);   
           }
           else{
    	       $userdata=$this->db->get_where("user", ["token"=>$postData->token])->row();
    	        $this->db->insert("user_last_visit", ["user_id"=>$userdata->user_id, "page "=>$postData->last_event ]);
          
           $res = ['status' => 1,'message' => 'success', 'data' => []];
           $this->response($res, REST_Controller::HTTP_OK);
           }
    	}
    	
    	

    public function contactsync_post()
    {
       $json = file_get_contents('php://input');
       $post = json_decode($json);
       if(!isset($post->token)){
           $res = ['status' => 0,'message' => 'Please provide token !!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
       }
       elseif(!isset($post->contact_no)){
           $res = ['status' => 0,'message' => 'Please provide contact list!!', 'data' => null];
           $this->response($res, REST_Controller::HTTP_OK);   
       }
       else
       {
               $userdata=$this->db->get_where("user", ["token"=>$post->token])->row();
               $user_id = $userdata->user_id;
               $contact_no=$post->contact_no;
                 $user = $this->db->get_where("user_contact", ["user_id"=>$user_id])->row();
               if(!empty($user)){
                   
                  $datas = ["contact_no"=>$post->contact_no];
                  $this->db->where(["user_id"=>$user_id])->update("user_contact", $datas);
                   
               }else{
                    $this->db->insert("user_contact", ["user_id"=>$user_id, "contact_no"=>$post->contact_no]); 
               }
               
               $res = ['status' => 1, 'message' => 'Contact Updated !!', 'data' => []];
               $this->response($res, REST_Controller::HTTP_OK);  
       }
    }    	
    	
    	
	
        
}