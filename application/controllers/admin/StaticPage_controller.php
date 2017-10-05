<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 10/5/2017
 * Time: 9:13 AM
 */
class StaticPage_controller extends CI_Controller
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
		$this->load->model('StaticPage_Model');
	}

	function index($offset=0){
		$result = $this->StaticPage_Model->searchByProperties($offset, MAX_PAGE_ITEM);
		$this->load->view("admin/staticpage/list", $result);
	}

	function add($id=0){
		$data = [];
		$data['txt_code'] = "";
		$data['txt_title'] = "";
		$data['txt_description'] = "";
		$data['ch_status'] = "";
		$data['staticPageID'] = "";

		if ($this->input->post('crudaction') == "insert") {
			$data['title'] = $this->input->post("txt_title");
			$data['code'] = $this->input->post("txt_code");
			$data['description'] = $this->input->post("txt_description");
			$data['status'] = $this->input->post("ch_status") == null ? INACTIVE : ACTIVE;
			$data['staticPageID'] = $this->input->post("staticPageID");

			//set validations
			$this->form_validation->set_rules("txt_title", "Title", "trim|required");
			$this->form_validation->set_rules("txt_code", "Code", "trim|required");
			$this->form_validation->set_rules("txt_description", "Description", "trim|required");

			$validateResult = $this->form_validation->run();
			if ($validateResult == TRUE) {
				if($this->StaticPage_Model->findByCode($data['code'], $data['staticPageID']) == null){
					$dbid = $this->StaticPage_Model->saveOrUpdate($data);
					$data['staticPageID'] = $dbid;
					redirect('admin/static-page/list');
				}else{
					$data['error_message'] = "The Code field must contain a unique value.";
				}
			}
		}else if($id > 0){
			$page = $this->StaticPage_Model->findById($id);
			$data['txt_code'] = $page->Code;
			$data['txt_title'] = $page->Title;
			$data['txt_description'] = $page->Description;
			$data['ch_status'] = $page->Status;
			$data['staticPageID'] = $page->StaticPageID;
		}

		$this->load->view("admin/staticpage/add", $data);
	}
}
