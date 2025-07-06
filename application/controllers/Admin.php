<?php

	//error_reporting(1);
class Admin extends CI_Controller 
{

    function __construct() {
        parent::__construct();

		$this->load->database();
		$this->load->library('session');
        $this->load->model('data_model');
    }

	public function index()
	{
      
        if(($this->session->userdata('admin_login')) != 1) redirect(base_url().'Admin_login', 'refresh');

        if(($this->session->userdata('admin_login'))  == 1)
        {
        	redirect('admin/dashboard', 'refresh');
        }
	}

	public function dashboard()
    {
        if(($this->session->userdata('admin_login')) != 1) redirect(base_url().'Admin_login', 'refresh');
        
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] =  ucwords('Admin Dashboard');

        $this->load->view('admin/index',$page_data);
    }

	public function system_setting($param1="", $param2="", $param3="")
    {
        if($param1 == "update")
        {
            $this->data_model->updateSystemSetting();
            redirect(base_url().'admin/system_setting', 'refresh');
        }

        if(($this->session->userdata('admin_login')) != 1) redirect(base_url().'Admin_login', 'refresh');
        $page_data['page_name']  = 'system_setting';
        $page_data['page_title'] =  ucwords('system setting');
        
        $this->load->view('admin/index',$page_data);
    }

    public function changeHeaderColortheme()
    {
       $insert =  $this->data_model->mdlchangeHeaderColor();
        echo json_encode($insert);
    }

    public function changeMenuColortheme()
    {
       $insert =  $this->data_model->mdlchangeMenuColortheme();
        echo json_encode($insert);
    }


    public function edit_profile($param1="", $param2="", $param3="")
    {
        if($param1 == "update_profile")
        {
            $this->data_model->update_user_profile();
            redirect('admin/edit_profile','refresh');
        }

        if($param1 == "changepassword")
        {
            $this->data_model->changepassword();
            redirect('admin/edit_profile','refresh');
        }

        $page_data['page_name']  = 'edit_profile';
        $page_data['page_title'] =  ucwords('profile setting');
        $this->load->view('admin/index',$page_data);
    }

    public function about_us($param1="", $param2="")
    {
        if($param1 == "update")
        {
            $this->data_model->update_about_us();
            redirect('admin/about_us','refresh');
        }
        
        if($param1 == "update_hindi")
        {
            $this->data_model->update_hindi_about_us();
            redirect('admin/about_us','refresh');
        }

        $page_data['page_name']  = 'about_us';
        $page_data['page_title'] =  ucwords('Manage about us');
        $this->load->view('admin/index',$page_data);
    }


    public function privacy($param1="", $param2="")
    {
        if($param1 == "update")
        {
            $this->data_model->update_privacy();
            redirect('admin/privacy','refresh');
        }

        $page_data['page_name']  = 'privacy';
        $page_data['page_title'] =  ucwords('Manage privacy policy');
        $this->load->view('admin/index',$page_data);
    }

    public function refund_policy($param1="", $param2="")
    {
        if($param1 == "update")
        {
            $this->data_model->update_refund_policy();
            redirect('admin/refund_policy','refresh');
        }

        $page_data['page_name']  = 'refund_policy';
        $page_data['page_title'] =  ucwords('Manage FAQ');
        $this->load->view('admin/index',$page_data);
    }

    public function terms($param1="", $param2="")
    {
        if($param1 == "update")
        {
            $this->data_model->update_terms();
            redirect('admin/terms','refresh');
        }

        $page_data['page_name']  = 'terms';
        $page_data['page_title'] =  ucwords('Manage terms & Condition');
        $this->load->view('admin/index',$page_data);
    }

    
    public function social_link($param1 = '')
    {
        if($param1 == 'facebook')
        {
            $this->data_model->facebook_link();
            redirect(base_url().'Admin/social_link','refresh'); 
        }

        if($param1 == 'instagram')
        {
            $this->data_model->instagram_link();
            redirect(base_url().'Admin/social_link','refresh'); 
        }
        
        if($param1 == 'linkedin')
        {
            $this->data_model->linkedin_link();
            redirect(base_url().'Admin/social_link','refresh'); 
        }
        
        if($param1 == 'youtube')
        {
            $this->data_model->youtube_link();
            redirect(base_url().'Admin/social_link','refresh'); 
        }
        
        if($param1 == 'twitter')
        {
            $this->data_model->twitter_link();
            redirect(base_url().'Admin/social_link','refresh'); 
        }

        $data['facebook']  = $this->db->get_where('social_links', array('id'=>1))->row()->link;
        $data['instagram']  = $this->db->get_where('social_links', array('id'=>2))->row()->link;
        $data['linkedin']  = $this->db->get_where('social_links', array('id'=>3))->row()->link;
        $data['youtube']  = $this->db->get_where('social_links', array('id'=>4))->row()->link;
        $data['twitter']  = $this->db->get_where('social_links', array('id'=>5))->row()->link;

        $data['page_name'] = 'social_link';
        $data['page_title'] =  ucwords('manage social link');
        $this->load->view('admin/index', $data);
    }


   public function contact_request($param1="", $param2="")
    {

        if($param1 == "delete")
        {
            $this->data_model->delete_contact_request($param2);
            redirect('admin/contact_request','refresh');
        }

        if($param1 == 'send_reply')
        {
            $email = $_POST['email'];
            
            $subject = 'The VeekayCabs';
             
            $message = $_POST['message'];
             
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
            $headers .= 'From: <info@happyeasyride.com>' . "\r\n";
             
            mail($email,$subject,$message,$headers);
            
            redirect('admin/contact_request','refresh');
        }

        $page_data['request'] = $this->db->order_by('contact_id','desc')->get('contact')->result_array();

        $page_data['page_name']  = 'contact_request';
        $page_data['page_title'] =  ucwords('Manage contact request');
        $this->load->view('admin/index',$page_data);
    } 



    public function gallery_image($param1="", $param2="")
    {

        if($param1 == "add")
        {
            $this->data_model->gallery_image();
            redirect('admin/gallery_image','refresh');
        }

        if($param1 == "delete")
        {
            $image_path = $_GET['image_path'];

            $this->data_model->delete_gallery_image($param2, $image_path);
            redirect('admin/gallery_image','refresh');
        }


        $page_data['page_name']  = 'gallery_image';
        $page_data['page_title'] =  ucwords('Manage gallery image');
        $this->load->view('admin/index',$page_data);
    }
    
    public function slider_image($param1="", $param2="")
    {

        if($param1 == "add")
        {
            $this->data_model->slider_image();
            redirect('admin/slider_image','refresh');
        }

        if($param1 == "delete")
        {
            $image_path = $_GET['image_path'];

            $this->data_model->delete_slider_image($param2, $image_path);
            redirect('admin/slider_image','refresh');
        }


        $page_data['page_name']  = 'slider_image';
        $page_data['page_title'] =  ucwords('Manage Slider image');
        $this->load->view('admin/index',$page_data);
    }
    public function testimonial($param1="", $param2="")
    {

        if($param1 == "add_image")
        {
            $this->data_model->testimonial_image();
            redirect('admin/testimonial','refresh');
        }
        if($param1 == "add")
        {
            extract($_POST);
            $this->data_model->testimonial_add($name,$review);
            
            // $array = ["name"=>$name, "review"=>$review];
            // $this->db->insert("testimonial", $array);
            redirect('admin/testimonial','refresh');
        }

        if($param1 == "delete")
        {
            $this->db->delete("testimonial", ["id"=>$param2]);
            redirect('admin/testimonial','refresh');
        }


        $page_data['page_name']  = 'testimonial';
        $page_data['page_title'] =  ucwords('Manage Testimonials');
        $this->load->view('admin/index',$page_data);
    }
    
    public function offer_image($param1="", $param2="")
    {
        if($param1 == "add")
        {
            $this->data_model->offer_image();
            redirect('admin/offer_image','refresh');
        }
        
        if($param1 == "delete")
        {
            $this->data_model->delete_offer_image();
            $this->session->set_flashdata('success','Banner Deleted Successfully!');
            redirect('admin/offer_image','refresh');
        }


        $page_data['page_name']  = 'offer_image';
        $page_data['page_title'] =  ucwords('Manage offer images');
        $this->load->view('admin/index',$page_data);
    }

    public function city($param1="", $param2="")
    {

        if($param1 == "add")
        {
            $this->data_model->add_city();
            redirect('admin/city','refresh');
        }

        if($param1 == "update")
        {
            $this->data_model->update_city($param2);
            redirect('admin/city','refresh');
        }

        if($param1 == "delete")
        {
            $this->data_model->delete_city();
            redirect('admin/city','refresh');
        }

        $data['city'] = $this->db->order_by('city_id','desc')->get_where('city', array('status'=>1))->result_array();
        $data['page_name']  = 'city';
        $data['page_title'] =  ucwords('Manage city');
        $this->load->view('admin/index',$data);
    }

    

    public function comments($param1="", $param2="")
    {
        if($param1 == "insert")
        {
            $this->data_model->insert_comments();
            redirect('admin/comments','refresh');
        }

        if($param1 == "delete")
        {
            $this->data_model->delete_comments($param2);
            redirect('admin/comments','refresh');
        }

        $page_data['comments'] = $this->db->order_by('comments_id','desc')->get('comments')->result_array();

        $page_data['page_name']  = 'comments';
        $page_data['page_title'] =  ucwords('Manage comments');
        $this->load->view('admin/index',$page_data);
    }
    
    public function coupons($param1="", $param2="")
    {
        if($param1 == "insert")
        {
            $this->data_model->insert_coupons();
            redirect('admin/coupons','refresh');
        }
        if($param1 == "update")
        {
            $this->data_model->update_coupons();
            redirect('admin/coupons','refresh');
        }
        if($param1 == "delete")
        {
            $this->data_model->delete_coupons($param2);
            redirect('admin/coupons','refresh');
        }

        $page_data['coupon'] = $this->db->order_by('id','desc')->get('coupon')->result_array();

        $page_data['page_name']  = 'coupons';
        $page_data['page_title'] =  ucwords('Manage Coupons');
        $this->load->view('admin/index',$page_data);
    }
    
    public function blog($param1="", $param2="")
    {
        if($param1 == "insert")
        {
            $this->data_model->insert_blog();
            redirect('admin/blog','refresh');
        }
        if($param1 == "update")
        {
            $this->data_model->update_blog();
            redirect('admin/blog','refresh');
        }
        if($param1 == "delete")
        {
            $this->data_model->delete_blog($param2);
            redirect('admin/blog','refresh');
        }

        $page_data['blog'] = $this->db->order_by('id','desc')->get('blog')->result_array();

        $page_data['page_name']  = 'blog';
        $page_data['page_title'] =  ucwords('Manage blogs');
        $this->load->view('admin/index',$page_data);
    }


    public function car($param1="", $param2="")
    {

        if($param1 == "add")
        {
            $this->data_model->add_car();
            $this->session->set_flashdata('message','Car Added Successfully!');
            redirect('admin/car','refresh');
        }

        if($param1 == "update")
        {
            $this->data_model->update_car($param2);
            $this->session->set_flashdata('message','Car updated Successfully!');
            redirect('admin/list_car','refresh');
        }

        if($param1 == "delete")
        {
            $this->data_model->delete_car();
            $this->session->set_flashdata('delete','Car Deleted Successfully!');
            redirect('admin/list_car','refresh');
        }

        if($param1 == "show_hide")
        {
            $this->data_model->show_hide_car();
            $this->session->set_flashdata('message','Car updated Successfully!');
            redirect('admin/list_car','refresh');
        }
        
        $data['city'] = $this->db->order_by('name','asc')->get_where('city', array('status'=>1))->result();
        $data['page_name']  = 'car';
        $data['page_title'] =  ucwords('Manage car');
        $this->load->view('admin/index',$data);
    }

    public function change_booking_availability(){
        if(isset($_POST["booking_id"])){
            extract($_POST);
            $where = ["booking_id"=>$booking_id];
            $data = ["availability"=>$availability];
            $this->db->where($where)->update("booking", $data);
            $this->session->set_flashdata('message', 'Car availability updated !!');
        }
        redirect($_SERVER["HTTP_REFERER"]);
    }
    
    public function list_car($param1="", $param2="")
    {
        $data['car'] = $this->db->order_by('car_id','desc')->get_where('car', array('status'=>1))->result();   
        $data['page_name']  = 'list_car';
        $data['page_title'] =  ucwords('Manage car listing');
        $this->load->view('admin/index',$data);
    }

    public function edit_car($param1="", $param2="")
    {
        $data['city'] = $this->db->order_by('name','asc')->get_where('city', array('status'=>1))->result();
        $data['car'] = $this->db->get_where('car', array('car_id'=>base64_decode($_GET['car_id'])))->result();   
        
        $data['car_hide_history'] = $this->db->get_where('car_hide_history', array('car_id'=>base64_decode($_GET['car_id'])))->result();
        
        // echo"<pre>";print_r($data['car_hide_history']);die;
        
        $data['page_name']  = 'edit_car';
        $data['page_title'] =  ucwords('Manage car');
        $this->load->view('admin/index',$data);
    }

