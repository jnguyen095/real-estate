<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/20/2017
 * Time: 11:17 AM
 */
class Home_controller extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('Category_Model');
		$this->load->helper("seo_url");
	}

	public function index() {
		$data = $this->Category_Model->getCategories();

		$this->load->helper('url');
		$this->load->view('Home_view', $data);
	}
}
