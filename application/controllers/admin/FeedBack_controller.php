<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 11/20/2017
 * Time: 1:29 PM
 */
class FeedBack_controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('loginid') && $this->session->userdata('usergroup') != 'ADMIN'){
			redirect('dang-nhap');
		}

		$this->load->library('session');
		$this->load->model('FeedBack_Model');
		$this->load->helper('form');
		$this->load->library('pagination');
		$this->load->helper("bootstrap_pagination_admin");
		$this->load->helper("seo_url");
	}

	public function index()
	{
		$crudaction = $this->input->post("crudaction");
		if($crudaction == DELETE){
			$productId = $this->input->post("productId");
			$this->deleteFeedBackById($productId);
			$data['message_response'] = 'Xóa tin phản hồi thành công.';
		}else if($crudaction == "delete-multiple"){
			$productIds = $this->input->post("checkList");
			foreach ($productIds as $productId){
				$this->deleteFeedBackById($productId);
			}
			$data['message_response'] = 'Xóa tin phản hồi thành công.';
		}
		$config = pagination($this);
		$config['base_url'] = base_url('admin/feedback/list.html');
		if(!$config['orderField']){
			$config['orderField'] = "CreatedDate";
			$config['orderDirection'] = "DESC";
		}
		$results = $this->FeedBack_Model->findAndFilter($config['page'], $config['per_page'], $config['searchFor'], $config['orderField'], $config['orderDirection']);
		$data['products'] = $results['items'];
		$config['total_rows'] = $results['total'];

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view("admin/feedback/list", $data);
	}

	public function view($feedBackId)
	{
		$feedBack = $this->FeedBack_Model->findById($feedBackId);
		$data['feedBack'] = $feedBack;
		$this->load->view("admin/feedback/view", $data);
	}

	private function deleteFeedBackById($productId){
		if($productId != null && $productId > 0) {
			$this->FeedBack_Model->deleteById($productId);
		}
	}
}
