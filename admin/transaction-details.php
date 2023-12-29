<?php session_start(); ?>
<?php include 'includes/head.php'; ?>
<body style="background:#fff;;min-width:auto;" class="no-touch">


  <div class="container mt-5" id="receipt">
    <header class="w-100 d-flex justify-content-center text-center mt-5 align-items-center pt-2 pb-2" >
      <center>
        <img src="<?php echo $settings['site_url']; ?>assets/img/core/<?php echo $settings['logo_line']; ?>" srcset="<?php echo $settings['site_url']; ?>assets/img/core/<?php echo $settings['logo_line']; ?> 2x" class="img-fluid mb-3" alt="logo">
      </center>
      <!-- <legend class="h1 font-weight-bold"><?php echo $settings['site_name']; ?> Electricity Bill Receipt</legend> -->
    </header>
    <h6 class="card-sub-title">Your Transaction Details are as Follows:</h6>

    <?php
    $trxid = $_GET['id'];
    $conn = $pdo->open();

    try{
      $stmt = $conn->prepare("SELECT * FROM transaction_all WHERE trxid=:trxid");
      $stmt->execute(['trxid'=>$trxid]);
      $details = $stmt->fetch();
      $i = 0;
      // foreach($stmt as $details){
        $stmt = $conn->prepare("SELECT * FROM users WHERE id=:userid");
        $stmt->execute(['userid'=>$details['userid']]);
        $iow = $stmt->fetch();

        if ($details['status'] == 0) {
          $status = '<div class="badge bg-danger">Unsuccessful</div>';
          $status1 = "<div class='alert alert-danger alert-center alert-dismissible fade show'>
            Your Deposit of <b>".$settings['currency']."".number_format($details['amount'], 2)."</b> to ".$settings['site_name']." Wallet was $status.
          </div>";
          // echo '<div class="badge bg-label-warning">Pending</div>';
        }
        if ($details['status'] == 1) {
          $status = '<div class="badge bg-success">Successfull</div>';
          $status1 = "<div class='alert alert-success alert-center alert-dismissible fade show'>
            Your Deposit of <b>".$settings['currency']."".number_format($details['amount'], 2)."</b> to ".$settings['site_name']." Wallet was $status.
          </div>";
          // echo '<div class="badge bg-label-success">Successfull</div>';
        }
        if ($details['status'] == 2) {
          $status = '<div class="badge bg-secondary">Cancelled</div>';
          $status1 = "<div class='alert alert-secondary alert-center alert-dismissible fade show'>
            Your Deposit of <b>".$settings['currency']."".number_format($details['amount'], 2)."</b> to ".$settings['site_name']." Wallet was $status.
          </div>";
          // echo '<div class="badge bg-label-success">Rejected</div>';
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
      <h6><i class="bx bx-purchase-tag-alt"></i> Transaction Details</h6>
      <span class="fw-semibold float-start">Username - ID:</span> <span class="float-end"><a href='user_details?id=<?php echo $iow['id']; ?>'><?php echo $iow['username']; ?> - <?php echo $iow['id']; ?></a></span> <br>
      <span class="fw-semibold float-start">Full Name:</span> <span class="float-end"><?php echo $iow['firstname']; ?> <?php echo $iow['lastname']; ?></span> <br>
      <span class="fw-semibold float-start">Amount:</span> <span class="fw-semibold float-end"><?php echo $settings['currency'].number_format($details['amount'], 2); ?></span> <br>
      <span class="fw-semibold float-start">Payment Via:</span> <span class="float-end">Flutterwave</span> <br>
      <span class="fw-semibold float-start">Transaction ID:</span> <span class="float-end"><?php echo $details['trxid']; ?></span> <br>
      <span class="fw-semibold float-start">Status:</span> <span class="float-end"><?php echo $status; ?></span> <br>
      <span class="fw-semibold float-start">Date:</span> <span class="float-end"><?php echo $details['datetime']; ?></span>
    </li>
  </ul>
</div>
<p class="text-center mt-4">&copy; All rights reserved | <?php echo $settings['site_name']; ?></p>


  </div>

  <center>
    <div style="margin-bottom:20px; padding-top: 15px;">
      

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
