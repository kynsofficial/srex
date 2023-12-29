<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/phpmailer/src/Exception.php';
require '../vendor/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/src/SMTP.php';

include 'include/session.php';

if (isset($_POST['send'])) {
  $conn = $pdo->open();
  $sender_name = $_POST['sender_name'];
  $sender_email = $_POST['sender_email'];
  $TagifyUserList = $_POST['TagifyUserList'];
  $subject = $_POST['subject'];
  $real_message = $_POST['message'];

  $sep = '"';

  $TagifyUserList = str_replace("[{", "{".$sep."data$sep: [{", $TagifyUserList);
    $TagifyUserList = str_replace("}]", "}]}", $TagifyUserList);


    $stmt = $conn->prepare("SELECT * FROM email_settings WHERE id = 1");
    $stmt->execute();
    $email_settings = $stmt->fetch();

    $email_host = $email_settings['stmphost'];
    $email_username = $email_settings['stmpuser'];
    $email_password = $email_settings['password'];
    $email_port = $email_settings['portno'];
    $email_from = $email_settings['from_email'];
    $email_reply = $email_settings['replyto'];

    $mail = new PHPMailer(true);
    try {
      // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
      $mail->isSMTP();
      $mail->Host = $email_host;
      $mail->Charset = 'UTF-8';
      // $mail->Encoding = 'base64';
      $mail->SMTPAuth = true;
      $mail->Username = $email_username;
      $mail->Password = $email_password;
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
      $mail->Port = $email_port;

      $mail->setFrom($email_from, $sender_name);

      //Content
      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body = $real_message;

      //Recipients
      // $mail->addAddress($settings['email']);
      // $mail->addAddress($receipient);

      // $re_tagify = json_decode($TagifyUserList);
      // $resultstr = array();
      // foreach ($re_tagify->data as $res => $value) {
      //   $resultstr[] = $value->email;
      // }
      // var_dump($resultstr);

      $re = json_decode($TagifyUserList);
      foreach ($re->data as $res) {
        try {
          $mail->addAddress($res->email, $res->name);
        } catch (Exception $e) {
          $_SESSION['error'] = 'Invalid address skipped: ' . htmlspecialchars($res->email) . '<br>';
          continue;
        }

        try {
          $mail->send();
          echo 'Message sent to :' . htmlspecialchars($res->email) . ' (' . htmlspecialchars($res->email) . ')<br>';
          $_SESSION['success'] = 'Email has been Sent';
          echo "<script>setTimeout(function () {
            window.location.href = 'email';
          },9000);</script>";
        }
        catch (Exception $e) {
          $_SESSION['error'] = 'Mailer Error (' . htmlspecialchars($res->email) . ') ' . $mail->ErrorInfo;
          $mail->getSMTPInstance()->reset();
        }
        $mail->clearAddresses();
      }
      $mail->addReplyTo($sender_email, $sender_name);

      //$mail->send();

      // $stmt = $conn->prepare("INSERT INTO transaction_bulkemail (trxid, userid, amount, total_no, subject, message, from_sender, from_email, to_receipent, datetime, status) VALUES (:trxid, :userid, :amount, :total_no, :subject, :message, :sender_name, :sender_email, :receipient, :datetime, :status)");
      // $stmt->execute(['trxid'=>$trx_ref, 'userid'=>$user['id'], 'amount'=>$amount, 'total_no'=>$t, 'subject'=>$subject, 'message'=>$real_message, 'sender_name'=>$sender_name, 'sender_email'=>$sender_email, 'receipient'=>$receipient, 'datetime'=>$date, 'status'=>1]);

    }
    catch (Exception $e) {
      $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
      echo "<script>window.location.assign('email')</script>";
    }


    // echo "From - $sender_name <br>";
    // echo "Email - $sender_email <br>";
    // //echo "$TagifyUserList <br>";
    // echo "Subject - $subject <br>";
    // $re = json_decode($TagifyUserList);
    // foreach ($re->data as $res) {
    //   echo "To - $res->email <br>";
    // }
    // echo "Message - $real_message <br>";


    $pdo->close();
  }
  else {
    $_SESSION['error'] = 'Opps, something went wrong, try again later.';
    echo "<script>window.location.assign('email')</script>";
  }
  ?>
