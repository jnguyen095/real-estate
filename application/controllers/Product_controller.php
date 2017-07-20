<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/20/2017
 * Time: 11:27 AM
 */
class Product_controller extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('Category_Model');
		$this->load->model('Product_Model');
	}

	public function listItem($catId) {
		$data = $this->Category_Model->getCategories();
		$data['products'] = $this->Product_Model->findByCatId($catId);

		$this->load->helper('url');
		$this->load->view('product/Product_list', $data);
	}

	public function detailItem($productId) {
		$data = $this->Category_Model->getCategories();
		$product = $this->Product_Model->findByIdFetchAll($productId);

		$data['product'] = $product;
		$this->load->helper('url');
		$this->load->view('product/Product_detail', $data);
	}
}
