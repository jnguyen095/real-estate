<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 11/1/2017
 * Time: 4:48 PM
 */
class SendMail_controller extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('Category_Model');
		$this->load->helper("seo_url");
	}

	public function htmlMail(){

		$config = Array(
			'protocol' => 'imap.gmail.com',
			'smtp_host' => 'smtp.gmail.com',
			'smtp_port' => 25,
			'smtp_user' => 'tindatdai@gmail.com',
			'smtp_pass' => '12345678@Xx',
			'smtp_timeout' => '4',
			'mailtype' => 'html',
			'charset' => 'iso-8859-1'
		);

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('your mail id', 'Anil Labs');
		$data = array(
			'userName'=> 'Anil Kumar Panigrahi'
		);
		$this->email->to("khang.nguyen@banvien.com"); // replace it with receiver mail id
		$this->email->subject("Test Email"); // replace it with relevant subject

		$body = $this->load->view('emails/post_success.php', $data, TRUE);

		$this->email->message($body);
		$this->email->send();

	}
}
