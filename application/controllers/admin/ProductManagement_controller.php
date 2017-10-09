<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 10/3/2017
 * Time: 10:25 AM
 */
class ProductManagement_controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('loginid') && $this->session->userdata('usergroup') != 'ADMIN'){
			redirect('dang-nhap');
		}

		$this->load->library('session');
		$this->load->model('Product_Model');
		$this->load->library('pagination');
		$this->load->helper("bootstrap_pagination_admin");
	}

	public function index()
	{
		$config = pagination($this);
		$config['base_url'] = base_url('admin/product/list.html');
		if(!$config['orderField']){
			$config['orderField'] = "PostDate";
			$config['orderDirection'] = "DESC";
		}
		$postFromDate = $this->input->get('postFromDate');
		$postToDate = $this->input->get('postToDate');
		$createdById = $this->input->get('createdById');
		$results = $this->Product_Model->findAndFilter($config['page'], $config['per_page'], $config['searchFor'], $postFromDate, $postToDate, $createdById, $config['orderField'], $config['orderDirection']);
		$data['products'] = $results['items'];
		$config['total_rows'] = $results['total'];

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view("admin/product/list", $data);
	}
}
