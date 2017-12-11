<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 8/9/2017
 * Time: 2:15 PM
 */
class Post_controller extends CI_Controller
{
	private $allowed_img_types;
	public function __construct()
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
		$this->load->helper('captcha');
		$this->load->model('City_Model');
		$this->load->model('User_Model');
		$this->load->model('District_Model');
		$this->load->model('Ward_Model');
		$this->load->model('Unit_Model');
		$this->load->model('Brand_Model');
		$this->load->model('Product_Model');
		$this->load->model('Direction_Model');
		$this->load->model('Transfer_Model');
		$this->load->helper('security');
		$this->load->library('email'); // load the library
	}

	public function sendMail()
	{
		// Email configuration
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.gmail.com.',
			'smtp_port' => 465,
			'smtp_user' => 'tindatdai@gmail.com', // change it to yours
			'smtp_pass' => '12345678@Xx', // change it to yours
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE
		);

		$this->load->library('email', $config);
		$this->email->from('tindatdai@gmail.com', "Tin Đất Đai");
		$this->email->to("nhukhang095@gmail.com");
		// $this->email->cc("testcc@domainname.com");
		$this->email->subject("This is test subject line");
		$this->email->message("Mail sent test message...");

		$data['message'] = "Sorry Unable to send email...";
		if ($this->email->send()) {
			$data['message'] = "Mail sent...";
		}
	}

	public function index()
	{
		$data = $this->Category_Model->getCategories();
		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();
		$data['cities'] = $this->City_Model->getAllActive();
		if($this->session->userdata('loginid') != null) {
			$user = $this->User_Model->getUserById($this->session->userdata('loginid'));
			$data['user'] = $user;
		}
		$data['units'] = $this->Unit_Model->findAll();
		$data['brands'] = $this->Brand_Model->findAll();
		$data['directions'] = $this->Direction_Model->findAll();
		$this->allowed_img_types = $this->config->item('allowed_img_types');

		if ($this->input->post('crudaction') == "add_new") {
			$this->processSaveNewPost($data, 'add');
		} else {
			$this->session->set_userdata("uuid", uniqid());
			$phoneNumber = null;
			if($this->session->userdata('loginid') != null && isset($user)) {
				$data['contact_name'] = $user->FullName;
				$data['contact_phone'] = $user->Phone;
				$data['txt_email'] = $user->Email;
				$data['contact_address'] = $user->Address;
				$phoneNumber = $user->Phone;
			}
			$data['postCost'] = 0;
			$data['from_date'] = date("d/m/Y");
			$date = strtotime('+1 months');
			$data['to_date'] = date("d/m/Y", $date);

			$ipAddress = $this->input->ip_address();
			$postToday = $this->Product_Model->findPostWithPackageToday($ipAddress, $phoneNumber, PRODUCT_STANDARD);
			if($postToday >= MAX_POST_PER_DAY){
				if(isset($user) && $user->AvailableMoney > 0) {
					$captcha = $this->generatedCapcha();
					$data['capchaImg'] = $captcha['image'];
					$this->session->set_userdata('captcha', $captcha['word']);

					$this->load->view('post/new', $data);
				}else{
					$this->load->view('post/limit', $data);
				}
			}else{
				$captcha = $this->generatedCapcha();
				$data['capchaImg'] = $captcha['image'];
				$this->session->set_userdata('captcha', $captcha['word']);

				$this->load->view('post/new', $data);
			}
		}
	}

	public function edit($productId){

		$data = $this->Category_Model->getCategories();
		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();
		$data['cities'] = $this->City_Model->getAllActive();
		if($this->session->userdata('loginid') != null) {
			$data['user'] = $this->User_Model->getUserById($this->session->userdata('loginid'));
		}
		$data['units'] = $this->Unit_Model->findAll();
		$data['brands'] = $this->Brand_Model->findAll();
		$data['directions'] = $this->Direction_Model->findAll();

		if ($this->input->post('crudaction') == "update_post") {
			$this->processUpdatePost($data, 'edit');
		}else{
			$product = $this->Product_Model->findByIdFetchAll($productId);
			$this->session->set_userdata("uuid", $product->code);
			$data['productId'] = $product->ProductID;
			$data['title'] = $product->Title;
			$data['categoryID'] = $product->CategoryID;
			$data['price'] = explode(' ', $product->Price)[0];
			$data['area'] = explode(' ', $product->Area)[0];
			$data['city'] = $product->CityID;
			$data['district'] = $product->DistrictID;
			$data['ward'] = $product->WardID;
			$data['street'] = $product->Street;
			$data['description'] = $product->Detail;
			$data['unit'] = $product->UnitID;
			$data['brand'] = $product->BrandID;
			$data['direction'] = $product->DirectionID;
			$data['width'] = $product->WidthSize;
			$data['long'] = $product->LongSize;
			$data['room'] = $product->Room;
			$data['floor'] = $product->Floor;
			$data['toilet'] = $product->Toilet;
			$data['contact_name'] = $product->ContactName;
			$data['contact_phone'] = $product->ContactPhone;
			$data['contact_address'] = $product->ContactAddress;
			$data['txt_email'] = $product->ContactEmail;
			$data['lat'] = $product->Latitude;
			$data['lng'] = $product->Longitude;
			$data['address'] = $product->Address;

			$data['districts'] = $this->District_Model->findByCityId($product->CityID);
			$data['wards'] = $this->Ward_Model->findByDistrictId($product->DistrictID);
			$_POST['txt_folder'] = $this->session->userdata('loginid');
			$data['other_images'] = $this->loadOthersImages();
			$data['image'] = $product->Thumb;

			$this->load->view('post/edit', $data);
		}
	}

	public function done($productId){
		$data = $this->Category_Model->getCategories();
		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();
		$success = $this->Product_Model->changeStatusPost($productId, ACTIVE);
		$product = $this->Product_Model->findByIdFetchAll($productId);
		$data['product'] = $product;
		$data['result'] = $success;
		$this->load->view('post/done', $data);
	}

	public function preview($productId){
		$data = $this->Category_Model->getCategories();
		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();
		$product = $this->Product_Model->findByIdFetchAll($productId);
		$data['category'] = $this->Category_Model->findById($product->CategoryID);
		$data['product'] = $product;

		$this->load->helper('url');
		$this->load->view('post/preview', $data);
	}

	private function processSaveNewPost($data, $type){
		try{
			// get posted values
			$data['title'] = $this->input->post("txt_title");
			$data['categoryID'] = $this->input->post("sl_category");
			$data['price'] = $this->input->post("txt_price");
			$data['area'] = $this->input->post("txt_area");
			$data['city'] = $this->input->post("txt_city");
			$data['district'] = $this->input->post("txt_district");
			$data['ward'] = $this->input->post("txt_ward");
			$data['street'] = $this->input->post("txt_street");
			$data['description'] = $this->input->post("description");
			$data['unit'] = $this->input->post("txt_unit");
			$data['brand'] = $this->input->post("txt_brand");
			$data['direction'] = $this->input->post("txt_direction");
			$data['width'] = $this->input->post("txt_width");
			$data['long'] = $this->input->post("txt_long");
			$data['room'] = $this->input->post("txt_room");
			$data['floor'] = $this->input->post("txt_floor");
			$data['toilet'] = $this->input->post("txt_toilet");
			$data['productId'] = $this->input->post("productId");
			$data['image'] = $this->input->post("image");
			$data['contact_name'] = $this->input->post("txt_fullname");
			$data['contact_phone'] = $this->input->post("txt_phone");
			$data['contact_address'] = $this->input->post("txt_address");
			$data['txt_email'] = $this->input->post("txt_email");
			$data['txt_captcha'] = $this->input->post("txt_captcha");
			$data['lng'] = $this->input->post("txt_lng");
			$data['lat'] = $this->input->post("txt_lat");
			$data['ipaddress'] = $this->input->ip_address();
			$data['address'] = $this->buildAddress($data['street'], $data['ward'], $data['district'], $data['city']);
			$data['sl_package'] = $this->input->post("sl_package");
			$data['from_date'] = $this->input->post("from_date");
			$data['to_date'] = $this->input->post("to_date");
			$data['postCost'] = 0;
			$data['displayMap'] = $this->input->post("displayMap");

			//set validations
			$this->form_validation->set_rules("txt_title", "Tiêu đề", "trim|required");
			$this->form_validation->set_rules("sl_category", "Danh mục", "required|numeric");
			$this->form_validation->set_rules("txt_price", "Giá", "numeric");
			$this->form_validation->set_rules("txt_area", "Diện tích", "numeric");
			$this->form_validation->set_rules("txt_city", "Thành phố", "required|numeric");
			$this->form_validation->set_rules("txt_district", "Quận", "required|numeric");
			$this->form_validation->set_rules("txt_ward", "Phường", "numeric");
			$this->form_validation->set_rules("txt_street", "Đường", "required");
			$this->form_validation->set_rules("txt_fullname", "Người liên hệ", "required");
			$this->form_validation->set_rules("txt_phone", "Số điện thoại", "required");
			// $this->form_validation->set_rules("sl_package", "Gói tin", "required");
			$this->form_validation->set_rules("from_date", "Ngày bắt đầu", "callback_validateDate");
			$this->form_validation->set_rules("to_date", "Ngày kết thúc", "required");
			if($data['productId'] == null || $data['productId'] < 1){
				$this->form_validation->set_rules("txt_captcha", "Mã xác thực", "callback_validateCaptcha");
			}
			$img = $this->uploadImage();
			if($img != null){
				$data['image'] = $img;
			}
			if($data['image'] == null){
				$this->form_validation->set_rules("txt_userfile", "Hình đại diện", "required");
			}

			$this->form_validation->set_rules("description", "Mô tả", "required");
			$this->form_validation->set_rules("txt_width", "Chiều rộng", "numeric");
			$this->form_validation->set_rules("txt_long", "Chiều dài", "numeric");
			$this->form_validation->set_rules("txt_room", "Số phòng", "numeric");
			$this->form_validation->set_rules("txt_floor", "Số tầng", "numeric");
			$this->form_validation->set_rules("txt_toilet", "Nhà vệ sinh", "numeric");

			$cost = 0;
			$diffDay = 0;
			if(isset($data['from_date']) && $data['from_date'] != null && isset($data['to_date']) && $data['to_date'] != null) {
				$dateOne = DateTime::createFromFormat("d/m/Y", $data['from_date']);
				$dateTwo = DateTime::createFromFormat("d/m/Y", $data['to_date']);
				$interval = $dateOne->diff($dateTwo);
				$diffDay = $interval->days;
				if($diffDay > 0){
					if($data['sl_package'] == "vip0"){
						$data['vip'] = PRODUCT_VIP_0;
						$cost = $diffDay * COST_VIP_0_PER_DAY;
					}else if($data['sl_package'] == "vip1"){
						$data['vip'] = PRODUCT_VIP_1;
						$cost = $diffDay * COST_VIP_1_PER_DAY;
					}else if($data['sl_package'] == "vip2"){
						$data['vip'] = PRODUCT_VIP_2;
						$cost = $diffDay * COST_VIP_2_PER_DAY;
					}else if($data['sl_package'] == "vip3"){
						$data['vip'] = PRODUCT_VIP_3;
						$cost = $diffDay * COST_VIP_3_PER_DAY;
					}else{
						$data['vip'] = PRODUCT_STANDARD;
					}
				}
				$data['postCost'] = number_format($cost);
			}

			$validateResult = $this->form_validation->run();
			if ($validateResult == FALSE) {
				$this->form_validation->set_message('txt_captcha', 'Mã xác thực không khớp.');
				//validation fails
				if($data['city'] != null && $data['city'] > 0){
					$data['districts'] = $this->District_Model->findByCityId($data['city']);
				}
				if($data['district'] != null && $data['district'] > 0){
					$data['wards'] = $this->Ward_Model->findByDistrictId($data['district']);
				}
				$data['other_images'] = $this->loadOthersImages();
				$data['error_message'] = 'Dữ liệu chưa hợp lệ, vui lòng kiểm tra các thông tin bên dưới.';
				if($type == 'add'){
					$captcha = $this->generatedCapcha();
					$data['capchaImg'] = $captcha['image'];
					$this->session->set_userdata('captcha', $captcha['word']);

					$this->load->view('post/new', $data);
				}else{
					$this->load->view('post/edit', $data);
				}
			}else{
				$data['CreatedByID'] = $this->session->userdata('loginid');
				$data['code'] = $this->session->userdata('uuid');
				$otherImgs = $this->input->post('otherImages');
				$address = $this->buildAddress($data['street'], $data['ward'], $data['district'], $data['city']);
				$data['address'] = $address;
				if($data['displayMap'] != null && $data['displayMap'] == 1) {
					$coordinators = $this->getLongitudeAndLatitudeFromAddress($address);
					$data['longitude'] = $coordinators[0];
					$data['latitude'] = $coordinators[1];
				}else{
					$data['longitude'] = 0;
					$data['latitude'] = 0;
				}
				if($data['ward'] == -1){
					$data['ward'] = null;
				}

				if($data['productId'] != null && $data['productId'] > 0){
					$ok = $this->Product_Model->updatePost($data, $otherImgs);
				}else{
					// validate post per day and cost
					if($data['vip'] == PRODUCT_STANDARD) {
						$postToday = $this->Product_Model->findPostWithPackageToday($data['ipaddress'], $data['contact_phone'], PRODUCT_STANDARD);
						if($postToday >= MAX_POST_PER_DAY) {
							$this->load->view('post/limit', $data);
							return;
						}
					}

					if($this->session->userdata('loginid') != null && $cost > 0) {
						$loginUser = $this->User_Model->getUserById($this->session->userdata('loginid'));
						$availableMoney = $loginUser->AvailableMoney;
						if($cost > $availableMoney){
							$this->load->view('post/limit', $data);
							return;
						}
					}

					$ok = $this->Product_Model->saveNewPost($data, $otherImgs);
					if($ok){
						// update payment history
						if($data['vip'] < PRODUCT_STANDARD && $this->session->userdata('loginid') != null){
							$loginId = $this->session->userdata('loginid');
							$addData['ActorID'] = $loginId;
							$addData['UserID'] = $loginId;
							$addData['Type'] = PAYMENT_WITHDRAW;
							$addData['Reason'] = "Đăng tin mã: {$ok} gói " . $this->getPackageByCode($data['vip']). ' - '.$diffDay. ' ngày.';
							$addData['Money'] = $cost;
							$this->Transfer_Model->addNewRow($addData);
						}
					}
				}

				if($ok){
					// Save successful
					$this->session->unset_userdata('captcha');
					redirect("dang-bai-thanh-cong-p".$ok);
				}else{
					// Save failure
					//validation fails
					if($data['city'] != null && $data['city'] > 0){
						$data['districts'] = $this->District_Model->findByCityId($data['city']);
					}
					if($data['district'] != null && $data['district'] > 0){
						$data['wards'] = $this->Ward_Model->findByDistrictId($data['district']);
					}
					$data['other_images'] = $this->loadOthersImages();
					$data['error_message'] = 'Có lỗi xảy ra trong quá trình lưu trữ, vui lòng kiểm tra lại dữ liệu.';
					if($type == 'add'){
						$captcha = $this->generatedCapcha();
						$data['capchaImg'] = $captcha['image'];
						$this->session->set_userdata('captcha', $captcha['word']);

						$this->load->view('post/new', $data);
					}else{
						$this->load->view('post/edit', $data);
					}

				}
			}
		}catch (Exception $e){
			print_r($e);
		}
	}

	private function getPackageByCode($code){
		if($code == 0){
			return "Siêu Vip";
		}else if($code == 1 || $code == 2 || $code == 3){
			return "Vip {$code}";
		}
	}

	private function processUpdatePost($data, $type){
		try{
			// get posted values
			$data['title'] = $this->input->post("txt_title");
			$data['categoryID'] = $this->input->post("sl_category");
			$data['price'] = $this->input->post("txt_price");
			$data['area'] = $this->input->post("txt_area");
			$data['city'] = $this->input->post("txt_city");
			$data['district'] = $this->input->post("txt_district");
			$data['ward'] = $this->input->post("txt_ward");
			$data['street'] = $this->input->post("txt_street");
			$data['description'] = $this->input->post("description");
			$data['unit'] = $this->input->post("txt_unit");
			$data['brand'] = $this->input->post("txt_brand");
			$data['direction'] = $this->input->post("txt_direction");
			$data['width'] = $this->input->post("txt_width");
			$data['long'] = $this->input->post("txt_long");
			$data['room'] = $this->input->post("txt_room");
			$data['floor'] = $this->input->post("txt_floor");
			$data['toilet'] = $this->input->post("txt_toilet");
			$data['productId'] = $this->input->post("productId");
			$data['image'] = $this->input->post("image");
			$data['contact_name'] = $this->input->post("txt_fullname");
			$data['contact_phone'] = $this->input->post("txt_phone");
			$data['contact_address'] = $this->input->post("txt_address");
			$data['txt_email'] = $this->input->post("txt_email");
			$data['txt_captcha'] = $this->input->post("txt_captcha");
			$data['lng'] = $this->input->post("txt_lng");
			$data['lat'] = $this->input->post("txt_lat");
			$data['ipaddress'] = $this->input->ip_address();
			$data['address'] = $this->buildAddress($data['street'], $data['ward'], $data['district'], $data['city']);
			$data['displayMap'] = $this->input->post("displayMap");

			//set validations
			$this->form_validation->set_rules("txt_title", "Tiêu đề", "trim|required");
			$this->form_validation->set_rules("sl_category", "Danh mục", "required|numeric");
			$this->form_validation->set_rules("txt_price", "Giá", "numeric");
			$this->form_validation->set_rules("txt_area", "Diện tích", "numeric");
			$this->form_validation->set_rules("txt_city", "Thành phố", "required|numeric");
			$this->form_validation->set_rules("txt_district", "Quận", "required|numeric");
			$this->form_validation->set_rules("txt_ward", "Phường", "numeric");
			$this->form_validation->set_rules("txt_street", "Đường", "required");
			$this->form_validation->set_rules("txt_fullname", "Người liên hệ", "required");
			$this->form_validation->set_rules("txt_phone", "Số điện thoại", "required");

			$img = $this->uploadImage();
			if($img != null){
				$data['image'] = $img;
			}
			if($data['image'] == null){
				$this->form_validation->set_rules("txt_userfile", "Hình đại diện", "required");
			}

			$this->form_validation->set_rules("description", "Mô tả", "required");
			$this->form_validation->set_rules("txt_width", "Chiều rộng", "numeric");
			$this->form_validation->set_rules("txt_long", "Chiều dài", "numeric");
			$this->form_validation->set_rules("txt_room", "Số phòng", "numeric");
			$this->form_validation->set_rules("txt_floor", "Số tầng", "numeric");
			$this->form_validation->set_rules("txt_toilet", "Nhà vệ sinh", "numeric");

			$validateResult = $this->form_validation->run();
			if ($validateResult == FALSE) {
				//validation fails
				if($data['city'] != null && $data['city'] > 0){
					$data['districts'] = $this->District_Model->findByCityId($data['city']);
				}
				if($data['district'] != null && $data['district'] > 0){
					$data['wards'] = $this->Ward_Model->findByDistrictId($data['district']);
				}
				$data['other_images'] = $this->loadOthersImages();
				$data['error_message'] = 'Dữ liệu chưa hợp lệ, vui lòng kiểm tra các thông tin bên dưới.';
				if($type == 'add'){
					$captcha = $this->generatedCapcha();
					$data['capchaImg'] = $captcha['image'];
					$this->session->set_userdata('captcha', $captcha['word']);

					$this->load->view('post/new', $data);
				}else{
					$this->load->view('post/edit', $data);
				}
			}else{
				$data['CreatedByID'] = $this->session->userdata('loginid');
				$data['code'] = $this->session->userdata('uuid');
				$otherImgs = $this->input->post('otherImages');
				$address = $this->buildAddress($data['street'], $data['ward'], $data['district'], $data['city']);
				$data['address'] = $address;
				if($data['displayMap'] != null && $data['displayMap'] == 1) {
					$coordinators = $this->getLongitudeAndLatitudeFromAddress($address);
					$data['longitude'] = $coordinators[0];
					$data['latitude'] = $coordinators[1];
				}else{
					$data['longitude'] = 0;
					$data['latitude'] = 0;
				}
				if($data['ward'] == -1){
					$data['ward'] = null;
				}

				if($data['productId'] != null && $data['productId'] > 0){
					$ok = $this->Product_Model->updatePost($data, $otherImgs);
				}else{
					$ok = $this->Product_Model->saveNewPost($data, $otherImgs);
				}

				if($ok){
					// Save successful
					$this->session->unset_userdata('captcha');
					redirect("dang-bai-thanh-cong-p".$ok);
				}else{
					// Save failure
					//validation fails
					if($data['city'] != null && $data['city'] > 0){
						$data['districts'] = $this->District_Model->findByCityId($data['city']);
					}
					if($data['district'] != null && $data['district'] > 0){
						$data['wards'] = $this->Ward_Model->findByDistrictId($data['district']);
					}
					$data['other_images'] = $this->loadOthersImages();
					$data['error_message'] = 'Có lỗi xảy ra trong quá trình lưu trữ, vui lòng thử lại.';
					if($type == 'add'){
						$captcha = $this->generatedCapcha();
						$data['capchaImg'] = $captcha['image'];
						$this->session->set_userdata('captcha', $captcha['word']);

						$this->load->view('post/new', $data);
					}else{
						$this->load->view('post/edit', $data);
					}

				}
			}
		}catch (Exception $e){
			print_r($e);
		}
	}

	public function validateDate(){
		$startDate = DateTime::createFromFormat("d/m/Y", $_POST['from_date']);
		$endDate = DateTime::createFromFormat("d/m/Y", $_POST['to_date']);
		if ($endDate < $startDate) {
			$this->form_validation->set_message('validateDate', 'Ngày bắt đầu phải nhỏ hơn ngày kết thúc.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function validateCaptcha($str){
		if($str != $this->session->userdata['captcha'])
		{
			$this->form_validation->set_message('validateCaptcha', '{field} không khớp');
			return FALSE;
		}else{
			return TRUE;
		}
	}

	private function generatedCapcha(){
		$config = array(
			'img_id'		=> 'captcha',
			'img_path'      => 'img/captcha/',
			'img_url'       => base_url().'img/captcha/',
			'font_path'		=> base_url().'admin/fonts/arial.ttf',
			'img_width'     => '150',
			'expiration'    => 7200,
			'img_height'    => 30,
			'word_length'   => 6,
			'font_size'     => 18,
			'line_count'	=> 10,
			'colors'        => array(
				'background' => array(255, 255, 255),
				'border' => array(204, 204, 204),
				'text' => array(255, 93, 14),
				'grid' => array(204, 204, 204)
			)
		);
		return create_captcha($config);
	}

	private function uploadImage(){
		if(!empty($this->input->post("txt_userfile"))){
			return $this->input->post("txt_userfile");
		}else{
			$upath = 'attachments' . DIRECTORY_SEPARATOR .'u'. $_POST['txt_folder'] . DIRECTORY_SEPARATOR. $this->session->userdata('uuid'). DIRECTORY_SEPARATOR;

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
				$config['width']     = 120;

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

	public function do_upload_others_images()
	{
		if ($this->input->is_ajax_request()) {
			$upath = 'attachments' . DIRECTORY_SEPARATOR .'u'. $_POST['txt_folder'] . DIRECTORY_SEPARATOR. $this->session->userdata('uuid'). DIRECTORY_SEPARATOR;
			if (!file_exists($upath)) {
				mkdir($upath, 0777, true);
			}

			$this->load->library('upload');

			$files = $_FILES;
			$cpt = count($_FILES['others']['name']);
			$is_OK = true;
			for ($i = 0; $i < $cpt; $i++) {
				unset($_FILES);
				$_FILES['others']['name'] = $files['others']['name'][$i];
				$_FILES['others']['type'] = $files['others']['type'][$i];
				$_FILES['others']['tmp_name'] = $files['others']['tmp_name'][$i];
				$_FILES['others']['error'] = $files['others']['error'][$i];
				$_FILES['others']['size'] = $files['others']['size'][$i];

				$this->upload->initialize(array(
					'upload_path' => $upath,
					'allowed_types' => $this->config->item('allowed_img_types')
				));
				if(!$this->upload->do_upload('others')){
					$error = array('error' => $this->upload->display_errors(), 'upload_path' => $upath, 'allowed_types' => $this->allowed_img_types);
					echo json_encode($error);
					$is_OK = false;
				}
			}
			if($is_OK){
				echo json_encode(array('success' => true));
			}

		}
	}

	public function loadOthersImages()
	{
		$output = '';
		if (isset($_POST['txt_folder']) && $_POST['txt_folder'] != null) {
			$dir = 'attachments' . DIRECTORY_SEPARATOR .'u'. $_POST['txt_folder'] . DIRECTORY_SEPARATOR. $this->session->userdata('uuid'). DIRECTORY_SEPARATOR;
			//$output = $dir;
			if (is_dir($dir)) {
				if ($dh = opendir($dir)) {
					$i = 0;
					while (($file = readdir($dh)) !== false) {
						if (is_file($dir . $file)) {
							if (strpos($file, '_thumb.') != true) {
								$output .= '
                                <div class="other-img" id="image-container-' . $i . '">
                                    <img src="' . $dir . $file . '" style="width:100px; height: 100px;">
                                    <input type="hidden" name="otherImages[]" value="\'/' . $dir . $file . '\'"/>
                                    <a href="javascript:void(0);" onclick="removeSecondaryProductImage(\'' . $file . '\', \'' . $_POST['txt_folder'] . '\', ' . $i . ')">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </a>
                                </div>
                               ';
							}
							$i++;
						}
					}
					closedir($dh);
				}
			}else{
				//$output = '<h2>Not valid</h2>'.$dir;
			}
		}else{
			//$output = '<h2>Not folder</h2>';
		}
		if ($this->input->is_ajax_request()) {
			echo $output;
		} else {
			return $output;
		}
	}

	public function removeSecondaryImage(){
		if ($this->input->is_ajax_request()) {
			$img = 'attachments' . DIRECTORY_SEPARATOR .'u'. $_POST['txt_folder'] . DIRECTORY_SEPARATOR . $this->session->userdata('uuid'). DIRECTORY_SEPARATOR. $_POST['image'];
			unlink($img);
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
			$address = substr($address, 0, count($address) - 2);
		}

		return $address;
	}

	private function getLongitudeAndLatitudeFromAddress($addr){
		$address = $addr.', Việt Nam';
		$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');

		// Convert the JSON to an array
		$geo = json_decode($geo, true);

		if ($geo['status'] == 'OK') {
			// Get Lat & Long
			$latitude = $geo['results'][0]['geometry']['location']['lat'];
			$longitude = $geo['results'][0]['geometry']['location']['lng'];

			return array($longitude, $latitude);
		}
		return array(0, 0);
	}

}
