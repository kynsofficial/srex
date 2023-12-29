<?php include 'includes/head.php'; ?>
<?php
$conn = $pdo->open();

$slug = $_GET['id'];

try{

  $stmt = $conn->prepare("SELECT * FROM pay_supplier WHERE ref_id = :slug");
  $stmt->execute(['slug' => $slug]);
  $details = $stmt->fetch();

  $stmt = $conn->prepare("SELECT * FROM users WHERE id = :userid");
  $stmt->execute(['userid' => $details['userid']]);
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
<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
      <?php include 'includes/sidebar.php'; ?>
      <input type="hidden" id="id" name="id" value="<?php echo $details['ref_id']; ?>">
      <!-- / Menu -->
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>
          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
              <div class="nav-item navbar-search-wrapper mb-0">
                <!-- <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);">
                <i class="bx bx-search bx-sm"></i>
                <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
              </a> -->
            </div>
          </div>
          <!-- /Search -->
          <ul class="navbar-nav flex-row align-items-center ms-auto">

            <!-- Style Switcher -->
            <li class="nav-item me-2 me-xl-0">
              <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                <i class='bx bx-sm'></i>
              </a>
            </li>
            <!--/ Style Switcher -->

            <?php include 'includes/notification.php'; ?>

            <?php include 'includes/user-profile.php'; ?>
          </ul>
        </div>

        <!-- Search Small Screens -->
        <div class="navbar-search-wrapper search-input-wrapper  d-none">
          <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..." aria-label="Search...">
          <i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
        </div>
      </nav>
      <!-- / Navbar -->

      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Services / Pay Supplier /</span> View Details
          </h4>
          <div class="row">
            <div class="col-12">
              <?php include 'includes/alert.php'; ?>
            </div>
            <div class="col-md-6 col-lg-12 mb-4 mb-md-0">
              <div class="card">
                <div class="bs-stepper-content p-3 mt-5 mb-5">
                  <div id="checkout-confirmation" class="content">
                    <div class="row mb-3">
                      <div class="col-12 col-lg-8 offset-lg-2 text-center mb-3">
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
                    </div>

                    <div class="row">
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
                      <?php if ($details['payment_method'] == "Bank Deposit" AND $details['trx_id'] !== ""): ?>
                        <div class="col-xl-6 mt-3">
                          <div class="border rounded p-3">
                            <!-- Price Details -->
                            <h6>Proof of Payment</h6>
                            <dl class="row mb-0">
                              <?php
                              //echo $details['trx_id'];
                              $ext = pathinfo($details['trx_id'], PATHINFO_EXTENSION);
                              //echo $ext;
                              ?>
                              <?php if ($ext == 'jpg' OR $ext == 'png' OR $ext == 'jpeg'): ?>
                                <a href="<?php echo $settings['site_url']; ?>assets/img/payments/<?php echo $details['trx_id']; ?>" target="_blank"><img src="<?php echo $settings['site_url']; ?>assets/img/payments/<?php echo $details['trx_id']; ?>" class="img-fluid" alt=""></a>
                              <?php else: ?>
                                <iframe src="<?php echo $settings['site_url']; ?>assets/img/payments/<?php echo $details['trx_id']; ?>" width="auto" height="500px"></iframe>
                              <?php endif; ?>
                            </dl>
                          </div>
                        </div>
                      <?php endif; ?>
                    </div>

                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-lg-12 mt-4 mb-md-0">
              <div class="card">
                <div class="bs-stepper-content p-3 mb-5">
                  <div id="checkout-confirmation" class="content">
                    <h3>Actions</h3>
                    <div class="row">
                      <div class="col-xl-12 mb-xl-0">
                        <h6 class="fw-bold mb-0">Payment Actions</h6>
                        <div class="btn-toolbar demo-inline-spacing" role="toolbar" aria-label="Toolbar with button groups">
                          <div class="btn-group" role="group" aria-label="First group">
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#approvePaymentNew"><i class="tf-icons bx bx-check"></i> Approve Payment</button>
                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#refundPayment"><i class="tf-icons bx bx-redo"></i> Refund Payment</button>
                            <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#ticket_supplier" onclick="paymentMsg()"><i class="tf-icons bx bx-purchase-tag-alt"></i> Create Ticket</button>
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#disapprovePayment"><i class="tf-icons bx bx-x"></i> Disapprove Payment</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xl-12 mb-xl-0 mb-3 mt-3">
                        <h6 class="fw-bold mb-0">Order Actions</h6>
                        <div class="btn-toolbar demo-inline-spacing" role="toolbar" aria-label="Toolbar with button groups">

                          <div class="btn-group" role="group" aria-label="Second group">
                            <div class="btn-group" role="group">
                              <button id="btnGroupDrop1" type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="tf-icons bx bx-info-circle"></i> Process Order</button>
                              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item bg-label-success" data-bs-toggle="modal" data-bs-target="#approveOrder" href="javascript:void(0);"><i class="bx bx-check"></i> Set as Successfull</a>
                                <a class="dropdown-item bg-label-danger" data-bs-toggle="modal" data-bs-target="#disapproveOrder" href="javascript:void(0);"><i class="bx bx-x"></i> Set as Unsuccessfull</a>
                              </div>
                            </div>
                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#refundOrder"><i class="tf-icons bx bx-redo"></i> Refund Order</button>
                            <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#ticket_supplier" onclick="orderMsg()"><i class="tf-icons bx bx-purchase-tag-alt"></i> Create Ticket</button>
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#cancelOrder"><i class="tf-icons bx bx-x"></i> Cancel Order</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xl-12 mb-xl-0 mb-3 mt-3">
                        <h6 class="fw-bold mb-0">Other Actions</h6>
                        <div class="btn-toolbar demo-inline-spacing" role="toolbar" aria-label="Toolbar with button groups">
                          <div class="btn-group" role="group" aria-label="Third Group">
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#shareLink"><i class="tf-icons bx bx-share"></i> Share</button>
                            <a type="button" class="btn btn-outline-success" href="pay-supplier-invoice?id=<?php echo $details['ref_id']; ?>" target="_blank"><i class="tf-icons bx bx-printer"></i> Print</a>
                            <a type="button" class="btn btn-outline-success" href="pay-supplier-receipt?id=<?php echo $details['ref_id']; ?>" target="_blank"><i class="tf-icons bx bx-download"></i> Download</a>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- / Content -->

        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>
        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
      </div>
      <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
  </div>
  <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>
  <!-- Drag Target Area To SlideIn Menu On Small Screens -->
  <div class="drag-target"></div>
