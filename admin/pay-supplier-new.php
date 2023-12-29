<?php include 'includes/head.php'; ?>
<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar  ">
    <div class="layout-container">
      <!-- Menu -->
      <?php include 'includes/sidebar.php'; ?>
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
              <span class="text-muted fw-light">Services / Pay Supplier /</span> Create
            </h4>

              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Create Payment Request</h5>
                      <!-- <p>Give us Naira, and we'll send Yuan to you or your supplier.</p> -->
                      <p>Give us Naira & get Yuan in China within 24 hours - You or Your supplier.</p>
                      <hr class="my-3">
                      <form method="POST" action="<?php echo htmlspecialchars('pay-supplier_insert'); ?>" onsubmit="return true">
                        <?php include 'includes/alert.php'; ?>
                        <div class="row">
                          <div class="mb-3 col-md-12">
                            <label for="subject">Assign to [User]</label>
                            <select name="userid" class="select2 form-select" required>
                              <option value="" selected disabled hidden>Choose Here</option>
                              <?php
                              $conn = $pdo->open();

                              try{
                                $stmt = $conn->prepare("SELECT * FROM users WHERE type = 0");
                                $stmt->execute();
                                foreach($stmt as $users_order){
                                  echo "
                                  <option value='".$users_order['id']."'>".$users_order['firstname'].' '.$users_order['lastname'].' ('.$users_order['username'].")</option>
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
                          <div class="mb-3 col-md-12">
                            <label for="supplier_name" class="form-label">Supplier's Name</label>
                            <input type="text" name="supplier_name" id="supplier_name" class="form-control" placeholder="Enter Supplier's Name" <?php if (isset($_SESSION['supplier_name'])) { echo 'value="'.$_SESSION['supplier_name'].'"'; unset($_SESSION['supplier_name']); } ?> required>
                          </div>
                          <div class="mb-3 col-md-12">
                            <label for="supplier_phone" class="form-label">Supplier's Phone</label>
                            <input type="tel" name="supplier_phone" id="supplier_phone" class="form-control" placeholder="Enter Supplier's Phone" <?php if (isset($_SESSION['supplier_phone'])) { echo 'value="'.$_SESSION['supplier_phone'].'"'; unset($_SESSION['supplier_phone']); } ?> required>
                          </div>
                          <div class="mb-3 col-md-12">
                            <label for="supplier_email" class="form-label">Supplier's Email</label>
                            <input type="email" name="supplier_email" id="supplier_email" class="form-control" placeholder="Enter Supplier's Email" <?php if (isset($_SESSION['supplier_email'])) { echo 'value="'.$_SESSION['supplier_email'].'"'; unset($_SESSION['supplier_email']); } ?> required>
                          </div>
                          <div class="mb-3 col-md-12">
                            <label for="supplier_alipay" class="form-label">Supplier's Alipay Details <small>(Optional)</small></label>
                            <textarea name="supplier_alipay" id="supplier_alipay" class="form-control" rows="3" cols="80" placeholder="Enter Supplier's Alipay Details"><?php if (isset($_SESSION['supplier_alipay'])) { echo $_SESSION['supplier_alipay']; unset($_SESSION['supplier_alipay']); } ?></textarea>
                          </div>
                          <div class="mb-3 col-md-12">
                            <label for="supplier_wechat" class="form-label">Supplier's Wechat Details <small>(Optional)</small></label>
                            <textarea name="supplier_wechat" id="supplier_wechat" class="form-control" rows="3" cols="80" placeholder="Enter Supplier's Wechat Details"><?php if (isset($_SESSION['supplier_wechat'])) { echo $_SESSION['supplier_wechat']; unset($_SESSION['supplier_wechat']); } ?></textarea>
                          </div>
                          <div class="mb-3 col-md-12">
                            <label for="supplier_bank_account" class="form-label">Supplier's Bank Account</label>
                            <textarea name="supplier_bank_account" id="supplier_bank_account" class="form-control" rows="3" cols="80" placeholder="Enter Supplier's Bank Account" required><?php if (isset($_SESSION['supplier_bank_account'])) { echo $_SESSION['supplier_bank_account']; unset($_SESSION['supplier_bank_account']); } ?></textarea>
                          </div>
                          <div class="mb-3 col-md-12">
                            <label for="additional_info" class="form-label">Additional Info <small>(Optional)</small></label>
                            <textarea name="additional_info" id="additional_info" class="form-control" rows="3" cols="80" placeholder="Enter Additional Info"><?php if (isset($_SESSION['additional_info'])) { echo $_SESSION['additional_info']; unset($_SESSION['additional_info']); } ?></textarea>
                          </div>
                          <div class="mb-3 col-md-12">
                            <label for="amount" class="form-label">Amount to be Paid <small>(In Yuan) RMB</small></label>
                            <input type="number" name="amount" onkeyup="equiRate()" id="amount" class="form-control" placeholder="Enter amount in Yuan" <?php if (isset($_SESSION['amount'])) { echo 'value="'.$_SESSION['amount'].'"'; unset($_SESSION['amount']); } ?> required>
                            <h5 class="mt-3 fw-bold text-success" id="naira_equi"><?php echo $settings['currency']; ?>0</h5>
                          </div>
                          <hr class="mt-2 mb-3 my-3">
                          <input type="hidden" id="suppling_rate" value="<?php echo $rates['suppling_rate']; ?>">
                          <input type="hidden" id="yuan_naira_rate" value="<?php echo $rates['yuan_naira_rate']; ?>">
                          <p class="mb-0">Service Charge: <?php if ($rates['suppling_rate'] == 0) { echo '<span class="badge bg-label-success">Free</span>'; } else { echo '<span class="badge bg-label-success">'.$rates['suppling_rate'].'%</span>'; } ?></p>
                          <p class="mb-0">Exchange Rate: <b>¥1 Yuan</b> = <b><?php echo $settings['currency']; ?><?php echo number_format($rates['yuan_naira_rate']); ?> Naira</b></p>
                          <p>Min. Amount Accepted: <b><?php echo $settings['currency']; ?><?php echo number_format($rates['suppling_min']); ?> Naira</b></p>
                          <hr class="mt-2 mb-3 my-3">
                          <div class="mb-3 col-md-6">
                            <label class="form-label">Payment Method</label>
                            <div class="col mt-2">
                              <div class="form-check form-check-inline">
                                <input name="payment_method" class="form-check-input" type="radio" value="Bank Deposit" <?php if (isset($_SESSION['payment_method']) === "Bank Deposit") { echo "checked"; unset($_SESSION['payment_method']); } ?> id="payment_method-bank" required />
                                <label class="form-check-label" for="payment_method-bank">Bank Deposit</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input name="payment_method" class="form-check-input" type="radio" value="Online Payment" <?php if (isset($_SESSION['payment_method']) === "Online Payment") { echo "checked"; unset($_SESSION['payment_method']); } ?> id="payment_method-online" required />
                                <label class="form-check-label" for="payment_method-online">Online Payment</label>
                              </div>
                            </div>
                          </div>
                          <hr class="my-3">
                          <div class="col mt-2 mb-3">
                            <div class="form-check form-check-inline">
                              <input name="terms" class="form-check-input" type="checkbox" value="on" id="terms" required />
                              <label class="form-check-label" for="terms">I agree to the <a href="" data-bs-toggle="modal" data-bs-target="#termsConditions">Terms & Conditions</a></label>
                            </div>
                          </div>
                        </div>
                        <div class="mt-2">
                          <button type="submit" name="save" value="save" class="btn btn-primary me-2"><i class="bx bx-plus"></i> Create Order</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
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
  <!-- / Layout wrapper -->
<?php include 'includes/scripts.php'; ?>
<?php
$conn = $pdo->open();

try{

  $stmt = $conn->prepare("SELECT * FROM frontend WHERE id=:id");
  $stmt->execute(['id'=>1]);
  $frontend = $stmt->fetch();

}
catch(PDOException $e){
  echo "There is some problem in connection: " . $e->getMessage();
}

?>
<div class="modal fade" id="termsConditions" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFullTitle">Terms and Conditions</h5>
      </div>
      <div class="modal-body">
        <?php echo $frontend['terms_condition']; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="bx bx-check"></i> I Agree</button>
      </div>
    </div>
  <div>
</div>
<script>
  function equiRate() {
    var amount = document.getElementById("amount").value;
    var suppling_rate = document.getElementById("suppling_rate").value;
    var yuan_naira_rate = document.getElementById("yuan_naira_rate").value;

    if(amount == ""){

      //display warning
      document.getElementById("naira_equi").innerHTML = "<?php echo $settings['currency']; ?>0";
    }
    else
    {
      //display warning
      document.getElementById("naira_equi").innerHTML = "";
    }

    var converted = amount * yuan_naira_rate;
    var percentage = converted * suppling_rate / 100;
    var charge_naira = converted + percentage;
    var naira_equi = '<?php echo $settings['currency']; ?>' + charge_naira.toLocaleString() + ' Naira';
    document.getElementById("naira_equi").innerHTML = naira_equi;


  }
</script>
</body>
</html>
