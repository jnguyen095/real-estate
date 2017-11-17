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
			$data['message_response'] = 'Xóa tin rao thành công.';
		}else if($crudaction == "delete-multiple"){
			$productIds = $this->input->post("checkList");
			foreach ($productIds as $productId){
				$this->deleteProductById($productId);
			}
			$data['message_response'] = 'Xóa tin rao thành công.';
		}
		$config = pagination($this);
		$config['base_url'] = base_url('admin/product/list.html');
		if(!$config['orderField']){
			$config['orderField'] = "ModifiedDate";
			$config['orderDirection'] = "DESC";
		}
		$postFromDate = $this->input->get('fromDate');
		$postToDate = $this->input->get('toDate');
		$createdById = $this->input->get('createdById');
		$results = $this->Product_Model->findAndFilter($config['page'], $config['per_page'], $config['searchFor'], $postFromDate, $postToDate, $createdById, $config['orderField'], $config['orderDirection']);
		$data['products'] = $results['items'];
		$config['total_rows'] = $results['total'];

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view("admin/product/list", $data);
	}

	private function deleteProductById($productId){
		if($productId != null && $productId > 0) {
			$product = $this->Product_Model->findById($productId);
			$folder = $product->code;
			$upath = 'attachments' . DIRECTORY_SEPARATOR .'u'. $product->CreatedByID . DIRECTORY_SEPARATOR. $folder;
			// delete db first
			$this->Product_Model->deleteById($productId);
			if (file_exists($upath)){
				$this->delete_directory($upath);
			}
		}
	}

	public function pushPostUp(){
		$productId = $this->input->post('productId');
		$this->Product_Model->pushPostUp($productId);
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
