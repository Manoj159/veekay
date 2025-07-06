<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('user_model');
    }

	public function index()
	{
		$data['history'] =  $this->db->select('booking_id')->get_where('booking', array('user_id'=>$this->session->userdata('user_id')))->result();
		$data["bookingCount"] = count($data['history']);
		$data['u']=$this->db->get_where('user', array('user_id'=>$this->session->userdata('user_id')))->first_row();

		$this->load->view('web/header');
		$this->load->view('web/account',$data);
		$this->load->view('web/footer');
	}

	public function history()
	{
		$data['history'] =  $this->db->order_by('booking_id','desc')->get_where('booking', array('user_id'=>$this->session->userdata('user_id')))->result();
		$data["bookingCount"] = count($data['history']);
		$this->load->view('web/header');
		//$this->load->view('web/history', $data);
		$this->load->view('web/user/booking',$data);
		$this->load->view('web/footer');
	}

	public function documents()
	{
		$data['history'] =  $this->db->select('booking_id')->get_where('booking', array('user_id'=>$this->session->userdata('user_id')))->result();
		$data["bookingCount"] = count($data['history']);
		$data['documents'] =  $this->db->get_where('documents', array('user_id'=>$this->session->userdata('user_id')))->result();
		$data['doc'] =  $this->db->get_where('documents', array('user_id'=>$this->session->userdata('user_id')))->first_row();
		
		$this->load->view('web/header');
		//$this->load->view('web/documents', $data);
		$this->load->view('web/user/document', $data);
		$this->load->view('web/footer');
	}

	public function verification()
	{
		$data['history'] =  $this->db->order_by('booking_id','desc')->get_where('booking', array('user_id'=>$this->session->userdata('user_id')))->result();
		$data["bookingCount"] = count($data['history']);
		$data['documents'] =  $this->db->get_where('documents', array('user_id'=>$this->session->userdata('user_id')))->result();
		
		$this->load->view('web/header');
		//$this->load->view('web/verification', $data);
		$this->load->view('web/user/verification', $data);
		$this->load->view('web/footer');
	}

	public function update_profile()
	{
		$this->user_model->update_profile();
		redirect(base_url().'Account','refresh');	
	}

	public function update_social_links()
	{
		$this->user_model->update_social_links();
		redirect(base_url().'Account','refresh');	
	}

	public function upload_documents()
	{
	    //echo"<pre>"; print_r($_FILES); exit;
		$this->user_model->upload_documents();
		redirect(base_url().'Account/documents','refresh');	
	}

	public function update_documents()
	{
		$this->user_model->update_documents();
		redirect(base_url().'Account/documents','refresh');	
	}

	public function cancell_booking()
	{
		$this->user_model->cancell_booking();
		$this->session->set_flashdata('success_message','Booking Canceled Successfully!');
		redirect(base_url().'Account/history','refresh');	
	}
	
	public function thankyou(){
	    //echo "<pre>"; print_r($this->session->userdata()); exit;
	    $data = [];
        $bid = $this->session->userdata("unique_order_id");
        $user_id = $this->db->get_where('booking', array('booking_id'=>$bid))->row()->user_id;
        $user = $this->db->get_where('user',array('user_id'=>$user_id))->row();
        
        $this->booking_success_whatapps($user->contact,$bid,$user->name);
   
        
         $this->booking_success_whatapps_for_admin('9311826201');
         $this->booking_success_whatapps_for_admin('9999926867');
         $this->booking_success_whatapps_for_admin('8448586825');
        $this->booking_success_whatapps_for_admin('9773796805');
         
        $this->load->view('web/header');
        $this->load->view('web/user/thankyou', $data);
        $this->load->view('web/footer');
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
           // echo 'Error:' . curl_error($ch);
        } else {
            // Process the response
          //  echo 'Response: ' . $response;
        }
        
        // Close cURL resource
        curl_close($ch);
          return true;
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
    
 
}
