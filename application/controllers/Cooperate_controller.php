<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 10/30/2017
 * Time: 4:32 PM
 */
class Cooperate_controller extends CI_Controller
{
	private $allowed_img_types;
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('loginid')){
			// redirect('dang-nhap');
			$this->session->set_userdata('loginid', 0);
		}
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('date');
		$this->load->library('form_validation');
		$this->load->model('Category_Model');
		$this->load->helper("seo_url");
		$this->load->model('City_Model');
		$this->load->model('User_Model');
		$this->load->model('District_Model');
		$this->load->model('Ward_Model');
		$this->load->model('Unit_Model');
		$this->load->model('Brand_Model');
		$this->load->model('Product_Model');
		$this->load->model('Direction_Model');
		$this->load->model('Cooperate_Model');
		$this->load->helper("bootstrap_pagination");
		$this->load->library('pagination');
		$this->allowed_img_types = $this->config->item('allowed_img_types');
	}

	public function index($offset=0)
	{
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
		// end file cached

		$cities = $this->cache->file->get('cities');
		if(!$cities){
			$cities = $this->City_Model->getAllActive();
			$this->cache->file->save('cities', $cities, 1440);
		}
		$data['cities'] = $cities;

		$search_data = $this->Cooperate_Model->searchByProperties($offset, MAX_PAGE_ITEM);
		$data = array_merge($data, $search_data);
		$config = pagination();
		$config['base_url'] = base_url('hop-tac.html');
		$config['total_rows'] = $data['total'];
		$config['per_page'] = MAX_PAGE_ITEM;

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('/cooperate/list', $data);
	}

	public function detail($cooperateID){
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
		// end file cached

		$cities = $this->cache->file->get('cities');
		if(!$cities){
			$cities = $this->City_Model->getAllActive();
			$this->cache->file->save('cities', $cities, 1440);
		}
		$data['cities'] = $cities;

		$post = $this->Cooperate_Model->findById($cooperateID);
		$data['cooperate'] = $post;
		$this->Cooperate_Model->updateViewForCooperate($cooperateID);
		$this->load->view('cooperate/detail', $data);
	}

	public function done($postId){
		$data = $this->Category_Model->getCategories();
		$post = $this->Cooperate_Model->findById($postId);
		$data['cooperate'] = $post;
		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();
		$data['cities'] = $this->City_Model->getAllActive();
		$this->load->view('cooperate/done', $data);
	}

	public function add()
	{
		$data = $this->Category_Model->getCategories();
		if($this->session->userdata('loginid') != null &&  $this->session->userdata('loginid') > 0){
			$user = $this->User_Model->getUserById($this->session->userdata('loginid'));
			$data['user'] = $user;
		}
		if ($this->input->post('crudaction') == "add_new") {
			//set validations
			$this->form_validation->set_rules("txt_title", "Tiêu đề", "trim|required");
			$this->form_validation->set_rules("txt_price", "Giá", "numeric");
			$this->form_validation->set_rules("txt_area", "Diện tích", "numeric");
			$this->form_validation->set_rules("txt_city", "Thành phố", "required|numeric");
			$this->form_validation->set_rules("txt_district", "Quận", "required|numeric");
			$this->form_validation->set_rules("txt_ward", "Phường", "numeric");
			$this->form_validation->set_rules("txt_street", "Đường", "required");
			$this->form_validation->set_rules("txt_fullname", "Người liên hệ", "required");
			$this->form_validation->set_rules("txt_phone", "Số điện thoại", "required");
			$this->form_validation->set_rules("txt_email", "Email", "valid_email");
			$this->form_validation->set_rules("description", "Mô tả", "required");

			$data['title'] = $this->input->post("txt_title");
			$data['price'] = $this->input->post("txt_price");
			$data['area'] = $this->input->post("txt_area");
			$data['city'] = $this->input->post("txt_city");
			$data['district'] = $this->input->post("txt_district");
			$data['ward'] = $this->input->post("txt_ward");
			$data['street'] = $this->input->post("txt_street");
			$data['description'] = $this->input->post("description");
			$data['unit'] = $this->input->post("txt_unit");
			$data['image'] = $this->input->post("image");
			$data['contact_name'] = $this->input->post("txt_fullname");
			$data['contact_phone'] = $this->input->post("txt_phone");
			$data['contact_address'] = $this->input->post("txt_address");
			$data['txt_email'] = $this->input->post("txt_email");

			$img = $this->uploadImage();
			if($img != null){
				$data['image'] = $img;
			}
			if($data['image'] == null){
				$this->form_validation->set_rules("txt_userfile", "Hình đại diện", "required");
			}

			$validateResult = $this->form_validation->run();
			if ($validateResult == FALSE) {
				if($data['city'] != null && $data['city'] > 0){
					$data['districts'] = $this->District_Model->findByCityId($data['city']);
				}
				if($data['district'] != null && $data['district'] > 0){
					$data['wards'] = $this->Ward_Model->findByDistrictId($data['district']);
				}
				$data['error_message'] = 'Dữ liệu chưa hợp lệ, vui lòng kiểm tra các thông tin bên dưới.';
			}else{
				$data['ipaddress'] = $this->input->ip_address();
				$data['address'] = $this->buildAddress($data['street'], $data['ward'], $data['district'], $data['city']);
				$data['CreatedByID'] = $this->session->userdata('loginid');
				$data['code'] = $this->session->userdata('uuid');

				$ok = $this->Cooperate_Model->saveNewPost($data);
				if($ok) {
					// Save successful
					redirect("dang-bai-thanh-cong-cp" . $ok);
				}
			}
		}else{
			$this->session->set_userdata("uuid", uniqid());
			if($this->session->userdata('loginid') != null && isset($user)) {
				$data['contact_name'] = $user->FullName;
				$data['contact_phone'] = $user->Phone;
				$data['txt_email'] = $user->Email;
				$data['contact_address'] = $user->Address;
			}
		}

		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();
		$data['cities'] = $this->City_Model->getAllActive();
		$data['units'] = $this->Unit_Model->findAll();

		$this->load->view('cooperate/new', $data);
	}

	private function uploadImage(){
		if(!empty($this->input->post("txt_userfile"))){
			return $this->input->post("txt_userfile");
		}else{
			$upath = 'cooperates' . DIRECTORY_SEPARATOR .'u'. $_POST['txt_folder'] . DIRECTORY_SEPARATOR. $this->session->userdata('uuid'). DIRECTORY_SEPARATOR;
			if (!file_exists($upath)) {
				mkdir($upath, 0777, true);
			}

			$config['upload_path'] = $upath;
			$config['allowed_types'] = $this->allowed_img_types;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('txt_userfile')) {
				log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
			}
			$img = $this->upload->data();
			if ($img['file_name'] != null) {
				// Resize image
				$this->load->library('image_lib');
				$config['image_library'] = 'gd2';
				$config['source_image'] = $upath.$img['file_name'];
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']     = 300;

				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->image_lib->resize();

				$imgDetailArray = explode('.', $img['file_name']);
				$thumbimgname = $imgDetailArray[0].'_thumb'.'.'.$imgDetailArray[1];

				unlink($upath.$img['file_name']);
				return "/".$upath.$thumbimgname;
			}
		}
	}

	private function buildAddress($street, $wardId, $districtId, $cityId){
		$address = "";
		if($street != null && count($street) > 0){
			$address .= $street.', ';
		}
		if($wardId != null && $wardId > 0){
			$ward = $this->Ward_Model->findById($wardId);
			$address .= $ward->WardName.', ';
		}
		if($districtId != null && $districtId > 0){
			$district = $this->District_Model->findById($districtId);
			$address .= $district->DistrictName.', ';
		}
		if($cityId != null && $cityId > 0){
			$city = $this->City_Model->findById($cityId);
			$address .= $city->CityName.', ';
		}
		if(count($address) > 2){
			$address = substr($address, 0, count($address) - 3);
		}

		return $address;
	}
}
