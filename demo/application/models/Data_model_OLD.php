<?php


class Data_model extends CI_Model
{

    function __construct()
     {
        parent::__construct();
    }

	public function mdlchangeHeaderColor()
	{
		$data['description'] = $this->input->post("chnageHeader");
        $query = $this->db->where('type','header-background');
        $query = $this->db->update('settings',$data);
        return $query;
	}

	public function mdlchangeMenuColortheme()
	{
		$data['description'] = $this->input->post("chnagemenu");
        $this->db->where('type','menubar-background');
        $this->db->update('settings',$data);
	}

	public function updateSystemSetting()
	{

		$data['description'] = $this->input->post("system_title");
        $this->db->where('type','system_title');
        $this->db->update('settings',$data);

		$data['description'] = $this->input->post("email");
        $this->db->where('type','email');
        $this->db->update('settings',$data);

		$data['description'] = $this->input->post("phone");
        $this->db->where('type','phone');
        $this->db->update('settings',$data);

		$data['description'] = $this->input->post("address");
        $this->db->where('type','address');
        $this->db->update('settings',$data);

        $data['description'] = $this->input->post("home_delivery");
        $this->db->where('type','home_delivery');
        $this->db->update('settings',$data);

        $data['description'] = $this->input->post("gst");
        $this->db->where('type','gst');
        $this->db->update('settings',$data);

		$data['description'] = date("Y");
        $this->db->where('type','session');
        $this->db->update('settings',$data);

		$data['description'] = $this->input->post("refund");
        $this->db->where('type','refund');
        $this->db->update('settings',$data);

        $data['description'] = $this->input->post("pick_start_time");
        $this->db->where('type','pick_start_time');
        $this->db->update('settings',$data);

        $data['description'] = $this->input->post("pick_end_time");
        $this->db->where('type','pick_end_time');
        $this->db->update('settings',$data);

        $data['description'] = $this->input->post("price_increase_percentage");
        $this->db->where('type','price_increase_percentage');
        $this->db->update('settings',$data);

	}


    public function update_user_profile()
    {
        $data['name']       =   $this->input->post('name');
        $data['email']      =   $this->input->post('email');

        if($_FILES['userimage']['name'] != "")
        {
            $data['image']    = $_FILES['userimage']['name'];
            $file_size    = $_FILES['userimage']['size'];
            $file_tmp     = $_FILES['userimage']['tmp_name'];
            $file_type    = $_FILES['userimage']['type'];
            $path         =  "uploads/admin/";
          
            $temp = explode(".", $_FILES["userimage"]["name"]);
            $newfilename = $this->session->userdata('admin_id') . '.' . end($temp);
            
            move_uploaded_file($file_tmp, $path.$newfilename);

            $data['image'] =  $path.$newfilename;
        }

        $this->db->where('id', $this->session->userdata('admin_id'));
        $this->db->update('admin', $data);
    }

    function changepassword()
    {   
        $current_old_password   = $this->input->post('current_old_password');
        $old_password           = md5($this->input->post('old_password'));
        $new_password           = md5($this->input->post('new_password'));
        $confirm_new_password   = md5($this->input->post('confirm_new_password'));

        if($current_old_password == $old_password)
        {

            if($old_password != $new_password && $old_password != $confirm_new_password)
            {
                if($new_password == $confirm_new_password)
                {
                    $data['password'] = $confirm_new_password;

                    $this->db->where('id', $this->session->userdata('admin_id'));
                    $this->db->update('admin', $data);

                    $this->session->set_flashdata('flash_message', ucwords('your password will be changed'));
                }
                else
                {
                   $this->session->set_flashdata('error_message', ucwords('new and confirm password should be same'));
                }
            }
            else
            {
                 $this->session->set_flashdata('error_message', ucwords('old and new password should be Change'));
            }
        }
        else
        {
            $this->session->set_flashdata('error_message', ucwords('old password are wrong'));
        }
    }



    public function update_about_us()
    {
        $data['about_us'] = $this->input->post('about_us');

        $this->db->where('aid',1);
        $this->db->update('about_us', $data); 
    }


