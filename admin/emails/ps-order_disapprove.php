<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/phpmailer/src/Exception.php';
require '../vendor/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/src/SMTP.php';

$conn = $pdo->open();

$stmt = $conn->prepare("SELECT * FROM email_settings WHERE id = 1");
$stmt->execute();
$email_settings = $stmt->fetch();

$email_host = $email_settings['stmphost'];
$email_username = $email_settings['stmpuser'];
$email_password = $email_settings['password'];
$email_port = $email_settings['portno'];
$email_from = $email_settings['from_email'];
$email_reply = $email_settings['replyto'];

$message = "

<!doctype html>
<html lang='en-US'>

<head>
<meta content='text/html; charset=utf-8' http-equiv='Content-Type' />
<title>Shippments Order</title>
<meta name='description' content='Shippments Order.'>
<style type='text/css'>
a:hover {text-decoration: underline !important;}
</style>
</head>

<body marginheight='0' topmargin='0' marginwidth='0' style='margin: 0px; background-color: #f2f3f8;' leftmargin='0'>
<table cellspacing='0' border='0' cellpadding='0' width='100%' bgcolor='#f2f3f8'
style='@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif;'>
<tr>
<td>
<table style='background-color: #f2f3f8; max-width:670px;  margin:0 auto;' width='100%' border='0'
align='center' cellpadding='0' cellspacing='0'>
<tr>
<td style='height:80px;'>&nbsp;</td>
</tr>
<tr>
<td style='text-align:center;'>
<a href='".$settings['site_url']."' title='logo' target='_blank'>
<img width='300' src='".$settings['site_url']."assets/img/core/".$settings['logo_line']."'>
</a>
</td>
</tr>
<tr>
<td style='height:20px;'>&nbsp;</td>
</tr>
<tr>
<td>
<table width='95%' border='0' align='center' cellpadding='0' cellspacing='0'
style='max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);'>
<tr>
<td style='height:40px;'>&nbsp;</td>
</tr>
<tr>
<td style='padding:0 35px;'>
<h1 style='color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;'>Shippments Order Notification</h1>
<span
style='display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;'></span>
<p style='color:#455056; font-size:15px;line-height:24px; margin:0;'>
Hello, this is to confirm that your Order with ID ".$ref_id." was  unsuccessful.
<br>Summary of the transactions is shown below:
</p>
<hr>
<table cellspacing='10' border='0' cellpadding='5' width='100%' bgcolor='#f2f3f8'>
  <tr>
    <th style='text-align: left !important'>Order Name</th>
    <td style='text-align: right !important'>".$row['orders_name']."</td>
  </tr>
  <tr>
    <th style='text-align: left !important'>No. of Products</th>
    <td style='text-align: right !important'>".$products['numrows']."</td>
  </tr>
  <tr>
    <th style='text-align: left !important'>Amount</th>
    <td style='text-align: right !important'>".$amount."</td>
  </tr>
  <tr>
    <th style='text-align: left !important'>Date Issues</th>
    <td style='text-align: right !important'>".date('d/m/Y', strtotime($row['date_created']))."</td>
  </tr>
  <tr>
    <th style='text-align: left !important'>Status</th>
    <td style='text-align: right !important'><span style='color: green'>Order Disapproved</span></td>
  </tr>
</table>
<hr>
<p style='font-size:15px; color:#455056; margin:8px 0 0; line-height:24px;'>
  Login to your dashboard to learn more.
</p>
<a href='".$settings['site_url']."login'
style='background:#FF6E01;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;'>Login</a>
</td>
</tr>
<tr>
<td style='height:40px;'>&nbsp;</td>
</tr>
</table>
</td>
<tr>
<td style='height:20px;'>&nbsp;</td>
</tr>
<tr>
<td style='text-align:center;'>
<p style='font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;'>&copy; ".date('Y')." <strong>".$settings['site_name']."</strong></p>
</td>
</tr>
<tr>
<td style='height:80px;'>&nbsp;</td>
</tr>
</table>
</td>
</tr>
</table>
</body>

</html>
";

$mail = new PHPMailer(true);
try {
  //Server settings
  // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
  $mail->isSMTP();
  $mail->Host = $email_host;
  $mail->SMTPAuth = true;
  $mail->CharSet = 'UTF-8';
  $mail->Encoding = 'base64';
  $mail->Username = $email_username;
  $mail->Password = $email_password;
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  $mail->Port = $email_port;

  $mail->setFrom($email_from, $settings['site_name']);

  //Recipients
  // $mail->addAddress($settings['admin_email'], 'Shippments Order');
  $mail->addAddress($iow['email']);
  $mail->addReplyTo($email_reply, $settings['site_name']);

  //Content
  $mail->isHTML(true);
  $mail->Subject = $settings['site_name']." Shippments Order Notification";
  $mail->Body = $message;

  $mail->send();

}
catch (Exception $e) {
  $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
}



?>
