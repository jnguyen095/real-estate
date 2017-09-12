<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 8/30/2017
 * Time: 1:56 PM
 */
class Default_controller extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('Category_Model');
		$this->load->model('City_Model');
		$this->load->helper("seo_url");
		$this->load->vars($this->loadVars());
	}

	private function loadVars(){
		$vars = array();
		$vars['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();
		return $vars;
	}
}
