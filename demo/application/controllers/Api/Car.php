<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Car extends CI_Controller {

	public function index()
	{     
        $car = $this->db->select('*')->order_by('show_top desc , name desc,  sold_to asc' )->get_where('car', $where)->result();
        echo json_encode(["status" => "success", "data" => $car]); exit;
	}
	
}
