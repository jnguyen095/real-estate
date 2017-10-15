<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 10/15/2017
 * Time: 1:26 PM
 */
class Notfound_controller extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('Category_Model');
		$this->load->model('City_Model');
		$this->load->helper("seo_url");
		$this->load->helper('form');
	}

	public function index() {
		$data = $this->Category_Model->getCategories();
		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();
		$data['cities'] = $this->City_Model->getAllActive();
		$this->load->helper('url');
		$this->load->view('Notfound_view', $data);
	}
}
