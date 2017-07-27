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
		$this->load->model('City_Model');
		$this->load->helper("seo_url");
		$this->load->helper("my_date");
		$this->load->helper("bootstrap_pagination");
		$this->load->library('pagination');
	}

	public function listItem($catId, $offset=0) {
		$data = $this->Category_Model->getCategories();
		$search_data = $this->Product_Model->findByCatIdFetchAddress($catId, $offset, MAX_PAGE_ITEM);

		$data = array_merge($data, $search_data);

		$thisCat = $this->Category_Model->findById($catId);
		$data['category'] = $thisCat;
		$data['sameLevels'] = $this->Category_Model->findByParentId($thisCat->ParentID, $catId);

		$config = pagination();
		$config['base_url'] = base_url(seo_url($data['category']->CatName).'-c'.$catId.'.html');
		$config['total_rows'] = $data['total'];
		$config['per_page'] = MAX_PAGE_ITEM;

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['cities'] = $this->City_Model->getAllActive();

		$this->load->helper('url');
		$this->load->view('product/Product_list', $data);
	}

	public function detailItem($productId) {
		$data = $this->Category_Model->getCategories();
		$product = $this->Product_Model->findByIdFetchAll($productId);
		$data['category'] = $this->Category_Model->findById($product->CategoryID);
		$data['product'] = $product;

		$this->Product_Model->updateViewForProductId($productId);
		$this->load->helper('url');
		$this->load->view('product/Product_detail', $data);
	}
}
