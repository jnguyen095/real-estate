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
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->library('form_validation');
		$this->load->model('Category_Model');
		$this->load->helper("seo_url");
		$this->load->model('City_Model');
		$this->load->model('User_Model');
	}

	public function index()
	{
		$data = $this->Category_Model->getCategories();
		$data['cities'] = $this->City_Model->getAllActive();
		$data['user'] = $this->User_Model->getUserById($this->session->userdata('loginid'));
		$this->allowed_img_types = $this->config->item('allowed_img_types');

		if ($this->input->post('crudaction') == "add_new") {
			try{
				// get posted values
				$data['title'] = $this->input->post("txt_title");
				$data['categoryID'] = $this->input->post("sl_category");
				$data['price'] = $this->input->post("txt_price");
				$data['area'] = $this->input->post("txt_area");
				$data['district'] = $this->input->post("txt_district");
				$data['ward'] = $this->input->post("txt_ward");
				$data['street'] = $this->input->post("txt_street");
				$data['description'] = $this->input->post("description");


				//set validations
				$this->form_validation->set_rules("txt_title", "Title", "trim|required");
				$this->form_validation->set_rules("sl_category", "Category", "required|numeric");
				$this->form_validation->set_rules("txt_price", "Price", "integer");
				$this->form_validation->set_rules("txt_area", "Area", "integer");
				$this->form_validation->set_rules("txt_city", "City", "required|numeric");
				$this->form_validation->set_rules("txt_district", "District", "required|numeric");
				$this->form_validation->set_rules("txt_ward", "Ward", "required|numeric");
				$this->form_validation->set_rules("txt_street", "Street", "required|numeric");
				$this->form_validation->set_rules("txt_userfile", "Image", "required");
				$this->form_validation->set_rules("description", "Des", "required");

				$validateResult = $this->form_validation->run();
				if ($validateResult == FALSE) {
					//validation fails
					$this->load->view('post/new', $data);
				}
			}catch (Exception $e){
				print_r($e);
			}
		} else {
			$this->load->view('post/new', $data);
		}
	}

	public function do_upload_others_images()
	{
		if ($this->input->is_ajax_request()) {
			$upath = 'attachments' . DIRECTORY_SEPARATOR .'u'. $_POST['txt_folder'] . DIRECTORY_SEPARATOR;

			if (!file_exists($upath)) {
				mkdir($upath, 0777);
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
			$dir = 'attachments' . DIRECTORY_SEPARATOR .'u'. $_POST['txt_folder'] . DIRECTORY_SEPARATOR;
			if (is_dir($dir)) {
				if ($dh = opendir($dir)) {
					$i = 0;
					while (($file = readdir($dh)) !== false) {
						if (is_file($dir . $file)) {
							$output .= '
                                <div class="other-img" id="image-container-' . $i . '">
                                    <img src="' . base_url($dir . $file) . '" style="width:100px; height: 100px;">
                                    <a href="javascript:void(0);" onclick="removeSecondaryProductImage(\'' . $file . '\', \'' . $_POST['txt_folder'] . '\', ' . $i . ')">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </a>
                                </div>
                               ';
						}
						$i++;
					}
					closedir($dh);
				}
			}
		}
		if ($this->input->is_ajax_request()) {
			echo $output;
		} else {
			return $output;
		}
	}

	public function removeSecondaryImage(){
		if ($this->input->is_ajax_request()) {
			$img = 'attachments' . DIRECTORY_SEPARATOR .'u'. $_POST['txt_folder'] . DIRECTORY_SEPARATOR . $_POST['image'];
			unlink($img);
		}
	}

}
