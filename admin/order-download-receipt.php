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


  <!-- <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/css/pages/app-invoice-print.css" /> -->
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

  $stmt = $conn->prepare("SELECT * FROM shippments WHERE ref_id = :slug");
  $stmt->execute(['slug' => $slug]);
  $details = $stmt->fetch();

  $stmt = $conn->prepare("SELECT * FROM shippments WHERE ref_id = :slug");
  $stmt->execute(['slug' => $slug]);
  $orders = $stmt->fetch();

  $stmt1 = $conn->prepare("SELECT * FROM states WHERE name=:shipping_rate");
  $stmt1->execute(['shipping_rate'=>$orders['receiver_state']]);
  $shipping_rate = $stmt1->fetch();

  $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
  $stmt->execute(['id' => $details['userid']]);
  $user = $stmt->fetch();

  $currency = $settings['currency'];

  if ($details != TRUE) {
    // echo "Not Valid";
    echo "<script>window.location.assign('404')</script>";
  }

}
catch(PDOException $e){
  echo "There is some problem in connection: " . $e->getMessage();
}

?>
<style>
html,body {
    background: #fff !important
}

/* body>:not(.invoice-print) {
    display: none !important
} */

.invoice-print {
    min-width: 768px !important;
    font-size: 15px !important
}

.invoice-print svg {
    fill: #697a8d !important
}

.invoice-print * {
    border-color: rgba(67,89,113,.5) !important;
    color: #697a8d !important
}

