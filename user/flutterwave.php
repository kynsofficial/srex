<?php
include 'include/session.php';
// require_once 'includes/head.php';

if(isset($_POST['pay']))
{

  $email = $user['email'];
  $phonenumber = $user['contact_info'];
  $name = $user['firstname'].' '.$user['lastname'];
  if($_POST['amount'] == ""){
      $_SESSION['error'] = 'Amount is needed';
      echo "<script>window.location.assign('wallet')</script>";
  }
  $amount = $_POST['amount'];
  $secret_key = $settings['secret_key'];
  $trx_ref = "TRX".time();
  $redirect_url = $settings['site_url']."user/flutterwave_process";
  $logo = $settings['site_url']."assets/images/".$settings['favicon'];
  $date = date('d/m/Y H:i');
  $title = $settings['site_name']." Flutterwave Payment";

    //* Prepare our rave request
    $request = [
        'tx_ref' => $trx_ref,
        'amount' => $amount,
        'currency' => 'NGN',
        'payment_options' => 'card, banktransfer, ussd',
        'redirect_url' => $redirect_url,
        'customer' => [
            'email' => $email,
            'name' => $name,
            'phone_number' => $phonenumber
        ],
        'meta' => [
            'price' => $amount
        ],
        'customizations' => [
            'title' => $title,
            'description' => 'Payment for wallet',
            'logo' => $logo
        ]
    ];

    //* Ca;; f;iterwave emdpoint
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.flutterwave.com/v3/payments',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($request),
    CURLOPT_HTTPHEADER => array(
        // 'Authorization: Bearer FLWSECK_TEST-a82c2045750d7e77d7e405f90c6a9ebe-X',
        "Authorization: Bearer {$secret_key}",
        "Content-Type: application/json"
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    // echo "<pre>";
    // echo $response;
    // echo "</pre>";

    $res = json_decode($response);
    if($res->status == 'success')
    {
        $link = $res->data->link;
        header('Location: '.$link);
    }
    else
    {
      $_SESSION['error'] = 'Can not process payment [Flutter]!';
      // header('Location: wallet');
    	echo "<script>window.location.assign('wallet')</script>";
        // echo 'We can not process your payment';
    }
}else {
  $_SESSION['error'] = 'Fill up transfer form first';
  echo "<script>window.location.assign('wallet')</script>";
}

?>