    public function update_privacy()
    {
        $data['privacy'] = $this->input->post('privacy');
        $data['heading'] = $this->input->post('heading');

        $this->db->where('pid',1);
        $this->db->update('privacy', $data);
    }


    public function update_refund_policy()
    {
        $data['heading'] = $this->input->post('heading');
        $data['refund_policy'] = $this->input->post('refund_policy');

        $this->db->where('rid',1);
        $this->db->update('refund_policy', $data);
    }


    public function update_terms()
    {
        $data['terms'] = $this->input->post('terms');

        $this->db->where('tid',1);
        $this->db->update('terms', $data);
    }


    public function facebook_link()
    {
        $data['link'] = $this->input->post('link');

        $this->db->where('id',1)->update('social_links', $data);
    }

    public function instagram_link()
    {
        $data['link'] = $this->input->post('link');

        $this->db->where('id',2)->update('social_links', $data);
    }

    public function linkedin_link()
    {
        $data['link'] = $this->input->post('link');

        $this->db->where('id',3)->update('social_links', $data);
    }

    public function youtube_link()
    {
        $data['link'] = $this->input->post('link');

        $this->db->where('id',4)->update('social_links', $data);
    }

    public function twitter_link()
    {
        $data['link'] = $this->input->post('link');

        $this->db->where('id',5)->update('social_links', $data);
    }


    public function delete_contact_request($param2)
    {
        $this->db->where('contact_id', $param2);
        $this->db->delete('contact'); 
    }


    public function gallery_image()
    {
        if($_FILES['gallery']['name'] != "")
        {
            $data['images']    = $_FILES['gallery']['name'];
            $file_size    = $_FILES['gallery']['size'];
            $file_tmp     = $_FILES['gallery']['tmp_name'];
            $file_type    = $_FILES['gallery']['type'];
            $path         =  "uploads/gallery/";
          
            $temp = explode(".", $_FILES["gallery"]["name"]);

            $newfilename = round(microtime(true)) . '.' . end($temp);
            
            move_uploaded_file($file_tmp, $path.$newfilename);

            $data['images'] =  $path.$newfilename;
        }

        $this->db->insert('results', $data);
    }
    
    public function slider_image()
    {
        if($_FILES['slider_image']['name'] != "")
        {
            $data['images']    = $_FILES['slider_image']['name'];
            $file_size    = $_FILES['slider_image']['size'];
            $file_tmp     = $_FILES['slider_image']['tmp_name'];
            $file_type    = $_FILES['slider_image']['type'];
            $path         =  "uploads/slider/";
          
            $temp = explode(".", $_FILES["slider_image"]["name"]);

            $newfilename = round(microtime(true)) . '.' . end($temp);
            
            move_uploaded_file($file_tmp, $path.$newfilename);

            $data['images'] =  $path.$newfilename;
        }

        $this->db->insert('slider', $data);
    }
    
    public function testimonial_image()
    {
        if($_FILES['bg_image']['name'] != "")
        {
            $data['images']    = $_FILES['bg_image']['name'];
            $file_size    = $_FILES['bg_image']['size'];
            $file_tmp     = $_FILES['bg_image']['tmp_name'];
            $file_type    = $_FILES['bg_image']['type'];
            $path         =  "uploads/testimonial_bg/";
          
            $temp = explode(".", $_FILES["bg_image"]["name"]);

            $newfilename = round(microtime(true)) . '.' . end($temp);
            
            move_uploaded_file($file_tmp, $path.$newfilename);

            $data['images'] =  $path.$newfilename;
        }

        $this->db->insert('testimonial_bg', $data);
    }
    
