<?php


class Admin extends CI_Controller 
{

    function __construct() {
        parent::__construct();

		$this->load->database();
		$this->load->library('session');
        $this->load->model('data_model');
        
        if(($this->session->userdata('admin_login')) != 1) redirect(base_url().'Admin_login', 'refresh');
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
        $page_data['page_title'] =  ucwords('Admin dahboard');

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
            $array = ["name"=>$name, "review"=>$review];
            $this->db->insert("testimonial", $array);
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
        $data['page_name']  = 'edit_car';
        $data['page_title'] =  ucwords('Manage car');
        $this->load->view('admin/index',$data);
    }

    public function booking_list($param1="", $param2="")
    {
        $where = ['status'=>1,'payment_status'=>1];
        
        if(isset($_GET["start_date"])){
            extract($_GET);
            
            if($type == "Arrivals"){
               $where += ["end >="=>$start_date, "end <="=>$end_date];
            }
            elseif($type == "Departures"){
               $where += ["start >="=>$start_date, "start <="=>$end_date];
            }
            else{
               $where += ["start >="=>$start_date, "end <="=>$end_date]; 
            }
        }
        
        $data['booking'] = $this->db->order_by('booking_id','desc')->get_where('booking', $where)->result();   
        
        $booking_count = $this->db->get_where("booking", ['status'=>1,'payment_status'=>1])->num_rows();
        $this->session->set_userdata("booking_count", $booking_count);
        
        $data['page_name']  = 'booking_list';
        $data['page_title'] =  ucwords('Manage booking');
        $this->load->view('admin/index',$data);
    }

    public function booking_details($param1="", $param2="")
    {
        $data['booking'] = $this->db->get_where('booking', array('booking_id'=>base64_decode($_GET['booking_id'])))->result();   
        
        $data['page_name']  = 'booking_details';
        $data['page_title'] =  ucwords('Manage booking');
        $this->load->view('admin/index',$data);
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
            $this->session->set_flashdata('message','Car updated Successfully!');
            redirect('admin/booking_list','refresh');
        }

        if($param1 == "delete")
        {
            $this->data_model->delete_booking();
            $this->session->set_flashdata('delete','Car Deleted Successfully!');
            redirect('admin/booking_list','refresh');
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



    public function edit_booking($param1="", $param2="")
    {
        $data['booking'] = $this->db->get_where('booking', array('booking_id'=>base64_decode($_GET['booking_id'])))->result();

        $data['car'] = $this->db->order_by('car_id','desc')->get_where('car', array('status'=>1))->result(); 
        
        $data['city'] = $this->db->order_by('name','asc')->get_where('city', array('status'=>1))->result(); 

        $data['page_name']  = 'edit_booking';
        $data['page_title'] =  ucwords('Manage booking');
        $this->load->view('admin/index',$data);
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
        $data['page_title'] =  ucwords('Manage booking');
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
    

}
