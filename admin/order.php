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
              <span class="text-muted fw-light">Services / Shippments / </span> Order
            </h4>


            <?php
              $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM shippments WHERE status=1");
              $stmt->execute();

              $approved_orders = 0;
              foreach ($stmt as $key1) {
                $subapproved_orders = $key1['numrows'];
                $approved_orders += $subapproved_orders;
              }

              $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM shippments WHERE status=4 OR status=3 OR status=5");
              $stmt->execute();

              $cancelled_orders = 0;
              foreach ($stmt as $key1) {
                $subcancelled_orders = $key1['numrows'];
                $cancelled_orders += $subcancelled_orders;
              }

              $stmt1 = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM shippments WHERE status=0 OR status=2");
              $stmt1->execute();

              $pending_orders = 0;
              foreach ($stmt1 as $key2) {
                $subpending_orders = $key2['numrows'];
                $pending_orders += $subpending_orders;
              }

              $stmt1 = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM shippments");
              $stmt1->execute();

              $total_orders = 0;
              foreach ($stmt1 as $key2) {
                $subtotal_orders = $key2['numrows'];
                $total_orders += $subtotal_orders;
              }

            ?>

            <div class="row g-4 mb-4">
              <div class="col-12">
                <?php include 'includes/alert.php'; ?>
              </div>
              <div class="col-sm-6 col-xl-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                      <div class="content-left">
                        <span>Order</span>
                        <div class="d-flex align-items-end mt-2">
                          <h4 class="mb-0 me-2"><?php echo number_format($total_orders, 0); ?></h4>
                          <!-- <small class="text-success">(+29%)</small> -->
                        </div>
                        <small>Total Order</small>
                        <!-- <small class="text-success"><a href="#"><i class="bx bx-show"></i></a> </small> -->
                      </div>
                      <span class="badge bg-label-primary rounded p-2">
                        <i class="bx bx-dollar bx-sm"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                      <div class="content-left">
                        <span>Approved Order</span>
                        <div class="d-flex align-items-end mt-2">
                          <h4 class="mb-0 me-2"><?php echo number_format($approved_orders, 0); ?></h4>
                          <!-- <small class="text-danger">(-14%)</small> -->
                        </div>
                        <small>Verified Order</small>
                      </div>
                      <span class="badge bg-label-success rounded p-2">
                        <i class="bx bx-dollar bx-sm"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                      <div class="content-left">
                        <span>Pending Order</span>
                        <div class="d-flex align-items-end mt-2">
                          <h4 class="mb-0 me-2"><?php echo number_format($pending_orders, 0); ?></h4>
                          <!-- <small class="text-success">(+42%)</small> -->
                        </div>
                        <small>Pending Order</small>
                      </div>
                      <span class="badge bg-label-warning rounded p-2">
                        <i class="bx bx-dollar bx-sm"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                      <div class="content-left">
                        <span>Rejected Order</span>
                        <div class="d-flex align-items-end mt-2">
                          <h4 class="mb-0 me-2"><?php echo number_format($cancelled_orders, 0); ?></h4>
                          <!-- <a href="#" class="text-success">(+29%)</a> -->
                        </div>
                        <small>Rejected Order</small>
                      </div>
                      <span class="badge bg-label-danger rounded p-2">
                        <i class="bx bx-dollar bx-sm"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Order List Table -->
            <div class="card">
              <div class="card-header border-bottom">
                <h5 class="card-title">All Orders</h5>
              </div>
              <div class="card-datatable table-responsive text-nowrap">
                <table class="datatables-users table border-top" id="example1">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>User</th>
                      <th>Delivery Type</th>
                      <th>Amount</th>
                      <th>Order Status</th>
                      <th>Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php
                    $conn = $pdo->open();
                    try{
                      $stmt = $conn->prepare("SELECT * FROM shippments ORDER BY date_created DESC");
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

                        $amount = 5000;
                        
                        // $status = ($row['status']) ? '<div class="badge bg-label-success">Successfull</div>' : '<div class="badge bg-label-danger">Cancelled</div>';
                        $i++;
                        echo "
                        <tr>
                          <td><a href='order-old-details?id=".$row['ref_id']."'>".$row['ref_id']."</a></td>
                          <td><a href='user-details?userid=".$row['userid']."' class='btn btn-success btn-sm btn-flat' target='_blank'><i class='bx bx-show'></i> View</a></td>
                          <td>".ucwords($row['delivery_type'])."</td>
                          <td>".$settings['currency'].$amount."</td>
                          <td>".$status."</td>
                          <td>".date('M d, Y', strtotime($row['date_created']))."</td>
                          <td>
                            <a class='dropdown-item' href='order-old-details?id=".$row['ref_id']."'><i class='bx bx-show me-1'></i> View</a>
                            <a class='dropdown-item' href='tracking?tracking_id=".$row['ref_id']."'><i class='bx bx-current-location me-1'></i> Track</a>
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
