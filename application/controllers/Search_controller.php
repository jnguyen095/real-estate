<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 8/26/2017
 * Time: 5:42 PM
 */
class Search_controller extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('Category_Model');
		$this->load->model('Product_Model');
		$this->load->model('City_Model');
		$this->load->model('Brand_Model');
		$this->load->model('District_Model');
		$this->load->model('User_Model');
		$this->load->helper("seo_url");
		$this->load->helper('text');
		$this->load->helper("my_date");
		$this->load->helper("bootstrap_pagination");
		$this->load->library('pagination');
		$this->load->helper('form');
		$this->load->library('session');
	}

	public function index($offset=0){
		// begin file cached
		$this->load->driver('cache');
		$categories = $this->cache->file->get('category');
		$footerMenus = $this->cache->file->get('footer');
		if(!$categories){
			$categories = $this->Category_Model->getCategories();
			$this->cache->file->save('category', $categories, 1440);
		}
		if(!$footerMenus) {
			$footerMenus = $this->City_Model->findByTopProductOfCategoryGroupByCity();
			$this->cache->file->save('footer', $footerMenus, 1440);
		}
		$data = $categories;
		$data['footerMenus'] = $footerMenus;

		$cities = $this->cache->file->get('cities');
		if(!$cities){
			$cities = $this->City_Model->getAllActive();
			$this->cache->file->save('cities', $cities, 1440);
		}
		$data['cities'] = $cities;
		// end file cached

		$keyword = $this->input->post("keyword");
		$query = $this->input->get("query");
		$type = $this->input->get("type");
		if($query){
			$keyword = $query;
		}

		if($offset == 0){
			$catId = $this->input->post("cmCatId");
			$cityId = $this->input->post("cmCityId");
			$districtId = $this->input->post("cmDistrictId");
			$area = $this->input->post("cmArea");
			$price = $this->input->post("cmPrice");
			if($type == "sale"){
				$catId = 257;
			}else if($type == "rent"){
				$catId = 267;
			}

			$searchFilters = array(
				'cmCatId' => $catId,
				'cmCityId' => $cityId,
				'cmDistrictId' => $districtId,
				'cmArea' => $area,
				'cmPrice' => $price
			);
			$this->session->set_userdata($searchFilters);
		}else{
			$catId = $this->session->userdata("cmCatId");
			$cityId = $this->session->userdata("cmCityId");
			$districtId = $this->session->userdata("cmDistrictId");
			$price = $this->session->userdata("cmPrice");
			$area = $this->session->userdata("cmArea");
		}


		$data['keyword'] = $keyword;
		$data['cmCatId'] = $catId;
		$data['cmCityId'] = $cityId;
		$data['cmDistrictId'] = $districtId;
		$data['cmArea'] = $area;
		$data['cmPrice'] = $price;

		$search_data = $this->Product_Model->searchByProperties($keyword, $catId, $cityId, $districtId, $area, $price, $offset, MAX_PAGE_ITEM);
		$data = array_merge($data, $search_data);
		$config = pagination();
		$config['base_url'] = base_url('tim-kiem.html');
		$config['total_rows'] = $data['total'];
		$config['per_page'] = MAX_PAGE_ITEM;

		if($catId != null && $catId > 0){
			$category = $this->Category_Model->findByNotChildId($catId);
			$data['category'] = $category;
		}
		if($cityId != null && $cityId > 0){
			$city = $this->City_Model->findById($cityId);
			$data['scity'] = $city;
			if($districtId == null || $districtId < 1){
				$data['sdistricts'] = $this->District_Model->findByCityId($cityId);
			}

		}
		if($districtId != null && $districtId > 0){
			$district = $this->District_Model->findById($districtId);
			$data['sdistrict'] = $district;
		}

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$this->load->helper('url');

		if($cityId != null && $cityId > -1) {
			if($catId != null && $catId > 0){
				$data['districtWithCategory'] = $this->District_Model->findByCatIdCityIdHasProduct($catId, $cityId);
			}else{
				$data['districts'] = $this->District_Model->findByCityId($cityId);
				$data['topdistricthasproduct'] = $data['districts'];
			}
		}

		$this->load->view('/search/Search_view', $data);
	}

	public function searchByCity($cityId, $offset=0) {
		// begin file cached
		$this->load->driver('cache');
		$categories = $this->cache->file->get('category');
		$footerMenus = $this->cache->file->get('footer');
		if(!$categories){
			$categories = $this->Category_Model->getCategories();
			$this->cache->file->save('category', $categories, 1440);
		}
		if(!$footerMenus) {
			$footerMenus = $this->City_Model->findByTopProductOfCategoryGroupByCity();
			$this->cache->file->save('footer', $footerMenus, 1440);
		}
		$data = $categories;
		$data['footerMenus'] = $footerMenus;

		$cities = $this->cache->file->get('cities');
		if(!$cities){
			$cities = $this->City_Model->getAllActive();
			$this->cache->file->save('cities', $cities, 1440);
		}
		$data['cities'] = $cities;
		// end file cached

		$data['city'] = $this->City_Model->findById($cityId);
		$data['cmCityId'] = $cityId;
		$districts = $this->District_Model->findByCityId($cityId);
		$data['districts'] = $districts;
		$search_data = $this->Product_Model->findByCityIdFetchAddress($cityId, $offset, MAX_PAGE_ITEM);
		$data = array_merge($data, $search_data);
		$config = pagination();
		$config['base_url'] = base_url(seo_url($data['city']->CityName).'-ct'.$cityId.'.html');
		$config['total_rows'] = $data['total'];
		$config['per_page'] = MAX_PAGE_ITEM;
		$data['topdistricthasproduct'] = $districts;

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$this->load->helper('url');
		$this->load->view('/search/Search_view', $data);
	}

	public function searchByDistrict($districtId, $offset=0) {
		// begin file cached
		$this->load->driver('cache');
		$categories = $this->cache->file->get('category');
		$footerMenus = $this->cache->file->get('footer');
		if(!$categories){
			$categories = $this->Category_Model->getCategories();
			$this->cache->file->save('category', $categories, 1440);
		}
		if(!$footerMenus) {
			$footerMenus = $this->City_Model->findByTopProductOfCategoryGroupByCity();
			$this->cache->file->save('footer', $footerMenus, 1440);
		}
		$data = $categories;
		$data['footerMenus'] = $footerMenus;

		$cities = $this->cache->file->get('cities');
		if(!$cities){
			$cities = $this->City_Model->getAllActive();
			$this->cache->file->save('cities', $cities, 1440);
		}
		$data['cities'] = $cities;
		// end file cached

		$district = $this->District_Model->findById($districtId);
		$data['district'] = $district;
		$data['city'] = $this->City_Model->findById($district->CityID);
		$data['cmCityId'] = $district->CityID;
		$data['cmDistrictId'] = $districtId;
		$districts = $this->District_Model->findByCityId($district->CityID);
		$data['districts'] = $districts;
		$search_data = $this->Product_Model->findByDistrictIdFetchAddress($districtId, $offset, MAX_PAGE_ITEM);
		$data = array_merge($data, $search_data);
		$config = pagination();
		$config['base_url'] = base_url(seo_url($district->DistrictName).'-dt'.$districtId.'.html');
		$config['total_rows'] = $data['total'];
		$config['per_page'] = MAX_PAGE_ITEM;
		$data['topdistricthasproduct'] = $districts;

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$this->load->helper('url');
		$this->load->view('/search/Search_view', $data);
	}

	public function searchByBranch($branchId, $offset=0) {
		// begin file cached
		$this->load->driver('cache');
		$categories = $this->cache->file->get('category');
		$footerMenus = $this->cache->file->get('footer');
		if(!$categories){
			$categories = $this->Category_Model->getCategories();
			$this->cache->file->save('category', $categories, 1440);
		}
		if(!$footerMenus) {
			$footerMenus = $this->City_Model->findByTopProductOfCategoryGroupByCity();
			$this->cache->file->save('footer', $footerMenus, 1440);
		}
		$data = $categories;
		$data['footerMenus'] = $footerMenus;

		$cities = $this->cache->file->get('cities');
		if(!$cities){
			$cities = $this->City_Model->getAllActive();
			$this->cache->file->save('cities', $cities, 1440);
		}
		$data['cities'] = $cities;
		// end file cached

		$data['branch'] = $this->Brand_Model->findById($branchId);
		$search_data = $this->Product_Model->findByBranchIdFetchAddress($branchId, $offset, MAX_PAGE_ITEM);
		$data = array_merge($data, $search_data);
		$config = pagination();
		$config['base_url'] = base_url(seo_url($data['branch']->BrandName).'-b'.$branchId.'.html');
		$config['total_rows'] = $data['total'];
		$config['per_page'] = MAX_PAGE_ITEM;

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['topbranchhasproduct'] = $this->Brand_Model->findTopBranchHasProduct(15);
		$this->load->helper('url');
		$this->load->view('/search/Search_view', $data);
	}

	public function searchByCategoryAndCity($catId, $cityId, $offset=0){
		// begin file cached
		$this->load->driver('cache');
		$categories = $this->cache->file->get('category');
		$footerMenus = $this->cache->file->get('footer');
		if(!$categories){
			$categories = $this->Category_Model->getCategories();
			$this->cache->file->save('category', $categories, 1440);
		}
		if(!$footerMenus) {
			$footerMenus = $this->City_Model->findByTopProductOfCategoryGroupByCity();
			$this->cache->file->save('footer', $footerMenus, 1440);
		}
		$data = $categories;
		$data['footerMenus'] = $footerMenus;

		$cities = $this->cache->file->get('cities');
		if(!$cities){
			$cities = $this->City_Model->getAllActive();
			$this->cache->file->save('cities', $cities, 1440);
		}
		$data['cities'] = $cities;
		// end file cached

		$category = $this->Category_Model->findByNotChildId($catId);
		$city = $this->City_Model->findById($cityId);
		$data['cat_city'] = $category->CatName.' tại '.$city->CityName;

		$search_data = $this->Product_Model->findByCatIdAndCityIdFetchAddress($catId, $cityId, $offset, MAX_PAGE_ITEM);
		$data = array_merge($data, $search_data);
		$config = pagination();
		$config['base_url'] = base_url(seo_url($category->CatName).'-'.seo_url($city->CityName).'-cc'.$catId.'-'.$cityId.'.html');
		$config['total_rows'] = $data['total'];
		$config['per_page'] = MAX_PAGE_ITEM;
		$data['cmCityId'] = $cityId;
		$data['cmCatId'] = $catId;
		$data['districts'] = $this->District_Model->findByCityId($cityId);
		$data['districtWithCategory'] = $this->District_Model->findByCatIdCityIdHasProduct($catId, $cityId);
		$data['category'] = $category;

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$this->load->helper('url');
		$this->load->view('/search/Search_view', $data);
	}

	public function searchByCategoryAndDistrict($catId, $districtId, $offset=0){
		// begin file cached
		$this->load->driver('cache');
		$categories = $this->cache->file->get('category');
		$footerMenus = $this->cache->file->get('footer');
		if(!$categories){
			$categories = $this->Category_Model->getCategories();
			$this->cache->file->save('category', $categories, 1440);
		}
		if(!$footerMenus) {
			$footerMenus = $this->City_Model->findByTopProductOfCategoryGroupByCity();
			$this->cache->file->save('footer', $footerMenus, 1440);
		}
		$data = $categories;
		$data['footerMenus'] = $footerMenus;

		$cities = $this->cache->file->get('cities');
		if(!$cities){
			$cities = $this->City_Model->getAllActive();
			$this->cache->file->save('cities', $cities, 1440);
		}
		$data['cities'] = $cities;
		// end file cached

		$category = $this->Category_Model->findByNotChildId($catId);
		$district = $this->District_Model->findById($districtId);
		$city = $this->City_Model->findById($district->CityID);
		$search_data = $this->Product_Model->findByCatIdAndDistrictId($catId, $districtId, $offset, MAX_PAGE_ITEM);
		$data = array_merge($data, $search_data);
		$config = pagination();
		$config['base_url'] = base_url(seo_url($category->CatName).'-'.seo_url($district->DistrictName).'-c'.$catId.'-d'.$districtId.'.html');
		$config['total_rows'] = $data['total'];
		$config['per_page'] = MAX_PAGE_ITEM;
		$data['cmCityId'] = $district->CityID;
		$data['cmCatId'] = $catId;
		$data['cmDistrictId'] = $districtId;
		$data['districts'] = $this->District_Model->findByCityId($district->CityID);
		$data['sdistrict'] = $district;
		$data['scity'] = $city;
		$data['category'] = $category;
		$data['districtWithCategory'] = $this->District_Model->findByCatIdCityIdHasProduct($catId, $district->CityID);

		$data['cat_city_dic'] = $category->CatName.' tại quận '.$district->DistrictName.', '.$city->CityName;

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$this->load->helper('url');
		$this->load->view('/search/Search_view', $data);
	}

	public function searchBySameUser($userId, $offset=0){
		// begin file cached
		$this->load->driver('cache');
		$categories = $this->cache->file->get('category');
		$footerMenus = $this->cache->file->get('footer');
		if(!$categories){
			$categories = $this->Category_Model->getCategories();
			$this->cache->file->save('category', $categories, 1440);
		}
		if(!$footerMenus) {
			$footerMenus = $this->City_Model->findByTopProductOfCategoryGroupByCity();
			$this->cache->file->save('footer', $footerMenus, 1440);
		}
		$data = $categories;
		$data['footerMenus'] = $footerMenus;

		$cities = $this->cache->file->get('cities');
		if(!$cities){
			$cities = $this->City_Model->getAllActive();
			$this->cache->file->save('cities', $cities, 1440);
		}
		$data['cities'] = $cities;
		// end file cached


		$data['userAuthor'] = $this->User_Model->getUserById($userId);
		$search_data = $this->Product_Model->findUserId($offset, MAX_PAGE_ITEM, $userId);
		$data = array_merge($data, $search_data);
		$config = pagination();
		$config['base_url'] = base_url(seo_url('bat-dong-san-cua').'-'.seo_url($data['userAuthor']->FullName).'-u'.$data['userAuthor']->Us3rID.'.html');
		$config['total_rows'] = $data['total'];
		$config['per_page'] = MAX_PAGE_ITEM;

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$this->load->helper('url');
		$this->load->view('/search/Search_view', $data);
	}
}
