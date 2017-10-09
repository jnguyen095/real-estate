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
		$this->load->library('pagination');
		$this->load->helper("bootstrap_pagination_admin");
	}

	public function index()
	{
		$config = pagination($this);
		$config['base_url'] = base_url('admin/user/list.html');
		if(!$config['orderField']){
			$config['orderField'] = "CreatedDate";
			$config['orderDirection'] = "DESC";
		}
		$results = $this->User_Model->getAllUsers($config['page'], $config['per_page'], $config['searchFor'], $config['orderField'], $config['orderDirection']);
		$data['users'] = $results['items'];
		$config['total_rows'] = $results['total'];

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view("admin/user/list", $data);
	}
}
