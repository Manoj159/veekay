<?php

class User_model extends CI_Model
{

    function __construct()
     {
        parent::__construct();
    }

    public function register_user()
    {
        extract($_POST);

        $data = array('name'=>$name,'contact'=>$contact,'email'=>$email);
        $this->db->insert('user', $data);
        $this->session->set_userdata('user_id',$this->db->insert_id());
        return true;
         
    }

    public function book_car($data)
    {
        // print_r($data['only_security_amount']);die;
        $book_id = $this->db->order_by('booking_id','desc')->get('booking')->row()->booking_id+1;

     // sanjay added 31-03-2022
        $start = date("Y-m-d H:i:s", strtotime($this->session->userdata('start')));
        $end = date("Y-m-d H:i:s", strtotime($this->session->userdata('end')));
        $availability = date("Y-m-d H:i:s", strtotime('+2 hours', strtotime($end)));
        //$availability = show cars on front after 2 hours of end datetime
     // end.. sanjay added 31-03-2022
        
        $remainingAmount = 0;
        
        if($data['only_security_amount']==0)
        {
            $remainingAmount = $this->session->userdata('total_payable') - ($this->session->userdata('token_amount'));
        }
        
        // if($this->session->userdata('home_delivery')){
        //     $remainingAmount + $this->session->userdata('home_delivery_charges');
        // }
        @$data = array('user_id'=>$this->session->userdata('user_id'),
                      'car_id'=>$this->session->userdata('car_id'),
                      'city'=>$this->session->userdata('city'),
                      'start'=>$start,
                      'end'=>$end,
                      'availability'=>$availability,
                      'gst'=>$this->session->userdata('gst'),
                      'refund'=>$this->session->userdata('refund'),
                      'final_car_price'=>$this->session->userdata('final_car_price'),
                      'total_payable'=>$this->session->userdata('total_payable'),
                      'home_delivery'=>$this->session->userdata('home_delivery'),
                      'home_delivery_charges'=>$this->session->userdata('home_delivery_charges'),
                      'address'=>$this->session->userdata('address'),
                      'details_order_id'=>$this->session->userdata('details_order_id')."_".$book_id,
                      'remaining' => $remainingAmount
                  );

        $this->db->insert('booking',$data);

        $insert_id = $this->db->insert_id();

        $this->session->set_userdata('unique_order_id',$insert_id);
        $this->session->set_userdata('details_order_id', $this->session->userdata('details_order_id')."_".$book_id);
        $this->session->set_userdata('user_id',$this->session->userdata('user_id'));
    }
    
    
    
    
    
    
    
    public function book_car_by_cod($data="")
    {
        $book_id = $this->db->order_by('booking_id','desc')->get('booking')->row()->booking_id+1;
        $start = date("Y-m-d H:i:s", strtotime($this->session->userdata('start')));
        $end = date("Y-m-d H:i:s", strtotime($this->session->userdata('end')));
        $availability = date("Y-m-d H:i:s", strtotime('+2 hours', strtotime($end)));
        $remainingAmount = $this->session->userdata('total_payable');
        $data = array('user_id'=>$this->session->userdata('user_id'),
                      'car_id'=>$this->session->userdata('car_id'),
                      'city'=>$this->session->userdata('city'),
                      'start'=>$start,
                      'end'=>$end,
                      'availability'=>$availability,
                      'gst'=>$this->session->userdata('gst'),
                      'refund'=>$this->session->userdata('refund'),
                      'final_car_price'=>$this->session->userdata('final_car_price'),
                      'total_payable'=>$this->session->userdata('total_payable'),
                      'home_delivery'=>$this->session->userdata('home_delivery'),
                      'home_delivery_charges'=>$this->session->userdata('home_delivery_charges'),
                      'address'=>$this->session->userdata('address'),
                      'details_order_id'=>$this->session->userdata('details_order_id')."_".$book_id,
                      'remaining' => $remainingAmount,
                      'type' => "cod"
                  );
        $this->db->insert('booking',$data);
        $insert_id = $this->db->insert_id();
        $this->session->set_userdata('unique_order_id',$insert_id);
        $this->session->set_userdata('details_order_id', $this->session->userdata('details_order_id')."_".$book_id);
        $this->session->set_userdata('user_id',$this->session->userdata('user_id'));
    }
    
    
    
	
    public function update_profile()
    {
        extract($_POST);
        $data = array('name'=>$name,'email'=>$email,'contact'=>$contact,'address'=>$address);
        $user_id = base64_decode($user_id);
        if($_FILES['image']['name'] != "")
        {
            $image    = $_FILES['image']['name'];
            $file_size    = $_FILES['image']['size'];
            $file_tmp     = $_FILES['image']['tmp_name'];
            $file_type    = $_FILES['image']['type'];
            $path         =  "uploads/user/";
            $temp = explode(".", $_FILES["image"]["name"]);
            $newfilename = $user_id . '.' . end($temp);
            move_uploaded_file($file_tmp, $path.$newfilename);
            $image =  $path.$newfilename;
            $data += array('image'=>$image);
        }
        $this->db->where('user_id',$user_id)->update('user', $data);
        $this->session->set_flashdata('success_message','Profile Updated Successfully!');
        if($password != '' && $cpassword != ''){
            if($password == $cpassword)
            {
                $data = array('password'=>$password);
                $this->db->where('user_id',$user_id)->update('user', $data);
                $this->session->set_flashdata('success_message', ucwords('your password will be changed!'));
            }
            else
            {
               $this->session->set_flashdata('error_message', ucwords('new and confirm password should be same'));
            }
        }
    }
    
    
    
    
	
