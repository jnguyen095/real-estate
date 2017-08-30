<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 8/24/2017
 * Time: 4:13 PM
 */
class Register_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('date');
		//$this->load->database();
		$this->load->library('form_validation');
		//load the login model
		$this->load->model('Login_Model');
		$this->load->model('User_Model');
		$this->load->model('City_Model');
		$this->load->model('Category_Model');
		$this->load->helper("seo_url");
	}

	public function index()
	{
		$data = $this->Category_Model->getCategories();
		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();
		if($this->input->post('crudaction') == "register"){
			$this->form_validation->set_message('txt_fullname', 'Họ tên không được để trống');

			$this->form_validation->set_rules("txt_fullname", "Fullname", "trim|required");
			$this->form_validation->set_rules("txt_username", "Username", "trim|required");
			$this->form_validation->set_rules("txt_password", "Password", "trim|required");
			$this->form_validation->set_rules("txt_email", "Email", "valid_email");
			$this->form_validation->set_rules('txt_phone', 'Mobile Number ', 'regex_match[/^[0-9]{10,11}$/]'); //{10} for 10 or 11 digits number

			if ($this->form_validation->run() == FALSE)
			{
				//validation fails
				$this->load->view('login/register', $data);
			}else{
				$fullname = $this->input->post('txt_fullname');
				$username = $this->input->post('txt_username');
				$password = $this->input->post('txt_password');
				$email = $this->input->post('txt_email');
				$phone = $this->input->post('txt_phone');
				$address = $this->input->post('txt_address');

				$count = $this->User_Model->checkExistUserName($username);
				if($count > 0){
					$data['error_response'] = 'Tên đăng nhập đã tồn tại.';
					$this->load->view('login/register', $data);
				}else{
					$newdata['fullname'] = $fullname;
					$newdata['username'] = $username;
					$newdata['password'] = $password;
					$newdata['email'] = $email;
					$newdata['phone'] = $phone;
					$newdata['address'] = $address;

					$this->User_Model->addNewUser($newdata);
					$data['message_response'] = 'Đăng ký thành công';
				}
			}
		}
		$this->load->view('login/register', $data);
	}
}
