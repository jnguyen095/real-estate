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
		$this->load->model('Product_Model');
		$this->load->model('SitemapIndex_Model');
		$this->load->model('Sitemap_Model');
		$this->load->helper("seo_url");
	}

	public function index()
	{
		header("Content-type: text/xml");
		$currentDate = date('Y-m-d');
		/*// create new instance
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
		$sitemap['categorylist'] = $url;
		$sitemap['currentDate'] = $currentDate;
		*/
		$sitemapindex = $this->SitemapIndex_Model->findAll();
		$data['items'] = $sitemapindex;
		$this->load->view('/sitemap/sitemap_index', $data);
		// first load the library

	}

	function viewItems($sitemapIndexId){
		header("Content-type: text/xml");
		$currentDate = date('Y-m-d');
		$data['items'] = $this->Sitemap_Model->findAllBySitemapIndexId($sitemapIndexId);
		$data['currentDate'] = $currentDate;
		$this->load->view('/sitemap/item_view', $data);
	}

	function publish2SearchEngine(){

		$isProductionServer = strpos(base_url(), "tindatdai");
		if($isProductionServer){
			$sitemapUrl = 'https:'.base_url('sitemap.xml');

			$sitemapUrl = htmlentities($sitemapUrl);
			//Google
			$url = "http://www.google.com/webmasters/sitemaps/ping?sitemap=".$sitemapUrl;
			$this->SubmitSiteMap($url);

			//Bing / MSN
			$url = "http://www.bing.com/webmaster/ping.aspx?siteMap=".$sitemapUrl;
			$this->SubmitSiteMap($url);

			// Ask
			$url = "http://submissions.ask.com/ping?sitemap=".$sitemapUrl;
			$this->SubmitSiteMap($url);

			// Live
			$url = "http://webmaster.live.com/ping.aspx?siteMap=".$sitemapUrl;
			$this->SubmitSiteMap($url);

			// moreover
			$url = "http://api.moreover.com/ping?sitemap=".$sitemapUrl;
			$this->SubmitSiteMap($url);

			$this->SitemapIndex_Model->updatePingDate();
		}
	}

	function Submit($url){
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		return $httpCode;
	}

	function SubmitSiteMap($url) {
		$returnCode = $this->Submit($url);
		if ($returnCode != 200) {
			echo "Error $returnCode: $url <BR/>";
		} else {
			echo "Submitted $returnCode: $url <BR/>";
		}
	}
}
