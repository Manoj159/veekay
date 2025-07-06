<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thankyou extends CI_Controller {

	public function index()
	{
      $user_id = $this->db->get_where('booking', array('booking_id'=>base64_decode($_GET['booking_id'])))->row()->user_id;

      $user = $this->db->get_where('user',array('user_id'=>$user_id))->row();
        
        $this->session->set_userdata('user_id',$user->user_id);
        $this->session->set_userdata('contact',$user->contact);
        $this->session->set_userdata('email',$user->email);
        $this->session->set_userdata('name',$user->name);
        
        $bid = base64_decode($_GET['booking_id']);
      //  $this->booking_success_webmailer($user->email, $bid);
       // $this->booking_success_webmailer_admin($bid);
        
         $this->booking_success_whatapps($user->contact,$bid,$user->name);
        
         $this->booking_success_whatapps_for_admin('9311826201');
         $this->booking_success_whatapps_for_admin('9999926867');
         $this->booking_success_whatapps_for_admin('8448586825');
     
        $this->load->view('web/header');
        $this->load->view('web/thankyou');
        $this->load->view('web/footer');
	}
    
    private function booking_success_webmailer($email="", $bid=0)
	{
          if($email != "" && $bid > 0){
              $to = $email;
         
              $data["book"] = $book = $this->db->get_where("booking", ["booking_id"=>$bid])->row();
              $subject = "Booking Confirmed $book->details_order_id";
              
              $user_id = $data["book"]->user_id; 
              $car_id = $data["book"]->car_id;
              $data["user"] = $this->db->get_where("user", ["user_id"=>$user_id])->row();
              $data["car"] = $this->db->get_where("car", ["car_id"=>$car_id])->row();
              
              $html = $this->load->view('web/mailer_booking_success', $data, true);
             // $html_admin = $this->load->view('web/mailer_booking_for_admin', $data, true);

              @send_webmail($to, $subject, $html);
            //  @send_webmail("hello@happyeasyrides.com", $subject, $html_admin);
          }
	}
    
    
    
    private function booking_success_webmailer_admin($bid)
	{
          if($bid > 0){
             

              $data["book"] = $book = $this->db->get_where("booking", ["booking_id"=>$bid])->row();
              $subject = "Booking Confirmed $book->details_order_id";
              
              $user_id = $data["book"]->user_id; 
              $car_id = $data["book"]->car_id;
              $data["user"] = $this->db->get_where("user", ["user_id"=>$user_id])->row();
              $data["car"] = $this->db->get_where("car", ["car_id"=>$car_id])->row();
             
              $html_admin = $this->load->view('web/mailer_booking_for_admin', $data, true);

          //   @send_webmail("hello@happyeasyrides.com", $subject, $html_admin);
                //  @send_webmail("ritfriends@gmail.com", $subject, $html_admin);
          }
	}
    
    
    
    
    public function booking_success_whatapps_bk($mob,$bid=0,$name="user")
    {
       
    if($mob != "" && $bid > 0){
         $mobile="91".$mob;
       $ids= base64_encode($bid);
       $link = 'https://veekaycabs.com/booking-conf/'.$ids;
       
        $curl = curl_init();
        
        $curl = curl_init();

            curl_setopt_array($curl, [
              CURLOPT_URL => "https://public.doubletick.io/whatsapp/message/template",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => json_encode([
                'messages' => [
                    [
                            'content' => [
                                             'language' => 'en_GB',
                                            'templateData' => [
                                             'body' => [
                                                    'placeholders' => [$name,  $link  ]
                                                   ]
                                            ],
                                            'templateName' => 'user_bookiing_detail'
                            ],
                            'to' => $mobile
                    ]
                ]
              ]),
              CURLOPT_HTTPHEADER => [
                "Authorization: key_72xZs0PJjJ",
                "accept: application/json",
                "content-type: application/json"
              ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            
            // if ($err) {
            //   echo "cURL Error #:" . $err;
            // } else {
            //   echo $response;
            // }
            return true;
     }
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
           echo 'Error:' . curl_error($ch);
        } else {
            // Process the response
           echo 'Response: ' . $response;
        }
        
        // Close cURL resource
        curl_close($ch);
      
      
      //  return true;
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
           echo 'Response: ' . $response;
        }
        
        // Close cURL resource
        curl_close($ch);
       //   return true;
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
     
       
    
    
}
