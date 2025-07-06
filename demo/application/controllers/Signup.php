<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {

	public function index()
	{
		if(isset($_GET['home_delivery'])){
			$this->session->set_userdata('home_delivery','yes');
			$this->session->set_userdata('check',1);
		}
        
		$this->load->view('web/header');
		$this->load->view('web/signup');
		$this->load->view('web/footer');
	}

	public function send_otp(){
	    
	    $this->db->insert("demo", ["ip"=>$this->get_client_ip(), "text"=>json_encode($_REQUEST), "ref"=>$_SERVER['HTTP_REFERER']]);
	    if($_SERVER['HTTP_REFERER'] == ""){
	       echo "went worn" ;exit;
	    }
		$otp = rand(100000,999999);
		 //$otp = 123456;
            if(isset($_POST["contact"]) && $_POST["contact"]){
                $this->session->set_userdata('otp', $otp);
        		$this->session->set_userdata('contact', $_POST['contact']);
        		
        		$mobile = $_POST['contact'];
        		$check = $this->db->get_where("user", ["contact"=>$mobile])->num_rows();
        		if($check > 0){
        		    $this->db->where("contact", $mobile)->update("user", ["otp"=>$otp]);
        		}else{
        		    $this->db->insert("user", ["otp"=>$otp, "contact"=>$mobile]);
        		}
        		
        		
        		
        		//$sms = "Your Registration OTP ".$otp;
        		$sms = "Welcome to Veekay Cabs Your OTP for verification is $otp Keep it confidential. Happy riding!";
        		$sms = urlencode($sms);
                $contact = $_POST['contact'];
                  //http://control.yourbulksms.com/api/sendhttp.php?authkey=3735794361627334383772&mobiles=9336630515&message=Welcome%20to%20Veekay%20Cabs%20Your%20OTP%20for%20verification%20is%201234%20Keep%20it%20confidential.%20Happy%20riding!&sender=VKCABS&route=2&country=0&DLT_TE_ID=1707171057080567628
                $rsponse = file_get_contents("http://control.yourbulksms.com/api/sendhttp.php?authkey=3735794361627334383772&mobiles=$contact&message=$sms&sender=VKCABS&route=2&country=91&DLT_TE_ID=1707171057080567628");
                //echo json_encode(["status"=>"success", "message"=>$rsponse]); exit;
                echo json_encode(["status"=>"success", "message"=>""]); exit;
                
            }else{
                echo "Invalid Aciton"; exit;
            }
	 
	}

   public function unset(){

                $this->session->set_userdata('otp','' );
        		$this->session->set_userdata('contact','');
        		

                echo json_encode(["status"=>"unset", "message"=>"number Chnage"]); exit;
                
            
   }
   
   
   
	public function resend_otp(){
	    $this->db->insert("demo", ["ip"=>$this->get_client_ip(), "text"=>json_encode($_REQUEST), "ref"=>$_SERVER['HTTP_REFERER']]);
	             $this->db->insert("demo", ["ip"=>$this->get_client_ip(), "text"=>json_encode($_REQUEST), "ref"=>$_SERVER['HTTP_REFERER']]);
            	    if($_SERVER['HTTP_REFERER'] == ""){
            	       echo "went worn" ;exit;
            	    }
	    	    $otp = rand(100000,999999);
	    	     //$otp = 123456;
	    	    $this->session->set_userdata('contact', $_POST['contacts']);
        		$contact = $this->session->userdata('contact');
        		$contact =$_POST['contacts'];
        		
        
        		$check = $this->db->get_where("user", ["contact"=>$contact])->num_rows();
        		if($check > 0){
        		    $this->db->where("contact", $contact)->update("user", ["otp"=>$otp]);
        		}else{
        		    $this->db->insert("user", ["otp"=>$otp, "contact"=>$contact]);
        		}
        		
				$sms = "Welcome to Veekay Cabs Your OTP for verification is $otp Keep it confidential. Happy riding!";
        		$sms = urlencode($sms);
                $rsponse = file_get_contents("http://control.yourbulksms.com/api/sendhttp.php?authkey=3735794361627334383772&mobiles=$contact&message=$sms&sender=VKCABS&route=2&country=91&DLT_TE_ID=1707171057080567628");
             
                $this->session->set_userdata('otp', $otp);
        	   echo json_encode(["status"=>"success", "message"=>""]); exit;
	            //$this->session->set_flashdata('success_message','OTP sent successfully!');
	            //redirect('/');exit;
		
		        

	}
	
	public function resend_otp_ld(){
	    $this->db->insert("demo", ["ip"=>$this->get_client_ip(), "text"=>json_encode($_REQUEST), "ref"=>$_SERVER['HTTP_REFERER']]);
	             $this->db->insert("demo", ["ip"=>$this->get_client_ip(), "text"=>json_encode($_REQUEST), "ref"=>$_SERVER['HTTP_REFERER']]);
            	    if($_SERVER['HTTP_REFERER'] == ""){
            	       echo "went worn" ;exit;
            	    }
	    	    $otp = rand(100000,999999);
	    	     //$otp = 123456;
        		$contact = $this->session->userdata('contact');
				$sms = "Welcome to Veekay Cabs Your OTP for verification is $otp Keep it confidential. Happy riding!";
        		$sms = urlencode($sms);
                $rsponse = file_get_contents("http://control.yourbulksms.com/api/sendhttp.php?authkey=3735794361627334383772&mobiles=$contact&message=$sms&sender=VKCABS&route=2&country=91&DLT_TE_ID=1707171057080567628");
             
                $this->session->set_userdata('otp', $otp);
        	 
	            $this->session->set_flashdata('success_message','OTP sent successfully!');
	            redirect('/');exit;
		
		        

	}

	public function check_otp(){
        
		extract($_POST);
		if($otp == $this->session->userdata('otp')){

			$response = $this->db->get_where('user', array('contact'=>$this->session->userdata('contact')));

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

				$this->session->set_flashdata('success_message','Log in successful !');
				echo json_encode(["status"=>"success", "message"=>"successfully login"]); exit;
				 

			}else{
				echo json_encode(["status"=>"error", "message"=>"Please enter correct otp"]); exit;
			}
			
		}else{
            echo json_encode(["status"=>"error", "message"=>"Please enter correct otp"]); exit;
		}
	}
	public function check_otp_old(){
        
		extract($_POST);
		if($otp == $this->session->userdata('otp')){

			$response = $this->db->get_where('user', array('contact'=>$this->session->userdata('contact')));

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

				$this->session->set_flashdata('success_message','Log in successful !');
				if($this->session->userdata('search_url') != '')
				{
					if($this->session->userdata('home_delivery')){
						$this->session->set_userdata('home_delivery','yes');
						redirect($_SERVER['HTTP_REFERER']);
						//redirect($this->session->userdata('search_url'));
					}else{
						//redirect(base_url().'Distribute');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else{
					//redirect(base_url());
					redirect($_SERVER['HTTP_REFERER']);
				}

			}else{
				//redirect(base_url().'Details');
				redirect($_SERVER['HTTP_REFERER']);
			}
			
		}else{
            $this->session->set_flashdata('error_message','Please Enter Correct OTP!');
            //echo $this->session->userdata('otp');
            //echo " OTP not match $otp";
			//redirect(base_url());
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function change_number(){
		$this->session->unset_userdata('contact');
		$this->session->unset_userdata('otp');
		redirect(base_url());
	}

	public function logout()
	{
		/*$this->session->unset_userdata('otp');
		$this->session->unset_userdata('user_id');
        $this->session->unset_userdata('contact');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('check');
        $this->session->unset_userdata('home_delivery');*/
        
        $this->session->sess_destroy();
        
		$this->input->set_cookie('user_id','', time() + (60*60*24*10));
		$this->input->set_cookie('contact','', time() + (60*60*24*10));
		$this->input->set_cookie('email','', time() + (60*60*24*10));
		$this->input->set_cookie('name','', time() + (60*60*24*10));

		redirect(base_url('/'));
	}
	
	
	
	
	function get_client_ip() {
            $ipaddress = '';
            if (getenv('HTTP_CLIENT_IP'))
                $ipaddress = getenv('HTTP_CLIENT_IP');
            else if(getenv('HTTP_X_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
            else if(getenv('HTTP_X_FORWARDED'))
                $ipaddress = getenv('HTTP_X_FORWARDED');
            else if(getenv('HTTP_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_FORWARDED_FOR');
            else if(getenv('HTTP_FORWARDED'))
               $ipaddress = getenv('HTTP_FORWARDED');
            else if(getenv('REMOTE_ADDR'))
                $ipaddress = getenv('REMOTE_ADDR');
            else
                $ipaddress = 'UNKNOWN';
            return $ipaddress;
        }
}
