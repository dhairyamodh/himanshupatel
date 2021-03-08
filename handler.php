<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php/PHPMailer-5.2.28/src/Exception.php';
require 'php/PHPMailer-5.2.28/src/PHPMailer.php';
require 'php/PHPMailer-5.2.28/src/SMTP.php';

$mail = new PHPMailer(true);
$mail_subject = 'Subject';
$mail_to_email = 'talkhimanshupunsari@gmail.com'; // your email
$mail_to_name = 'Himanshu Patel';

try {

	$mail_from_name = isset($_POST['name']) ? $_POST['name'] : '';
	$mail_from_email = isset($_POST['email']) ? $_POST['email'] : '';
	// $mail_category = isset( $_POST['category'] ) ? $_POST['category'] : '';
	// $mail_budget = isset( $_POST['budget'] ) ? $_POST['budget'] : '';
	$mail_message = isset($_POST['message']) ? $_POST['message'] : '';
	$mail_mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';

	// Server settings
	$mail->isSMTP(); // Send using SMTP
	$mail->Mailer = "smtp";
	$mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
	$mail->SMTPDebug  = 1;
	$mail->SMTPAuth = true; // Enable SMTP authentication
	$mail->SMTPSecure = 'tls';
	$mail->Username = 'talkhimanshupunsari@gmail.com'; // SMTP username
	$mail->Password = 'himanshu.patel@punsari'; // SMTP password
	$mail->Port = 587; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

	$mail->setFrom($mail_to_email, $mail_to_name); // Your email
	$mail->addAddress($mail_to_email, $mail_to_name); // Add a recipient

	// for($ct=0; $ct<count($_FILES['file_attach']['tmp_name']); $ct++) {
	// 	$mail->AddAttachment($_FILES['file_attach']['tmp_name'][$ct], $_FILES['file_attach']['name'][$ct]);
	// }

	// Content
	$mail->isHTML(true); // Set email format to HTML

	$mail->Subject = $mail_subject;
	$mail->Body = '
		<strong>Name:</strong> ' . $mail_from_name . '<br>
		<strong>Email:</strong> ' . $mail_from_email . '<br>
		<strong>Mobile:</strong> ' . $mail_mobile . '<br>
		<strong>Message:</strong> ' . $mail_message;
	if (!$mail->Send()) {
		header("HTTP/1.1 500 Error while sending Email.");
	} else {
		header("HTTP/1.1 200 Message has been sent");
	}
} catch (Exception $e) {
	header("HTTP/1.1 500 Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
}
