<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Basic {
    var $CI;
    public function __construct($params = array()) {
        $this->CI = & get_instance();
        $this->CI->load->helper('url');
        $this->CI->config->item('base_url');
        $this->CI->load->database();
        date_default_timezone_set('Asia/Kolkata');
    }
    
    public function delete_file($filePath) {
        if(file_exists($filePath))
        {
            unlink($filePath);
        }
    }
    
    public function file_upload($file_path, $file_name) {
        $new_name = mt_rand(111111, 999999) . $file_name;
        $config['file_name'] = $new_name;
        $config['upload_path'] = 'assets/' . $file_path;
        $config['allowed_types'] = '*';
        //  $config['max_size'] = 100;
        $this->CI->load->library('upload', $config);
        $this->CI->upload->initialize($config);
        if (!$this->CI->upload->do_upload($file_name)) {
            $error = $this->CI->upload->display_errors();
            $new_name = '';
            return $error;
            exit;
        } else {
            $upload_data = $this->CI->upload->data();
            $new_name = '';
            return $config['upload_path'] . '/' . $upload_data['file_name'];
        }
    }
    

}