public function booking_list($param1 = "", $param2 = "")
{
    $where = ['b.status' => 1];

    if (isset($_GET["start_date"])) {
        extract($_GET);

        $start_date = $start_date . " 00:00:00";
        $end_date = $end_date . " 23:59:59";

        if ($type == "Arrivals") {
            $where += ["b.end >=" => $start_date, "b.end <=" => $end_date];
        } elseif ($type == "Departures") {
            $where += ["b.start >=" => $start_date, "b.start <=" => $end_date];
        } else {
            $where += ["b.start >=" => $start_date, "b.end <=" => $end_date];
        }
    }

    // Use JOIN to get username and carname
    $this->db->select('b.*, u.name AS username,u.contact, c.name AS carname,c.vehicle_number');
    $this->db->from('booking b');
    $this->db->join('user u', 'u.user_id = b.user_id', 'left');
    $this->db->join('car c', 'c.car_id = b.car_id', 'left');
    $this->db->where($where);
    $this->db->order_by('b.booking_id', 'desc');
    $query = $this->db->get();

    $data['booking'] = $query->result();

    $notRecive = [];
    $Recive = [];

    foreach ($data['booking'] as $bk) {
        if ($bk->car_received == 0) {
            $notRecive[] = $bk;
        } else {
            $Recive[] = $bk;
        }
    }

    $data['booking'] = array_merge($notRecive, $Recive);

    $booking_count = $this->db->where(['status' => 1, 'payment_status' => 1])->count_all_results("booking");
    $this->session->set_userdata("booking_count", $booking_count);
    // echo'<pre>';
    // print_r($data);
    // exit;

    $data['page_name'] = 'booking_list';
    $data['page_title'] = ucwords('Manage booking');
    $this->load->view('admin/index', $data);
}


    public function booking_details($param1="", $param2="")
    {
        $data['booking'] = $this->db->get_where('booking', array('booking_id'=>base64_decode($_GET['booking_id'])))->result();   
        // echo"<pre>";print_r($data['booking']);die;
        $data['page_name']  = 'booking_details';
        $data['page_title'] =  ucwords('Manage booking');
        $this->load->view('admin/index',$data);
    }
    

    public function add_booking($param1="", $param2="")
    {
        if($param1 == "add")
        {
            extract($_POST);
             $user=  $this->db->get_where('user', array('contact'=>$contact))->row();
           if(!empty($user)){
               $userId =  $user->user_id;
               $contact =  $user->contact;
               $name = $name;
               
                $where = ["user_id"=>$userId];
                
                $data2 = [
                    'name' => $name,
                ];
                if($email!=''){
                   $data2["email"]=$email;
                }
                if($address!=''){
                   $data2["address"]=$address;
                }
                $this->db->where($where)->update("user", $data2);
               
            }else{
                $data = [
                    'name' => $name,
                    "email"=>$email, 
                    "address"=>$address, 
                    'contact' => $contact,
                ];
                $this->db->insert("user", $data);
                $userId = $this->db->insert_id();
            }

            $short_city = $this->db->get_where("city", ["city_id"=>$city])->row()->short_name;
            $car_name = $this->db->get_where("car", ["car_id"=>$car_id])->row()->name;   
            $car_name = str_replace(" ", "", $car_name);
            $username = str_replace(" ", "", $name); 
            $rand = rand(1234,9999);
            $details_order_id = $short_city."_".$car_name."_".$username."_".$rand;
                
            $availability = date("Y-m-d H:i:s", strtotime('+2 hours', strtotime($end)));
            $remaining = ($total_payable)-($receved_amount);
    
            $data1 = [
                'car_id' => $car_id,
                'user_id' => $userId,
                'details_order_id' => $details_order_id,
                'availability' => $availability,
                "city"=>$city, 
                "start"=>$start, 
                'end' => $end,
                'final_car_price' => $final_car_price,
                "refund"=>$refund,
                "total_payable"=>$total_payable,
                "GST"=>0,
                "remaining"=>$remaining,
                "home_delivery_charges"=>$home_delivery_charges,
                "home_delivery"=>$home_delivery_charges!=0?1:0,
                'booking_via'=>3,
                'admin_name'=>$admin_name,
                'address'=>$address,
                
                "payment_status"=>1,

            ];
            
            $this->db->insert("booking", $data1);
            $bookigId = $this->db->insert_id();
            // redirect($_SERVER["HTTP_REFERER"]);
            $this->booking_success_whatapps($contact,$bookigId,$name);
            
            $this->booking_success_whatapps_for_admin('9311826201');
            $this->booking_success_whatapps_for_admin('9999926867');
            $this->booking_success_whatapps_for_admin('8448586825');
            $this->booking_success_whatapps_for_admin('9773796805');
            
             //  $this->booking_success_whatapps_for_admin('9336630515');
            $this->session->set_flashdata('message','Booking Added Successfully!');
            redirect(base_url('admin/booking_list'));
        }
        
        $where = "status =1 and show_hide=1";
        $carquery = $this->db->select('*')->order_by('hide_to DESC, sold_to asc ' )->get_where('car', $where)->result();

        $page_data['city'] =$this->db->order_by('name','asc')->get_where('city', array('status'=>1))->result();
        $page_data['car_list'] = $carquery;
        $page_data['page_name']  = 'booking_add';
         $page_data['page']  = 'booking_add';
        $page_data['page_title'] =  ucwords('Add Page');
        $this->load->view('admin/index',$page_data);
    }

    public function mark_payement_complete($param1="")
    {
        // print_r($_GET);die;
        
        $bookingId = base64_decode($_GET['booking_id']);
        // print($bookingId);die;
        
        $up = $this->db->where('booking_id',$bookingId)
            ->update('booking',['remark' => $this->input->get('remark'),'remaining' => 0]);
        
        $response = [
            'message' => 'Success',
            'data' => $up
        ];
        
        echo json_encode($response);die;
        
        return redirect(base_url('Admin/booking_details?booking_id='.$_GET['booking_id']));
    }

    public function user_details($param1="", $param2="")
    {
        $data['user'] = $this->db->get_where('user', array('user_id'=>base64_decode($_GET['user_id'])))->result();   
        
        $data['page_name']  = 'user_details';
        $data['page_title'] =  ucwords('Manage booking');
        $this->load->view('admin/index',$data);
    }


    public function booking($param1="", $param2="")
    {

        if($param1 == "update")
        {
            $this->data_model->update_booking($param2);
            $this->session->set_flashdata('message','Booking updated Successfully!');
            redirect('admin/booking_list','refresh');
        }

        if($param1 == "delete")
        {
            $this->data_model->delete_booking();
            $this->session->set_flashdata('delete','Booking Deleted Successfully!');
            redirect('admin/booking_list','refresh');
        }

        if($param1 == "show_hide")
        {
            $this->data_model->show_hide_car();
            $this->session->set_flashdata('message','Booking updated Successfully!');
            redirect('admin/list_car','refresh');
        }
        
        
        if($param1 == "cancel_booking_admin")
        {
            // print('cancel_booking_admin');die;
            
            $up = $this->data_model->cancel_booking_admin();
        
            echo json_encode([
                'message' => 'success',
                'status' => 200
            ]);
            die;
        }
        
        
        
        $data['city'] = $this->db->order_by('name','asc')->get_where('city', array('status'=>1))->result();
        $data['page_name']  = 'car';
        $data['page_title'] =  ucwords('Manage car');
        $this->load->view('admin/index',$data);
    }
	
	
    public function edit_booking($param1="", $param2="")
    {
        $data['booking'] = $this->db->get_where('booking', array('booking_id'=>base64_decode($_GET['booking_id'])))->result();
        
        // echo"<pre>";print_r($data['booking']);die;
        
        // extract($_GET);
        
        // print($latitude);die;
        
        // print('index');die;
        
        // $data['city'] = $this->db->order_by('name','asc')->get_where('city', array('status'=>1))->result();

        // echo"<pre>"; print_r($data['booking']);die;
        
        // $today = date("Y-m-d");
        
        $where = "status=1 AND show_hide=1";
		
		// if(isset($_GET['city']) && $_GET['city'] != ''){
        //     $city = $_GET['city'] ?? $data['booking'][0]->city;
        //     $where .= " AND city='$city' ";
		// }

		/*if(isset($_GET['fuel']) && $_GET['fuel'] != ''){
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
		}*/
    
        // print_r($where);die;
        
		$data['car_list'] = $this->db->select('*')->order_by('name asc')->get_where('car', $where)->result();

        // print_r($this->db->last_query());die;
        
        // echo"<pre>";print_r($data['car_list']);die;
        
        $data['car'] = $this->db->order_by('car_id','desc')->get_where('car', array('status'=>1))->result(); 
        
        $data['city'] = $this->db->order_by('name','asc')->get_where('city', array('status'=>1))->result(); 

        $data['page_name']  = 'edit_booking';
        $data['page_title'] =  ucwords('Manage booking');
        $this->load->view('admin/index',$data);
    }

    public function update_booking()
    {
        $bookingId = $this->input->post('booking_id');
        $data['booking'] = $this->db->get_where('booking', array('booking_id'=>$bookingId))->result();
        
        $bookingData = $data['booking'][0];
        $booking_modify = $this->db->where(['booking_id' => $bookingId])->get('booking_modify')->row();
        
        
        $carDetail = $this->db->get_where('car', array('car_id'=>$this->input->post('car')))->row();
        
        // echo"<pre>";print_r($carDetail);die;
        
        if($bookingData->car_id > 0){
            
            $data = array(
                'booking_id' => $bookingId,
                'details_order_id'=>$bookingData->details_order_id,
                'user_id'=> $bookingData->user_id,
                'car_id'=> $bookingData->car_id,
                'city'=> $bookingData->city,
                'start'=>$bookingData->start,
                'end'=>$bookingData->end,
                'availability'=>$bookingData->availability,
                'final_car_price'=> $bookingData->final_car_price,
                'gst'=> $bookingData->gst,
                'refund'=> $bookingData->refund,
                'total_payable'=> $bookingData->total_payable,
                'remaining' => $bookingData->remaining,
                'remark' => $bookingData->remark,
                'home_delivery'=> $bookingData->home_delivery,
                'home_delivery_charges'=> $bookingData->home_delivery_charges,
                'address'=>$bookingData->address,
            );
            
            $this->db->insert('booking_modify', $data);            
            
            
            $start = new DateTime($this->input->post('start'));
            $end = new DateTime($this->input->post('end'));
            
            
            
            // echo"<pre>";print_r($bookingData);die;
            
            $where = "status=1 AND show_hide=1";
    		
            $city = $bookingData->city;
            $where .= " AND city='$city' ";
    
            // $fuel = $carDetail->fuel;
            // $where .= " AND fuel='$fuel' ";
    
            // $seats = $carDetail->seats;
            // $where .= " AND seats='$seats' ";
    
            // $car_type = $carDetail->car_type;
            // $where .= " AND car_type='$car_type' ";
    
            // $transmission = $carDetail->transmission;
            // $where .= " AND transmission='$transmission' ";
        
            // print_r($where);die;
            
    		/*$data['car_list'] = $this->db->select('*')
    	        ->order_by('show_top desc , name asc')
    	        ->get_where('car', $where)
    	        ->result();*/
    	        
    	   // print_r($this->db->last_query());die;
    	    
            // echo"<pre>";print_r($data['car_list']);die;
            
            $main = $start->diff($end);
            
            // echo"<pre>";print_r($main);die;
            
            if($main->h > 0){
            
                if($main->d != 0){
                    $main_date = $main->d. " Days & ".$main->h." Hours";
                }else{
                    $main_date = $main->h." Hours";
                }
            
            }else{
                $main_date = $main->d. " Days";
            }
            
            $price = $carDetail->price;
            
            $day = date("l", strtotime($this->input->post('start')));
    
            if($day=="Saturday" || $day=="Sunday"){
                $price = $carDetail->weekend_price;    
            }
            
            
            // print($price);die;
            $price_per_hour =  round($price / 24);
            // print($price_per_hour);die;
            
            $mdate = $main->d*24 +$main->h ;
            // print($mdate);die;
            
            @$final_car_price = round($price*$mdate);
            
            // print($final_car_price);die;
            
            
            $pick_data = $this->db->get_where('settings', "settings_id=12 OR settings_id=13 OR settings_id=14")->result();
            $pick_start_time = $pick_end_time = $price_increase_percentage = "";
            
            foreach($pick_data as $p){ 
               if($p->settings_id == 12){
                  $pick_start_time = $p->description;
               }
               elseif($p->settings_id == 13){
                  $pick_end_time = $p->description;
               }
               elseif($p->settings_id == 14){
                  $price_increase_percentage = $p->description;
               }
            }
        
            // print($final_car_price);die;
            
            $interval = DateInterval::createFromDateString('1 hour');
            $period = new DatePeriod($start, $interval, $end);
            // echo"<pre>";print_r($period);die;
            $overall_fare = 0;
            
            // print($overall_fare);die;
            
            foreach ($period as $dt) 
            {
                //checking for the weekend day in current loop hour.
                $date_day = $dt->format("l"); 
              
                // print($date_day);die;
              
                if($date_day=="Saturday" || $date_day=="Sunday"){
                  if( $carDetail->weekend_price )
                    $overall_fare = $overall_fare + $carDetail->weekend_price;
                }else{
                    // print($overall_fare);die;
                    // print($carDetail->price);die;
                    $overall_fare = $overall_fare + $carDetail->price;
                    // print($overall_fare);die;
                }
              
                //   print($overall_fare);die;
    
                $dateDiff2 = $dt->format("Y-m-d H:i:s");
                
                $percentToApply = $percentAddon = 0;
              
                if($dateDiff2 >= $pick_start_time && $dateDiff2 <= $pick_end_time){
                  
                    $percentToApply = $price_increase_percentage;
                }
              
                // print($percentToApply);die;
              
                if($percentToApply > 0){
                    $percentAddon = (($overall_fare*$percentToApply)/100);
                }
            }
            
            
            // print($percentAddon);die;
            
            // print($final_car_price);die;
            
            // print($overall_fare);die;
            
            $fpric_abd = $overall_fare + $percentAddon;
            // print($fpric_abd);die;
            @$final_car_price = round($fpric_abd);
            // print(@$final_car_price);die;
            
            
            // ========================================================================================== GST ==============================================================
                $gst_per = $this->db->get_where('settings', array('type'=>'gst'))->row()->description;
                $gst = @round($final_car_price/ 100 * $gst_per);
                $gst = 0;
            // ========================================================================================== GST ==============================================================
            
            
            // ========================================================================================== REFUND ==============================================================        
                $refund = $carDetail->refund_deposit;
                if($refund == 0){
                    $refund = $this->db->get_where('settings', array('type'=>'refund'))->row()->description;
                }
                // print($refund);die;
            // ========================================================================================== REFUND ==============================================================
            
            
            // ========================================================================================== HOME DELIVERY ==============================================================
                $home_delivery = $carDetail->home_delivery_charge;         
                if($home_delivery == 0){  
                    $home_delivery = $this->db->get_where('settings', array('type'=>'home_delivery'))->row()->description;
                }
                // print_r($home_delivery);die;
            // ========================================================================================== HOME DELIVERY ==============================================================
            
            
            // ========================================================================================== TOTAL PAYABLE ==============================================================
                $total_payable = $final_car_price + $gst + $refund;
                // print($total_payable);die;
            // ========================================================================================== TOTAL PAYABLE ==============================================================
            
            
            // echo"<pre>";print_r($bookingData);die;
            $prevPaid = $bookingData->total_payable - $bookingData->remaining;
            
            // print($prevPaid);die;
            
            $start = date("Y-m-d H:i:s", strtotime($this->input->post('start')));
            $end = date("Y-m-d H:i:s", strtotime($this->input->post('end')));
            $availability = date("Y-m-d H:i:s", strtotime($this->input->post('availability')));
            
            
            @$data = array(
                'start' =>  $start,
                'end'   =>  $end,
                'is_modified'   =>  1,
                'availability'  =>  $availability,
                'car_id'    =>  $this->input->post('car'),
                'gst'   =>  $gst,
                'refund'=> $refund,
                'final_car_price'   =>  $final_car_price,
                'total_payable' =>  $total_payable,
                'home_delivery' =>  $bookingData->home_delivery,
                'home_delivery_charges'=>   $carDetail->home_delivery_charges,
                'address'   =>  $bookingData->address,
                'remaining' => $total_payable - $prevPaid,
            );
            
            // echo"<pre>";print_r($data);die;
            
            $this->db->where(['booking_id' => ($bookingId)])->update('booking',$data);        
            
            $this->session->set_flashdata('message', 'Booking updated!');
            
        }else{

            $this->session->set_flashdata('error', 'Please Select Car!');
        }
        return redirect(base_url('Admin/edit_booking?booking_id='.base64_encode($bookingId)));
    }   
    
    public function addDocRemark(){
        $this->data_model->updateDocRemark();
        $this->session->set_flashdata('message','Car updated Successfully!');
        redirect(base_url().'admin/user','refresh');
    }
    
    public function user($param1="", $param2="")
    {
        if($param1 == "action")
        {
            $this->data_model->user_action();
            $this->session->set_flashdata('message','Car updated Successfully!');
            redirect(base_url().'admin/user','refresh');
        }

        $page_data['documents'] = $this->db->order_by('documents_id','desc')->get('documents')->result_array();

        $page_data['page_name']  = 'user';
        $page_data['page_title'] =  ucwords('Manage Documents');
        $this->load->view('admin/index',$page_data);
    } 

    public function get_payment_calculation()
    {
          $start = new DateTime($_POST['start']);
          $end = new DateTime($_POST['end']);

          $main = $start->diff($end); 

          $car = $this->db->get_where('car', array('car_id'=>$_POST['car_id']))->row();

          $booking = $this->db->get_where('booking', array('booking_id'=>$_POST['booking_id']))->row();

          $total_new = ($main->d*24 +$main->h)*$car->price;

          $total = $booking->total_payable + $total_new;

          $remaining = $total - $booking->total_payable - $booking->final_car_price;

          $gst = $remaining / 100 * $this->db->get_where('settings', array('type'=>'gst'))->row()->description;

          $total_remaing = $remaining + $gst;

          $abcd = array('total_new'=>$total_new,'total'=>round($total_remaing),'remaining'=>$remaining,'gst'=>round($gst));

          echo json_encode($abcd);
    }

    public function get_payment_calculation_again()
    {
          $start = new DateTime($_POST['start']);
          $end = new DateTime($_POST['end']);

          $main = $start->diff($end); 

          $car = $this->db->get_where('car', array('car_id'=>$_POST['car_id']))->row();

          $booking = $this->db->order_by('booking_modify_id','desc')->get_where('booking_modify', array('booking_id'=>$_POST['booking_id'],'payment_status'=>0))->row();

          $total_new = ($main->d*24 +$main->h)*$car->price;

          $total = $booking->total_payable + $total_new;

          $remaining = $total - $booking->total_payable - $booking->final_car_price;

          $gst = $remaining / 100 * $this->db->get_where('settings', array('type'=>'gst'))->row()->description;

          $total_remaing = $remaining + $gst;

          $abcd = array('total_new'=>$total_new,'total'=>round($total_remaing),'remaining'=>$remaining,'gst'=>round($gst));

          echo json_encode($abcd);
    }

    public function cancel_request_res($book_id=0, $status=""){
        if($book_id > 0){
            $this->db->where(["booking_id"=>$book_id]);
            $this->db->update("booking_cancell", ["order_status"=>$status]);
            
            if($status == "accept"){
                $this->db->where(["booking_id"=>$book_id]);
                $this->db->update("booking", ["payment_status"=>0]);
            }
        }
        redirect($_SERVER["HTTP_REFERER"]);
    }
    public function cancel_request($param1="", $param2="")
    {
        $data['booking'] = $this->db->order_by('cancell_id','desc')->get_where('booking_cancell', array('status'=>1))->result();   
        
        $data['page_name']  = 'cancel_request';
        $data['page_title'] =  ucwords('Manage Cancel Booking Request');
        $this->load->view('admin/index',$data);
    }
    
    
    
    public function cancel_bookings($param1="", $param2="")
    {
        $data['booking'] = $this->db
            ->select('booking.*,
                cancell_id,
                order_status,
                note,
                response,
                name,
                contact
            ')
            ->join('user', 'user.user_id = booking_cancell.user_id')
            ->join('booking', 'booking.booking_id = booking_cancell.booking_id')
            ->order_by('booking_cancell.cancell_id','desc')
            ->get_where('booking_cancell', array('booking_cancell.status'=>1))
            ->result();   
        
        // echo"<pre>"; print_r($data['booking']);die;
        
        $data['page_name']  = 'cancel_bookings';
        $data['page_title'] =  ucwords('Cancelled booking List');
        $this->load->view('admin/index',$data);
    }
    
    
    public function policy($param1="", $param2="")
    {
        if($param1 == "update")
        {
            extract($_POST);
            $where = ["page"=>$page];
            $data = ["content"=>$content];
            $this->db->where($where)->update("policy", $data);
            redirect($_SERVER["HTTP_REFERER"]);
        }
        $page_data['page_name']  = 'policy';
        $page_data['page_title'] =  ucwords('Manage policies');
        $this->load->view('admin/index',$page_data);
    }
    
    public function meta($param1="", $param2="")
    {
        if($param1 == "update")
        {
            extract($_POST);
            $where = ["pages"=>$page];
            $data = ["title"=>$title, "keyword"=>$keyword, "description"=>$description];
            $this->db->where($where)->update("meta", $data);
            redirect($_SERVER["HTTP_REFERER"]);
        }
        $page_data['page_name']  = 'meta';
        $page_data['page_title'] =  ucwords('Manage Meta');
        $this->load->view('admin/index',$page_data);
    }
    
    
    public function arrival_departure($param1="", $param2="")
    {
        $where = ['booking.status'=>1,'booking.payment_status'=>1];
        
        $type = isset( $_GET["type"] ) ? (int)($_GET["type"]) : 1;
        
        if( isset($_GET["start_date"]) && !empty($_GET["start_date"]) ) {
            extract($_GET);
            
            // print($start_date);die;
            
            $start_date  = $start_date;
            $end_date  = $end_date;
            
        }else{
            
            $start_date = $end_date = date('Y-m-d');
        }
        
        
        // print_r($start_date);die;
        
        
        // print($type);die;
         
        if($type == "1"){
           $where += ["end >="=>$start_date, "end <="=>$end_date];
        }
        elseif($type == "2"){
           $where += ["start >="=>$start_date, "start <="=>$end_date];
        }
        else{
           $where += ["start >="=>$start_date, "end <="=>$end_date]; 
        }
        
        
        
        $data['booking'] = $this->db
            ->join('car', 'car.car_id = booking.car_id', 'right')
            ->join('user', 'user.user_id = booking.user_id', 'right')
            ->select([
                'booking.*',
                'car.name as car_name',
                'car.vehicle_number as vehicle_number',
                'user.name user_name',
                'user.contact user_contact',
                'user.email user_email',
            ])
            ->order_by('booking.booking_id','desc')
            ->get_where('booking', $where)
            ->result();   
        
        
        // print_r($this->db->last_query());die;
        
        // echo"<pre>";print_r($data['booking']);die;
        
        $data['page_name']  = 'arrival_departure';
        
        $data['page_title'] =  ucwords('Manage Arrival Departure Car');
        
        $this->load->view('admin/index',$data);
    }
    

    public function get_admin_change_car_details()
    {
       $car = $this->db->get_where('car', array('car_id'=>$_POST['display_car']))->row();
       
       echo json_encode($car);
    }
    
    
    
    public function modify_list($param1="", $param2="")
    {
        $page_data['car'] = $this->db->get_where('booking_modify', array('status'=>1))->result();
        
        $page_data['page_name']  = 'modify_list';
        $page_data['page_title'] =  ucwords('Manage modify list');
        $this->load->view('admin/index',$page_data);
    }
    

    public function page_list($param1="", $param2="")
    {   
        $data = $this->db
            ->select('*')
            ->where('status', 1)
            ->order_by('id','desc')
            ->get('tbl_pages')
            ->result();
        
        // echo "<pre>"; print_r($data);die;
        
        $page_data['meta_data'] = $data;
        $page_data['page_name']  = 'page_list';
        $page_data['page']  = 'page_list';
        $page_data['page_title'] =  ucwords('Page List');
        $this->load->view('admin/index',$page_data);
    }
    
    public function add_page($param1="", $param2="")
    {
        if($param1 == "add")
        {
            extract($_POST);
            
            $data = [
                'page_title' => $page_title,
                'slug' => strtolower(url_title($page_title)),
                "meta_title"=>$meta_title, 
                "meta_keyword"=>$meta_keyword, 
                'meta_description' => $meta_description,
                'h1_tag' => $h1_tag,
                "content"=>$content,
                "parent"=>$parent,
                "author"=>$author,
                "robots"=>$robots,
                "short_content"=>$short_content,

            ];
            
            
            $this->db->insert("tbl_pages", $data);
            
            // redirect($_SERVER["HTTP_REFERER"]);
        
            redirect(base_url('admin/page_list'));
        }
        
        $meta_pages = $this->db->get('tbl_pages')->result();
        $page_data['meta_pages'] = $meta_pages;
        $page_data['page_name']  = 'page_add';
         $page_data['page']  = 'page_add';
        $page_data['page_title'] =  ucwords('Add Page');
        $this->load->view('admin/index',$page_data);
    }
    public function update_page($param1="", $param2="")
    {
        if($param1 == "update")
        {
            extract($_POST);
            $where = ["id"=>$_GET['page']];
            
             $data = [
                'page_title' => $page_title,
                'slug' => strtolower(url_title($page_title)),
                "meta_title"=>$meta_title, 
                "meta_keyword"=>$meta_keyword, 
                'meta_description' => $meta_description,
                'h1_tag' => $h1_tag,
                "content"=>$content,
                "parent"=>$parent,
                "author"=>$author,
                "robots"=>$robots,
                "short_content"=>$short_content,

            ];
        
            $this->db->where($where)->update("tbl_pages", $data);
            redirect(base_url('admin/page_list'));
        }
        
        $page_data['page_name']  = 'page_edit';
          $page_data['page']  = 'page_edit';
        $page_data['page_title'] =  ucwords('Edit Page');
        $this->load->view('admin/index',$page_data);
    }
    
    public function delete_page()
    {
        $metaId = base64_decode($_GET['meta_id']);
        // print($metaId);
        $this->db->where('id', $metaId)->delete('tbl_pages');
        redirect(base_url('admin/page_list'));
        
    }
    
    
    public function userlist()
    {

        $page_data['users'] = $this->db->order_by('user_id','desc')->get('user')->result_array();

        $page_data['page_name']  = 'user_list';
        $page_data['page_title'] =  ucwords('User List');
        $this->load->view('admin/index',$page_data);
    } 


     public function extendBooking()
    {
            $enddate = $this->input->post('enddate');
            $bookingId = $this->input->post('bookingId');
        if( $enddate != '' &&  $bookingId !=''){
            
            
              $booking = $this->db->get_where('booking', array('booking_id'=>$bookingId))->row();
         
              $start = date("Y-m-d H:i:s", strtotime($booking->start));
              $enddate = date("Y-m-d H:i:s", strtotime($enddate));
           
             $availability = date("Y-m-d H:i:s", strtotime('+2 hours', strtotime($enddate)));
             
            $carDetail = $this->db->get_where('car', array('car_id'=>$booking->car_id))->row();
            
            
            $start = new DateTime($start );
            $end = new DateTime($enddate);
            $interval = DateInterval::createFromDateString('1 hour');
            $period = new DatePeriod($start, $interval, $end);
            $overall_fare = 0;
        
            foreach ($period as $dt) {
                $date_day = $dt->format("l"); 
                if($date_day=="Saturday" || $date_day=="Sunday"){
                    $overall_fare = $overall_fare+$carDetail->weekend_price;
                }else{
                    $overall_fare = $overall_fare+$carDetail->price;
                }
            }
            
             $payvalue = ($booking->total_payable - $booking->remaining );
            
             $total_payable= $overall_fare + $booking->refund;
            
              $remaining= $total_payable-$payvalue;
              
            $data = array(
                'end'   => $enddate,
                'is_modified'   =>  1,
                'availability'  =>  $availability,
                'final_car_price'   =>  $overall_fare,
                'total_payable' => $total_payable,
                'remaining' => $remaining
            );
            
            
            $this->db->where(['booking_id' => ($bookingId)])->update('booking',$data);        
            
            $users = $this->db->get_where('user', array('user_id'=>$booking->user_id))->row();   
            
            if($users->name !=''){
                 $usersname=$users->name;
            }else{
                $usersname='User';
            }
             
             $this->booking_update_whatapps($users->contact,$bookingId,$usersname);
              
            $this->session->set_flashdata('message', 'Booking updated!');
            
        }

     
       return redirect(base_url('Admin/booking_details?booking_id='.base64_encode($bookingId)));
    } 


   
  // public function test_msg($mob)
    public function booking_update_whatapps($mob,$bid=0,$name="user")
      {
         
         $mobile="+91".$mob;
           $ids= base64_encode($bid);
         $link = 'https://veekaycabs.com/booking-conf/'.$ids;
         
          // Initialize cURL
          $ch = curl_init();
          
          // API URL
          $url = "https://backend.api-wa.co/campaign/neodove/api/v2";
          
          // API Key and other details for the request
          $apiKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2YzA0MjlkMmY1MjNiMGI3YzMxOTAzOSIsIm5hbWUiOiJWRUVLQVkgQ1JBTkVTICYgQ0FCUyBQUklWQVRFIExJTUlURUQiLCJhcHBOYW1lIjoiQWlTZW5zeSIsImNsaWVudElkIjoiNjZjMDQyOWMyZjUyM2IwYjdjMzE5MDA5IiwiYWN0aXZlUGxhbiI6Ik5PTkUiLCJpYXQiOjE3MjM4NzU5OTd9.YyKaKUP4S9omtgsdBdHTGcryNeXp818mGR9TKx9yTeU"; // Replace with your actual API key
          $campaignName = "update_booking"; // Replace with your campaign name
          $destination = $mobile; // Replace with the destination phone number
          $userName = isset($name)?$name:'user'; // Replace with the user name
          $source = "Facebook forms"; // Optional, replace with source of the lead
          
          $templateParams = [$name, $link]; // Optional, replace with template parameters
          
          // Create the data array
          $data = [
              "apiKey" => $apiKey,
              "campaignName" => $campaignName,
              "destination" => $destination,
              "userName" => $userName,
              "source" => $source,
              "templateParams" => $templateParams
            
          ];
          
          // Encode the data to JSON format
          $jsonData = json_encode($data);
          
          // Set cURL options
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_POST, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, [
              "Content-Type: application/json",
              "Content-Length: " . strlen($jsonData)
          ]);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
          
          // Execute the request
          $response = curl_exec($ch);
          
          // Check for cURL errors
          if (curl_errno($ch)) {
             echo 'Error:' . curl_error($ch);
          } else {
              // Process the response
          //   echo 'Response: ' . $response;
          }
          
          // Close cURL resource
          curl_close($ch);
           return true;
        } 
             


      // public function test_msg($mob)
    public function booking_success_whatapps($mob,$bid=0,$name="user")
      {
         
         $mobile="+91".$mob;
           $ids= base64_encode($bid);
         $link = 'https://veekaycabs.com/booking-conf/'.$ids;
         
          // Initialize cURL
          $ch = curl_init();
          
          // API URL
          $url = "https://backend.api-wa.co/campaign/neodove/api/v2";
          
          // API Key and other details for the request
          $apiKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2YzA0MjlkMmY1MjNiMGI3YzMxOTAzOSIsIm5hbWUiOiJWRUVLQVkgQ1JBTkVTICYgQ0FCUyBQUklWQVRFIExJTUlURUQiLCJhcHBOYW1lIjoiQWlTZW5zeSIsImNsaWVudElkIjoiNjZjMDQyOWMyZjUyM2IwYjdjMzE5MDA5IiwiYWN0aXZlUGxhbiI6Ik5PTkUiLCJpYXQiOjE3MjM4NzU5OTd9.YyKaKUP4S9omtgsdBdHTGcryNeXp818mGR9TKx9yTeU"; // Replace with your actual API key
          $campaignName = "booking_details"; // Replace with your campaign name
          $destination = $mobile; // Replace with the destination phone number
          $userName = $name; // Replace with the user name
          $source = "Facebook forms"; // Optional, replace with source of the lead
          
          $templateParams = [$name, $link]; // Optional, replace with template parameters
          
          // Create the data array
          $data = [
              "apiKey" => $apiKey,
              "campaignName" => $campaignName,
              "destination" => $destination,
              "userName" => $userName,
              "source" => $source,
              "templateParams" => $templateParams
            
          ];
          
          // Encode the data to JSON format
          $jsonData = json_encode($data);
          
          // Set cURL options
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_POST, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, [
              "Content-Type: application/json",
              "Content-Length: " . strlen($jsonData)
          ]);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
          
          // Execute the request
          $response = curl_exec($ch);
          
          // Check for cURL errors
          if (curl_errno($ch)) {
             echo 'Error:' . curl_error($ch);
          } else {
              // Process the response
          //   echo 'Response: ' . $response;
          }
          
          // Close cURL resource
          curl_close($ch);
           return true;
        } 
             
             
       public function booking_success_link($id=0)
      {
            if($id!=''){
                 $bid= base64_decode($id);
              //  $bid= $id;
                $data["book"] = $book = $this->db->get_where("booking", ["booking_id"=>$bid])->row();
                
                $user_id = $data["book"]->user_id; 
                $car_id = $data["book"]->car_id;
                $data["user"] = $this->db->get_where("user", ["user_id"=>$user_id])->row();
                $data["car"] = $this->db->get_where("car", ["car_id"=>$car_id])->row();
                
                $this->load->view('web/confom_pdf', $data);
               
            }
      }
       


      public function data_list(){
	
		if ($this->input->is_ajax_request()) {
			$data = [];
			$post = $this->input->post();
			  $city_id=$post['city'];
			  $start=$post['start'];
			  $end=$post['end'];

              $where = "status =1 and show_hide=1";
              if(isset($city_id) && $city_id != ''){
                  $city = $city_id;
                  $where .= " AND city='$city' ";
              }
    
                    $carquery = $this->db->select('*')->order_by('hide_to DESC, sold_to asc ' )->get_where('car', $where)->result();
                    
                 
                    $s = date('Y-m-d H:i:s',strtotime($start));
                    $e = date('Y-m-d H:i:s',strtotime($end));
                    $carLists = [];    
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
                                $carLists[]=$cdata;
                            }
                    }
                   // echo '<pre>';  print_r($carLists); die;
			  if(!empty($carLists)){
            	$html='';
				foreach( $carLists as  $carList){
					$html.="<option value='".$carList->car_id."'>".$carList->name. ' / '. $carList->vehicle_number."</option>";
				}
			    $res = ['status' => true, 'data' => $html];
			  }else{
				$html='<option value="">No any car </option>';

				$res = ['status' => false, 'data' => $html];
			  }
			echo json_encode($res);
		}
	}

    public function carreceived()
     {
         if($_GET['booking_id'] !=''){
             
            $data['car_received']=1;
            $this->db->where(['booking_id' => $_GET['booking_id']])->update('booking',$data);        
            $this->session->set_flashdata('message', 'Booking updated!');
         }
        redirect(base_url('admin/booking_list'));
    }
    
               
  public function booking_success_whatapps_for_admin($mob)
    {
       
       $name ="admin";
       
       
       $mobile="91".$mob;
       
        // Initialize cURL
        $ch = curl_init();
        
        // API URL
        $url = "https://backend.api-wa.co/campaign/neodove/api/v2";
        
        // API Key and other details for the request
        $apiKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2YzA0MjlkMmY1MjNiMGI3YzMxOTAzOSIsIm5hbWUiOiJWRUVLQVkgQ1JBTkVTICYgQ0FCUyBQUklWQVRFIExJTUlURUQiLCJhcHBOYW1lIjoiQWlTZW5zeSIsImNsaWVudElkIjoiNjZjMDQyOWMyZjUyM2IwYjdjMzE5MDA5IiwiYWN0aXZlUGxhbiI6Ik5PTkUiLCJpYXQiOjE3MjM4NzU5OTd9.YyKaKUP4S9omtgsdBdHTGcryNeXp818mGR9TKx9yTeU"; // Replace with your actual API key
        $campaignName = "admin_info"; // Replace with your campaign name
        $destination = $mobile; // Replace with the destination phone number
        $userName = $name; // Replace with the user name
        $source = "Facebook forms"; // Optional, replace with source of the lead
        
     
        
        // Create the data array
        $data = [
            "apiKey" => $apiKey,
            "campaignName" => $campaignName,
            "destination" => $destination,
            "userName" => $userName,
            "source" => $source,
          
          
        ];
        
        // Encode the data to JSON format
        $jsonData = json_encode($data);
        
        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Content-Length: " . strlen($jsonData)
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        
        // Execute the request
        $response = curl_exec($ch);
        
        // Check for cURL errors
        if (curl_errno($ch)) {
          //  echo 'Error:' . curl_error($ch);
        } else {
            // Process the response
          //  echo 'Response: ' . $response;
        }
        
        // Close cURL resource
        curl_close($ch);
      
      
        return true;
    } 
    
    
