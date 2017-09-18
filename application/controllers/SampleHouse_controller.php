<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 9/14/2017
 * Time: 8:56 AM
 */
class SampleHouse_controller extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('Category_Model');
		$this->load->model('SampleHouse_Model');
		$this->load->model('City_Model');
		$this->load->model('News_Model');
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


		$search_data = $this->SampleHouse_Model->searchByProperties($offset, MAX_PAGE_ITEM);
		$data = array_merge($data, $search_data);
		$config = pagination();
		$config['base_url'] = base_url('nha-mau-dep.html');
		$config['total_rows'] = $data['total'];
		$config['per_page'] = MAX_PAGE_ITEM;
		$data['topNews'] = $this->News_Model->findTopNewExceptCurrent(0, 5);

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('/samplehouse/List_view', $data);
	}

	public function detail($sampleHouseId){
		$data = $this->Category_Model->getCategories();
		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();
		$data['cities'] = $this->City_Model->getAllActive();
		$data['topNews'] = $this->News_Model->findTopNewExceptCurrent(0, 5);

		$data['sampleHouseDetail'] = $this->SampleHouse_Model->findById($sampleHouseId);
		$data['topSampleHouses'] = $this->SampleHouse_Model->findTopNewExceptCurrent($sampleHouseId, 5);
		$this->SampleHouse_Model->updateViewForNewsId($sampleHouseId);

		$this->load->view('/samplehouse/Detail_view', $data);
	}

}
