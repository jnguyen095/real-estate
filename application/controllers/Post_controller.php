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
		$this->load->library('form_validation');
		$this->load->model('Category_Model');
		$this->load->helper("seo_url");
	}

	public function index(){
		$data = $this->Category_Model->getCategories();
		$this->load->view('post/new', $data);
		$this->allowed_img_types = $this->config->item('allowed_img_types');
	}

	public function do_upload_others_images()
	{
		if ($this->input->is_ajax_request()) {
			$upath = 'attachments' . DIRECTORY_SEPARATOR. $_POST['txt_folder'] . DIRECTORY_SEPARATOR;
			
			if (!file_exists($upath)) {
				mkdir($upath, 0777);
			}

			$this->load->library('upload');

			$files = $_FILES;
			$cpt = count($_FILES['others']['name']);
			for ($i = 0; $i < $cpt; $i++) {
				unset($_FILES);
				$_FILES['others']['name'] = $files['others']['name'][$i];
				$_FILES['others']['type'] = $files['others']['type'][$i];
				$_FILES['others']['tmp_name'] = $files['others']['tmp_name'][$i];
				$_FILES['others']['error'] = $files['others']['error'][$i];
				$_FILES['others']['size'] = $files['others']['size'][$i];

				$this->upload->initialize(array(
					'upload_path' => $upath,
					'allowed_types' => $this->allowed_img_types
				));
				$this->upload->do_upload('others');
			}
		}
	}

	public function loadOthersImages()
	{
		$output = '';
		if (isset($_POST['txt_folder']) && $_POST['txt_folder'] != null) {
			$dir = 'attachments' . DIRECTORY_SEPARATOR . $_POST['txt_folder'] . DIRECTORY_SEPARATOR;
			if (is_dir($dir)) {
				if ($dh = opendir($dir)) {
					$i = 0;
					while (($file = readdir($dh)) !== false) {
						if (is_file($dir . $file)) {
							$output .= '
                                <div class="other-img" id="image-container-' . $i . '">
                                    <img src="' . base_url($dir . $file) . '" style="width:100px; height: 100px;">
                                    <a href="javascript:void(0);" onclick="removeSecondaryProductImage(\'' . $file . '\', \'' . $_POST['folder'] . '\', ' . $i . ')">
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

}