public function booking_edit($param1="", $param2="")
    {
        if($param1 == "edit")
        {
            extract($_POST);
             $user=  $this->db->get_where('user', array('contact'=>$contact))->row();
           if(!empty($user)){
               $userId =  $user->user_id;
               $contact =  $user->contact;
               $name = $name;
               
                $where = ["user_id"=>$userId];
                
                $data2 = [
                    'name' => $name,
                ];
                if($email!=''){
                   $data2["email"]=$email;
                }
                if($address!=''){
                   $data2["address"]=$address;
                }
                $this->db->where($where)->update("user", $data2);
               
            }else{
                $data = [
                    'name' => $name,
                    "email"=>$email, 
                    "address"=>$address, 
                    'contact' => $contact,
                ];
                $this->db->insert("user", $data);
                $userId = $this->db->insert_id();
            }

            $short_city = $this->db->get_where("city", ["city_id"=>$city])->row()->short_name;
            $car_name = $this->db->get_where("car", ["car_id"=>$car_id])->row()->name;   
            $car_name = str_replace(" ", "", $car_name);
            $username = str_replace(" ", "", $name); 
            $rand = rand(1234,9999);
            $details_order_id = $short_city."_".$car_name."_".$username."_".$rand;
                
            $availability = date("Y-m-d H:i:s", strtotime('+2 hours', strtotime($end)));
            $remaining = ($total_payable)-($receved_amount);
    
            $data1 = [
                'car_id' => $car_id,
                'user_id' => $userId,
                'details_order_id' => $details_order_id,
                'availability' => $availability,
                "city"=>$city, 
                "start"=>$start, 
                'end' => $end,
                'final_car_price' => $final_car_price,
                "refund"=>$refund,
                "total_payable"=>$total_payable,
                "GST"=>0,
                "remaining"=>$remaining,
                'remark'=>$remark,
                "home_delivery_charges"=>$home_delivery_charges,
                "home_delivery"=>$home_delivery_charges!=0?1:0,
                // 'booking_via'=>3,
                 'admin_name'=>$admin_name,
                
                "payment_status"=>1,

            ];
    
            // redirect($_SERVER["HTTP_REFERER"]);
            // $this->booking_success_whatapps($contact,$bookigId,$name);
            
            // $this->booking_success_whatapps_for_admin('9311826201');
            // $this->booking_success_whatapps_for_admin('9999926867');
            // $this->booking_success_whatapps_for_admin('8448586825');
            // $this->booking_success_whatapps_for_admin('9773796805');
            
             //  $this->booking_success_whatapps_for_admin('9336630515');
            //  echo $_GET['booking_id'];
            //  print_r($data1); die;
            $this->db->where(['booking_id' => $_GET['booking_id']])->update('booking',$data1);        
            
            $this->session->set_flashdata('message', 'Booking updated!');
            redirect(base_url('admin/booking_list'));
        }
        
        $where = "status =1 and show_hide=1";
        $carquery = $this->db->select('*')->order_by('hide_to DESC, sold_to asc ' )->get_where('car', $where)->result();
        $page_data['booking'] = $this->db->get_where('booking', array('booking_id'=>base64_decode($_GET['booking_id'])))->row();
        $page_data['user'] = $this->db->get_where('user', array('user_id'=> $page_data['booking']->user_id))->row();
         
        $page_data['city'] =$this->db->order_by('name','asc')->get_where('city', array('status'=>1))->result();
        $page_data['car_list'] = $carquery;
        $page_data['page_name']  = 'booking_edit';
         $page_data['page']  = 'booking_edit';
        $page_data['page_title'] =  ucwords('Edit Booking');
       //   echo '<pre>';   print_r($page_data);
        $this->load->view('admin/index',$page_data);
    }

    
    
}

