<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 8/17/2017
 * Time: 10:39 AM
 */
class Ajax_controller extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('District_Model');
		$this->load->model('Ward_Model');
		$this->load->helper("seo_url");
		$this->load->model('Street_Model');
		$this->load->model('Product_Model');
		$this->load->model('User_Model');
		$this->load->model('Subscrible_Model');
		$this->load->helper('captcha');
		$this->load->helper('date');
	}

	public function findStreetByName(){
		$streetName = $this->input->get('query');
		$streetNames = $this->Street_Model->findByName($streetName);
		echo json_encode($streetNames);
	}

	public function findDistrictByCityId(){
		$cityId = $this->input->post('cityId');
		$districts = $this->District_Model->findByCityId($cityId);
		echo json_encode($districts);
	}

	public function findWardByDistrictId(){
		$districtId = $this->input->post('districtId');
		$wards = $this->Ward_Model->findByDistrictId($districtId);
		echo json_encode($wards);
	}

	public function updateCoordinator(){
		$productId = $this->input->post('productId');
		$longitude = $this->input->post('lng');
		$latitude = $this->input->post('lat');
		$this->Product_Model->updateCoordinator($productId, $longitude, $latitude);
		echo json_encode('{success: true}');
	}

	public function addSubscrible(){
		$email = $this->input->post('email');
		if($this->Subscrible_Model->findByEmail($email) < 1){
			$data = array("Email" => $email, "CreatedDate" => date('Y-m-d H:i:s'), "Status" => ACTIVE);
			$this->Subscrible_Model->insert($data);
			echo json_encode('success');
		}else{
			echo json_encode('failure');
		}
	}

	public function updateViewForProductIdManual(){
		$productId = $this->input->post('productId');
		$view = $this->input->post('view');
		$this->Product_Model->updateViewForProductIdManual($productId, $view);
		echo json_encode('success');
	}

	public function updateVipPackageForProductId(){
		$productId = $this->input->post('productId');
		$vip = $this->input->post('vip');
		$this->Product_Model->updateVipPackageForProductId($productId, $vip);
		echo json_encode('success');
	}
	public function getGeoFromAddress(){
		$addr = $this->input->post('address');
		$address = $addr.', Việt Nam';
		$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');

		// Convert the JSON to an array
		$geo = json_decode($geo, true);

		$latitude = 0;
		$longitude = 0;
		if ($geo['status'] == 'OK') {
			// Get Lat & Long
			$latitude = $geo['results'][0]['geometry']['location']['lat'];
			$longitude = $geo['results'][0]['geometry']['location']['lng'];
		}
		echo json_encode(array($longitude, $latitude));
	}

	public function getCaptchaImg(){
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
		$captcha = create_captcha($config);
		$data['capchaImg'] = $captcha['image'];
		$this->session->set_userdata('captcha', $captcha['word']);
		echo json_encode(array($data));
	}

	public function loadPrice4Package(){
		$package = $this->input->post('package');
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$loginId = $this->session->userdata('loginid');

		if($package == 'standard'){
			$result["status"] = "free_cost";
			$result["val"] = "0";
			echo json_encode($result);
		}else{
			if(!isset($loginId) || $loginId == null){
				$result["status"] = "no_authenticated";
				$result["val"] = 0;
				echo json_encode($result);
			}else{
				$loginUser = $this->User_Model->getUserById($loginId);
				$availableMoney = $loginUser->AvailableMoney;
				if($availableMoney == 0){
					$result["status"] = "not_enough_quota";
					$result["val"] = 0;
					echo json_encode($result);
				}else{
					if(isset($from_date) && $from_date != null && isset($to_date) && $to_date != null){
						$dateOne = DateTime::createFromFormat("d/m/Y", $from_date);
						$dateTwo = DateTime::createFromFormat("d/m/Y", $to_date);
						$interval = $dateOne->diff($dateTwo);
						$diffDay = $interval->days;
						$cost = 0;
						if($package == "vip0"){
							$cost = $diffDay * COST_VIP_0_PER_DAY;
						}else if($package == "vip1"){
							$cost = $diffDay * COST_VIP_1_PER_DAY;
						}else if($package == "vip2"){
							$cost = $diffDay * COST_VIP_2_PER_DAY;
						}else if($package == "vip3"){
							$cost = $diffDay * COST_VIP_3_PER_DAY;
						}
						if($availableMoney >= $cost){
							$result["status"] = "valid_payment";
							$result["val"] = number_format($cost);
							echo json_encode($result);
						}else{
							$result["status"] = "not_enough_quota";
							$result["val"] = 0;
							echo json_encode($result);
						}
					}else{
						$result["status"] = "not_qualify_input";
						$result["val"] = 0;
						echo json_encode($result);
					}
				}
			}
		}
	}
}
