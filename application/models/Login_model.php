<?php


class Login_model extends CI_Model
{

    function __construct() 
    {
        parent::__construct();
    }

    public function mdlcheckUserLogin()
    {
    	$email = $this->input->post('email');

    	$password = md5($this->input->post('password'));

    	$data = array('email'=>$email, 'password'=>$password);

    	$query = $this->db->get_where('admin', $data);

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			$this->session->set_userdata("login_type",$row->login_type);
			$this->session->set_userdata("admin_login",1);
			$this->session->set_userdata("admin_id", $row->id);
			$this->session->set_userdata("name", $row->name);

			$this->input->set_cookie("login_type",$row->login_type , time() + (10 * 365 * 24 * 60 * 60));
			$this->input->set_cookie("admin_login",1, time() + (10 * 365 * 24 * 60 * 60));
			$this->input->set_cookie("admin_id", $row->id, time() + (10 * 365 * 24 * 60 * 60));
			$this->input->set_cookie("name", $row->name, time() + (10 * 365 * 24 * 60 * 60));

			$this->db->set("status",1)->where("id",$this->session->userdata("admin_id"))->update('admin');
		}

    }


	public function update_status()
	{
		$this->db->set("status",0)->where("id",$this->session->userdata("admin_id"))->update('admin');
	}

}