    public function offer_image()
    {
        $desktop_banner = $this->input->post('desktop_banner_text');
        $mobile_banner = $this->input->post('mobile_banner_text');
        
        //$desktop_banner = $mobile_banner = "";
        $path         =  "assets/offer/";
        
        if($_FILES['desktop_banner']['size'] > 0)
        {
            $desktop_banner    = $_FILES['desktop_banner']['name'];
            $file_size    = $_FILES['desktop_banner']['size'];
            $file_tmp     = $_FILES['desktop_banner']['tmp_name'];
            $file_type    = $_FILES['desktop_banner']['type'];
          
            $temp = explode(".", $_FILES["desktop_banner"]["name"]);

            $newfilename = rand().round(microtime(true)) . '.' . end($temp);
            
            move_uploaded_file($file_tmp, $path.$newfilename);

            $desktop_banner =  $path.$newfilename;
        }
       
        if($_FILES['mobile_banner']['size'] > 0)
        {
            $mobile_banner    = $_FILES['mobile_banner']['name'];
            $file_size2    = $_FILES['mobile_banner']['size'];
            $file_tmp2     = $_FILES['mobile_banner']['tmp_name'];
            $file_type2    = $_FILES['mobile_banner']['type'];
          
            $temp2 = explode(".", $_FILES["mobile_banner"]["name"]);

            $newfilename2 = rand().round(microtime(true)) . '.' . end($temp2);
            
            move_uploaded_file($file_tmp2, $path.$newfilename2);

            $mobile_banner =  $path.$newfilename2;
        }

        $array = ["desktop_banner"=>$desktop_banner, "mobile_banner"=>$mobile_banner];
        $this->db->insert('offer_banner', $array);
    }

public function delete_slider_image($param2, $image_path)
    {
        @unlink($image_path);

        $this->db->where('id', $param2);
        $this->db->delete('slider');
    }
    public function delete_gallery_image($param2, $image_path)
    {
        @unlink($image_path);

        $this->db->where('result_id', $param2);
        $this->db->delete('results');
    }


    public function add_city()
    {
        $data['name'] = $this->input->post('name'); 
        $data['address'] = $this->input->post('address'); 
        $data['short_name'] = $this->input->post('short_name'); 

        if($_FILES['image']['name'] != "")
        {
            $data['image']    = $_FILES['image']['name'];
            $file_size    = $_FILES['image']['size'];
            $file_tmp     = $_FILES['image']['tmp_name'];
            $file_type    = $_FILES['image']['type'];
            $path         =  "uploads/city/";
          
            $temp = explode(".", $_FILES["image"]["name"]);

            $newfilename = round(microtime(true)) . '.' . end($temp);
            
            move_uploaded_file($file_tmp, $path.$newfilename);

            $data['image'] =  $path.$newfilename;
        }
        
        $this->db->insert('city', $data);
    }


    public function update_city($param2)
    {
        $data['name'] = $this->input->post('name');
        $data['address'] = $this->input->post('address'); 
        $data['short_name'] = $this->input->post('short_name');

        if($_FILES['image']['name'] != "")
        {
            $data['image']    = $_FILES['image']['name'];
            $file_size    = $_FILES['image']['size'];
            $file_tmp     = $_FILES['image']['tmp_name'];
            $file_type    = $_FILES['image']['type'];
            $path         =  "uploads/city/";
          
            $temp = explode(".", $_FILES["image"]["name"]);

            $newfilename = round(microtime(true)) . '.' . end($temp);
            
            move_uploaded_file($file_tmp, $path.$newfilename);

            $data['image'] =  $path.$newfilename;
        } 
        
        $this->db->where('city_id',$param2)->update('city', $data);
    }


    public function delete_city(){
        $city_id = base64_decode($_GET['city_id']);
        $data = array('status'=>0);
        $this->db->where('city_id', $city_id)->update('city', $data);
    }


    public function insert_comments()
    {
        $data['message'] = $this->input->post('message');
        $data['name'] = $this->input->post('name');

        $this->db->insert('comments', $data);
    }
    public function delete_comments($param2)
    {
        $this->db->where('comments_id', $param2);
        $this->db->delete('comments'); 
    }
    
