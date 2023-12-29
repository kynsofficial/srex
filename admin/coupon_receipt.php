<?php include 'includes/head.php'; ?>
<body style="background:#fff;;min-width:auto;" class="no-touch">


  <div class="container mt-5" id="receipt">
    <header class="w-100 d-flex justify-content-center text-center mt-5 align-items-center pt-2 pb-2" >
      <center>
        <img src="<?php echo $settings['site_url']; ?>assets/img/core/<?php echo $settings['logo_line']; ?>" srcset="<?php echo $settings['site_url']; ?>assets/img/core/<?php echo $settings['logo_line']; ?> 2x" class="img-fluid mb-3" alt="logo">
      </center>
      <!-- <legend class="h1 font-weight-bold"><?php echo $settings['site_name']; ?> Electricity Bill Receipt</legend> -->
    </header>
    <h6 class="card-sub-title">Your Coupon Details are as Follows:</h6>

    <?php
    $order_id = $_GET['order_id'];
    $conn = $pdo->open();

    try{
      $stmt = $conn->prepare("SELECT * FROM coupon WHERE coupon_code=:order_id");
      $stmt->execute(['order_id'=>$order_id]);
      $details = $stmt->fetch();
      $i = 0;
      // foreach($stmt as $details){
        $stmt = $conn->prepare("SELECT * FROM users WHERE id=:userid");
        $stmt->execute(['userid'=>$details['userid']]);
        $iow = $stmt->fetch();

        if ($details['type'] == 0) {
          $type = "Shippments";
        }elseif ($details['type'] == 1) {
          $type = "Pay Supplier";
        }

        $stmt1 = $conn->prepare("SELECT * FROM currency WHERE id = :id");
        $stmt1->execute(['id'=>$details['currency']]);
        $currency = $stmt1->fetch();

        if ($details['value_type'] == 0) {
          $value_type = "Percentage Off";
          $value = $details['value']."%"; // "Percentage"
        }elseif ($details['value_type'] == 1) {
          $value_type = "Amount Off";
          $value =  $currency['sign']."".$details['value']; // "Amount"
        }
        // $status = ($details['status']) ? '<div class="badge badge-success">Successfull</div>' : '<div class="badge badge-warning">Pending</div>';
        if ($details['status'] == 1) {
          $status = '<spaan class="p-1 bg-label-danger">Used</spaan>';
          $status1 = "<div class='alert alert-danger alert-center alert-dismissible fade show'>
          Your Coupon of <b>".$value."</b> off for ".$type." Order.
          </div>";
          // echo '<div class="p-1 warning">Pending</div>';
        }
        if ($details['status'] == 0) {
          $status = '<span class="p-1 bg-label-success">Unused</span>';
          $status1 = "<div class='alert alert-success alert-center alert-dismissible fade show'>
          Your Coupon of <b>".$value."</b> off for ".$type." Order.
          </div>";
          // echo '<div class="badge badge-success">Successfull</div>';
        }
        $i++;
        echo "
        $status1
    ";
  // }
}
catch(PDOException $e){
  echo $e->getMessage();
}

$pdo->close();
?>
<div class="col-12">
  <ul class="list-group list-group-horizontal-md">
    <li class="list-group-item flex-fill">
      <h6><i class="bx bx-purchase-tag-alt"></i> Coupon Details</h6>
      <span class="fw-semibold float-start">Username - ID:</span> <span class="float-end"><a href='user_details?id=<?php echo $iow['id']; ?>'><?php echo $iow['username']; ?> - <?php echo $iow['id']; ?></a></span> <br>
      <span class="fw-semibold float-start">Full Name:</span> <span class="float-end"><?php echo $iow['firstname']; ?> <?php echo $iow['lastname']; ?></span> <br>
      <span class="fw-semibold float-start">Coupon Code:</span> <span class="fw-semibold float-end"><?php echo $details['coupon_code']; ?></span> <br>
      <span class="fw-semibold float-start">Value Type:</span> <span class="float-end"><?php echo $value_type; ?></span> <br>
      <span class="fw-semibold float-start">Value:</span> <span class="float-end"><?php echo $value; ?></span> <br>
      <span class="fw-semibold float-start">Validity:</span> <span class="float-end"><?php echo $details['validity']." time(s)"; ?></span> <br>
      <span class="fw-semibold float-start">Order:</span> <span class="float-end"><?php echo $details['order_id']; ?></span> <br>
      <span class="fw-semibold float-start">Status:</span> <span class="float-end"><?php echo $status; ?></span> <br>
      <span class="fw-semibold float-start">Date Generated:</span> <span class="float-end"><?php echo $details['upload_date']; ?></span> <br>
      <span class="fw-semibold float-start">Date Used:</span> <span class="float-end"><?php echo $details['used_date']; ?></span>
    </li>
  </ul>
</div>
<p class="text-center mt-4">&copy; All rights reserved | <?php echo $settings['site_name']; ?></p>


  </div>

  <center>
    <div style="margin-bottom:20px; padding-top: 15px;">
      <b class="mt-4">Share on:</b>

      <ul class="social-icons light list-inline mb-4 mt-2 h1">
        <?php
        $text1 = "Hey there, here is your Coupon of <b>".$value."</b> off for ".$type." Order. The coupon validity is ".$details['validity']." time(s). Use the link to verify the coupon. ".$settings['site_url']."coupon.";
        $text = urlencode($text1);
        // echo urlencode($text);
        ?>
        <li class="list-inline-item"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $text; ?>&t=<?php echo $settings['site_name']; ?> Coupon" rel="noopener" target="_blank"><i class="bx bxl-facebook"></i></a></li>
        <li class="list-inline-item"><a href="https://wa.me?text=<?php echo $text; ?>" data-action="share/whatsapp/share" rel="noopener" target="_blank"><i class="bx bxl-whatsapp text-success"></i></a></li>
        <li class="list-inline-item"><a href="https://www.twitter.com/intent/tweet?text=<?php echo $text; ?>" rel="noopener" target="_blank"><i class="bx bxl-twitter"></i></a></li>
      </ul>

      <button class="btn btn-primary btn-sm" onclick="printContent('receipt');"><i class="bx bx-printer"></i> Print</button>
      <button class="btn btn-primary btn-sm" id="btnPrint"><i class="bx bx-save"></i> Save</button>
    </div>
  </center>

  <script>
  function printContent(el){
    var restorepage = $('body').html();
    var printcontent = $('#' + el).clone();
    $('body').empty().html(printcontent);
    window.print();
    $('body').html(restorepage);
  }
  </script>

  <?php include 'includes/scripts.php'; ?>

  <script type="text/javascript" src="js/pdfmake.min.js"></script>
  <script type="text/javascript" src="js/html2canvas.min.js"></script>

  <script type="text/javascript">
  document.getElementById('btnPrint').addEventListener('click',
  Export);

  function Export() {
    html2canvas(document.getElementById('receipt'), {
      onrendered: function (canvas) {
        var data = canvas.toDataURL();
        var docDefinition = {
          content: [{
            image: data,
            width: 500
          }]
        };
        pdfMake.createPdf(docDefinition).download("<?php echo $settings['site_name']; ?>_coupon_<?php echo $details['id']; ?>.pdf");
      }
    });
  }  </script>


</body>
</html>