    public function update_social_links()
    {
        extract($_POST);
        $data = array('facebook'=>$facebook,'instagram'=>$instagram,'twitter'=>$twitter);
        $user_id = ($user_id);
        $this->db->where('user_id',$user_id)->update('user', $data);
        $this->session->set_flashdata('success_message','Profile Updated Successfully!');
    }


    
    public function upload_documents()
    {
        //echo "<pre>"; print_r($_POST); exit;
        extract($_POST);

        $user_id = base64_decode($user_id);
        
        $data = array('user_id'=>$user_id);

        if($_FILES['doc1']['name'] != "")
        {
            $doc1    = $_FILES['doc1']['name'];
            $file_size    = $_FILES['doc1']['size'];
            $file_tmp     = $_FILES['doc1']['tmp_name'];
            $file_type    = $_FILES['doc1']['type'];
            $path         =  "uploads/doc1/";
          
            $temp = explode(".", $_FILES["doc1"]["name"]);
            $newfilename = $user_id . '.' . end($temp);
            
            move_uploaded_file($file_tmp, $path.$newfilename);

            $doc1 =  $path.$newfilename;

            $data += array('doc1'=>$doc1);
        }
        if($_FILES['doc2']['name'] != "")
        {
            $doc2    = $_FILES['doc2']['name'];
            $file_size    = $_FILES['doc2']['size'];
            $file_tmp     = $_FILES['doc2']['tmp_name'];
            $file_type    = $_FILES['doc2']['type'];
            $path         =  "uploads/doc1/";
          
            $temp = explode(".", $_FILES["doc2"]["name"]);
            $newfilename = $user_id.rand(123,999). '.' . end($temp);
            
            move_uploaded_file($file_tmp, $path.$newfilename);

            $doc2 =  $path.$newfilename;

            $data += array('doc2'=>$doc2);
        }
        if($_FILES['license']['name'] != "")
        {
            $license    = $_FILES['license']['name'];
            $file_size    = $_FILES['license']['size'];
            $file_tmp     = $_FILES['license']['tmp_name'];
            $file_type    = $_FILES['license']['type'];
            $path         =  "uploads/license/";
          
            $temp = explode(".", $_FILES["license"]["name"]);
            $newfilename = $user_id . '.' . end($temp);
            
            move_uploaded_file($file_tmp, $path.$newfilename);

            $license =  $path.$newfilename;

            $data += array('license'=>$license);
        }

        $this->db->insert('documents', $data);

        $this->session->set_flashdata('success_message','Profile Updated Successfully!');
    }


    
    public function update_documents()
    {
        extract($_POST);

        $data = array();

        $user_id = base64_decode($user_id);

        if($_FILES['doc1']['name'] != "")
        {
            $doc1    = $_FILES['doc1']['name'];
            $file_size    = $_FILES['doc1']['size'];
            $file_tmp     = $_FILES['doc1']['tmp_name'];
            $file_type    = $_FILES['doc1']['type'];
            $path         =  "uploads/doc1/";
          
            $temp = explode(".", $_FILES["doc1"]["name"]);
            $newfilename = $user_id . '.' . end($temp);
            
            move_uploaded_file($file_tmp, $path.$newfilename);

            $doc1 =  $path.$newfilename;

            $data += array('doc1'=>$doc1);
        }
        if($_FILES['doc2']['name'] != "")
        {
            $doc2    = $_FILES['doc2']['name'];
            $file_size    = $_FILES['doc2']['size'];
            $file_tmp     = $_FILES['doc2']['tmp_name'];
            $file_type    = $_FILES['doc2']['type'];
            $path         =  "uploads/doc1/";
          
            $temp = explode(".", $_FILES["doc2"]["name"]);
            $newfilename = $user_id.rand(123,999). '.' . end($temp);
            
            move_uploaded_file($file_tmp, $path.$newfilename);

            $doc2 =  $path.$newfilename;

            $data += array('doc2'=>$doc2);
        }

        if($_FILES['license']['name'] != "")
        {
            $license    = $_FILES['license']['name'];
            $file_size    = $_FILES['license']['size'];
            $file_tmp     = $_FILES['license']['tmp_name'];
            $file_type    = $_FILES['license']['type'];
            $path         =  "uploads/license/";
          
            $temp = explode(".", $_FILES["license"]["name"]);
            $newfilename = $user_id . '.' . end($temp);
            
            move_uploaded_file($file_tmp, $path.$newfilename);

            $license =  $path.$newfilename;

            $data += array('license'=>$license);
        }

        $this->db->where('user_id',$user_id)->update('documents', $data);

        $this->session->set_flashdata('success_message','Profile Updated Successfully!');
    }

    public function cancell_booking(){
        
        extract($_POST);

        $data = array('note'=>$note,'booking_id'=>$booking_id,'user_id'=>$this->session->userdata('user_id'));

        $this->db->insert('booking_cancell', $data);
    }

}
