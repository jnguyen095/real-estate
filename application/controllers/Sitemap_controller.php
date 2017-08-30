<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 8/28/2017
 * Time: 4:13 PM
 */
class Sitemap_controller extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('Category_Model');
		$this->load->helper("seo_url");
	}

	public function index()
	{
		// create new instance
		$url = array();

		$data = $this->Category_Model->getCategories();
		$categories = $data['categories'];
		$child = $data['child'];
		foreach($categories as $r) {
			array_push($url, base_url() . seo_url($r->CatName).'-c'.$r->CategoryID. '.html');
			if (count($child[$r->CategoryID]) > 0) {
				array_push($url, base_url() . seo_url($r->CatName) . '-c' . $r->CategoryID . '.html');
			}
		}
		$sitemap['urlslist'] = $url;

		$this->load->view('/sitemap/index', $sitemap);
	}
}