    public function insert_coupons()
    {
        $data['name'] = $this->input->post('name');
        $data['percent'] = $this->input->post('percent');
        $data['expiry'] = $this->input->post('expiry');
        $data['terms'] = $this->input->post('terms');
        $data['min_days'] = $this->input->post('min_days');
        $data['secret'] = $this->input->post('secret');

        if($_FILES['image']['name'] != "")
        {
            $data['image']    = $_FILES['image']['name'];
            $file_size    = $_FILES['image']['size'];
            $file_tmp     = $_FILES['image']['tmp_name'];
            $file_type    = $_FILES['image']['type'];
            $path         =  "uploads/gallery/";
          
            $temp = explode(".", $_FILES["image"]["name"]);
            $newfilename = uniqid(). '.' . end($temp);
            
            move_uploaded_file($file_tmp, $path.$newfilename);

            $data['image'] =  $path.$newfilename;
        }
        
        $this->db->insert('coupon', $data);
    }
    public function update_coupons()
    {
        $id = $this->input->post('id');
        $data['name'] = $this->input->post('name');
        $data['percent'] = $this->input->post('percent');
        $data['expiry'] = $this->input->post('expiry');
        $data['terms'] = $this->input->post('terms');
        $data['min_days'] = $this->input->post('min_days');
        $data['secret'] = $this->input->post('secret');

        if($_FILES['image']['name'] != "")
        {
            $data['image']    = $_FILES['image']['name'];
            $file_size    = $_FILES['image']['size'];
            $file_tmp     = $_FILES['image']['tmp_name'];
            $file_type    = $_FILES['image']['type'];
            $path         =  "uploads/gallery/";
          
            $temp = explode(".", $_FILES["image"]["name"]);
            $newfilename = uniqid(). '.' . end($temp);
            
            move_uploaded_file($file_tmp, $path.$newfilename);

            $data['image'] =  $path.$newfilename;
        }
        
        $where = ["id"=>$id];
        
        $this->db->where($where)->update('coupon', $data);
    }
    public function delete_coupons($param2)
    {
        $this->db->where('id', $param2);
        $this->db->delete('coupon'); 
    }

    public function insert_blog()
    {
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['meta_title'] = $this->input->post('meta_title');
        $data['meta_key'] = $this->input->post('meta_key');
        $data['meta_description'] = $this->input->post('meta_des');

        if($_FILES['image']['name'] != "")
        {
            $data['image']    = $_FILES['image']['name'];
            $file_size    = $_FILES['image']['size'];
            $file_tmp     = $_FILES['image']['tmp_name'];
            $file_type    = $_FILES['image']['type'];
            $path         =  "uploads/gallery/";
          
            $temp = explode(".", $_FILES["image"]["name"]);
            $newfilename = uniqid(). '.' . end($temp);
            
            move_uploaded_file($file_tmp, $path.$newfilename);

            $data['image'] =  $path.$newfilename;
        }
        
        $this->db->insert('blog', $data);
    }
    public function update_blog()
    {
        $id = $this->input->post('id');
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['meta_title'] = $this->input->post('meta_title');
        $data['meta_key'] = $this->input->post('meta_key');
        $data['meta_description'] = $this->input->post('meta_des');

        if($_FILES['image']['name'] != "")
        {
            $data['image']    = $_FILES['image']['name'];
            $file_size    = $_FILES['image']['size'];
            $file_tmp     = $_FILES['image']['tmp_name'];
            $file_type    = $_FILES['image']['type'];
            $path         =  "uploads/gallery/";
          
            $temp = explode(".", $_FILES["image"]["name"]);
            $newfilename = uniqid(). '.' . end($temp);
            
            move_uploaded_file($file_tmp, $path.$newfilename);

            $data['image'] =  $path.$newfilename;
        }
        
        $where = ["id"=>$id];
        
        $this->db->where($where)->update('blog', $data);
    }
    public function delete_blog($param2)
    {
        $this->db->where('id', $param2);
        $this->db->delete('blog'); 
    }


