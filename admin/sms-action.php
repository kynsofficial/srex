<?php

include 'include/session.php';

if (isset($_POST['send'])) {
  $conn = $pdo->open();
  $sender_name = $_POST['sender_name'];
  $TagifyUserList = $_POST['TagifyUserList'];
  $subject = $_POST['subject'];
  $real_message = $_POST['message'];
  $encode_message = urlencode($_POST['message']);

  $text_api = $settings['text_api_key'];
  $text_dnd = $settings['text_api_dnd'];

  $sep = '"';

  $TagifyUserList = str_replace("[{", "{".$sep."data$sep: [{", $TagifyUserList);
    $TagifyUserList = str_replace("}]", "}]}", $TagifyUserList);

    try {
      $re_tagify = json_decode($TagifyUserList);
      $resultstr = array();
      foreach ($re_tagify->data as $res => $value) {
        $resultstr[] = $value->email;
      }

      $receipient = implode(",", $resultstr);
      // echo $receipient;

      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.bulksmsnigeria.com/api/v1/sms/create?api_token={$settings['text_api_key']}&from={$sender_name}&to={$receipient}&body={$encode_message}&dnd={$text_dnd}",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
      ));
      $response = curl_exec($curl);
      curl_close($curl);
      $res = json_decode($response);

      // echo "<pre>";
      // echo "$response";
      // echo "$encode_message";
      // echo "</pre>";

      $status_code = $res->data->status;
      $status_message = $res->data->message;
      // $order_id = $res->order_id;

      if($status_code == 'success')
      {
        // $stmt = $conn->prepare("INSERT INTO transaction_bulkemail (trxid, userid, amount, total_no, subject, message, from_sender, from_email, to_receipent, datetime, status) VALUES (:trxid, :userid, :amount, :total_no, :subject, :message, :sender_name, :sender_email, :receipient, :datetime, :status)");
        // $stmt->execute(['trxid'=>$trx_ref, 'userid'=>$user['id'], 'amount'=>$amount, 'total_no'=>$t, 'subject'=>$subject, 'message'=>$real_message, 'sender_name'=>$sender_name, 'sender_email'=>$sender_email, 'receipient'=>$receipient, 'datetime'=>$date, 'status'=>1]);

        $_SESSION['success'] = "SMS sent to $receipient was successful.";
        echo "<script>window.location.assign('sms')</script>";

      }elseif ($status_code == 'failure') {

        // $stmt = $conn->prepare("INSERT INTO error_logs (userid, order_id, status_message,	type) VALUES (:userid, :order_id, :status_message, :type)");
        // $stmt->execute(['userid'=>$user['id'], 'order_id'=>$trx_ref, 'status_message'=>$status_message, 'type'=>$type]);

        $_SESSION['error'] = 'Opps, something went wrong, try again later.'.$status_message;
        echo "<script>window.location.assign('sms')</script>";

      }


    }
    catch (Exception $e) {
      $_SESSION['error'] = $e->getMessage();
      echo "<script>window.location.assign('sms')</script>";
    }

    // echo "<br>From - $sender_name <br>";
    // echo "Subject - $subject <br>";
    //
    // foreach ($re_tagify->data as $res) {
    //   echo "To - $res->email <br>";
    // }
    // echo "Message - $real_message <br>";
    // echo "Encoded Message - $encode_message <br>";
    $pdo->close();
  }
  else{
    $_SESSION['error'] = 'Opps, something went wrong, try again later.';
    header('location: sms');
  }
  // $_SESSION['error'] = 'Opps, something went wrong, try again later.';
  // header('location: sms');
  // echo "<script>window.location.assign('sms')</script>";
  ?>
