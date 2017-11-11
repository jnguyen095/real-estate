<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 10/3/2017
 * Time: 9:35 AM
 */
class Admin_controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('loginid') && $this->session->userdata('usergroup') != 'ADMIN'){
			redirect('dang-nhap');
		}
		$this->load->model('Dashboard_Model');
		$this->load->library('session');
	}

	public function index() {
		$data['totalUser'] = $this->Dashboard_Model->countUser();
		$data['totalPost'] = $this->Dashboard_Model->countPost();
		$data['postDisabled'] = $this->Dashboard_Model->countPostDisabled();
		$data['totalCrawler'] = $this->Dashboard_Model->countCrawler();
		$data['totalSubscribe'] = $this->Dashboard_Model->countSubscribe();
		$data['loginToday'] = $this->Dashboard_Model->getLoginToday();
		$data['createdToday'] = $this->Dashboard_Model->getRegisterToday();
		$data['postToday'] = $this->Dashboard_Model->getPostToday();
		$data['postPushToday'] = $this->Dashboard_Model->getPostPushToday();
		$data['postVipPreviousDate'] = $this->Dashboard_Model->countStandardForPreviousPost();
		$data['postCurrentDate'] = $this->Dashboard_Model->getPostCurrentDate();
		$data['postVip1'] = $this->Dashboard_Model->countPostVip(1);
		$data['postVip2'] = $this->Dashboard_Model->countPostVip(2);
		$data['postVip3'] = $this->Dashboard_Model->countPostVip(3);
		$data['userRegistByDate'] = $this->Dashboard_Model->countUserByDate(15);
		$data['postRegistByDate'] = $this->Dashboard_Model->countPostByDate(15);
		$data['captchaImgs'] = count(glob("img/captcha/*.jpg"));

		$thumbs = ["https://file1.batdongsan.com.vn/images/no-photo.jpg", "https://dothi.net/Images/no-photo170.png"];
		$data['thumbNoImages'] = $this->Dashboard_Model->countProductHasNoThumb($thumbs);
		$this->load->view('admin/dashboard', $data);
	}
	public function updateStandardForPreviousPost(){
		$this->Dashboard_Model->updateStandardForPreviousPost();
		echo json_encode('success');
	}
	public function replaceThumbs(){
		$thumbs = ["https://file1.batdongsan.com.vn/images/no-photo.jpg", "https://dothi.net/Images/no-photo170.png"];
		$this->Dashboard_Model->updateProductHasNoThumb($thumbs, "/img/no_image.png");
		echo json_encode('success');
	}
	public function deleteAllCaptcha(){
		$files = glob('img/captcha/*.jpg'); // get all file names
		foreach($files as $file){ // iterate files
			if(is_file($file)) {
				unlink($file); // delete file
			}
		}
		echo json_encode('success');
	}
}
