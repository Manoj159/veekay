<?php
defined('BASEPATH') OR exit('No direct script access allowed');
     header("Access-Control-Allow-Origin: *");
class Welcome extends CI_Controller {

	function __construct(){
        parent::__construct();

        if(get_cookie('email') != '' && get_cookie('user_id') != ''){
        	
        	$response = $this->db->get_where('user', array('user_id'=>get_cookie('user_id')));

			if($response->num_rows() > 0){

				$user = $response->row();

				$this->session->set_userdata('user_id',$user->user_id);
				$this->session->set_userdata('contact',$user->contact);
				$this->session->set_userdata('email',$user->email);
				$this->session->set_userdata('name',$user->name);

				$this->input->set_cookie('user_id',$user->user_id, time() + (60*60*24*10));
				$this->input->set_cookie('contact',$user->contact, time() + (60*60*24*10));
				$this->input->set_cookie('email',$user->email, time() + (60*60*24*10));
				$this->input->set_cookie('name',$user->name, time() + (60*60*24*10));
			}
        }
	}

	public function index()
	{
	   // print('index');die;
	    
        $data["meta"] = $this->db->get_where("meta", ["pages"=>"Home"])->row();
        $data['car'] = $this->db->select('*')->order_by('show_top desc' )->limit(10)->get_where('car',  array('status'=>1))->result(); 
        $data["blog"] = $this->db->order_by('id desc' )->limit(10)->get_where("blog")->result();
		$this->load->view('web/index',$data);
		$this->load->view('web/footer');
	}
    public function car_rental_in_chandigarh()
	{
        $data["meta"] = (Object)["title"=>"Chandigarh Self Drive Car Rentals | VeekayCabss","h1_tag"=>"Self Drive Car Rental In Chandigarh" , "keyword"=>"Car Rental in chandigarh,  Luxury Cars Rental In Chandigarh, self drive car rental chandigarh", "description"=>"We provide you the best car rental in Chandigarh. Self Drive Car Rentals from VeekayCabss gives you the freedom and privacy you want during your trip."];
		$this->load->view('web/header', $data);
		$this->load->view('web/car-rental-in-chandigarh');
		$this->load->view('web/footer');
	}
    public function car_on_rent_in_delhi()
	{
        $data["meta"] = (Object)["title"=>"Self Drive Cars on Rent in Delhi | Car Rentals Delhi","h1_tag"=>"Best Luxury Car On Rent In Delhi NCR" , "keyword"=>"car on rent in delhi,  Self Drive Car Rental In Ghaziabad,  Luxury Car Rental Noida", "description"=>"Discover the ease of self drive cars on rent in Delhi. Explore the city at your pace with VeekayCabss car rentals in Delhi. Book now for a memorable journey"];
		$this->load->view('web/header', $data);
		$this->load->view('web/car-on-rent-in-delhi');
		$this->load->view('web/footer');
	}
    public function car_rental_in_amritsar()
	{
        $data["meta"] = (Object)["title"=>"Self Drive Car Rental in Amritsar", "h1_tag"=>"Self Drive Car Rental In Amritsar" ,  "keyword"=>"car rental in Amritsar,  self drive car rental in amritsar", "description"=>"VeekayCabss is a reputable service provider of Self drive car rental in Amritsar. Our dealerships verified and committed to Quality for convenient self drive."];
		$this->load->view('web/header', $data);
		$this->load->view('web/car-rental-in-amritsar');
		$this->load->view('web/footer');
	}
    public function car_on_rental_in_bangalore()
	{
        $data["meta"] = (Object)["title"=>"Book the Best Luxury car on Rental in Bangalore", "h1_tag"=>"Best Luxury Car On Rental In Bangalore" , "keyword"=>"car on rental in Bangalore", "description"=>"We Offer self drive car on rental in Bangalore at VeekayCabss so that you can choose a vehicle that suits you and drive it wherever you like. Book today"];
		$this->load->view('web/header', $data);
		$this->load->view('web/car-on-rental-in-bangalore');
		$this->load->view('web/footer');
	}
    public function car_rental_in_rajasthan()
	{
        $data["meta"] = (Object)["title"=>"Book Economical Rates Self Drive car Rental in Rajasthan","h1_tag"=>"Self Drive Car Rental In Rajasthan" ,"keyword"=>"Car rental in Rajasthan,  car rental in kota, self drive car rental in kota", "description"=>"Explore Rajasthan with ease with our Self drive cars on rent. Discover the beauty of Rajasthan with our convenient car rentals. Book now for a great adventure!"];
		$this->load->view('web/header', $data);
		$this->load->view('web/car-rental-in-rajasthan');
		$this->load->view('web/footer');
	}
    
    
    
    public function page_not_found()
	{
        $this->load->view('web/header');
		$this->load->view('web/page_not_found');
		$this->load->view('web/footer');
	}
    
    public function addHours(){
        $date="";
        if(isset($_GET["date"])){
           $date =  $_GET["date"];
        }
        if($date != ""){
            //echo $date;
            echo date("H:i", strtotime("$date +4 hours"));
        }
    }
    public function getHrs(){
      
        if(isset($_GET["end"])){
            extract($_GET);
            if($start!="" && $end!=""){
                echo round((strtotime($end) - strtotime($start))/3600, 1);
            }
        }
     
    }
    public function format_change(){
        if(isset($_POST["start_date"])){
            extract($_POST);
            echo date("m-d-Y", strtotime($start_date));
        }
    }
    
    
    
