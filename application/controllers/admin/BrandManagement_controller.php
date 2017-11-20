<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 11/17/2017
 * Time: 5:36 PM
 */
class BrandManagement_controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('loginid') && $this->session->userdata('usergroup') != 'ADMIN'){
			redirect('dang-nhap');
		}

		$this->load->library('session');
		$this->load->model('Brand_Model');
		$this->load->helper('form');
		$this->load->library('pagination');
		$this->load->helper("bootstrap_pagination_admin");
		$this->load->helper("seo_url");
	}

	public function index()
	{
		$config = pagination($this);
		$config['base_url'] = base_url('admin/brand/list.html');
		if(!$config['orderField']){
			$config['orderField'] = "BrandName";
			$config['orderDirection'] = "ASC";
		}
		$results = $this->Brand_Model->findAndFilter($config['page'], $config['per_page'], $config['searchFor'], $config['orderField'], $config['orderDirection']);
		$data['products'] = $results['items'];
		$config['total_rows'] = $results['total'];

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view("admin/brand/list", $data);
	}
}
