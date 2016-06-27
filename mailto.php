<?php
//connect PHPMailer class
require_once('../../../PHPMailer_5.2.0/class.phpmailer.php');

$mail = new PHPMailer();
//contact message
$body = $_POST["message"];
//contact email
$address = $_POST["contactEmail"];
//contact name
$name = $_POST["contactName"];

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "mail.arnuga3.co.uk"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Username   = "contacts@arnuga3.co.uk";  //username
$mail->Password   = "zfBg4^64Y";            //password
//emial from
$mail->SetFrom($address, $name);
//reply option in email(set to submitted email and name)
$mail->AddReplyTo($address, $name);

$mail->Subject    = "New contact message";

$mail->MsgHTML($body);
//send this email to
$mail->AddAddress("contacts@arnuga3.co.uk", "Cleaning Services");

//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
} else {
	echo "Message sent!";
}
?>