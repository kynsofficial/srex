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

            <div class="row">
              <div class="com-md-12">
                <?php
                include 'includes/alert.php';
                if(isset($_SESSION['token'])){
                  echo $_SESSION['token'];
                  unset($_SESSION['token']);
                }
                ?>
              </div>
              <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Welcome <?php echo $admin['firstname']; ?>! 🎉</h5>
                        <p class="mb-4">You're here now, let's make money. Shall we? 🙌🥳</p>

                        <a href="order" class="btn btn-sm btn-label-primary">Let Get to Work!</a>
                      </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                      <div class="card-body pb-0 px-0 px-md-4">
                        <?php if ($admin['gender'] == "Female"): ?>
                          <img loading="lazy" src="<?php echo $settings['site_url']; ?>assets/img/illustrations/sitting-girl-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/sitting-girl-with-laptop-light.png" data-app-light-img="illustrations/sitting-girl-with-laptop-light.png">
                        <?php else: ?>
                          <img loading="lazy" src="<?php echo $settings['site_url']; ?>assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-light.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <?php
                // Total Order Number
                $stmt1 = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM orders WHERE status = 1 OR status = 2");
                $stmt1->execute();

                $total_orders = 0;
                foreach ($stmt1 as $key2) {
                  $subtotal_orders = $key2['numrows'];
                  $total_orders += $subtotal_orders;
                }

                // Total Order Amount in USD
                $stmt1 = $conn->prepare("SELECT naira_amount FROM orders WHERE status = 1 ");
                $stmt1->execute();

                $total_orders_amount = 0;
                foreach ($stmt1 as $key2) {
                  $subtotal_orders_amount = $key2['naira_amount'];
                  $total_orders_amount += $subtotal_orders_amount;
                }

              ?>

              <div class="col-lg-4 col-md-12 order-1">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-6 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                          <div class="avatar flex-shrink-0">
                            <img loading="lazy" src="<?php echo $settings['site_url']; ?>assets/img/icons/unicons/cube-secondary.png" alt="Credit Card" class="rounded">
                          </div>
                          <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                              <a class="dropdown-item" href="javascript:void(0);">View More</a>
                            </div>
                          </div>
                        </div>
                        <span>Orders</span>
                        <h3 class="card-title text-nowrap mb-1"><?php echo $total_orders; ?></h3>
                        <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +28.42%</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-md-12 col-lg-12 mb-4 mb-md-0">
                <div class="card">
                  <h5 class="card-header">Transaction History</h5>
                  <div class="card-datatable table-responsive text-nowrap">
                    <table class="table border-top" id="example1">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Payment Method</th>
                          <th>Type</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        <?php
                        $conn = $pdo->open();
                        try{
                          $stmt = $conn->prepare("SELECT * FROM transactions ORDER BY id DESC LIMIT 5");
                          $stmt->execute();
                          $i = 0;
                          foreach($stmt as $row){
                            if ($row['type'] == "Order" && $row['status'] == 1) {
                              $status = '<div class="badge bg-label-success">Delivered</div>';
                              // echo '<div class="badge badge-success">Successfull</div>';
                            }
                            if ($row['status'] == 0) {
                              $status = '<div class="badge bg-label-warning">Awaiting Payment</div>';
                              // echo '<div class="badge badge-warning">Pending</div>';
                            }
                            elseif ($row['status'] == 1) {
                              $status = '<div class="badge bg-label-success">Successfull</div>';
                              // echo '<div class="badge badge-success">Successfull</div>';
                            }
                            elseif ($row['status'] == 2) {
                              $status = '<div class="badge bg-label-info">Pending</div>';
                              // echo '<div class="badge badge-success">Successfull</div>';
                            }
                            elseif ($row['status'] == 3) {
                              $status = '<div class="badge bg-label-secondary">Refunded</div>';
                              // echo '<div class="badge badge-success">Successfull</div>';
                            }
                            elseif ($row['status'] == 4) {
                              $status = '<div class="badge bg-label-danger">Cancelled</div>';
                              // echo '<div class="badge badge-success">Successfull</div>';
                            }
                            elseif ($row['status'] == 5) {
                              $status = '<div class="badge bg-label-danger">Unsuccessfull</div>';
                              // echo '<div class="badge badge-success">Successfull</div>';
                            }
                            else {
                              $status = '<div class="badge bg-label-dark">Error</div>';
                            }
                            if ($row['type'] == "Pay Supplier") {
                              $link = "pay-supplier-details?id=".$row['ref_id'];
                            }
                            if ($row['type'] == "Order" || $row['type'] == "Order Commitment Fee") {
                              $link = "order-details?id=".$row['ref_id'];
                            }
                            // $status = ($row['status']) ? '<div class="badge badge-success">Successfull</div>' : '<div class="badge badge-danger">Cancelled</div>';
                            $i++;
                            echo "
                              <tr>
                                <td><a href='".$link."'>".$row['ref_id']."</a></td>
                                <td>".$row['payment_method']."</td>
                                <td>".$row['type']."</td>
                                <td>".$status."</td>
                                <td>
                                  <div class='dropdown'>
                                    <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'><i class='bx bx-dots-vertical-rounded'></i></button>
                                    <div class='dropdown-menu'>
                                      <a class='dropdown-item' href='".$link."'><i class='bx bx-show me-1'></i> View Details</a>
                                    </div>
                                  </div>
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
<script>
<?php 
$user_currency = $settings['currency'];
include 'includes/script.js'; ?>
</script>
</body>
</html>