</div>

<!-- refund payment Modal -->
<div class="modal fade" id="refundPayment" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="refundPaymentTitle">Are you sure you want to refund this payment?</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <hr>
      <div class="modal-body">
        <form action="pay-supplier_action" method="POST">
        <div class="row">
          <div class="col">
            <h5 class="text-center">You won't be able to revert this!</h5>
            <textarea name="reason" rows="8" cols="80" class="form-control" placeholder="Enter reason" required></textarea>
          </div>
        </div>
      </div>
      <hr>
      <div class="modal-footer">
          <input type="hidden" name="userid" value="<?php echo $user['id']; ?>">
          <input type="hidden" name="ref_id" value="<?php echo $details['ref_id']; ?>">
          <input type="hidden" name="id" value="<?php echo $details['id']; ?>">
          <button type="submit" name="refund" value="refund" class="btn btn-success"><i class="bx bx-check"></i> Yes</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x"></i> No</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- disapprove payment Modal -->
<div class="modal fade" id="disapprovePayment" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="disapprovePaymentTitle">Are you sure you want to disapprove this payment?</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <hr>
      <form action="pay-supplier_action" method="POST">
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <h5 class="text-center">You won't be able to revert this!</h5>
            <textarea name="reason" rows="8" cols="80" class="form-control" placeholder="Enter reason" required></textarea>
          </div>
        </div>
      </div>
      <hr>
      <div class="modal-footer">
          <input type="hidden" name="userid" value="<?php echo $user['id']; ?>">
          <input type="hidden" name="ref_id" value="<?php echo $details['ref_id']; ?>">
          <input type="hidden" name="id" value="<?php echo $details['id']; ?>">
          <button type="submit" name="disapprove" value="disapprove" class="btn btn-success"><i class="bx bx-check"></i> Yes</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x"></i> No</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- approve payment Modal -->
