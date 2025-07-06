<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends CI_Controller {

	public function index()
	{  
// 	    error_reporting(E_ALL);
// ini_set('display_errors', 1);

	   
	    $this->load->helper('check');
	    $this->checkValidations();
        extract($_GET);
		$data['city'] = $this->db->get_where('city', array('status'=>1))->result();
        // print_r($data);die;
        $today = date("Y-m-d");
        
        $where = "status =1 and show_hide=1";
		
		if(isset($_GET['city']) && $_GET['city'] != ''){
            $city = $_GET['city'];
            $where .= " AND city='$city' ";
		}

		if(isset($_GET['fuel']) && $_GET['fuel'] != ''){
            $fuel = $_GET['fuel'];
            $where .= " AND fuel='$fuel' ";
		}

		if(isset($_GET['seats']) && $_GET['seats'] != ''){
            $seats = $_GET['seats'];
            $where .= " AND seats='$seats' ";
		}

		if(isset($_GET['car_type']) && $_GET['car_type'] != ''){
            $car_type = $_GET['car_type'];
            $where .= " AND car_type='$car_type' ";
		}

		if(isset($_GET['transmission']) && $_GET['transmission'] != ''){
            $transmission = $_GET['transmission'];
            $where .= " AND transmission='$transmission' ";
		}
    
        // print_r($where);die;
        
		
		// if( $latitude && $longitude)
		// {
    	// 	$data['car'] = $data['car']->select(
    	// 	    '*,
    	// 	    ROUND(6371 * acos (cos ( radians('.$latitude.') ) * cos( radians( car_lat ) )
        //         * cos( radians( car_long ) - radians('.$longitude.') ) + sin ( radians('.$latitude.') )
        //         * sin( radians( car_lat ) ))) AS distance,
        //         '
        //     )
            
        //     ->order_by(' sold_to asc ,distance asc')
        //     ;
		// }else{
		//     $data['car'] = $data['car']->select('*');
		// }
            
		$carquery = $this->db->select('*')->order_by('hide_to DESC, sold_to asc ' )->get_where('car', $where)->result();
		 
		 
	        
	   $av = $bk = [];    
	    $s = date('Y-m-d H:i:s',strtotime($_GET["start"]));
        $e = date('Y-m-d H:i:s',strtotime($_GET["end"]));
	   foreach($carquery as $cdata)
	   {
	       $bookings =  $this->db->get_where('booking', array('car_id'=>$cdata->car_id,'payment_status'=>1,'status=1'))->result();
	        $booking = check_booking($bookings,$s,$e);
	        if($booking == 0){
                 
                    
                  $vdata = $this->db->query( "SELECT *  FROM car_hide_history  WHERE hide_from <= '$e' and car_id = '$cdata->car_id'  ")->result();
                     
                 if($vdata)
                 {    foreach($vdata as $cd){
                         if($cd->hide_to > $s)
                         {
                            
                             $booking = 1;
                             break;
                         }
                     }
                 }
              }
              $cdata->booking_status = $booking;
              if($booking==0){
                $av[]=$cdata;
              }else{
                 $bk[]=$cdata;
              }
	   }
	   
	   $res = array_merge($av,$bk);
	   
	   
	    
	   
	   if(isset($_GET['test']))
	   {
	       echo"<pre>";
	       echo  $s;
	       echo  $e;
	       print_r($res);
	       exit;
	   }
	   
	   $data['car'] = $res;
        
	        
        $meta_data["meta"] = $this->db->get_where("meta", ["pages"=>"Book"])->row();
        
        // print_r($meta_data);die;
        
		$this->load->view('web/header', $meta_data);
		$this->load->view('web/book', $data);
		$this->load->view('web/footer');
	}
	
	
	
	//For Api Of Car Listing :: Start
	

	public function apiCars()
	{   
	    
	    $today = date("Y-m-d");
        $where = "status =1 and show_hide=1";
		
		if(isset($_GET['city']) && $_GET['city'] != ''){
            $city = $_GET['city'];
            //$where .= " AND city='$city' ";
		}

		if(isset($_GET['fuel']) && $_GET['fuel'] != ''){
            $fuel = $_GET['fuel'];
            $where .= " AND fuel='$fuel' ";
		}

		if(isset($_GET['seats']) && $_GET['seats'] != ''){
            $seats = $_GET['seats'];
            $where .= " AND seats='$seats' ";
		}

		if(isset($_GET['car_type']) && $_GET['car_type'] != ''){
            $car_type = $_GET['car_type'];
            $where .= " AND car_type='$car_type' ";
		}

		if(isset($_GET['transmission']) && $_GET['transmission'] != ''){
            $transmission = $_GET['transmission'];
            $where .= " AND transmission='$transmission' ";
		}
        $car = $this->db->select('*')->order_by('show_top desc , name desc,  sold_to asc' )->get_where('car', $where)->result();
        $carData=[];
        foreach($car as $cars){
            $isSoldOut=0;
            if(isset($_GET["start"]) && isset($_GET["end"])){
                $booking =  $this->db->get_where('booking', array('car_id'=>$c->car_id,'start >= '=>$_GET["start"]))->result();
                $booking = check_booking($booking,$_GET["start"],$_GET["end"]);
                if($booking == 1){
                    $isSoldOut = 1;
                }
                $start = new DateTime($_GET["start"]);
                $end = new DateTime($_GET["end"]);
                $interval = DateInterval::createFromDateString('1 hour');
                $period = new DatePeriod($start, $interval, $end);
                $overall_fare=0;
                foreach ($period as $dt) {
                    $date_day = $dt->format("l"); 
                    if($date_day=="Saturday" || $date_day=="Sunday"){
                        $overall_fare = $overall_fare+$cars->weekend_price;
                    }else{
                        $overall_fare = $overall_fare+$cars->price;
                    }
                }
                                            
            }
            $cars->car_id = "V".$cars->car_id;
            $cars->overallPrice = $overall_fare;
            $cars->source = "Vk";
            $cars->isSoldOut = $isSoldOut;
            $carData[] = $cars;
        }
        //echo $this->db->last_query(); exit;
        echo json_encode(["status" => "success", "data" => $car, "img_url"=>base_url()]); exit;
	}
	//For Api Of Car Listing :: End

	public function set_user_address(){

		extract($_POST);

		$data = array('address'=>$address,'check'=>$check);

		return $this->session->set_userdata($data);

	}
    public function set_check(){
        $this->session->set_userdata("check", 1);
    }
    public function unset_user_address(){
		//$this->session->unset_userdata("address");
		$this->session->unset_userdata("check");
	}
	
	
	public function checkValidations(){
	    //echo "<pre>"; print_r($this->input->get()); exit;
	    $currDate = date("Y-m-d H:i:s");
	    $data = $this->input->get();
	    $startStr = strtotime(date("Y-m-d H:00:00", strtotime("+2 Hours")));
	    $endStr = strtotime($data["end"]);
	    $curStr = strtotime($currDate);
	    
	    
	    
	    if(($data["start"] == "" && $data["end"] == "")){
    	    $newEnd = date("Y-m-d H:00:00", strtotime("+26 Hours"));
    	    $newStart = date("Y-m-d H:00:00", $startStr);
    	    header("Location:/book?city=4&start=".$newStart."&end=".$newEnd); exit;
	    }
	    
	    
	    /*if($data["start"] == "" && $data["end"] != ""){
	        redirect("/?dter=1");
	    }
	    $matchTime = ($curStr + (3600*3));
	    if($startStr < $matchTime){
	        redirect("/?dter=1");
	    }
	    if(isset($endStr) && $startStr+(3600*24) > $endStr){
	        redirect("/?dter=1");
	    }*/
	}
	
	
		//For Api Of Car Listing :: Start
	

	public function checkBookCar()
	{   
        $sus='errro';
        $booking=0;
	   if(isset($_GET["start"]) && isset($_GET["end"]) && isset($_GET["vehicle_number"])){
            $vehicle_number= $_GET["vehicle_number"];
            $car = $this->db->select('*')->get_where('car', array('vehicle_number'=>$vehicle_number))->row();
            
                 $s = date('Y-m-d H:i:s',strtotime($_GET["start"]));
                 $e = date('Y-m-d H:i:s',strtotime($_GET["end"]));
             $bookings =  $this->db->get_where('booking', array('car_id'=>$car->car_id,'start >= '=>$s))->result();
             $booking = check_booking($bookings,$s,$e);
             if($booking == 0){
                 
                   
                 $data = $this->db->query( "SELECT * 
                    FROM car_hide_history 
                    WHERE hide_from <= '$e' and car_id = '$car->car_id'  ")->result();
                    if($data)
                    {    foreach($data as $cd)
                         {
                            if($cd->hide_to > $s)
                            {
                               
                                $booking = 1;
                                break;
                            }
                         }
                    }
             }
               
              $sus='success';
                                            
            }
            
        echo json_encode(["status" =>$sus, "data" => $booking ]); exit;
	//For Api Of Car Listing :: End
   }
   

}