    public function updateDocRemark(){
        $data['status_remark']      =  $this->input->post('remark');
        $data['doc_status']         =  'Reject';
        $documents_id               =  $this->input->post('documents_id');
        $this->db->where('documents_id',$documents_id)->update('documents',$data);
    }

    public function add_car()
    {
        $data['name']           =   $this->input->post('name');
        $data['vehicle_number']           =   $this->input->post('vehicle_number');
        $data['fuel']           =   $this->input->post('fuel');
        $data['seats']          =   $this->input->post('seats');
        $data['car_type']       =   $this->input->post('car_type');
        $data['transmission']   =   $this->input->post('transmission');
        $data['price']          =   $this->input->post('price');
        $data['weekend_price']  =   $this->input->post('weekend_price');
        $data['description']    =   $this->input->post('description');
        $data['show_top']       =   $this->input->post('show_top');
        $data['city']           =   $this->input->post('city');
        $data['place']          =   $this->input->post('place');
        $data['home_delivery']  =   $this->input->post('home_delivery');
        $data['hide_from']  =   $this->input->post('hide_from');
        $data['hide_to']  =   $this->input->post('hide_to');
        $data['hide_reason']  =   $this->input->post('hide_reason');
        
        $data['sold_from']  =   $this->input->post('sold_from');
        $data['sold_to']  =   $this->input->post('sold_to');
        $data['sold_remark']  =   $this->input->post('sold_remark');
        
        $data['refund_deposit']  =   $this->input->post('refund_deposit');
        $data['home_delivery_charge']  =   $this->input->post('home_delivery_charge');

        if($_FILES['image']['name'] != "")
        {
            $data['image']    = $_FILES['image']['name'];
            $file_size    = $_FILES['image']['size'];
            $file_tmp     = $_FILES['image']['tmp_name'];
            $file_type    = $_FILES['image']['type'];
            $path         =  "uploads/car/";
          
            $temp = explode(".", $_FILES["image"]["name"]);
            $newfilename = uniqid(). '.' . end($temp);
            
            move_uploaded_file($file_tmp, $path.$newfilename);

            $data['image'] =  $path.$newfilename;
        }

        $this->db->insert('car', $data);
    }

      public function update_car($param2)
    {
         
          
        $data['name']           =   $this->input->post('name');
          $data['vehicle_number']           =   $this->input->post('vehicle_number');
        $data['fuel']           =   $this->input->post('fuel');
        $data['seats']          =   $this->input->post('seats');
        $data['car_type']       =   $this->input->post('car_type');
        $data['transmission']   =   $this->input->post('transmission');
        $data['price']          =   $this->input->post('price');
        $data['weekend_price']  =   $this->input->post('weekend_price');
        $data['description']    =   $this->input->post('description');
        $data['show_top']       =   $this->input->post('show_top');
        $data['city']           =   $this->input->post('city');
        $data['place']          =   $this->input->post('place');
        $data['home_delivery']  =   $this->input->post('home_delivery');
        $data['hide_from']  =   $this->input->post('hide_from');
        $data['hide_to']  =   $this->input->post('hide_to');
        $data['hide_reason']  =   $this->input->post('hide_reason');
          
        $data['sold_from']  =   $this->input->post('sold_from');
        $data['sold_to']  =   $this->input->post('sold_to');
        $data['sold_remark']  =   $this->input->post('sold_remark');
          
          
        $data['refund_deposit']  =   $this->input->post('refund_deposit');
        $data['home_delivery_charge']  =   $this->input->post('home_delivery_charge');

        if($_FILES['image']['name'] != "")
        {
            $data['image']    = $_FILES['image']['name'];
            $file_size    = $_FILES['image']['size'];
            $file_tmp     = $_FILES['image']['tmp_name'];
            $file_type    = $_FILES['image']['type'];
            $path         =  "uploads/car/";
          
            $temp = explode(".", $_FILES["image"]["name"]);
            $newfilename = uniqid(). '.' . end($temp);
            
            move_uploaded_file($file_tmp, $path.$newfilename);

            $data['image'] =  $path.$newfilename;
        }

        $this->db->where('car_id',$param2)->update('car', $data);
    }

