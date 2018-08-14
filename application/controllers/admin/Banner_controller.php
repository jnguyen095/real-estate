<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 10/31/2017
 * Time: 5:16 PM
 */
class Banner_controller extends CI_Controller
{
	private $allowed_img_types;
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('loginid') && $this->session->userdata('usergroup') != 'ADMIN'){
			redirect('dang-nhap');
		}

		$this->load->library('session');
		$this->load->model('User_Model');
		$this->load->model('Banner_Model');
		$this->load->library('pagination');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('form_validation');
		$this->load->helper("bootstrap_pagination_admin");
	}

	public function index()
	{
		$crudaction = $this->input->post("crudaction");
		if($crudaction == DELETE){
			$bannerId = $this->input->post("bannerId");
			$this->deleteBanner($bannerId);
			$data['message_response'] = 'Xóa banner thành công.';
		}
		$config = pagination($this);
		$config['base_url'] = base_url('admin/banner/list.html');
		if(!$config['orderField']){
			$config['orderField'] = "Code";
			$config['orderDirection'] = "DESC";
		}
		$results = $this->Banner_Model->findAndFilter($config['page'], $config['per_page'], $config['searchFor'], $config['orderField'], $config['orderDirection']);
		$data['banners'] = $results['items'];
		$config['total_rows'] = $results['total'];

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view("admin/banner/list", $data);
	}

	public function add($id = 0){
		$data = [];
		$data['txt_code'] = "";
		$data['txt_target'] = "";
		$data['txt_priority'] = "";
		$data['ch_status'] = "";
		$data['BannerID'] = "";
		$data['txt_image'] = "";
		$crudaction = $this->input->post("crudaction");
		if($crudaction == "insert"){
			$data['txt_target'] = $this->input->post("txt_target");
			$data['txt_code'] = $this->input->post("txt_code");
			$data['txt_priority'] = $this->input->post("txt_priority");
			$data['ch_status'] = $this->input->post("ch_status") == null ? INACTIVE : ACTIVE;
			$data['BannerID'] = $this->input->post("BannerID");
			$data['from_date'] = $this->input->post("from_date");
			$data['to_date'] = $this->input->post("to_date");
			$preImg = $this->input->post("preImg");
			$img = $this->uploadImage();
			if($img == null && $preImg != null){
				$img = $preImg;
			}
			$data['txt_image'] = $img;
			//set validations
			$this->form_validation->set_rules("txt_target", "Target Url", "trim|required");
			$this->form_validation->set_rules("txt_code", "Code", "trim|required");
			if($img == null){
				$this->form_validation->set_rules("txt_image", "Image", "trim|required");
			}

			$validateResult = $this->form_validation->run();

			if ($validateResult == TRUE) {
				$id = $this->Banner_Model->addOrUpdateBanner($data);
				if($id != null){
					redirect('admin/banner/list');
				}
			}else{
				$data['error_message'] = "There are some issues while validation, please check again.";
			}
		}else if($id > 0){
			$banner = $this->Banner_Model->findById($id);
			$data['txt_target'] = $banner->TargetUrl;
			$data['txt_code'] = $banner->Code;
			$data['txt_priority'] = $banner->Priority;
			$data['ch_status'] = $banner->Status;
			$data['BannerID'] = $banner->BannerID;
			$data['from_date'] = date('d/m/Y', strtotime($banner->FromDate));;
			$data['to_date'] = date('d/m/Y', strtotime($banner->ToDate));
			$data['txt_image'] = $banner->Image;
		}else{
			$data['from_date'] = date("d/m/Y");
			$date = strtotime('+1 months');
			$data['to_date'] = date("d/m/Y", $date);
		}
		$this->load->view("admin/banner/add", $data);
	}

	private function uploadImage(){
		if(!empty($this->input->post("txt_image"))){
			return $this->input->post("txt_image");
		}else{
			$this->allowed_img_types = $this->config->item('allowed_img_types');
			$upath = 'img' . DIRECTORY_SEPARATOR .'banner'. DIRECTORY_SEPARATOR;

			if (!file_exists($upath)) {
				mkdir($upath, 0777, true);
			}

			$config['upload_path'] = $upath;
			$config['allowed_types'] = $this->allowed_img_types;
			$config['remove_spaces'] = true;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('txt_image')) {
				log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
			}
			$img = $this->upload->data();
			return $img['file_name'];
		}
	}

	public function analytic($bannerId){
		$config = pagination($this);
		$config['base_url'] = base_url('admin/banner/analytic-'.$bannerId.'.html');

		$results = $this->Banner_Model->findModelDetail($bannerId, $config['page'], $config['per_page']);
		$data['bannerDetails'] = $results['details'];
		$config['total_rows'] = $results['total'];

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view("admin/banner/analytic", $data);

	}

	private function deleteBanner($bannerId){
		if($bannerId != null && $bannerId > 0) {
			$banner = $this->Banner_Model->findById($bannerId);
			$this->output->delete_cache($banner->Code);
			$imgFile = $banner->Image;
			$upath = 'img' . DIRECTORY_SEPARATOR .'banner'. DIRECTORY_SEPARATOR.$imgFile;
			// delete db first
			$this->Banner_Model->deleteById($bannerId);
			if (file_exists($upath)){
				unlink($upath);
			}
		}
	}
}
