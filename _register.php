<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/phpmailer/src/Exception.php';
require 'vendor/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/src/SMTP.php';

include 'include/session.php';
$trx_ref = "TRX".time();

if(isset($_GET['return'])){
	$return = $_GET['return'];
}
else{
	$return = 'register';
}

if(isset($_POST['index'])){
	$fullname = $_POST['fullname'];
	$fullnameP = explode(" ", $fullname);
	$firstname = $fullnameP[0];
	$lastname = $fullnameP[1];
	$username = substr($fullnameP[0], 0, 3).''.substr($fullnameP[1], 0, 3).''.substr(rand(), 0, 3);
	$contact_info = $_POST['phone'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	// $repassword = $_POST['repassword'];

	if (isset($_POST['email'])) {
		$reffered_by = $_POST['email'];
		$link = "register?email=".$reffered_by;
	}else {
		$reffered_by = 'Harkone';
		$link = "register";
	}

	$_SESSION['username'] = $username;
	$_SESSION['firstname'] = $firstname;
	$_SESSION['lastname'] = $lastname;
	$_SESSION['contact_info'] = $contact_info;
	$_SESSION['email'] = $email;

	$uppercaseCon = preg_match('@[A-Z]@', $password);
	$lowercaseCon = preg_match('@[a-z]@', $password);
	$numberCon = preg_match('@[0-9]@', $password);
	$specialCon = preg_match('@[^\w]@', $password);

	if(strlen($password) < 8){
		// if(!$uppercaseCon || !$lowercaseCon || !$numberCon || !$specialCon || strlen($password) < 8){
		$_SESSION['error'] = 'Password should be at least 8 characters in length!';
		echo "<script>window.location.assign('$link')</script>";
	}
	else{
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM settings WHERE id = 1");
		$stmt->execute();
		$settings = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM email_settings WHERE id = 1");
		$stmt->execute();
		$email_settings = $stmt->fetch();

		$email_host = $email_settings['stmphost'];
		$email_username = $email_settings['stmpuser'];
		$email_password = $email_settings['password'];
		$email_port = $email_settings['portno'];
		$email_from = $email_settings['from_email'];
		$email_reply = $email_settings['replyto'];

		// $bvn = $settings['bvn'];

		$secret_key = $settings['secret_key'];
		$site_name = $settings['site_name'];

		$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE email=:email");
		$stmt->execute(['email'=>$email]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE username=:username");
		$stmt->execute(['username'=>$username]);
		$iow = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Email already taken';
			echo "<script>window.location.assign('$link')</script>";
		}elseif ($iow['numrows'] > 0){
			$_SESSION['error'] = 'Username already taken';
			echo "<script>window.location.assign('$link')</script>";
		}
		else{
			$now = date('Y-m-d');
			$password = password_hash($password, PASSWORD_DEFAULT);

			//generate code
			$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$code = substr(str_shuffle($set), 0, 12);

			// Update the referrals
			// $stmt = $conn->prepare("SELECT * FROM users WHERE username = :reffered_by");
			// $stmt->execute(['reffered_by'=>$reffered_by]);
			// $reffered_by = $stmt->fetch();

			// echo $reffered_by['referrals'];
			// echo "<br>";
			// echo $reffered_by['username'];
			// echo "<br>";
			// echo $reffered_by['id'];

// 			$request = [
// 				'email' => $email,
// 				'phone' => $contact_info,
// 				'first_name' => $firstname,
// 				'last_name' => $lastname
// 			];

// 			$curl = curl_init();
// 			curl_setopt_array($curl, array(
// 			  CURLOPT_URL => "https://api.paystack.co/customer",
// 			  CURLOPT_RETURNTRANSFER => true,
// 			  CURLOPT_ENCODING => "",
// 			  CURLOPT_MAXREDIRS => 10,
// 			  CURLOPT_TIMEOUT => 0,
// 			  CURLOPT_FOLLOWLOCATION => true,
// 			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// 			  CURLOPT_CUSTOMREQUEST => "POST",
// 			  CURLOPT_POSTFIELDS => json_encode($request),
// 			  CURLOPT_HTTPHEADER => array(
// 					"Content-Type: application/json",
// 					"Authorization: Bearer {$secret_key}"
// 			  ),
// 			));
// 			$response = curl_exec($curl);
// 			curl_close($curl);

			// echo "<pre>";
			// echo $response;
			// echo "</pre>";

			//$res = json_decode($response);
			if(true)
			{
				//$order_ref = $res->data->id; // Use to call back customer in the user dashboard

				try{
					// Insert new user into DB
					// $stmt = $conn->prepare("UPDATE users SET referrals=:current_ref WHERE username=:ref_username");
					// $stmt->execute(['current_ref'=>$reffered_by['referrals']+1, 'ref_username'=>$reffered_by['username']]);

					$stmt = $conn->prepare("INSERT INTO users (username, email, contact_info, password, firstname, lastname, activate_code, created_on) VALUES (:username, :email, :contact_info, :password, :firstname, :lastname, :code, :now)");
					$stmt->execute(['username'=>$username, 'email'=>$email, 'contact_info'=>$contact_info, 'password'=>$password, 'firstname'=>$firstname, 'lastname'=>$lastname, 'code'=>$code, 'now'=>$now]);
					$userid = $conn->lastInsertId();

					// $stmt = $conn->prepare("UPDATE users SET referredby_userid=:ref_id WHERE id=:userid");
					// $stmt->execute(['ref_id'=>$reffered_by['id'], 'userid'=>$userid]);

					$message = "
					<!doctype html>
					<html lang='en-US'>

					<head>
					  <meta content='text/html; charset=utf-8' http-equiv='Content-Type' />
					  <title>New Account on ".$settings['site_name']."</title>
					  <meta name='description' content='New Account Email Template.'>
					  <style type='text/css'>
					    a:hover {text-decoration: underline !important;}
					  </style>
					</head>

					<body marginheight='0' topmargin='0' marginwidth='0' style='margin: 0px; background-color: #f2f3f8;' leftmargin='0'>
					  <table cellspacing='0' border='0' cellpadding='0' width='100%' bgcolor='#f2f3f8'
					  style='@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif;'>
					  <tr>
					    <td>
					      <table style='background-color: #f2f3f8; max-width:670px; margin:0 auto;' width='100%' border='0'
					      align='center' cellpadding='0' cellspacing='0'>
					      <tr>
					        <td style='height:80px;'>&nbsp;</td>
					      </tr>
					      <tr>
					        <td style='text-align:center;'>
					          <a href='".$settings['site_url']."' title='logo' target='_blank'>
					            <img width='150' src='".$settings['site_url']."assets/images/".$settings['logo_line']."'>
					          </a>
					        </td>
					      </tr>
					      <tr>
					        <td style='height:20px;'>&nbsp;</td>
					      </tr>
					      <tr>
					        <td>
					          <table width='95%' border='0' align='center' cellpadding='0' cellspacing='0'
					          style='max-width:670px; background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);'>
					          <tr>
					            <td style='height:40px;'>&nbsp;</td>
					          </tr>
					          <tr>
					            <td style='padding:0 35px;'>
					              <h1 style='color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;'>Get started <br> ".$firstname." ".$lastname."</h1>
					              <p style='font-size:15px; color:#455056; margin:8px 0 0; line-height:24px;'> Your account has been created on ".$settings['site_name'].". <br> Below are your registered credentials, <br><strong>Click on the button below to activate your account</strong>.</p>
					                  <span style='display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;'></span>
					                  <p style='color:#455056; font-size:18px;line-height:20px; margin:0; font-weight: 500;'>
						                  <strong style='display: block;font-size: 13px; margin: 0 0 4px; color:rgba(0,0,0,.64); font-weight:normal;'>Username</strong>".$username."
						                  <strong style='display: block; font-size: 13px; margin: 24px 0 4px 0; font-weight:normal; color:rgba(0,0,0,.64);'>Password</strong>".$_POST['password']."
					                	</p>

					                <a href='".$settings['site_url']."activate?code=".$code."&user=".$userid."'
					                style='background:#13293d;text-decoration:none !important; display:inline-block; font-weight:500; margin-top:24px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;'>Activate Your Account</a>
					              </td>
					            </tr>
					            <tr>
					              <td style='height:40px;'>&nbsp;</td>
					            </tr>
					          </table>
					        </td>
					      </tr>
					      <tr>
					        <td style='height:20px;'>&nbsp;</td>
					      </tr>
					      <tr>
					        <td style='text-align:center;'>
					          <p style='font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;'>&copy; ".date('Y')." <strong>".$settings['site_name']."</strong> </p>
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
						$mail->Username = $email_username;
						$mail->Password = $email_password;
						$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
						$mail->Port = $email_port;

						$mail->setFrom($email_from, $settings['site_name']);

						//Recipients
						// $mail->addAddress($settings['admin_email'], 'New Signup');
						$mail->addAddress($email, $settings['site_name .'].' New Signup');
						$mail->addReplyTo($email_reply, $settings['site_name']);

						//Content
						$mail->isHTML(true);
						$mail->Subject = $settings['site_name']." Sign Up";
						$mail->Body    = $message;

						$mail->send();

						unset($_SESSION['firstname']);
						unset($_SESSION['lastname']);
						unset($_SESSION['email']);
						unset($_SESSION['username']);
						unset($_SESSION['contact_info']);

						$_SESSION['success'] = 'Account created. Check your email to activate. If you cant find the email, check your spam or <a href="contact">reach</a> out to us if you still cant find it.';
						echo "<script>window.location.assign('register')</script>";

					}
					catch (Exception $e) {
						$_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
						echo "<script>window.location.assign('$link')</script>";
					}


				}
				catch(PDOException $e){
					$_SESSION['error'] = $e->getMessage();
					echo "<script>window.location.assign('$link')</script>";
				}

			}else{
				// echo "$link";
				$_SESSION['error'] = 'Opps, an error occcured. Try again later.';
				echo "<script>window.location.assign('$link')</script>";
			}

			$pdo->close();

		}

	}

}
else{
	$_SESSION['warning'] = 'No shortcuts, Fill up registration form first';
	echo "<script>window.location.assign('register')</script>";
}

?>
