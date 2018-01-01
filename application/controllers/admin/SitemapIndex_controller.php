<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 12/28/2017
 * Time: 10:48 AM
 */
class SitemapIndex_controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('loginid') && $this->session->userdata('usergroup') != 'ADMIN'){
			redirect('dang-nhap');
		}
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper("seo_url");
		$this->load->model('Sitemap_Model');
		$this->load->library('pagination');
		$this->load->model('SitemapIndex_Model');
		$this->load->helper('form');
		$this->load->helper("bootstrap_pagination_admin");
	}

	public function index($lookbackDays = 1){
		$products = $this->Sitemap_Model->findProductNotIndexYet($lookbackDays);
		if(count($products) > 0){

			$sitemapIndex = array(
				"LastModified" => date('Y-m-d H:i:s'),
				"TotalItem" => count($products)
			);

			$sitemap_index_id = $this->SitemapIndex_Model->save($sitemapIndex);
			if($sitemap_index_id != null && $sitemap_index_id > 0){
				foreach ($products as $product){
					$sitemap = array(
						"SitemapIndexID" => $sitemap_index_id,
						"ProductID" => $product->ProductID,
						"Url" => base_url(seo_url($product->Title).'-p'.$product->ProductID.'.html'),
						"LastModified" => $product->PostDate,
						"ChangeFrequency" => "weekly",
						"Priority" => 0.3
					);
					$this->Sitemap_Model->save($sitemap);
				}
			}
		}
		redirect("/admin/sitemap/list");
		//$this->load->view('/admin/sitemap/generator');
	}

	public function xmlView($sitemapIndexId)
	{
		header("Content-type: text/xml");
		$currentDate = date('Y-m-d');
		$data['items'] = $this->Sitemap_Model->findAllBySitemapIndexId($sitemapIndexId);
		$data['currentDate'] = $currentDate;
		$this->load->view('admin/sitemap/xmlview', $data);
	}

	function listItems($offset=0){
		$crudaction =  $this->input->post("crudaction");
		$result = array();
		if($crudaction != null && $crudaction == DELETE){
			$sitemapId = $this->input->post("sitemapId");
			if($sitemapId != null && $sitemapId > 0){
				$this->SitemapIndex_Model->deleteByIndexId($sitemapId);
				$result['message_response'] = 'Xóa thành công.';
			}
		}
		$searchResults = $this->SitemapIndex_Model->searchByProperties($offset, MAX_PAGE_ITEM);
		$result = array_merge($searchResults, $result);
		$this->load->view("admin/sitemap/list", $result);
	}

	function viewItems($sitemapIndexId){
		$config = pagination($this);
		$crudaction =  $this->input->post("crudaction");
		if($crudaction != null && $crudaction == DELETE){
			$productId = $this->input->post("productId");
			if($productId != null && $productId > 0){
				$this->Sitemap_Model->deleteByProductId($productId);
				$data['message_response'] = 'Xóa thành công.';
			}
		}
		$config['base_url'] = base_url('admin/sitemap/view-'.$sitemapIndexId.'.html');
		$results = $this->Sitemap_Model->findBySitemapIndexId($sitemapIndexId, $config['page'], $config['per_page']);
		$data['products'] = $results['items'];
		$config['total_rows'] = $results['total'];

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['sitemapIndexID'] = $sitemapIndexId;

		$this->load->view("admin/sitemap/view", $data);
	}
}