.dark-style .invoice-print th {
    color: #fff !important
}
</style>
<body onload="onLoaded()">

  <!-- Content -->

  <div class="invoice-print p-5" id="myInvoice">

    <div class="d-flex justify-content-between flex-row">
      <div class="mb-4">
        <div class="d-flex svg-illustration mb-3 gap-2">
          <span class="app-brand-logo demo">

            <img src="<?php echo $settings['site_url']; ?>assets/img/core/<?php echo $settings['logo_line']; ?>" class="img-fluid brand_img" alt="logo">

          </span>
        </div>
        <p class="mb-1"><?php echo $settings['location']; ?></p>
        <p class="mb-1"><?php echo $settings['country']; ?>.</p>
        <p class="mb-0"><?php echo $about['phone']; ?>.</p>
      </div>
      <div>
        <h4>Invoice #<?php echo strtotime($orders['date_created']); ?></h4>
        <div class="mb-2">
          <span class="me-1">Date Issued:</span>
          <span class="fw-semibold"><?php echo date('d/m/Y', strtotime($orders['date_created'])); ?></span>
        </div>
        <div class="mb-2">
          <span class="me-1">Order ID:</span>
          <span class="fw-semibold"><?php echo $orders['ref_id']; ?></span>
        </div>
        <div>
          <span class="me-1">Order Status:</span>
          <?php
          
          if ($details['status'] == 0) {
            // Not made payment
            echo "<span class='fw-semibold badge bg-warning'>Awaiting Pickup</span>";
          }elseif ($details['status'] == 1) {
            // We have settle the supplier
            echo "<span class='fw-semibold badge bg-success'>Successfully Delivered</span>";
          }elseif ($details['status'] == 2) {
            // Made payment
            echo "<span class='fw-semibold badge bg-info'>Proccessing Order</span>";
          }elseif ($details['status'] == 3) {
            // We refunded you back
            echo "<span class='fw-semibold badge bg-secondary'>Funds Refunded</span>";
          }elseif ($details['status'] == 4) {
            // You cancelled the order
            echo "<span class='fw-semibold badge bg-danger'>Order Cancelled</span>";
          }elseif ($details['status'] == 5) {
            // Shipping in progress
            echo "<span class='fw-semibold badge bg-primary'>Shipping in Progress</span>";
          }elseif ($details['status'] == 6) {
            // Shipping in progress
            echo "<span class='fw-semibold badge bg-warning'>Error in Product</span>";
          }elseif ($details['status'] ==7) {
            // Shipping in progress
            echo "<span class='fw-semibold badge bg-danger'>Unsuccessfull Order</span>";
          }
          
          ?>
        </div>
      </div>
    </div>

    <hr />

    <div class="row d-flex justify-content-between mb-4">
      <div class="col-sm-6 w-50">
        <h6 class="pb-2">Sender:</h6>
        <b class="mb-1"><?php echo $details['sender_name']; ?></b>
        <p class="mb-1"><?php echo $details['sender_postal_code'].", ".$details['sender_address'].", ".$details['sender_city']; ?></p>
        <p class="mb-1"><?php echo $details['sender_state'].", ".$details['sender_country']; ?></p>
        <p class="mb-1"><?php echo $details['sender_phone']; ?></p>
        <p class="mb-0"><?php echo $details['sender_email']; ?></p>
      </div>
      <div class="col-sm-6 w-50">
        <h6 class="pb-2">Receiver:</h6>
        <b class="mb-1"><?php echo $details['receiver_name']; ?></b>
        <p class="mb-1"><?php echo $details['receiver_postal_code'].", ".$details['receiver_address'].", ".$details['receiver_city']; ?></p>
        <p class="mb-1"><?php echo $details['receiver_state'].", ".$details['receiver_country']; ?></p>
        <p class="mb-1"><?php echo $details['receiver_phone']; ?></p>
        <p class="mb-0"><?php echo $details['receiver_email']; ?></p>
      </div>
    </div>

    <div class="table-responsive text-nowrap">
      <table class="table border-top m-0">
                      <thead>
                        <tr>
                          <th>Delivery Type</th>
                          <th>Delivery Method</th>
                          <th>Destination Option</th>
                          <th>Item Category</th>
                          <th>Item Value</th>
                          <th>Item Desc</th>
                          <th>Item Quantity</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $conn = $pdo->open();

                        echo "
                        <tr>
                          <td>".ucwords($orders['delivery_type'])."</td>
                          <td>".ucwords($orders['delivery_method'])."</td>
                          <td>".ucwords($orders['destination_option'])."</td>
                          <td>".$orders['item_category']."</td>
                          <td>".$orders['item_value']."</td>
                          <td>".$orders['item_description']."</td>
                          <td>".$orders['item_quantity']."</td>
                        </tr>
                        ";
                        ?>

                        <?php
                        // $international_transportation_cost = $shipping_plan['price'] * $total_weight;
                        // $domestic_transportation_cost = $rates['domestic_transportation_cost'] * $total_qty;
                        // $converted2 = $domestic_transportation_cost + $international_transportation_cost;
                        if($settings['service_charge'] == 0){
                          $service_charge = "<span class='badge bg-success'>Free</span>";
                        }else{
                          $service_charge = $currency.number_format($settings['service_charge']);
                        }
                        ?>
                        <tr>
                          <td colspan="5" class="align-top px-4 py-5">
                            <p class="mb-2">
                              <span class="me-1">Est. Total Weight of Order: <b><?php echo $orders['item_weight']; ?> KG</b><br>
                              <span class="me-1">Shipping Plan: <b><?php echo ucwords($orders['shipping_rate_type']); ?></b><br>
                              <span class="me-1">Shipping Rate: <b><?php echo $settings['currency'].$orders['shipping_rate_amount']; ?></b><br>
                              <span class="me-1">Shipping Period: <b><?php echo $orders['shipping_rate_period']; ?> Day(s)</b><br>
                            </p>
                          </td>
                          <td class="text-end px-4 py-5">
                            <p class="mb-2">Subtotal:</p>
                            <p class="mb-2">Shipping:</p>
                            <p class="mb-2">S.Charge:</p>
                            <p class="mb-2">VAT:</p>
                            <p class="mb-2 fw-bold">Grand Total:</p>
                          </td>
                          <td class="px-4 py-5">
                              <p class="fw-semibold mb-2"><?php echo $currency; ?><?php echo number_format($orders['item_quantity'] * $orders['item_weight'], 2); ?></p>
                              <p class="fw-semibold mb-2"><?php echo $currency; ?><?php echo number_format($shipping_rate['amount']); ?></p>
                              <p class="fw-semibold mb-2"><?php echo $service_charge; ?></p>
                              <p class="fw-semibold mb-2"><?php echo $currency; ?><?php echo number_format($orders['item_quantity'] * $orders['item_weight'], 2); ?></p>
                              <p class="fw-bold mb-0"><?php echo $settings['currency']; ?><?php echo $orders['item_quantity'] * $orders['item_weight']; ?></p>
                          </td>
                        </tr>
                      </tbody>
      </table>
    </div>

    <div class="row">
      <div class="col-12">
        <span class="fw-semibold">Note:</span>
        <span>If this Estimated Shipping Cost is higher than the actual Estimated Shipping Cost which will be determined later at the China office, we will refund you. If the actual Estimated Shipping Cost is higher than this Estimated Shipping Cost, you will be required to make a balance payment. Thank You!</span>
        </div>
      </div>
    </div>

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

      <!-- Main JS -->
      <script src="../assets/js/main.js"></script>
      <script src="<?php echo $settings['site_url']; ?>assets/js/html2canvas.min.js"></script>
      <script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/pdfmake/pdfmake.js"></script>

      <!-- Page JS -->
      <script type="text/javascript">

      // function doCapture() {
      //   window.scrollTo(0, 0);
      //   html2canvas(document.getElementById('myInvoice')).then(function (canvas){
      //     console.log(canvas.toDataURL("image/jpeg", 1.0));
      //   })
      // }

      function onLoaded() {
        // alert('Light of the world don wake up!!! Hans up')
        let capture = document.getElementById('myInvoice');
        // html2canvas(capture).then(canvas => {
        html2canvas(capture).then(canvas => {
          const imageOld = canvas.toDataURL("image/jpeg", 1.0);
          console.log(imageOld);
          var docDefinition = {
            content: [
              {
                image: imageOld,
                alignment: 'center',
                fit: [600, 600],
              }
            ]
          }
          pdfMake.createPdf(docDefinition).download("Receipt Order <?php echo $details['ref_id']; ?>.pdf");
          // pdfMake.createPdf(docDefinition).open();
          window.close();
          // alert(printSection);
          // console.log(printSection);
        });
      }
      </script>
      <!-- <script src="../assets/js/app-invoice-print.js"></script> -->

</body>
</html>
