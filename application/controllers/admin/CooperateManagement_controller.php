<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 11/17/2017
 * Time: 4:49 PM
 */
class CooperateManagement_controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('loginid') && $this->session->userdata('usergroup') != 'ADMIN'){
			redirect('dang-nhap');
		}

		$this->load->library('session');
		$this->load->model('Cooperate_Model');
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
			$this->deleteProductById($productId);
			$data['message_response'] = 'Xóa tin hợp tác thành công.';
		}else if($crudaction == "delete-multiple"){
			$productIds = $this->input->post("checkList");
			foreach ($productIds as $productId){
				$this->deleteProductById($productId);
			}
			$data['message_response'] = 'Xóa tin hợp tác thành công.';
		}
		$config = pagination($this);
		$config['base_url'] = base_url('admin/cooperate/list.html');
		if(!$config['orderField']){
			$config['orderField'] = "ModifiedDate";
			$config['orderDirection'] = "DESC";
		}
		$postFromDate = $this->input->get('fromDate');
		$postToDate = $this->input->get('toDate');
		$createdById = $this->input->get('createdById');
		$results = $this->Cooperate_Model->findAndFilter($config['page'], $config['per_page'], $config['searchFor'], $postFromDate, $postToDate, $createdById, $config['orderField'], $config['orderDirection']);
		$data['products'] = $results['items'];
		$config['total_rows'] = $results['total'];

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view("admin/cooperate/list", $data);
	}

	private function deleteProductById($productId){
		if($productId != null && $productId > 0) {
			$product = $this->Cooperate_Model->findById($productId);
			$folder = $product->Thumb;
			$code = trim(explode("/", $folder)[3]);
			$upath = 'attachments' . DIRECTORY_SEPARATOR .'u'. $product->CreatedByID . DIRECTORY_SEPARATOR. $code;
			// delete db first
			$this->Cooperate_Model->deleteById($productId);
			if (file_exists($upath)){
				$this->delete_directory($upath);
			}
		}
	}

	public function pushPostUp(){
		$postId = $this->input->post('CooperateID');
		$this->Cooperate_Model->pushPostUp($postId);
		echo json_encode('success');
	}

	public function updateViewManual(){
		$postId = $this->input->post('CooperateID');
		$view = $this->input->post('view');
		$this->Cooperate_Model->updateViewForProductIdManual($postId, $view);
		echo json_encode('success');
	}

	private function delete_directory($dirname) {
		if (is_dir($dirname))
			$dir_handle = opendir($dirname);
		if (!$dir_handle)
			return false;
		while($file = readdir($dir_handle)) {
			if ($file != "." && $file != "..") {
				if (!is_dir($dirname."/".$file))
					unlink($dirname."/".$file);
				else
					delete_directory($dirname.'/'.$file);
			}
		}
		closedir($dir_handle);
		rmdir($dirname);
		return true;
	}
}
