<?php if (!defined('BASEPATH'))exit('No direct script access allowed');


class Modal extends CI_Controller 
{

    function __construct() {
        parent::__construct();
    }

    public function index($page_name='', $param= '', $param2= '')
    {
        $account_type = $this->session->userdata('login_type');
        $data['param'] = $param;
        $data['param2'] = $param2;
        $this->load->view('admin/'.$account_type.'/'.$page_name.'.php', $data);
    }

}
?>