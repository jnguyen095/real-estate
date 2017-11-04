<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 9/12/2017
 * Time: 9:28 AM
 */
class News_controller extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('Category_Model');
		$this->load->model('News_Model');
		$this->load->model('City_Model');
		$this->load->model('Brand_Model');
		$this->load->model('Product_Model');
		$this->load->model('SampleHouse_Model');
		$this->load->helper("seo_url");
		$this->load->helper("my_date");
		$this->load->helper("bootstrap_pagination");
		$this->load->library('pagination');
		$this->load->helper('form');
	}

	public function index($offset=0){
		$data = $this->Category_Model->getCategories();
		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();
		$data['cities'] = $this->City_Model->getAllActive();


		$search_data = $this->News_Model->searchByProperties($offset, MAX_PAGE_ITEM);
		$data = array_merge($data, $search_data);
		$config = pagination();
		$config['base_url'] = base_url('tin-tuc.html');
		$config['total_rows'] = $data['total'];
		$config['per_page'] = MAX_PAGE_ITEM;
		$data['sampleHouses'] = $this->SampleHouse_Model->findTopNewExceptCurrent(0, 5);
		$data['justUpdatedProducts'] = $this->Product_Model->findJustUpdate(0, 10);
		$data['topcityhasproduct'] = $this->City_Model->findTopCityHasProduct(20);
		$data['topbranchhasproduct'] = $this->Brand_Model->findTopBranchHasProduct(20);

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('/news/News_view', $data);
	}

	public function detail($newsId){
		$data = $this->Category_Model->getCategories();
		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();
		$data['cities'] = $this->City_Model->getAllActive();

		$data['newsDetail'] = $this->News_Model->findById($newsId);
		$data['topNews'] = $this->News_Model->findTopNewExceptCurrent($newsId, 5);
		$data['sampleHouses'] = $this->SampleHouse_Model->findTopNewExceptCurrent(0, 5);
		$this->News_Model->updateViewForNewsId($newsId);

		$this->load->view('/news/News_detail', $data);
	}

}
