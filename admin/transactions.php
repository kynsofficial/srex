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
              <span class="text-muted fw-light">Misc /</span> Transactions
            </h4>


            <?php
              $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM transaction_all WHERE status=1");
              $stmt->execute();

              $approved_transaction_all = 0;
              foreach ($stmt as $key1) {
                $subapproved_transaction_all = $key1['numrows'];
                $approved_transaction_all += $subapproved_transaction_all;
              }

              $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM transaction_all WHERE status=4 OR status=3 OR status=5");
              $stmt->execute();

              $cancelled_transaction_all = 0;
              foreach ($stmt as $key1) {
                $subcancelled_transaction_all = $key1['numrows'];
                $cancelled_transaction_all += $subcancelled_transaction_all;
              }

              $stmt1 = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM transaction_all WHERE status=0 OR status=2");
              $stmt1->execute();

              $pending_transaction_all = 0;
              foreach ($stmt1 as $key2) {
                $subpending_transaction_all = $key2['numrows'];
                $pending_transaction_all += $subpending_transaction_all;
              }

              $stmt1 = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM transaction_all");
              $stmt1->execute();

              $total_transaction_all = 0;
              foreach ($stmt1 as $key2) {
                $subtotal_transaction_all = $key2['numrows'];
                $total_transaction_all += $subtotal_transaction_all;
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
                        <span>Transactions</span>
                        <div class="d-flex align-items-end mt-2">
                          <h4 class="mb-0 me-2"><?php echo number_format($total_transaction_all, 0); ?></h4>
                          <!-- <small class="text-success">(+29%)</small> -->
                        </div>
                        <small>Total Transactions</small>
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
                        <span>Approved Transactions</span>
                        <div class="d-flex align-items-end mt-2">
                          <h4 class="mb-0 me-2"><?php echo number_format($approved_transaction_all, 0); ?></h4>
                          <!-- <small class="text-danger">(-14%)</small> -->
                        </div>
                        <small>Verified Transactions</small>
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
                        <span>Pending Transactions</span>
                        <div class="d-flex align-items-end mt-2">
                          <h4 class="mb-0 me-2"><?php echo number_format($pending_transaction_all, 0); ?></h4>
                          <!-- <small class="text-success">(+42%)</small> -->
                        </div>
                        <small>Pending Transactions</small>
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
                        <span>Rejected Transactions</span>
                        <div class="d-flex align-items-end mt-2">
                          <h4 class="mb-0 me-2"><?php echo number_format($cancelled_transaction_all, 0); ?></h4>
                          <!-- <a href="#" class="text-success">(+29%)</a> -->
                        </div>
                        <small>Rejected Transactions</small>
                      </div>
                      <span class="badge bg-label-danger rounded p-2">
                        <i class="bx bx-dollar bx-sm"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Transactions List Table -->
            <div class="card">
              <div class="card-header border-bottom">
                <h5 class="card-title">All Transactions</h5>
              </div>
              <div class="card-datatable table-responsive text-nowrap">
                <table class="datatables-users table border-top" id="example1">
                  <thead>
                    <tr>
                      <th>TRX ID</th>
                      <th>Amount</th>
                      <th>Type</th>
                      <th>User</th>
                      <th>Payment Status</th>
                      <th>Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php
                    $conn = $pdo->open();
                    try{
					  $stmt = $conn->prepare("SELECT * FROM transaction_all ORDER BY id DESC");
                      $stmt->execute();
                      $i = 0;
                      foreach($stmt as $row){
                        if ($row['status'] == 1) {
                          $status = '<div class="badge bg-label-success">Successfull</div>';
                        }
                        elseif ($row['status'] == 2) {
                          $status = '<div class="badge bg-label-danger">Cancelled</div>';
                        }
                        elseif ($row['status'] == 0) {
                          $status = '<div class="badge bg-label-danger">Unsuccessfull Order</div>';
                        }
                        else {
                          $status = '<div class="badge bg-label-dark">Error</div>';
                        }
                        $amount = $settings['currency'].''.number_format($row['amount'], 2);
                        $i++;
                        echo "
                        <tr>
                          <td><a href='transaction-details?id=".$row['trxid']."'>".$row['trxid']."</a></td>
                          <td>".$amount."</td>
                          <td>".$row['type']."</td>
                          <td><a href='user-details?userid=".$row['userid']."' class='btn btn-success btn-sm btn-flat' target='_blank'><i class='bx bx-show'></i> View</a></td>
                          <td>".$status."</td>
                          <td>".date('M d, Y', strtotime($row['datetime']))."</td>
                          <td>
                            <a class='dropdown-item' href='transaction-details?id=".$row['trxid']."'><i class='bx bx-show me-1'></i> View</a>
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
