<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 8/24/2017
 * Time: 1:19 PM
 */
class ManagePost_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('loginid')){
			redirect('dang-nhap');
		}
		$this->load->model('Product_Model');
		$this->load->model('Category_Model');
		$this->load->helper("seo_url");
		$this->load->helper('date');
		$this->load->helper('form');
	}

	public function index()
	{
		$data = $this->Category_Model->getCategories();
		$userId = $this->session->userdata('loginid');

		$crudaction = $this->input->post("crudaction");
		if($crudaction == DELETE){
			$productId = $this->input->post("productId");
			if($productId != null && $productId > 0) {
				$product = $this->Product_Model->findById($productId);
				$folder = $product->code;
				$upath = 'attachments' . DIRECTORY_SEPARATOR .'u'. $userId . DIRECTORY_SEPARATOR. $folder;
				// delete db first
				$this->Product_Model->deleteById($productId);
				if (file_exists($upath)){
					$this->delete_directory($upath);
				}
				$data['message_response'] = 'Xóa tin rao thành công.';
			}
		}else if($crudaction == REFRESH){
			$productId = $this->input->post("productId");
			if($productId != null && $productId > 0) {
				$this->Product_Model->pushPostUp($productId);
				$data['message_response'] = 'Làm mới tin rao thành công.';
			}
		}else if($crudaction == INACTIVE_POST){
			$productId = $this->input->post("productId");
			if($productId != null && $productId > 0) {
				$this->Product_Model->changeStatusPost($productId, INACTIVE);
				$data['message_response'] = 'Đã tạm khóa tin rao.';
			}
		}else if($crudaction == ACTIVE_POST){
			$productId = $this->input->post("productId");
			if($productId != null && $productId > 0) {
				$this->Product_Model->changeStatusPost($productId, ACTIVE);
				$data['message_response'] = 'Tin rao đã mở trạng thái hoạt động.';
			}
		}

		$products = $this->Product_Model->findByUserId($userId);

		$data['products'] = $products;
		$this->load->view('post/list', $data);
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
