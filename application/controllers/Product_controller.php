<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/20/2017
 * Time: 11:27 AM
 */
class Product_controller extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->model('Category_Model');
		$this->load->model('Product_Model');
		$this->load->model('City_Model');
		$this->load->model('District_Model');
		$this->load->model('News_Model');
		$this->load->model('SampleHouse_Model');
		$this->load->model('Brand_Model');
		$this->load->helper("seo_url");
		$this->load->helper("my_date");
		$this->load->helper("bootstrap_pagination");
		$this->load->library('pagination');
		$this->load->helper('form');
	}

	public function listItem($catId, $offset=0) {
		$data = $this->Category_Model->getCategories();
		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();
		$search_data = $this->Product_Model->findByCatIdFetchAddress($catId, $offset, MAX_PAGE_ITEM);


		$data = array_merge($data, $search_data);

		$thisCat = $this->Category_Model->findById($catId);
		$data['category'] = $thisCat;
		$data['sameLevels'] = $this->Category_Model->findByParentId($thisCat->ParentID, $catId);

		$config = pagination();
		$config['base_url'] = base_url(seo_url($data['category']->CatName).'-c'.$catId.'.html');
		$config['total_rows'] = $data['total'];
		$config['per_page'] = MAX_PAGE_ITEM;

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['cities'] = $this->City_Model->getAllActive();
		$data['topNews'] = $this->News_Model->findTopNewExceptCurrent(0, 5);
		$data['cityWithCats'] = $this->City_Model->findCityByCategoryId($catId);

		$this->load->helper('url');
		$this->load->view('product/Product_list', $data);
	}

	public function detailItem($productId) {
		$product = $this->Product_Model->findByIdFetchAll($productId);
		if(!isset($product) || $product->ProductID == null){
			redirect("/khong-tim-thay");
		}
		$data = $this->Category_Model->getCategories();
		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();
		$product = $this->Product_Model->findByIdFetchAll($productId);
		$category =  $this->Category_Model->findById($product->CategoryID);
		$data['category'] = $category;
		$data['product'] = $product;
		$data['district'] = $this->District_Model->findById($product->DistrictID);
		$data['cities'] = $this->City_Model->getAllActive();
		$data['sampleHouses'] = $this->SampleHouse_Model->findTopNewExceptCurrent(0, 5);
		if($product->DistrictID != null) {
			$similarPros = $this->Product_Model->findByCatIdAndDistrictIdFetchAddressNotCurrent($product->CategoryID, $product->DistrictID, 10, $productId);
			if(count($similarPros)%2 != 0){
				unset($similarPros[0]);
			}
			$data['similarProducts'] = $similarPros;
			if(count($similarPros) < 1){
				$similarCityPros = $this->Product_Model->findByCatIdAndCityIdFetchAddressNotCurrent($product->CategoryID, $product->CityID, 10, $productId);
				if(count($similarCityPros)%2 != 0){
					unset($similarCityPros[0]);
				}
				$data['similarCityProducts'] = $similarCityPros;
				$data['city'] = $this->City_Model->findById($product->CityID);
			}
		}
		if($product->BrandID != null){
			$data['branch'] = $this->Brand_Model->findByIdHasImage($product->BrandID);
		}

		$googleBoot = false;
		if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), "googlebot"))
		{
			$googleBoot = true;
		}
		$this->Product_Model->updateViewForProductId($productId);
		if($product->CreatedByID != null && $product->CreatedByID > 0){
			$data['totalProductWithThisUser'] = $this->Product_Model->countProductWithUser($product->CreatedByID);
		}

		$this->load->helper('url');

		//load the same parent category
		$data['sameLevels'] = $this->Category_Model->findByParentId($category->ParentID, $category->CategoryID);

		$this->load->view('product/Product_detail', $data);
	}

	public function justUpdateItems($offset=0) {
		$data = $this->Category_Model->getCategories();
		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();

		$totalProduct = $this->Product_Model->countAllProduct();
		$justUpdateItems = $this->Product_Model->findJustUpdate($offset, MAX_PAGE_ITEM);
		$data['products'] = $justUpdateItems;

		$config = pagination();
		$config['base_url'] = base_url('/bat-dong-san-moi-cap-nhat.html');
		$config['total_rows'] = $totalProduct;
		$config['per_page'] = MAX_PAGE_ITEM;

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['cities'] = $this->City_Model->getAllActive();
		$data['topNews'] = $this->News_Model->findTopNewExceptCurrent(0, 5);
		$data['topcityhasproduct'] = $this->City_Model->findTopCityHasProduct(20);
		$data['topbranchhasproduct'] = $this->Brand_Model->findTopBranchHasProduct(20);

		$this->load->helper('url');
		$this->load->view('product/Product_just_update', $data);
	}

	public function underOneBillion($offset=0){
		$data = $this->Category_Model->getCategories();
		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();

		$totalProduct = $this->Product_Model->countProductUnderOneBillion();
		$underOneBillionItems = $this->Product_Model->findUnderOneBillion($offset, MAX_PAGE_ITEM);
		$data['products'] = $underOneBillionItems;

		$config = pagination();
		$config['base_url'] = base_url('/nha-dat-duoi-mot-ty.html');
		$config['total_rows'] = $totalProduct;
		$config['per_page'] = MAX_PAGE_ITEM;

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['cities'] = $this->City_Model->getAllActive();
		$data['topNews'] = $this->News_Model->findTopNewExceptCurrent(0, 5);
		$data['topcityhasproduct'] = $this->City_Model->findTopCityHasProduct(20);
		$data['topbranchhasproduct'] = $this->Brand_Model->findTopBranchHasProduct(20);

		$this->load->helper('url');
		$this->load->view('product/Product_under_one_billion', $data);
	}
}
