<?php session_start();?>
<!DOCTYPE html>
<html lang="en" class="light-style " dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template">
<?php include 'include/session.php'; ?>
<?php
date_default_timezone_set("Africa/Lagos");
$conn = $pdo->open();
try{
  $stmt = $conn->prepare("SELECT * FROM about WHERE id = 1");
  $stmt->execute();
  $about = $stmt->fetch();
}
catch(PDOException $e){
  echo "There is some problem in connection: " . $e->getMessage();
}
$pdo->close();
$now = date('d F, Y');
?>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title><?php echo $settings['site_name']; ?> | <?php echo $admin['username']; ?></title>
  <meta name="description" content="<?php echo $settings['site_desc']; ?>">
  <meta name="keyword" content="<?php echo $settings['site_keyword']; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="theme-color" content="<?php echo $settings['theme']; ?>">
  <meta name="msapplication-navbutton-color" content="<?php echo $settings['theme']; ?>">
  <meta name="apple-mobile-web-app-status-bar-style" content="<?php echo $settings['theme']; ?>">
  <meta name="language" content="English">
  <meta name="revisit-after" content="1 days">
  <meta name="author" content="Adebisi Covenant">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?php echo $settings['site_url']; ?>" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <meta property="og:title" content="<?php echo $settings['site_name']; ?>"/>
  <meta property="og:locale" content="en_US"/>
  <meta property="og:url" content="<?php echo $settings['site_url']; ?>"/>
  <meta property="og:type" content="website"/>
  <meta property="og:description" content="<?php echo $settings['site_desc']; ?>">
  <meta property="og:image" content="<?php echo $settings['site_url']; ?>assets/img/core/<?php echo $settings['favicon']; ?>">

  <meta property="twitter:card" content="summary"/>
  <meta property="twitter:title" content="<?php echo $settings['site_name']; ?>"/>
  <meta property="twitter:description" content="<?php echo $settings['site_desc']; ?>">
  <meta property="twitter:url" content="<?php echo $settings['site_url']; ?>"/>
  <meta property="twitter:image" content="<?php echo $settings['site_url']; ?>assets/img/core/<?php echo $settings['favicon']; ?>">

  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $settings['site_url']; ?>assets/img/core/<?php echo $settings['favicon']; ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $settings['site_url']; ?>assets/img/core/<?php echo $settings['favicon']; ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $settings['site_url']; ?>assets/img/core/<?php echo $settings['favicon']; ?>">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo $settings['site_url']; ?>assets/img/core/<?php echo $settings['favicon']; ?>">
  <link rel="manifest" href="<?php echo $settings['site_url']; ?>assets/img/favicons/manifest.php">
  <meta name="msapplication-TileImage" content="<?php echo $settings['site_url']; ?>assets/img/core/<?php echo $settings['favicon']; ?>">

  <!-- Icons -->
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/fonts/boxicons.css" />
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/fonts/fontawesome.css" />
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/fonts/flag-icons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/css/demo.css" />


  <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/css/pages/app-invoice-print.css" />
  <!-- Helpers -->
  <script src="<?php echo $settings['site_url']; ?>assets/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
  <script src="<?php echo $settings['site_url']; ?>assets/vendor/js/template-customizer.js"></script>
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="<?php echo $settings['site_url']; ?>assets/js/config.js"></script>
  <!-- Custom notification for demo -->
  <!-- beautify ignore:end -->
</head>

<?php
$conn = $pdo->open();

$slug = $_GET['id'];

try{

  $stmt = $conn->prepare("SELECT * FROM pay_supplier WHERE ref_id = :slug");
  $stmt->execute(['slug' => $slug]);
  $details = $stmt->fetch();

  $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
  $stmt->execute(['id' => $details['userid']]);
  $user = $stmt->fetch();

  if ($details != TRUE) {
    // echo "Not Valid";
    echo "<script>window.location.assign('404')</script>";
  }

}
catch(PDOException $e){
  echo "There is some problem in connection: " . $e->getMessage();
}

