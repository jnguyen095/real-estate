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
			$config['orderField'] = "Hot";
			$config['orderDirection'] = "DESC";
		}
		$results = $this->Brand_Model->findAndFilter($config['page'], $config['per_page'], $config['searchFor'], $config['orderField'], $config['orderDirection']);
		$data['brands'] = $results['items'];
		$config['total_rows'] = $results['total'];

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view("admin/brand/list", $data);
	}

	public function detail($brandId){
		$data['brand'] = $this->Brand_Model->findById($brandId);
		$this->load->view("admin/brand/view", $data);
	}


	public function updateHot(){
		$brandId = $this->input->post('BrandID');
		$hot = $this->input->post('Hot');
		$this->Brand_Model->updateHotForBrand($brandId, $hot);
		echo json_encode('success');
	}
}
