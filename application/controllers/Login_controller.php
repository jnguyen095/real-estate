<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/31/2017
 * Time: 11:29 AM
 */
class Login_controller extends CI_Controller
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
		$this->load->model('City_Model');
		$this->load->model('Category_Model');
		$this->load->helper("seo_url");
	}

	public function logout(){
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('loginuser');
		$this->session->unset_userdata('loginid');
		redirect("trang-chu");
	}

	public function socialLogin(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$fullname = $this->input->post('fullname');

		$usr_result = $this->Login_Model->get_facebooker($username, $password, $fullname);

		$data = array(
			'success' => false
		);
		if(($usr_result != null && isset($usr_result->Us3rID)) || $usr_result){
			$data = array(
				'success' => true
			);
			$sessiondata = array(
				'loginid' => $usr_result->Us3rID,
				'username' => $username,
				'fullname' => $fullname,
				'loginuser' => TRUE
			);
			$this->Login_Model->updateLastLogin($usr_result->Us3rID);
			$this->session->set_userdata($sessiondata);
		}

		//Either you can print value or you can send value to database
		echo json_encode($data);
	}

	public function index()
	{
		$data = $this->Category_Model->getCategories();
		$data['footerMenus'] = $this->City_Model->findByTopProductOfCategoryGroupByCity();
		$data['cities'] = $this->City_Model->getAllActive();
		//get the posted values
		$username = $this->input->post("txt_username");
		$password = $this->input->post("txt_password");

		//set validations
		$this->form_validation->set_rules("txt_username", "Username", "trim|required");
		$this->form_validation->set_rules("txt_password", "Password", "trim|required");

		if ($this->form_validation->run() == FALSE)
		{
			//validation fails
			$this->load->view('login/login', $data);
		}
		else
		{
			//validation succeeds
			if ($this->input->post('crudaction') == "Login")
			{
				//check if username and password is correct
				$usr_result = $this->Login_Model->get_user($username, $password);
				if ($usr_result != null) //active user record is present
				{
					//set the session variables
					$sessiondata = array(
						'loginid' => $usr_result->Us3rID,
						'username' => $username,
						'fullname' => $usr_result->FullName,
						'loginuser' => TRUE,
						'usergroup' => $usr_result->UserGroup
					);
					$this->session->set_userdata($sessiondata);
					$this->Login_Model->updateLastLogin($usr_result->Us3rID);
					redirect("trang-chu");
				}
				else
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Tên đăng nhập hoặc mật khẩu không đúng!</div>');
					redirect('dang-nhap');
				}
			}
			else
			{
				redirect('dang-nhap');
			}
		}
	}
}