    public function about_us()
	{
	     $data["meta"] = (Object)["title"=>"About VeekayCabss - Car Rentals in Delhi", "keyword"=>"About VeekayCabss", "description"=>"Learn about us, your trusted choice for self drive car rentals in Delhi. Discover our commitment to quality self drive cars on rent in Delhi."];
	
        $this->load->view('web/header',$data);
		$this->load->view('web/about_us');
		$this->load->view('web/footer');
	}
	
    
    public function addCar()
	{
	    if($this->input->post()){
	        $post = $this->input->post();
	        $adhaar=$rc="";
	        if($_FILES['adhaar']['name'] != ""){
                $image    = $_FILES['adhaar']['name'];
                $file_size    = $_FILES['adhaar']['size'];
                $file_tmp     = $_FILES['adhaar']['tmp_name'];
                $file_type    = $_FILES['adhaar']['type'];
                $path         =  "/uploads/adhaar/";
                $temp = explode(".", $_FILES["adhaar"]["name"]);
                $newfilename = 'adhaar'.time().'.' . end($temp);
                move_uploaded_file($file_tmp, $_SERVER["DOCUMENT_ROOT"]."/".$path.$newfilename);
                $image = $path.$newfilename;
                $adhaar =$image;
            }
            
	        if($_FILES['rc']['name'] != ""){
                $image    = $_FILES['rc']['name'];
                $file_size    = $_FILES['rc']['size'];
                $file_tmp     = $_FILES['rc']['tmp_name'];
                $file_type    = $_FILES['rc']['type'];
                $path         =  "/uploads/adhaar/";
                $temp = explode(".", $_FILES["rc"]["name"]);
                $newfilename = 'carRc'.time().'.' . end($temp);
                move_uploaded_file($file_tmp, $_SERVER["DOCUMENT_ROOT"]."/".$path.$newfilename);
                $image = $path.$newfilename;
                $rc =$image;
            }
            $name = $post["name"];
            $contact = $post["contact"];
            $email = $post["email"];
            $brand = $post["brand"];
            $car_name = $post["car_name"];
            $fuel = $post["fuel"];
            $insertArray = [
                    "name"=>$name,
                    "email"=>$email,
                    "contact"=>$contact,
                    "brand"=>$brand,
                    "car_name"=>$car_name,
                    "fuel"=>$fuel,
                    "adhaar"=>$adhaar,
                    "rc"=>$rc
                ];
                
            $this->db->insert("add_cars", $insertArray);
            $encoded = base64_encode("Request Added Cantact You Soon");
            redirect("/add-car?msg=".$encoded);
	    }
	    $data["meta"] = (Object)["title"=>"Add Car VeekayCabss - Car Rentals in Delhi", "keyword"=>"About VeekayCabss", "description"=>"Learn about us, your trusted choice for self drive car rentals in Delhi. Discover our commitment to quality self drive cars on rent in Delhi."];
        $this->load->view('web/header',$data);
		$this->load->view('web/add-car');
		$this->load->view('web/footer');
	}
	
	public function page($title="")
    {
        if($title!=""){
            $titleUrl = str_replace("-"," ",$title);
            $sql = $this->db->get_where("tbl_pages", ["slug"=>$title]);
            if($sql->num_rows() > 0){
                $data["page"] = $blog = $sql->row();
                $data["meta"] = (Object)["title"=>$blog->meta_title, "keyword"=>$blog->meta_keyword, "meta_description"=>$blog->meta_description,"h1_tag"=>$blog->h1_tag, "mata_image"=>$blog->images];
                	$where = array('status'=>1, 'show_hide'=>1);
		      // 	$data['product_list'] = $this->db->order_by('id','desc')->get_where('product', array('status'=>1,'approved'=>1))->result();
                $this->load->view('web/header', $data);
                $this->load->view('web/page_details', $data);
                $this->load->view('web/footer');
            }else{
                redirect("/");
            }
        }else{
            redirect("/");
        }
    }
    
	public function delete_account()
	{
	 
	       $data["meta"] = (Object)["title"=>"VeekayCabss - Car Rentals in Delhi", "keyword"=>"About VeekayCabss", "description"=>"Learn about us, your trusted choice for self drive car rentals in Delhi. Discover our commitment to quality self drive cars on rent in Delhi."];
   
          $this->load->view('web/header', $data);
		$this->load->view('web/delete_account');
		$this->load->view('web/footer');
	}
	
		public function delete_user_account()
	{
	 
//	echo 'ok'; die;
	       $data["meta"] = (Object)["title"=>"VeekayCabss - Car Rentals in Delhi", "keyword"=>"About VeekayCabss", "description"=>"Learn about us, your trusted choice for self drive car rentals in Delhi. Discover our commitment to quality self drive cars on rent in Delhi."];
      $this->session->set_flashdata('success_message','User account deleted Successfully!');
        redirect("/");
	}
}
