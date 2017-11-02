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
		$this->load->library('session');
		$this->load->model('Category_Model');
		$this->load->model('Product_Model');
		$this->load->model('City_Model');
		$this->load->model('Brand_Model');
		$this->load->helper("seo_url");
		$this->load->helper('text');
		$this->load->helper("my_date");
		$this->load->model('News_Model');
		$this->load->model('Cooperate_Model');
		$this->load->model('SampleHouse_Model');
		$this->load->helper('form');
	}

	public function index() {
		$data = $this->Category_Model->getCategories();
		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();
		// $data['hotProducts'] = $this->Product_Model->findByHotProduct();
		$data['nhadatban'] = $this->Product_Model->findByCategoryCode(NHADAT_BAN, 0, 10);
		$data['nhadatchothue'] = $this->Product_Model->findByCategoryCode(NHADAT_CHOTHUE, 0, 10);
		$data['topcityhasproduct'] = $this->City_Model->findTopCityHasProduct(20);
		$data['topbranchhasproduct'] = $this->Brand_Model->findTopBranchHasProduct(20);
		$data['hotBranches'] = $this->Brand_Model->findTopBranchHasProductAndData(4);
		$data['cities'] = $this->City_Model->getAllActive();
		$data['topNews'] = $this->News_Model->findTopNewExceptCurrent(0, 6);
		$data['sampleHouses'] = $this->SampleHouse_Model->findTopNewExceptCurrent(0, 10);
		$data['underOneBillion'] = $this->Product_Model->findUnderOneBillion(0, 8);
		$data['justUpdates'] = $this->Product_Model->findJustUpdate(0, 8);
		$data['cooperates'] = $this->Cooperate_Model->findTopLatest(3);
		$this->load->helper('url');
		$this->load->view('Home_view', $data);
	}

}