<div class="modal fade" id="approvePaymentNew" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="approvePaymentNewTitle">Are you sure you want to approve this payment?</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <hr>
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <h5 class="text-center">Be sure you have received the funds, You won't be able to revert this!</h5>
          </div>
        </div>
      </div>
      <hr>
      <div class="modal-footer">
        <form action="pay-supplier_action" method="POST">
          <input type="hidden" name="userid" value="<?php echo $user['id']; ?>">
          <input type="hidden" name="ref_id" value="<?php echo $details['ref_id']; ?>">
          <input type="hidden" name="id" value="<?php echo $details['id']; ?>">
          <button type="submit" name="approve" value="approve" class="btn btn-success"><i class="bx bx-check"></i> Yes</button>
        </form>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x"></i> No</button>
      </div>
    </div>
  </div>
</div>

<!-- approve order Modal -->
<div class="modal fade" id="approveOrder" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="approveOrder">Are you sure you want to set this order as completed?</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <hr>
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <h5>You are required to send ¥<?php echo number_format($details['amount'], 2) ?> to this account - <?php echo $details['supplier_bank_account']; ?></h5>
            <p>If completed, click on the yes button to confirm the order.</p>
            <!-- <h5 class="text-center">You won't be able to revert this!</h5> -->
          </div>
        </div>
      </div>
      <hr>
      <div class="modal-footer">
        <form action="pay-supplier_action" method="POST">
          <input type="hidden" name="userid" value="<?php echo $user['id']; ?>">
          <input type="hidden" name="ref_id" value="<?php echo $details['ref_id']; ?>">
          <input type="hidden" name="id" value="<?php echo $details['id']; ?>">
          <button type="submit" name="approve_order" value="approve_order" class="btn btn-success"><i class="bx bx-check"></i> Yes</button>
        </form>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x"></i> No</button>
      </div>
    </div>
  </div>
</div>

<!-- disapprove order Modal -->
<div class="modal fade" id="disapproveOrder" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="disapproveOrderTitle">Are you sure you want to set this order as Unsuccessfull?</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <hr>
      <form action="pay-supplier_action" method="POST">
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <h5 class="text-center">You won't be able to revert this!</h5>
            <textarea name="reason" rows="8" cols="80" class="form-control" placeholder="Enter reason" required></textarea>
          </div>
        </div>
      </div>
      <hr>
      <div class="modal-footer">
          <input type="hidden" name="userid" value="<?php echo $user['id']; ?>">
          <input type="hidden" name="ref_id" value="<?php echo $details['ref_id']; ?>">
          <input type="hidden" name="id" value="<?php echo $details['id']; ?>">
          <button type="submit" name="disapprove_order" value="disapprove_order" class="btn btn-success"><i class="bx bx-check"></i> Yes</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x"></i> No</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- refund order Modal -->
<div class="modal fade" id="refundOrder" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="refundOrderTitle">Are you sure you want to refund this order?</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <hr>
      <form action="pay-supplier_action" method="POST">
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <h5 class="text-center">You won't be able to revert this!</h5>
            <textarea name="reason" rows="8" cols="80" class="form-control" placeholder="Enter reason" required></textarea>
          </div>
        </div>
      </div>
      <hr>
      <div class="modal-footer">
          <input type="hidden" name="userid" value="<?php echo $user['id']; ?>">
          <input type="hidden" name="ref_id" value="<?php echo $details['ref_id']; ?>">
          <input type="hidden" name="id" value="<?php echo $details['id']; ?>">
          <button type="submit" name="refund_order" value="refund_order" class="btn btn-success"><i class="bx bx-check"></i> Yes</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x"></i> No</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- cancel order Modal -->