    public function delete_car(){

        $car_id = base64_decode($_GET['car_id']);

        $data['status'] = 0;

        $this->db->where('car_id',$car_id)->update('car',$data);
    }

    public function show_hide_car(){

        $car_id = base64_decode($_GET['car_id']);

        $data['show_hide'] = $_GET['show_hide'];

        $this->db->where('car_id',$car_id)->update('car',$data);
    }

    public function delete_booking(){

        $booking_id = base64_decode($_GET['booking_id']);

        $data['status'] = 0;

        $this->db->where('booking_id',$booking_id)->update('booking',$data);
    }


    public function update_booking($param2)
    {
        $details_order_id = $this->input->post('details_order_id');
        $user_id = $this->input->post('user_id');
        
        $total_amounts = $this->input->post('total');

        $resp = $this->db->order_by('booking_id','desc')->get_where('booking_modify', array('details_order_id'=>$details_order_id,'payment_status'=>0));

        if($resp->num_rows() > 0){

            $result = $resp->row();

            $data['final_car_price'] = $this->input->post('final_car_price');
            
            $data['car_id'] = $this->input->post('car_id');
            $data['start'] = $this->input->post('start'); 
            $data['end'] = $this->input->post('end');
            $data['remaining'] = $this->input->post('remaining');
            $data['gst'] = $this->input->post('new_gst');
            $data['total'] = $total_amounts;

            $this->db->where(array('booking_id'=>$param2,'payment_status'=>0))->update('booking_modify', $data);

        }else{

            $data['car_id'] = $this->input->post('car_id');
            $data['start'] = $this->input->post('start'); 
            $data['end'] = $this->input->post('end');
            $data['remaining'] = $this->input->post('remaining');
            $data['gst'] = $this->input->post('new_gst');
            $data['total'] = $total_amounts;
            $data['booking_id'] = $this->input->post('booking_id');
            $data['details_order_id'] = $this->input->post('details_order_id');
            $data['final_car_price'] = $this->input->post('final_car_price');
            
            $this->db->insert('booking_modify', $data);
        }

        $bk = $this->db->get_where('booking', array('booking_id'=>$this->input->post('booking_id')))->row();

        $resp = $this->db->order_by('booking_modify_id','desc')->get_where('booking_modify', array('booking_id'=>$param2));

        $pay = $bk->total_payable;

        if($resp->num_rows() > 0){

            if($resp->row()->payment_status == 1){
                
                $data2['total_payable'] = $total_amounts;
            
            } else if($resp->row()->payment_status == 0){

                $data2['total_payable'] = $total_amounts + $bk->final_car_price + $bk->gst + $bk->refund ;

            }  
        } else{

            $data2['total_payable'] = $total_amounts + $pay;
        }

        $data2['remaining'] = $this->input->post('total');

        $this->db->where('booking_id',$param2)->update('booking', $data2);
    }


    public function user_action(){
        $documents_id   = $_GET['documents_id'];
        $data['doc_status']     = $_GET['doc_status'];

        $this->db->where('documents_id',$documents_id)->update('documents', $data);
    }

    public function car_booking()
    {
        extract($_GET);

        $booking = $this->db->get_where('booking', array('booking_id'=>base64_decode($booking_id)))->row();  

        $amount = $booking->remaining;

        $user = $this->db->get_where('user', array('user_id'=>$booking->user_id))->row();

        $this->session->set_userdata('final_amount',$amount);
        $this->session->set_userdata('unique_order_id',$booking->booking_id);
        $this->session->set_userdata('name',$user->name);
        $this->session->set_userdata('email',$user->email);
        $this->session->set_userdata('contact',$user->contact);
    }


    public function delete_offer_image(){

        $img = $this->db->get_where('offer_banner', array('id'=>$_GET['banner_id']))->row();

        @unlink($img->mobile_banner);
        @unlink($img->desktop_banner);

        $this->db->where('id', $_GET['banner_id']);
        $this->db->delete('offer_banner');

    }
}
