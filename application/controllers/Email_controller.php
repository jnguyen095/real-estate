<?php

/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 12/26/2017
 * Time: 2:17 PM
 */
include('/libraries/class.smtp.php');
include "/libraries/class.phpmailer.php";

class Email_controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('my_email');
	}

	function send_email() {
		$response = false;
		$mail = new PHPMailer();
		$subject = 'Test subject';
		$body = 'Hi there, <strong>Carl</strong> here.<br/> This is our email body.';
		$email = 'nhukhang095@gmail.com';


		$mail->CharSet = 'UTF-8';
		$mail->SetFrom('tindatdai@gmail.com','Tin Đất Đai');

		//You could either add recepient name or just the email address.
		$mail->AddAddress($email,"Khang");
		$mail->AddAddress($email);

		//Address to which recipient will reply
		$mail->addReplyTo("tindatdai@gmail.com","Reply");
		//$mail->addCC("cc@example.com");
		//$mail->addBCC("bcc@example.com");

		//Add a file attachment
		//$mail->addAttachment("file.txt", "File.txt");
		//$mail->addAttachment("images/profile.png"); //Filename is optional

		//You could send the body as an HTML or a plain text
		$mail->IsHTML(true);

		$mail->Subject = $subject;
		$mail->Body = $body;

		//Send email via SMTP
		$mail->IsSMTP();
		$mail->SMTPAuth   = true;
		$mail->SMTPSecure = "ssl";  //tls
		$mail->Host       = "smtp.googlemail.com";
		$mail->Port       = 465; //you could use port 25, 587, 465 for googlemail
		$mail->Username   = "tindatdai@gmail.com";
		$mail->Password   = "12345678@Xx";

		if(!$mail->send()){
			$response['message'] = 'Email has been sent successfully';
		}
		else{
			$response['message'] = 'Oops! Something went wrong while trying to send your email.';
		}
		echo json_encode($response);
	}
}
