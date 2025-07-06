<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs extends CI_Controller {

	public function index()
	{
        $meta_data["meta"] = $this->db->get_where("meta", ["pages"=>"Blog"])->row();
        $data["blog"] = $this->db->get_where("blog")->result();
        
		$this->load->view('web/header', $meta_data);
		$this->load->view('web/blogs', $data);
		$this->load->view('web/footer');
	}
    public function read($title="")
    {
        if($title!=""){
            //$titleUrl = str_replace("-"," ",$title);
            $sql = $this->db->get_where("blog", ["slug"=>$title]);
            $data["blogs"] = $this->db->get_where("blog")->result();
            if($sql->num_rows() > 0){
                $data["blog"] = $blog = $sql->row();
                $meta_data["meta"] = (Object)["title"=>$blog->meta_title, "keyword"=>$blog->meta_key, "description"=>$blog->meta_description];
                
                $this->load->view('web/header', $meta_data);
                $this->load->view('web/blog_full', $data);
                $this->load->view('web/footer');
            }else{
                redirect("blogs/");
            }
        }else{
            redirect("blogs/");
        }
    }
    
    // function test()
    // {
       
       
       
    //     $curl = curl_init();
    
    //     curl_setopt_array($curl, [
    //         CURLOPT_URL => 'https://api.sobot.in/message/',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_POSTFIELDS => json_encode([
    //                                   "template_name"=> "bookingnew",
    //                                   "template_lang"=> "en",
    //                                   "customer_number"=>"919336630515",
    //                                   "customer_name"=>"Reetesh devs ",
                                      
    //                                  ]),
    //         CURLOPT_HTTPHEADER => [
    //             'cache-control: no-cache',
    //             'content-type: application/json',
    //             'x-api-key: RA7oi6QyuFfJOf-' ,
    //             'x-api-secret: jft6o_q2iG5NCsMTgY0Wc1lrs1qk1VsJY6UtKW7AaM8' 
    //         ],
    //     ]);
    

    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);
    
    //     curl_close($curl);
    
    //     if ($err) {
    //         echo 'cURL Error #:'.$err;
    //     } else {
    //         echo $response; die;
    //         $data = json_decode($response, true);
    //         if (isset($data['status']) && $data['status'] == 'error') {
    //             echo  'test';
    //         } else {
    //             // echo "<pre>"; print_r($data); die;
    //             echo  (isset($data['companyId'])) ? $data['companyId'] : '22';
    //         }
    //     }
    // }

}
