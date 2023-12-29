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
              <span class="text-muted fw-light">Services / Shippments / </span> Pending Orders
            </h4>

            <div class="row g-4 mb-4">
              <div class="col-12">
                <?php include 'includes/alert.php'; ?>
              </div>
            </div>
            <!-- Order List Table -->
            <div class="card">
              <div class="card-header border-bottom">
                <h5 class="card-title">Pending Orders</h5>
              </div>
              <div class="card-datatable table-responsive text-nowrap">
                <table class="datatables-users table border-top" id="example1">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Order Name</th>
                      <th>Products</th>
                      <th>Amount</th>
                      <th>Commitment</th>
                      <th>Payment Status</th>
                      <th>Order Status</th>
                      <th>Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php
                    $conn = $pdo->open();
                    try{
                      $stmt = $conn->prepare("SELECT * FROM orders WHERE status = 2 OR status = 0 ORDER BY date_created DESC");
                      $stmt->execute();
                      $i = 0;
                      foreach($stmt as $row){
                        if ($row['status'] == 0) {
                          $status = '<div class="badge bg-label-warning">Awaiting Payment</div>';
                          // echo '<div class="badge badge-warning">Pending</div>';
                        }
                        elseif ($row['status'] == 1) {
                          $status = '<div class="badge bg-label-success">Completed</div>';
                          // echo '<div class="badge badge-success">Successfull</div>';
                        }
                        elseif ($row['status'] == 2) {
                          $status = '<div class="badge bg-label-info">Proccessing Order</div>';
                          // echo '<div class="badge badge-success">Successfull</div>';
                        }
                        elseif ($row['status'] == 3) {
                          $status = '<div class="badge bg-label-secondary">Funds Refunded</div>';
                          // echo '<div class="badge badge-success">Successfull</div>';
                        }
                        elseif ($row['status'] == 4) {
                          $status = '<div class="badge bg-label-danger">Order Cancelled</div>';
                          // echo '<div class="badge badge-success">Successfull</div>';
                        }
                        elseif ($row['status'] == 5) {
                          $status = '<div class="badge bg-label-primary">Shipping in Progress</div>';
                          // echo '<div class="badge badge-success">Successfull</div>';
                        }
                        elseif ($row['status'] == 6) {
                          $status = '<div class="badge bg-label-warning">Error in Product</div>';
                          // echo '<div class="badge badge-success">Successfull</div>';
                        }
                        elseif ($row['status'] == 7) {
                          $status = '<div class="badge bg-label-danger">Unsuccessfull Order</div>';
                          // echo '<div class="badge badge-success">Successfull</div>';
                        }
                        else {
                          $status = '<div class="badge bg-label-dark">Error</div>';
                        }
                        
                        if ($row['commitment'] == 0) {
                          $commitment = '<div class="badge bg-label-danger">Unpaid</div>';
                          // echo '<div class="badge badge-warning">Pending</div>';
                        }
                        elseif ($row['commitment'] == 1) {
                          $commitment = '<div class="badge bg-label-success">Paid</div>';
                          // echo '<div class="badge badge-success">Successfull</div>';
                        }
                        elseif ($row['commitment'] == 2) {
                          $commitment = '<div class="badge bg-label-warning">Pending Approval</div>';
                          // echo '<div class="badge badge-success">Successfull</div>';
                        }

                        if ($row['payment_stat'] == 0) {
                          $p_status = '<div class="badge bg-label-warning">Awaiting Payment</div>';
                          // echo '<div class="badge badge-warning">Pending</div>';
                        }
                        elseif ($row['payment_stat'] == 1) {
                          $p_status = '<div class="badge bg-label-success">Payment Approved</div>';
                          // echo '<div class="badge badge-success">Successfull</div>';
                        }
                        elseif ($row['payment_stat'] == 2) {
                          $p_status = '<div class="badge bg-label-info">Proccessing Payment</div>';
                          // echo '<div class="badge badge-success">Successfull</div>';
                        }
                        elseif ($row['payment_stat'] == 3) {
                          $p_status = '<div class="badge bg-label-secondary">Funds Refunded</div>';
                          // echo '<div class="badge badge-success">Successfull</div>';
                        }
                        elseif ($row['payment_stat'] == 4) {
                          $p_status = '<div class="badge bg-label-danger">Payment Cancelled</div>';
                          // echo '<div class="badge badge-success">Successfull</div>';
                        }
                        elseif ($row['payment_stat'] == 5) {
                          $p_status = '<div class="badge bg-label-danger">Unapproved Payment</div>';
                          // echo '<div class="badge badge-success">Successfull</div>';
                        }
                        else {
                          $p_status = '<div class="badge bg-label-dark">Error</div>';
                        }

                        $stmtat = $conn->prepare("SELECT * FROM currency WHERE slug=:slug");
                        $stmtat->execute(['slug'=>$row['currency']]);
                        $currency = $stmtat->fetch();

                        $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM products WHERE ref_id=:ref_id");
                        $stmt->execute(['ref_id'=>$row['ref_id']]);
                        // $products = $stmt->fetch();

                        $total_amount = 0;
                        $total_weight = 0;
                        $total_qty = 0;
                        // foreach ($stmt1 as $products1) {
                          foreach($stmt as $products){
                            $subtotal_amount = $products['product_qty'] * $products['product_price'];
                            $total_amount += $subtotal_amount;

                            $subtotal_weight = $products['product_qty'] * $products['product_weight'];
                            $total_weight += $subtotal_weight;

                            $subtotal_qty = $products['product_qty'];
                            $total_qty += $subtotal_qty;
                          }

                        $stmt1 = $conn->prepare("SELECT * FROM shipping_plan WHERE slug=:shipping_plan");
                        $stmt1->execute(['shipping_plan'=>$row['shipping_plan']]);
                        $shipping_plan = $stmt1->fetch();

                        $stmt1 = $conn->prepare("SELECT * FROM shipping_rate WHERE myid=:shipping_rate");
                        $stmt1->execute(['shipping_rate'=>$row['destination_country']]);
                        $shipping_rate = $stmt1->fetch();

                        $international_transportation_cost = $shipping_plan['price'] * $total_weight;
                        $domestic_transportation_cost = $rates['domestic_transportation_cost'] * $total_qty;
                        $converted2 = $domestic_transportation_cost + $international_transportation_cost;

                        if ($currency['slug'] == "Yuan") {
                          $converted = $total_amount * $rates['yuan_naira_rate'];
                          $converted1 = $total_amount * $rates['yuan_dollar_rate'];

                          // Total
                          $total_amount1 = $total_amount + ($converted2 * $rates['dollar_yuan_rate']);

                          $service_charge_amount = $total_amount * ($rates['order_rate']/100);
                          $service_charge_total = number_format($total_amount + $service_charge_amount, 2);

                          $vat_charge_amount = $total_amount * ($rates['vat']/100);
                          $vat_charge_total = number_format($total_amount + $vat_charge_amount, 2);

                          $total_charges = $service_charge_amount + $vat_charge_amount;

                          $total_yuan_o = $total_amount1 + $total_charges;
                          $total_yuan = $total_amount1 + $total_charges;
                          $grand_total_yuan = number_format($row['discount_yuan_amount'], 2);

                          $total_usd = number_format($total_yuan_o * $rates['yuan_dollar_rate'], 2);
                          $grand_total_usd = number_format($row['discount_usd_amount'], 2);
                          $total_naira = number_format($total_yuan_o * $rates['yuan_naira_rate'], 2);
                          $grand_total_naira = number_format($row['discount_naira_amount'], 2);
                        }
                        elseif ($currency['slug'] == "Dollar") {
                          $converted = $total_amount * $rates['dollar_naira_rate'];

                          $service_charge_amount = $total_amount * ($rates['order_rate']/100);
                          $service_charge_total = number_format($total_amount + $service_charge_amount, 2);

                          $vat_charge_amount = $total_amount * ($rates['vat']/100);
                          $vat_charge_total = number_format($total_amount + $vat_charge_amount, 2);

                          $total_charges = $service_charge_amount + $vat_charge_amount;

                          $total_usd_o = $total_amount + $converted2 + $total_charges;
                          $total_usd = number_format($total_amount + $converted2 + $total_charges, 2);
                          $grand_total_usd = number_format($row['discount_usd_amount'], 2);
                          $total_naira = number_format($total_usd_o * $rates['dollar_naira_rate'], 2);
                          $grand_total_naira = number_format($row['discount_naira_amount'], 2);
                        }

                        $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM coupon WHERE coupon_code=:coupon_code ");
                        $stmt->execute(['coupon_code'=>$row['coupon_code']]);
                        $coupon_code = $stmt->fetch();

                        $stmt1 = $conn->prepare("SELECT * FROM currency WHERE id = :id");
                        $stmt1->execute(['id'=>$coupon_code['currency']]);
                        $currency_coupon = $stmt1->fetch();

                        if ($coupon_code['value_type'] == 0) {
                          $value = $coupon_code['value']."%"; // "Percentage"
                        }elseif ($coupon_code['value_type'] == 1) {
                          $value = $currency_coupon['sign']."".$coupon_code['value']; // "Amount"
                        }

                        if ($currency['slug'] == "Yuan") {
                          if ($row['coupon_code'] !== "") {
                            $amount = "<div class='text-muted lh-1'><span class='text-primary fw-semibold'>".$currency['sign']."".$grand_total_yuan."</span></div>
                            <small class='text-muted'>".$settings['currency']."".number_format($grand_total_naira)."</small>";
                          }else {
                            $amount = "<div class='text-muted lh-1'><span class='text-primary fw-semibold'>".$currency['sign']."".number_format($total_yuan)."</span></div>
                            <small class='text-muted'>".$settings['currency']."".$total_naira."</small>";
                          }
                        }elseif ($currency['slug'] == "Dollar") {
                          if ($row['coupon_code'] !== "") {
                            $amount = "<div class='text-muted lh-1'><span class='text-primary fw-semibold'>".$currency['sign']."".$grand_total_usd."</span></div>
                            <small class='text-muted'>".$settings['currency']."".number_format($grand_total_naira)."</small>";
                          }else {
                            $amount = "<div class='text-muted lh-1'><span class='text-primary fw-semibold'>".$currency['sign']."".$total_usd."</span></div>
                            <small class='text-muted'>".$settings['currency']."".$total_naira."</small>";
                          }
                        }
                        // $status = ($row['status']) ? '<div class="badge bg-label-success">Successfull</div>' : '<div class="badge bg-label-danger">Cancelled</div>';
                        $i++;
                        echo "
                        <tr>
                          <td><a href='order-details?id=".$row['ref_id']."'>".$row['ref_id']."</a></td>
                          <td>".$row['orders_name']."</td>
                          <td>".$products['numrows']."</td>
                          <td>
                            ".$amount."
                          </td>
                          <td>".$commitment."</td>
                          <td>".$p_status."</td>
                          <td>".$status."</td>
                          <td>".date('M d, Y', strtotime($row['date_created']))."</td>
                          <td>
                            <a class='dropdown-item' href='order-details?id=".$row['ref_id']."'><i class='bx bx-show me-1'></i> View</a>
                          </td>
                        </tr>
                          ";
                        }
                      }
                      catch(PDOException $e){
                        echo $e->getMessage();
                      }

                      $pdo->close();
                    ?>
                  </tbody>
                </table>
              </div>

            </div>



          </div>
          <!-- / Content -->

          <!-- Footer -->
          <?php include 'includes/footer.php'; ?>
          <?php include 'includes/users_modal.php'; ?>
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
</body>
</html>