<div class="modal fade" id="cancelOrder" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="cancelOrderTitle">Are you sure you want to cancel this order?</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <hr>
      <form action="pay-supplier_action" method="POST">
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <h5 class="text-center">You won't be able to revert this!</h5>
            <textarea name="reason" rows="8" cols="80" class="form-control" placeholder="Enter reason" required></textarea>
          </div>
        </div>
      </div>
      <hr>
      <div class="modal-footer">
          <input type="hidden" name="userid" value="<?php echo $user['id']; ?>">
          <input type="hidden" name="ref_id" value="<?php echo $details['ref_id']; ?>">
          <input type="hidden" name="id" value="<?php echo $details['id']; ?>">
          <button type="submit" name="cancel_order" value="cancel_order" class="btn btn-success"><i class="bx bx-check"></i> Yes</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x"></i> No</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Share Modal -->
<div class="modal fade" id="shareLink" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-refer-and-earn">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        <h5 class="mt-2">Share this invoice</h5>
        <form class="row g-3" onsubmit="return false">
          <div class="col-lg-8">
            <label class="form-label" for="modalRnFLink">You can also copy and share it on your social media 🥳</label>
            <div class="input-group input-group-merge">
              <input type="text" id="modalRnFLink" class="form-control" value="<?php echo $settings['site_url']; ?>view-pay-order?id=<?php echo $details['ref_id']; ?>">
              <span class="input-group-text text-primary cursor-pointer" onclick="copyLink()" id="basic-addon33"><i class='bx bx-copy bx-xs' ></i> Copy link</span>
            </div>
          </div>
          <div class="col-lg-4 d-flex align-items-end">
            <div class="btn-social">
              <?php
              $text1 = "Hey there, check out my invoice on ".$settings['site_name'].". ".$settings['site_url']."view-pay-order?id=".$details['ref_id'].".";
              $text = urlencode($text1);
              // echo urlencode($text);
              ?>
              <a href="https://wa.me?text=<?php echo $text; ?>" data-action="share/whatsapp/share" rel="noopener" target="_blank" class="btn btn-icon btn-success mr-2"><i class="tf-icons bx bxl-whatsapp"></i></a>
              <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $settings['site_url']; ?>view-pay-order?id=<?php echo $details['ref_id']; ?>&t=<?php echo $text; ?>" rel="noopener" target="_blank" class="btn btn-icon btn-facebook mr-2"><i class="tf-icons bx bxl-facebook"></i></a>
              <a href="https://www.twitter.com/intent/tweet?text=<?php echo $text; ?>" rel="noopener" target="_blank" class="btn btn-icon btn-twitter mr-2"><i class="tf-icons bx bxl-twitter"></i></a>
              <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $settings['site_url']; ?>view-pay-order?id=<?php echo $details['ref_id']; ?>&title=<?php echo $text; ?>" target="_blank" class="btn btn-icon btn-linkedin"><i class="tf-icons bx bxl-linkedin"></i></a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ticket_supplier">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><b>Create New Ticket for <?php echo $details['ref_id']; ?></b></h4>
        <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form action="ticket-new" method="post" accept-charset="utf-8">
            <div class="form-group mb-3">
              <label for="subject">Subject</label>
              <input type="text" placeholder="Subject" id="subject_supplier" name="subject" formcontrolname="subject" class="form-control ng-pristine ng-valid ng-touched" required>
            </div>
            <div class="row">
              <div class="form-group mb-3 col-md-6">
                <label for="subject">Assign to [User]</label>
                <select name="userId" class="select2 form-select" required>
                  <option value="<?php echo $user['id']; ?>" selected><?php echo $user['firstname'].' '.$user['lastname']; ?></option>
                </select>
              </div>
              <div class="form-group mb-3 col-md-6">
                <label for="subject">Assign to [Admin]</label>
                <select name="assignedTo" class="select2 form-select" required>
                  <option value="" selected disabled hidden>Choose Here</option>
                  <?php
                  $conn = $pdo->open();

                  try{
                    $stmt = $conn->prepare("SELECT * FROM users WHERE type = 1");
                    $stmt->execute();
                    foreach($stmt as $admin_ticket){
                      if ($admin_ticket['id'] == $admin['id']) {
                        $admin_cheked = "selected";
                      }else {
                        $admin_cheked = '';
                      }
                      echo "
                      <option value='".$admin_ticket['id']."' ".$admin_cheked.">".$admin_ticket['firstname'].' '.$admin_ticket['lastname']."</option>
                      ";
                    }
                  }
                  catch(PDOException $e){
                    echo $e->getMessage();
                  }

                  $pdo->close();
                  ?>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="form-group mb-3 col-md-6">
                <label for="subject">Category</label>
                <select name="category" class="select2 form-select" required>
                  <?php
                  $conn = $pdo->open();

                  try{
                    $stmt = $conn->prepare("SELECT * FROM tbl_ticket_categories WHERE categoryName LIKE 'Pay Supplier'");
                    $stmt->execute();
                    foreach($stmt as $category){
                      echo "
                      <option value='".$category['categoryId']."' selected>".$category['categoryName']."</option>
                      ";
                    }
                  }
                  catch(PDOException $e){
                    echo $e->getMessage();
                  }

                  $pdo->close();
                  ?>
                </select>
              </div>
              <div class="form-group mb-3 col-md-6">
                <label for="priority">Priority</label>
                <select name="priority" class="select2 form-select" required>
                  <option value="" selected disabled hidden>Choose Here</option>
                  <option value="high">High</option>
                  <option value="medium">Medium</option>
                  <option value="low">Low</option>
                </select>
              </div>
            </div>
            <div class="form-group mb-3">
              <label for="text-area-1">Message</label>
              <textarea name="message" id="message_supplier" rows="10" placeholder="Detail the issue here" class="form-control" required></textarea>
            </div>
            <button class="btn btn-primary w-100" name="save"><i class="bx bx-plus"></i> Create</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-rounded pull-left" data-bs-dismiss="modal"><i class="bx bx-x"></i> Close</button>
        </div>
      </div>
    </div>
  </div>

<!-- / Layout wrapper -->
<?php include 'includes/scripts.php'; ?>
<script>
  function paymentMsg() {
    var title = "Payment Issue for Order <?php echo $details['ref_id']; ?>";
    var msg = "An issue occur with the Payment of Pay Supplier Order with ID <?php echo $details['ref_id']; ?>";

    document.getElementById('subject_supplier').value = title;
    document.getElementById('message_supplier').innerHTML = msg;
  }

  function orderMsg() {
    var title = "Issue for Order <?php echo $details['ref_id']; ?>";
    var msg = "An issue occur with Pay Supplier Order with ID <?php echo $details['ref_id']; ?>";

    document.getElementById('subject_supplier').value = title;
    document.getElementById('message_supplier').innerHTML = msg;
  }

  function copyLink() {
    var copyText = document.getElementById('modalRnFLink');
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);
    document.getElementById("basic-addon33").innerHTML = "<span class='text-success'><i class='bx bx-copy bx-xs'></i> Copied!</span>";
    setTimeout(function () {
      document.getElementById("basic-addon33").innerHTML = "<i class='bx bx-copy bx-xs'></i> Copy Link";
    },2000);
  }
</script>
<!-- <script src="includes/coupon_validate.js"></script> -->
</body>
</html>
