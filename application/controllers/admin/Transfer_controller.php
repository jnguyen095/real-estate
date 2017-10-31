<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 10/31/2017
 * Time: 5:16 PM
 */
class Transfer_controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('loginid') && $this->session->userdata('usergroup') != 'ADMIN'){
			redirect('dang-nhap');
		}

		$this->load->library('session');
		$this->load->model('User_Model');
		$this->load->model('Transfer_Model');
		$this->load->library('pagination');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('form_validation');
		$this->load->helper("bootstrap_pagination_admin");
	}

	public function index()
	{

	}

	public function processUser($userId){
		$user = $this->User_Model->getUserById($userId);
		$data['user'] = $user;

		$data['sl_type'] = "";
		$data['txt_reason'] = "";
		$data['txt_money'] = "";
		$deleteId = $this->input->get("deleteId");
		if($deleteId != null && $deleteId > 0){
			$this->Transfer_Model->deleteById($deleteId);
			redirect("/admin/transfer-user-".$userId);
		}
		if ($this->input->post('crudaction') == "insert") {
			$data['sl_type'] = $this->input->post("sl_type");
			$data['txt_reason'] = $this->input->post("txt_reason");
			$data['txt_money'] = $this->input->post("txt_money");

			//set validations
			$this->form_validation->set_rules("sl_type", "Loại giao dịch", "numeric|required");
			$this->form_validation->set_rules("txt_reason", "Lý do", "trim|required");
			$this->form_validation->set_rules("txt_money", "Số tiền", "trim|required|numeric");

			$validateResult = $this->form_validation->run();
			if ($validateResult == TRUE) {
				$addData['ActorID'] = $this->session->userdata('loginid');
				$addData['UserID'] = $userId;
				$addData['Type'] = $data['sl_type'];
				$addData['Reason'] = $data['txt_reason'];
				$addData['Money'] = $data['txt_money'];
				$this->Transfer_Model->addNewRow($addData);
				$data['message_response'] = "Thực hiện thành công.";
				$data['sl_type'] = "";
				$data['txt_reason'] = "";
				$data['txt_money'] = "";
			}
		}
		$data['histories'] = $this->Transfer_Model->findByUserId($userId);
		$this->load->view("admin/transfer/process", $data);
	}
}
