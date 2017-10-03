<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 10/3/2017
 * Time: 10:25 AM
 */
class UserManagement_controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('loginid') && $this->session->userdata('usergroup') != 'ADMIN'){
			redirect('dang-nhap');
		}

		$this->load->library('session');
		$this->load->model('User_Model');
	}

	public function index($offset=0)
	{
		$users = $this->User_Model->getAllUsers($offset, MAX_PAGE_ITEM);
		$data['users'] = $users;
		$this->load->view("admin/user/list", $data);
	}
}
