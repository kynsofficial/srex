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
                        <p class="mb-4">You're the boss here, you control everything here. How cool is that? 🙌🥳</p>

                        <a href="javascript:;" class="btn btn-sm btn-label-primary">Let Get to Work!</a>
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
                  <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                          <div class="avatar flex-shrink-0">
                            <img loading="lazy" src="<?php echo $settings['site_url']; ?>assets/img/icons/unicons/chart.png" alt="Watch" class="rounded">
                          </div>
                          <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                              <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#visitor"> View More</a>
                            </div>
                          </div>
                        </div>
                        <span>Visitors</span>
                        <h3 class="card-title text-nowrap mb-1"><?php echo number_format_short($about['visitors'], 0); ?></h3>
                        <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +28.42%</small>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-12 col-6 mb-4">
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
              <!-- Total Income -->
              <div class="col-md-12 col-lg-12 mb-4">
                <div class="card">
                  <div class="row row-bordered g-0">
                    <div class="col-md-8">
                      <div class="card-header">
                        <h5 class="card-title mb-0">Total Income</h5>
                        <small class="card-subtitle">Yearly report overview</small>
                      </div>
                      <div class="card-body">
                        <div id="totalIncomeChart"></div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="card-header d-flex justify-content-between">
                        <div>
                          <h5 class="card-title mb-0">Report</h5>
                          <small class="card-subtitle">Monthly Avg. <?php echo $settings['currency']; ?><?php echo number_format_short($total_orders_amount / 12, 2); ?></small>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="report-list">
                          <div class="report-list-item rounded-2 mb-3">
                            <div class="d-flex align-items-start">
                              <div class="report-list-icon shadow-sm me-2">
                                <img loading="lazy" src="<?php echo $settings['site_url']; ?>assets/img/icons/unicons/cube-secondary.png" width="22" height="22" alt="Paypal">
                              </div>
                              <div class="d-flex justify-content-between align-items-end w-100 flex-wrap gap-2">
                                <div class="d-flex flex-column">
                                  <span>Orders</span>
                                  <h5 class="mb-0"><?php echo $settings['currency']; ?><?php echo number_format_short($total_orders_amount, 2); ?></h5>
                                </div>
                                <!-- <small class="text-success">+2.34k</small> -->
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Total Income -->
              </div>
              <!--/ Total Income -->
            </div>

            <div class="row">
              <div class="col-md-6 col-lg-7 mb-4 mb-md-0">
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
              <div class="col-md-6 col-lg-5 mb-4 mb-md-0">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <?php
                      $stmt1 = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE type=0");
                      $stmt1->execute();

                      $total_users = 0;
                      foreach ($stmt1 as $key2) {
                        $subtotal_users = $key2['numrows'];
                        $total_users += $subtotal_users;
                      }
                      ?>
                      <h6 class="fw-normal">Total <?php echo number_format($total_users); ?> users</h6>
                      <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">

                        <?php
                        $conn = $pdo->open();
                        $stmt = $conn->prepare("SELECT * FROM users WHERE type = 0 ORDER BY date_created DESC LIMIT 10");
                        $stmt->execute();
                        ?>
                        <?php foreach ($stmt as $row): ?>
                          <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="<?php echo $row['firstname'].' '.$row['lastname']; ?>" class="avatar avatar-sm pull-up">
                            <?php if ($row['photo'] == ""): ?>
                              <div class="avatar avatar-sm">
                                <span class="avatar-initial rounded-circle bg-label-<?php echo $colors[array_rand($colors)]; ?>"><?php echo $row['username'][0]; ?></span>
                              </div>
                            <?php elseif ($row['google_id'] !== ""): ?>
                              <img loading="lazy" class="rounded-circle" src="<?php echo $row['photo']; ?>" alt="Avatar">
                            <?php else: ?>
                              <img loading="lazy" class="rounded-circle" src="<?php echo $settings['site_url']; ?>assets/img/avatars/<?php echo $row['photo']; ?>" alt="Avatar">
                            <?php endif; ?>
                          </li>
                        <?php endforeach; ?>

                      </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                      <div class="role-heading">
                        <h4 class="mb-1">Latest Users</h4>
                        <!-- <a href="users" class="role-edit-modal"><small>View All</small></a> -->
                      </div>
                    </div>
                  </div>
                <!-- </div>
  							<div class="card"> -->
  								<div class="card-body p-0">
  									<!-- <h4 class="card-title">Latest Members</h4> -->
  									<div class="p-0">
  										<ul class="flex-column-reverse" style="list-style-type: none;">
                        <?php
                        $conn = $pdo->open();

                        try{
                          $stmt = $conn->prepare("SELECT * FROM users WHERE type = 0 ORDER BY date_created DESC LIMIT 5");
                          $stmt->execute();
                          $i = 0;
                          foreach($stmt as $row){
                            $i++;
                              if ($row['photo'] == "") {
                                $img = '
                                  <div class="avatar avatar-md avatar-online d-block m-2">
                                    <span class="avatar-initial rounded-circle bg-label-'.$colors[array_rand($colors)].'">'.$row['username'][0].'</span>
                                  </div>
                                ';
                              }
                              elseif ($row['google_id'] !== ""){
                                $img = '
                                  <img loading="lazy" src="'.$row['photo'].'" alt="user-avatar" class="d-block rounded m-2" height="50" width="50" id="uploadedAvatar" />
                                ';
                              }
                              else{
                                $img = '
                                  <img loading="lazy" src="'.$settings['site_url'].'assets/img/avatars/'.$row['photo'].'" alt="user-avatar" class="d-block rounded m-2" height="50" width="50" id="uploadedAvatar" />
                                ';
                              }
                            // $image = (!empty($row['photo'])) ? '/assets/img/avatars/'.$row['photo'] : '/assets/img/avatars/profile.jpg';
                            $status = ($row['status']) ? '<span class="text-success">Verified</span>' : '<span class="text-danger">Not Verified</span>';
                            echo "
                            <li>
                              <div class='d-flex'>
                                ".$img."
                                <div class='m-2'>
                                  <p class='text-info mb-1'><a class='users-list-name' href='user-details?userid=".$row['id']."'>".$row['username']."</a></p>
                                  <p class='mb-0'>User joined ".date('M d, Y', strtotime($row['date_created']))."</p>
                                  <small>Status - ".$status."</small>
                                </div>
                              </div>
                            </li>
                            ";
                            }
                          }
                          catch(PDOException $e){
                            echo $e->getMessage();
                          }

                          $pdo->close();
                        ?>
  										</ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-end px-3 py-3">
                      <div class="role-heading">
                        <a href="users" class="role-edit-modal"><small>View All</small></a>
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
  <!-- / Layout wrapper -->
