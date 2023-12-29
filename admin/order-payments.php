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
              <span class="text-muted fw-light">Services / Shippments /</span> Payments
            </h4>

            <div class="col-12">
              <?php include 'includes/alert.php'; ?>
            </div>
            <!-- Orders List Table -->
            <div class="card">
              <div class="card-header border-bottom">
                <h5 class="card-title">All Orders Payments</h5>
              </div>
              <div class="card-datatable table-responsive text-nowrap">
                <table class="table border-top" id="example1">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Payment Method</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php
                    $conn = $pdo->open();
                    $type = "Order";

                    try{
                      $stmt = $conn->prepare("SELECT * FROM transactions WHERE type=:type ORDER BY id DESC");
                      $stmt->execute(['type'=>$type]);
                      $i = 0;
                      foreach($stmt as $row){
                        if ($row['status'] == 0) {
                          $status = '<div class="badge bg-label-warning">Awaiting Payment</div>';
                          // echo '<div class="badge badge-warning">Pending</div>';
                        }
                        elseif ($row['status'] == 1) {
                          $status = '<div class="badge bg-label-success">Approved</div>';
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
                          $status = '<div class="badge bg-label-danger">Disapproved</div>';
                          // echo '<div class="badge badge-success">Successfull</div>';
                        }
                        else {
                          $status = '<div class="badge bg-label-dark">Error</div>';
                        }
                        // $status = ($row['status']) ? '<div class="badge badge-success">Successfull</div>' : '<div class="badge badge-danger">Cancelled</div>';
                        $i++;
                        echo "
                          <tr>
                            <td><a href='pay-supplier-details?id=".$row['ref_id']."'>".$row['ref_id']."</a></td>
                            <td>".$row['payment_method']."</td>
                            <td>".$status."</td>
                            <td>
                              <a class='dropdown-item' href='pay-supplier-details?id=".$row['ref_id']."'><i class='bx bx-show me-1'></i> View Details</a>
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
