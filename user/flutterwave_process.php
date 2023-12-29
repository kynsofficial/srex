<?php
include 'include/session.php';
$secret_key = $settings['secret_key'];
$date = date('d/m/Y H:i');
$trxid = $_GET['tx_ref'];
$type = "Flutterwave";
if(isset($_GET['status']))
{
  $conn = $pdo->open();
  //* check payment status
  if($_GET['status'] == 'cancelled')
  {
    // echo 'YOu cancel the payment';
    //  1 is successful, 2 is Unsuccessful/pending, 3 is canceled.
    try{
      // $stmt = $conn->prepare("INSERT INTO transaction_flutterwave (trxid, userid, datetime, status) VALUES (:trxid, :userid, :datetime, :status)");
      // $stmt->execute(['trxid'=>$trxid, 'userid'=>$user['id'], 'datetime'=>$date, 'status'=>2]);
      //
      // $stmt = $conn->prepare("INSERT INTO transaction_all (userid, trxid, type, status) VALUES (:userid, :trxid, :type, :status)");
      // $stmt->execute(['userid'=>$user['id'], 'trxid'=>$trxid, 'type'=>$type, 'status'=>2]);

      $_SESSION['cancelled'] = 'You cancelled this payment';
      echo "<script>window.location.assign('wallet')</script>";
    }
    catch(PDOException $e){
      $_SESSION['error'] = $e->getMessage();
      echo "<script>window.location.assign('wallet')</script>";
    }
  }
  elseif($_GET['status'] == 'successful' || $_GET['status'] == 'completed')
  {
    $txid = $_GET['transaction_id'];

    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM transaction_flutterwave WHERE trxid=:trxid");
    $stmt->execute(['trxid'=>$txid]);
    $row = $stmt->fetch();

    if ($row['trxid'] > 0) {
      //   // echo "I exist";
      //
      $status_message = "Fraud Transaction Detected - Transaction already exist";

      $stmt = $conn->prepare("INSERT INTO error_logs (userid, order_id, status_message,	type) VALUES (:userid, :order_id, :status_message, :type)");
      $stmt->execute(['userid'=>$user['id'], 'order_id'=>$txid, 'status_message'=>$status_message, 'type'=>$type]);

      $_SESSION['error'] = $status_message;
      echo "<script>window.location.assign('wallet')</script>";

    }
    else
    {

      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/{$txid}/verify",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "Content-Type: application/json",
          "Authorization: Bearer {$secret_key}"
          // "Authorization: Bearer FLWSECK_TEST-a82c2045750d7e77d7e405f90c6a9ebe-X"
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

    //   echo "<pre>";
    //   echo $response;
    //   echo "</pre>";

      $res = json_decode($response);

      if($res->status == "success") {
        $amountPaid1 = $res->data->charged_amount;
        $amountToPay = $res->data->meta->price;
        $appFee = $res->data->app_fee;
        $merchantFee = $res->data->merchant_fee;
        $type = "Flutterwave";
        if($amountPaid1 >= $amountToPay)
        {
          $calc_1 = $amountPaid1*100;
          $calc_2 = (100+$settings['percentage']);
          $amountPaid = $calc_1/$calc_2;
          //echo $amountPaid;
          try{
            $stmt = $conn->prepare("INSERT INTO transaction_flutterwave (trxid, userid, amount, datetime, status) VALUES (:trxid, :userid, :amount, :datetime, :status)");
            $stmt->execute(['trxid'=>$txid, 'userid'=>$user['id'], 'amount'=>$amountPaid, 'datetime'=>$date, 'status'=>1]);

            $stmt = $conn->prepare("INSERT INTO transaction_all (userid, trxid, amount,	type, status) VALUES (:userid, :trxid, :amount, :type, :status)");
            $stmt->execute(['userid'=>$user['id'], 'trxid'=>$txid, 'amount'=>$amountPaid, 'type'=>$type, 'status'=>1]);

            $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
            $stmt->execute(['id'=>$user['id']]);
            $row = $stmt->fetch();
            $balance_amount = $row['balance'];

            $amountTotal = $balance_amount + $amountPaid;

            $stmt = $conn->prepare("UPDATE users SET balance=:balance WHERE id=:id");
            $stmt->execute(['balance'=>$amountTotal, 'id'=>$user['id']]);
            
            // Send mail
            include 'emails/deposit_email.php';

            $_SESSION['success'] = 'Payment has been confirmed & your wallet balance has been updated!';
            echo "<script>window.location.assign('wallet')</script>";
          }
          catch(PDOException $e){
            $_SESSION['error'] = $e->getMessage();
            echo "<script>window.location.assign('wallet')</script>";
          }
          // echo 'Payment successful';

          //* Continue to give item to the user
        }
        else
        {
          $status_message = "Fraudulent Transaction Detected";

          // $stmt = $conn->prepare("INSERT INTO transaction_flutterwave (trxid, userid, amount, datetime, status) VALUES (:trxid, :userid, :amount, :datetime, :status)");
          // $stmt->execute(['trxid'=>$txid, 'userid'=>$user['id'], 'amount'=>$amountPaid1, 'datetime'=>$date, 'status'=>0]);
          //
          // $stmt = $conn->prepare("INSERT INTO transaction_all (userid, trxid, amount,	type, status) VALUES (:userid, :trxid, :amount, :type, :status)");
          // $stmt->execute(['userid'=>$user['id'], 'trxid'=>$txid, 'amount'=>$amountPaid1, 'type'=>$type, 'status'=>0]);

          $stmt = $conn->prepare("INSERT INTO error_logs (userid, order_id, status_message,	type) VALUES (:userid, :order_id, :status_message, :type)");
          $stmt->execute(['userid'=>$user['id'], 'order_id'=>$txid, 'status_message'=>$status_message, 'type'=>$type]);

          $_SESSION['error'] = 'Fraudulent transaction detected!';
          echo "<script>window.location.assign('wallet')</script>";
          // echo 'Fraud transaction detected';
        }
      }
      elseif ($res->status == 'error') {
        $status_message = "Invalid Transaction!";

        // $stmt = $conn->prepare("INSERT INTO transaction_flutterwave (trxid, userid, amount, datetime, status) VALUES (:trxid, :userid, :amount, :datetime, :status)");
        // $stmt->execute(['trxid'=>$txid, 'userid'=>$user['id'], 'amount'=>$amountPaid1, 'datetime'=>$date, 'status'=>0]);
        //
        // $stmt = $conn->prepare("INSERT INTO transaction_all (userid, trxid, amount,	type, status) VALUES (:userid, :trxid, :amount, :type, :status)");
        // $stmt->execute(['userid'=>$user['id'], 'trxid'=>$txid, 'amount'=>$amountPaid1, 'type'=>$type, 'status'=>0]);

        $stmt = $conn->prepare("INSERT INTO error_logs (userid, order_id, status_message,	type) VALUES (:userid, :order_id, :status_message, :type)");
        $stmt->execute(['userid'=>$user['id'], 'order_id'=>$txid, 'status_message'=>$status_message, 'type'=>$type]);

        $_SESSION['error'] = 'Invalid transaction!';
        echo "<script>window.location.assign('wallet')</script>";
        // echo 'Fraud transaction detected';
      }
      else
      {
        $status_message = "Can not process payment!";

        // $stmt = $conn->prepare("INSERT INTO transaction_flutterwave (trxid, userid, amount, datetime, status) VALUES (:trxid, :userid, :amount, :datetime, :status)");
        // $stmt->execute(['trxid'=>$txid, 'userid'=>$user['id'], 'amount'=>$amountPaid, 'datetime'=>$date, 'status'=>0]);

        $stmt = $conn->prepare("INSERT INTO error_logs (userid, order_id, status_message,	type) VALUES (:userid, :order_id, :status_message, :type)");
        $stmt->execute(['userid'=>$user['id'], 'order_id'=>$txid, 'status_message'=>$status_message, 'type'=>$type]);

        $_SESSION['error'] = 'Can not process payment!';
        echo "<script>window.location.assign('wallet')</script>";
        // echo 'Can not process payment';
      }
    }
  }
  else {
    $_SESSION['error'] = 'An error occured';
    echo "<script>window.location.assign('wallet')</script>";
  }
}
?>