<?php include 'includes/scripts.php'; ?>

<div class="modal fade" id="visitor">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Total Website Visitors</b></h4>
              <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="settings_visitors">
                <input type="hidden" value="1" name="id">
                <p>Website visitors count anytime someone visits your website.</p>
                <p class="text-danger">If you want to reset it, input Zero (0) or simply leave blank and save.</p>
                <div class="form-group">
                    <label for="visitors" class="col-sm-3 control-label">Total No.</label>
                    <?php
                    $conn = $pdo->open();

                    $stmt = $conn->prepare("SELECT * FROM about WHERE id = 1");
                		$stmt->execute();
                		$row = $stmt->fetch();

                		$pdo->close();
                     ?>
                      <input type="text" class="form-control" value="<?php echo $row['visitors']; ?>" name="visitors">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-rounded pull-left" data-bs-dismiss="modal"><i class="bx bx-close"></i> Close</button>
              <button type="reset" class="btn btn-danger btn-rounded"><i class="bx bx-recycle"></i> Reset</button>
              <button type="submit" class="btn btn-primary btn-rounded" name="edit"><i class="bx bx-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/apex-charts/apexcharts.js"></script>
<script>
<?php
  $today = date('Y-m-d');
  $year = date('Y');
  if(isset($_GET['year'])){
    $year = $_GET['year'];
  }
  $months = array();
  $sales = array();
  for( $m = 1; $m <= 12; $m++ ) {
    try{
      $stmt = $conn->prepare(
        "SELECT naira_amount FROM orders WHERE MONTH(date_created)=:month AND YEAR(date_created)=:year AND status = 1"
      );
      $stmt->execute(['month'=>$m, 'year'=>$year]);
      $total = 0;
      foreach($stmt as $srow){
        $subtotal = $srow['naira_amount'];
        $total += $subtotal;
      }
      array_push($sales, $total);
      $sales = array_map(function($num){return $num;}, $sales);
    }
    catch(PDOException $e){
      echo $e->getMessage();
    }

    $num = str_pad( $m, 2, 0, STR_PAD_LEFT );
    $month =  date('M', mktime(0, 0, 0, $m, 1));
    array_push($months, $month);
  }

  $months = json_encode($months);
  $sales = json_encode($sales);

  // echo $months;
  // echo $sales;

  $total_used_in_chart = $total_orders_amount;

  if ($total_used_in_chart < 10) {
    // echo "<br>Max 10";
    // echo "<br>Min 10";
    $new_max = 10;
    $new_min = 10;
  }elseif ($total_used_in_chart < 50) {
    // echo "<br>Max 50";
    // echo "<br>Min 10";
    $new_max = 50;
    $new_min = 10;
  }elseif ($total_used_in_chart < 100) {
    // echo "<br>Max 100";
    // echo "<br>Min 10";
    $new_max = 100;
    $new_min = 10;
  }elseif ($total_used_in_chart < 1000) {
    // echo "<br>Max 1000";
    // echo "<br>Min 10";
    $new_max = 1000;
    $new_min = 10;
  }elseif ($total_used_in_chart > 1000) {
    // echo "<br>Max ".$total_used_in_chart + 200;
    // echo "<br>Min 10";
    $new_max = floor($total_used_in_chart + 200);
    $new_min = 5;
  }

?>
<?php 
$user_currency = $settings['currency'];
include 'includes/script.js'; ?>
</script>
</body>
</html>
