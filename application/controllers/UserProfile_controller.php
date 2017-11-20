<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 8/24/2017
 * Time: 7:19 PM
 */
class UserProfile_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('loginid')){
			redirect('dang-nhap');
		}
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('date');
		//$this->load->database();
		$this->load->library('form_validation');
		$this->load->model('User_Model');
		//load the login model
		$this->load->model('Login_Model');
		$this->load->model('Category_Model');
		$this->load->model('City_Model');
		$this->load->helper("seo_url");
	}

	public function index()
	{
		$userId = $this->session->userdata('loginid');
		$data = $this->Category_Model->getCategories();
		$data['UserId'] = $userId;
		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();
		$user = $this->User_Model->getUserById($userId);
		$crudaction = $this->input->post("crudaction");
		if($crudaction == UPDATE){
			$this->form_validation->set_rules("txt_fullname", "Fullname", "trim|required");
			$this->form_validation->set_rules("txt_email", "Email", "valid_email");
			$this->form_validation->set_rules('txt_phone', 'Mobile Number ', 'regex_match[/^[0-9]{10,11}$/]'); //{10} for 10 or 11 digits number

			$data['txt_fullname'] = $this->input->post("txt_fullname");
			$data['txt_email'] = $this->input->post("txt_email");
			$data['txt_phone'] = $this->input->post("txt_phone");
			$data['txt_address'] = $this->input->post("txt_address");
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('user/profile', $data);
			}else{
				
				$this->User_Model->updateUser($data);
				$data['message_response'] = 'Cập nhật thành công';
			}
		}else{
			$data['txt_fullname'] = $user->FullName;
			$data['txt_email'] = $user->Email;
			$data['txt_phone'] = $user->Phone;
			$data['txt_address'] = $user->Address;
		}
		$this->load->view('user/profile', $data);
	}

	public function changePassword(){
		$userId = $this->session->userdata('loginid');
		$data = $this->Category_Model->getCategories();
		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();
		$crudaction = $this->input->post("crudaction");
		if($crudaction == UPDATE){
			$this->form_validation->set_rules("txt_oddpw", "Mật khẩu cũ", "trim|required");
			$this->form_validation->set_rules("txt_newpw", "Mật khẩu mới", "trim|required");
			$this->form_validation->set_rules("txt_newpwconfirm", "Xác nhận mật khẩu mới", "trim|required");
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('user/changePassword', $data);
			}else{
				$oddPw = $this->input->post("txt_oddpw");
				$newPw = $this->input->post("txt_newpw");
				$newPwConfirm = $this->input->post("txt_newpwconfirm");

				$user = $this->User_Model->getUserById($userId);
				$oddPwDb = $user->Password;
				if($oddPwDb != md5($oddPw)){
					$data['error_response'] = 'Mật khẩu đang sử dụng không đúng';
				}else if($newPw != $newPwConfirm){
					$data['error_response'] = 'Mật khẩu mới không khớp';
				}else{
					$this->User_Model->changePassword($userId, $newPw);
					$data['message_response'] = 'Cập nhật thành công';
				}
				$this->load->view('user/changePassword', $data);
			}
		}else {
			$this->load->view('user/changePassword', $data);
		}
	}
}
