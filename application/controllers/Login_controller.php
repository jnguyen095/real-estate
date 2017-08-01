<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/31/2017
 * Time: 11:29 AM
 */
class Login_controller extends CI_Controller
{
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('Stud_view');
	}
}