?>
<!-- <style media="print">
  body * {
    visibility: hidden;
  }
  #printSection, #printSection * {
    visibility: visible;
    /* height: auto !important; */
  }
  #printSection {
    /* display: block; */
    position: absolute;
    left: 0;
    top: 0;
  }
</style> -->
<body>

  <!-- Content -->

  <div class="invoice-print p-4" id="printSection">

    <!-- <div class="col-md-6 col-lg-12 mb-4 mb-md-0"> -->
      <div class="card">
        <div class="bs-stepper-content p-3">
          <div id="checkout-confirmation" class="content">
            <div class="row">
              <div class="col-12 col-lg-8 offset-lg-2 text-center mb-3">
                <div class="mb-1">
                  <div class="d-flex svg-illustration mb-3 gap-2">
                    <!-- <span class="app-brand-logo demo"> -->
                      <!-- <center> -->
                      <div class="container">
                        <div class="row">
                          <div class="col text-center">
                            <img src="<?php echo $settings['site_url']; ?>assets/img/core/<?php echo $settings['logo_line']; ?>" class="img-fluid brand_img" width="200px" alt="logo">

                          </div>
                        </div>
                      </div>
                        <!-- <img src="<?php echo $settings['site_url']; ?>assets/img/core/<?php echo $settings['logo_line']; ?>" class="img-fluid brand_img" alt="logo"> -->
                      <!-- </center> -->
                    <!-- </span> -->
                  </div>
                </div>
                <h4 class="mt-2">User: <a href="user-details?userid=<?php echo $user['id']; ?>" target="_blank"><?php echo $user['firstname'].' '.$user['lastname'].' ('.$user['username'].')'; ?></a></h4>
                <!-- <button type="button" class="btn btn-info btn-sm" name="button" onclick="window.location.href='user-details?userid=<?php echo $user['id']; ?>'">View User</button> -->
                <!-- <span class="btn btn-success"><a href="user-details?userid=<?php echo $user['id']; ?>" class="text-bg-success" target="_blank">View User Details</a></span> -->
                <p><b>Pay Supplier Order</b> with Ref. ID <a href="javascript:void(0)"><?php echo $details['ref_id']; ?></a></p>
                <b>Payment Status</b>
                <?php

                if ($details['payment_stat'] == 0) {
                  // Not made payment
                  echo "<h2 class='badge bg-warning'>Awaiting Payment</h2>";
                }
                elseif ($details['payment_stat'] == 1) {
                  // We have settle the supplier
                  echo "<h2 class='badge bg-success'>Payment Approved</h2>";
                }
                elseif ($details['payment_stat'] == 2) {
                  // Made payment but we have not settled the supplier
                  echo "<h2 class='badge bg-info'>Proccessing Payments</h2>";
                }
                elseif ($details['payment_stat'] == 3) {
                  // We refunded you back
                  echo "<h2 class='badge bg-secondary'>Funds Refunded</h2>";
                }
                elseif ($details['payment_stat'] == 4) {
                  // You cancelled the order
                  echo "<h2 class='badge bg-danger'>Payment Cancelled</h2>";
                }
                elseif ($details['payment_stat'] == 5) {
                  // You cancelled the order
                  echo "<h2 class='badge bg-danger'>Unapproved Payment</h2>";
                }
                else {
                  // We dont know what is happening
                  echo "<h2 class='badge bg-dark'>Error</h2>";
                }

                ?>
                <br>
                <b>Order Status</b>
                <?php

                if ($details['status'] == 0) {
                  // Not made payment
                  echo "<h2 class='badge bg-warning'>Awaiting Payment</h2>";
                }
                elseif ($details['status'] == 1) {
                  // We have settle the supplier
                  echo "<h2 class='badge bg-success'>Completed</h2>";
                }
                elseif ($details['status'] == 2) {
                  // Made payment but we have not settled the supplier
                  echo "<h2 class='badge bg-info'>Proccessing Order</h2>";
                }
                elseif ($details['status'] == 3) {
                  // We refunded you back
                  echo "<h2 class='badge bg-secondary'>Funds Refunded</h2>";
                }
                elseif ($details['status'] == 4) {
                  // You cancelled the order
                  echo "<h2 class='badge bg-danger'>Order Cancelled</h2>";
                }
                elseif ($details['status'] == 5) {
                  // You cancelled the order
                  echo "<h2 class='badge bg-danger'>Unsuccessfull Order</h2>";
                }
                else {
                  // We dont know what is happening
                  echo "<h2 class='badge bg-dark'>Error</h2>";
                }

                ?>

                <!-- <p>We sent an email to <a href="javascript:void(0)"><?php echo $admin['email']; ?></a> with your order confirmation and receipt. If the email hasn't arrived within two minutes, please check your spam folder to see if the email was routed there.</p> -->
                <p><span class="fw-semibold"><i class="bx bx-time-five"></i> Time placed:</span> <?php echo date('d/m/Y h:ia', strtotime($details['date_created'])); ?></p>
              </div>
              <!-- Confirmation details -->
              <div class="col-12">
                <ul class="list-group list-group-horizontal-md">
                  <li class="list-group-item flex-fill">
                    <h6><i class="bx bx-user"></i> Supplier Contact</h6>
                    <span class="fw-semibold">Name:</span> <?php echo $details['supplier_name']; ?> <br>
                    <span class="fw-semibold">Phone:</span> <?php echo $details['supplier_phone']; ?> <br>
                    <span class="fw-semibold">Email:</span> <?php echo $details['supplier_email']; ?> <br><br>
                  </li>
                  <li class="list-group-item flex-fill">
                    <h6><i class="bx bx-credit-card"></i> Supplier Details</h6>
                    <span class="fw-semibold">Alipay:</span> <?php echo $details['supplier_alipay']; ?> <br>
                    <span class="fw-semibold">WeChat:</span> <?php echo $details['supplier_wechat']; ?> <br>
                    <span class="fw-semibold">Bank Details:</span> <?php echo $details['supplier_bank_account']; ?> <br><br>
                  </li>
                  <li class="list-group-item flex-fill">
                    <h6><i class="bx bx-info-circle"></i> Additional Info</h6>
                    <?php echo $details['additional_info']; ?> <br><br>
                  </li>
                </ul>
              </div>
            <!-- </div>

            <div class="row"> -->
              <!-- Confirmation total -->
              <div class="col-xl-6 mt-3">
                <div class="border rounded p-3">
                  <!-- Price Details -->
                  <h6>Price Details</h6>
                  <dl class="row mb-0">

                    <dt class="col-6 fw-normal">Amount</dt>
                    <dd class="col-6 text-end">¥<?php echo number_format($details['amount'], 2) ?></dd>

                    <dt class="col-6 fw-normal">Services Charges</dt>
                    <dd class="col-6 text-end"><?php if ($rates['suppling_rate'] == 0) { echo '<span class="badge bg-label-success">Free</span>'; } else { echo '<span class="badge bg-label-success">'.$rates['suppling_rate'].'%</span>'; } ?></dd>
                    <?php
                    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM coupon WHERE coupon_code=:coupon_code ");
                    $stmt->execute(['coupon_code'=>$details['coupon_code']]);
                    $coupon_code = $stmt->fetch();

                    $stmt1 = $conn->prepare("SELECT * FROM currency WHERE id = :id");
                    $stmt1->execute(['id'=>$coupon_code['currency']]);
                    $currency_coupon = $stmt1->fetch();

                    if ($coupon_code['value_type'] == 0) {
                      $value = $coupon_code['value']."%"; // "Percentage"
                    }elseif ($coupon_code['value_type'] == 1) {
                      $value = $currency_coupon['sign']."".$coupon_code['value']; // "Amount"
                    }
                    ?>
                    <?php if ($details['coupon_code'] !== ""): ?>
                      <!-- A coupon was applied -->
                      <dt class="col-6 fw-normal">Discount</dt>
                      <dd class="col-6 text-end"><span class="badge bg-label-success"><s><?php echo $value; ?> off</s></span></dd>
                    <?php endif; ?>
                    <?php
                    // Percentage = amount * service_charge/100
                    $charge_yuan = $details['amount'] * $rates['suppling_rate']/100;
                    $total_yuan = $details['amount'] + $charge_yuan;
                    // Naira
                    $charge_naira = $details['naira_equi'] * $rates['suppling_rate']/100;
                    $total_naira = $details['naira_equi'] + $charge_naira;
                    ?>
                    <hr>
                    <dt class="col-6">Sub Total</dt>
                    <dd class="col-6 fw-semibold text-end mb-0">¥<?php echo number_format($total_yuan, 2); ?></dd>

                    <?php if ($details['coupon_code'] == ""): ?>
                      <dt class="col-6">Total</dt>
                      <dd class="col-6 fw-semibold text-end mb-0">¥<?php echo number_format($total_yuan, 2); ?></dd>

                      <dt class="col-6">Equivant to </dt>
                      <dd class="col-6 fw-semibold text-end mb-0"><span ><?php echo $settings['currency']; ?><?php echo number_format($total_naira, 2); ?></span></dd>
                    <?php else: ?>
                      <dt class="col-6">Total</dt>
                      <dd class="col-6 fw-semibold text-end mb-0">¥<?php echo number_format($details['discount_amount'], 2); ?></dd>

                      <dt class="col-6">Equivant to </dt>
                      <dd class="col-6 fw-semibold text-end mb-0"><span ><?php echo $settings['currency']; ?><?php echo number_format($details['discount_naira_equi'], 2); ?></span></dd>
                    <?php endif; ?>

                    <?php if ($details['payment_method'] == "Bank Deposit" AND $details['payment_stat'] > 1): ?>
                      <?php
                      $stmt = $conn->prepare("SELECT * FROM transactions WHERE ref_id=:ref_id");
                      $stmt->execute(['ref_id'=>$details['ref_id']]);
                      $transactions = $stmt->fetch();

                      $stmt = $conn->prepare("SELECT * FROM bank_accounts WHERE account_number=:account_number");
                      $stmt->execute(['account_number'=>$transactions['account']]);
                      $bank_account1 = $stmt->fetch();

                      $stmt = $conn->prepare("SELECT * FROM bank_accounts_others WHERE account_number=:account_number");
                      $stmt->execute(['account_number'=>$transactions['account']]);
                      $bank_account2 = $stmt->fetch();

                      if ($bank_account1 == TRUE) {
                        $bank_account = $bank_account1;
                      }else {
                        $bank_account = $bank_account2;
                      }

                      ?>
                      <dt class="col-6 fs-tiny fw-light"></small>Payment via Bank Deposit</small></dt>
                      <dd class="col-6 fs-tiny text-end"></small><b><?php echo $bank_account['bank_name']; ?> - <?php echo $bank_account['account_number']; ?></b></small></dd>
                      <small> </small>
                    <?php else: ?>
                      <small>Payment Method: <?php echo $details['payment_method']; ?></small>
                    <?php endif; ?>
                  </dl>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    <!-- </div> -->
    <!-- Core JS -->
      <!-- build:js assets/vendor/js/core.js -->
      <script src="../assets/vendor/libs/jquery/jquery.js"></script>
      <script src="../assets/vendor/libs/popper/popper.js"></script>
      <script src="../assets/vendor/js/bootstrap.js"></script>
      <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

      <script src="../assets/vendor/libs/hammer/hammer.js"></script>
      <script src="../assets/vendor/libs/i18n/i18n.js"></script>
      <script src="../assets/vendor/libs/typeahead-js/typeahead.js"></script>

      <script src="../assets/vendor/js/menu.js"></script>
      <!-- endbuild -->

      <!-- Vendors JS -->



      <!-- Main JS -->
      <script src="../assets/js/main.js"></script>

      <!-- Page JS -->
      <script type="text/javascript">
        "use strict";
        window.print();
        window.close();
      </script>

</body>
</html>
