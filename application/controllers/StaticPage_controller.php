<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 10/5/2017
 * Time: 12:58 PM
 */
class StaticPage_controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('StaticPage_Model');
		$this->load->model('Category_Model');
		$this->load->model('City_Model');
		$this->load->helper("seo_url");
		$this->load->helper('form');
	}

	// Dieu khoan su dung
	public function term(){
		$data = $this->Category_Model->getCategories();
		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();
		$data['cities'] = $this->City_Model->getAllActive();

		$page = $this->StaticPage_Model->findByCode('TERM');
		$data['page'] = $page;
		$this->StaticPage_Model->updateViewForPageWithCode('TERM');
		$this->load->view("/static/Dynamic_view", $data);
	}

	// Quy che hoat dong
	public function used(){
		$data = $this->Category_Model->getCategories();
		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();
		$data['cities'] = $this->City_Model->getAllActive();

		$page = $this->StaticPage_Model->findByCode('USED');
		$data['page'] = $page;
		$this->StaticPage_Model->updateViewForPageWithCode('USED');
		$this->load->view("/static/Dynamic_view", $data);
	}

	// Bao gia quang cao
	public function adv(){
		$data = $this->Category_Model->getCategories();
		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();
		$data['cities'] = $this->City_Model->getAllActive();

		$page = $this->StaticPage_Model->findByCode('ADV');
		$data['page'] = $page;
		$this->StaticPage_Model->updateViewForPageWithCode('ADV');
		$this->load->view("/static/Dynamic_view", $data);
	}

	// tuyen dung
	public function carer(){
		$data = $this->Category_Model->getCategories();
		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();
		$data['cities'] = $this->City_Model->getAllActive();

		$page = $this->StaticPage_Model->findByCode('CARER');
		$data['page'] = $page;
		$this->StaticPage_Model->updateViewForPageWithCode('CARER');
		$this->load->view("/static/Dynamic_view", $data);
	}
}
