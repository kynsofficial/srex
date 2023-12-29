<?php include 'includes/head.php'; ?>
<?php
$conn = $pdo->open();

$driverid = $_GET['userid'];

try{

  $stmt = $conn->prepare("SELECT * FROM drivers WHERE id = :userid");
  $stmt->execute(['userid' => $driverid]);
  $driver = $stmt->fetch();

}
catch(PDOException $e){
  echo "There is some problem in connection: " . $e->getMessage();
}
$pdo->close();
?>
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
            <span class="text-muted fw-light">Manage / Drivers /</span> Driver Account
          </h4>
          <div class="row">
            <!-- User Sidebar -->
            <div class="col-xl-4 col-lg-5 col-md-5 order-0 order-md-0">
              <!-- User Card -->
              <div class="card mb-4">
                <div class="card-body">
                  <div class="user-avatar-section">
                    <div class=" d-flex align-items-center flex-column">

                      <!-- <img class="img-fluid rounded my-4" src="../assets/img/avatars/10.png" height="110" width="110" alt="User avatar" /> -->
                      <?php

                      if ($driver['photo'] == "") {
                        $img = '
                        <div class="avatar avatar-xl avatar-online d-block m-2">
                        <span class="avatar-initial rounded-circle bg-label-'.$colors[array_rand($colors)].'">'.$driver['username'][0].'</span>
                        </div>
                        ';
                      }
                      else{
                        $img = '
                        <img src="'.$settings['site_url'].'assets/img/avatars/'.$driver['photo'].'" height="110" width="110" alt="User avatar" class="img-fluid rounded my-4" />
                        ';
                      }

                      echo $img;

                      if ($driver['status'] == 0) {
                        $mark = 'bx bx-badge-check text-warning';
                        $color = 'text-warning';
                        $status = '<span class="badge bg-label-warning">Not Verified</span>';
                        $active = '<span class="float-right"><a href="#activate1" class="status" data-bs-toggle="modal" data-id="'.$driver['id'].'"><i class="bx bx-check"></i></a></span>';
                        // href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser" data-bs-toggle="modal"
                        $block = '<a href="" data-bs-target="#activate1" data-bs-toggle="modal" data-id="'.$driver['id'].'" class="btn btn-success me-3"><i class="bx bx-check"></i> Verify Driver</a>';
                        // echo '<span class="badge bg-label-warning">Pending</span>';
                      }
                      if ($driver['status'] == 1) {
                        $mark = 'bx bx-badge-check text-success';
                        $color = 'text-success';
                        $status = '<span class="badge bg-label-success">Active</span>';
                        $active = '';
                        $block = '<a href="" data-bs-target="#block" data-bs-toggle="modal" data-id="'.$driver['id'].'" class="btn btn-danger me-3"><i class="bx bx-block"></i> Suspend Driver</a>';
                        // echo '<span class="badge bg-label-success">Successfull</span>';
                      }
                      if ($driver['status'] == 2) {
                        $mark = 'bx bx-badge-check text-danger';
                        $color = 'text-danger';
                        $status = '<span class="badge bg-label-danger">Suspended</span>';
                        $active = '<span class="float-right"><a href="" data-bs-target="#unblock" class="status" data-bs-toggle="modal" data-id="'.$driver['id'].'"><i class="bx bx-check"></i></a></span>';
                        $block = '<a href="" data-bs-target="#unblock" data-bs-toggle="modal" data-id="'.$driver['id'].'" class="btn btn-warning me-3"><i class="bx bx-block"></i> Unblock Suspend</a>';
                        // echo '<span class="badge bg-label-danger">Rejected</span>';
                      }
                      ?>
                      <div class="user-info text-center">
                        <h4 class="mb-2"><?php echo $driver['firstname'].' '.$driver['lastname']; ?><sup><i class="<?php echo $mark; ?>" style="font-size:10px;"></i></sup></h4>
                        <span class="badge bg-label-info"><?php echo $driver['username'];?></span>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-around flex-wrap my-1 py-3">
                  </div>
                  <h5 class="pb-2 border-bottom mb-4">Details</h5>
                  <div class="info-container">
                    <ul class="list-unstyled">
                      <li class="mb-3">
                        <span class="fw-bold me-2">Email:</span>
                        <span><?php echo $driver['email'];?></span>
                      </li>
                      <li class="mb-3">
                        <span class="fw-bold me-2">Status:</span>
                        <?php echo $status; ?>
                      </li>
                      <li class="mb-3">
                        <span class="fw-bold me-2">Phone No:</span>
                        <span><?php echo $driver['contact_info'];?></span>
                      </li>
                      <li class="mb-3">
                        <span class="fw-bold me-2">Gender:</span>
                        <span><?php echo $driver['gender'];?></span>
                      </li>
                      <li class="mb-3">
                        <span class="fw-bold me-2">DOB:</span>
                        <span><?php echo $driver['dob'];?></span>
                      </li>
                      <li class="mb-3">
                        <span class="fw-bold me-2">Address:</span>
                        <span><?php echo $driver['address'];?></span>
                      </li>
                      <li class="mb-3">
                        <span class="fw-bold me-2">State:</span>
                        <span><?php echo $driver['state'];?></span>
                      </li>
                      <li class="mb-3">
                        <span class="fw-bold me-2">Country:</span>
                        <span><?php echo $driver['country'];?></span>
                      </li>
                      <li class="mb-3">
                        <span class="fw-bold me-2">ZipCode:</span>
                        <span><?php echo $driver['zipcode'];?></span>
                      </li>
                      <li class="mb-3">
                        <span class="fw-bold me-2">Account Number:</span>
                        <span><?php echo $driver['main_account_number'];?></span>
                      </li>
                      <li class="mb-3">
                        <span class="fw-bold me-2">Bank Name:</span>
                        <span><?php echo $driver['main_bank_name'];?></span>
                      </li>
                      <li class="mb-3">
                        <span class="fw-bold me-2">Account Name:</span>
                        <span><?php echo $driver['name_on_account'];?></span>
                      </li>
                      <li class="mb-3">
                        <span class="fw-bold me-2">Short Code:</span>
                        <span><?php echo $driver['short_code'];?></span>
                      </li>
                      <li class="mb-3">
                        <span class="fw-bold me-2">About:</span>
                        <span><?php echo $driver['about'];?></span>
                      </li>
                    </ul>
                    <div class="d-flex justify-content-center pt-3">
                      <!-- <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser" data-bs-toggle="modal">Edit</a>
                      <a href="javascript:;" class="btn btn-label-danger suspend-user">Suspended</a> -->
                      <?php echo $block; ?>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /User Card -->
            </div>
            <!--/ User Sidebar -->


            <!-- User Content -->
            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">



                <!-- Project table -->
                <div class="card mb-4">
                  <h5 class="card-header">Driver's Log</h5>
                  <div class="card-datatable table-responsive text-nowrap mb-3">
                    <table class="table table-hover border-top" id="example3">
                      <thead>
                        <tr>
                          <th>S/N</th>
                          <th>Driver IP</th>
                          <th>Login Time</th>
                          <th>Device Info</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $conn = $pdo->open();

                        try{
                          $stmt = $conn->prepare("SELECT * FROM driverslog WHERE userid = :userid ORDER BY id DESC");
                          $stmt->execute(['userid'=>$driverid]);
                          $i = 0;
                          foreach($stmt as $row){
                            $i++;
                            echo "

                            <tr>
                            <td>".$i."</td>
                            <td><a href='https://whatismyipaddress.com/ip/".$row['userip']."' target='_blank'>".$row['userip']."</a></td>
                            <td>".$row['loginTime']."</td>
                            <td>".$row['deviceinfo']."</td>
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
                <!-- /Project table -->

              </div>
              <!--/ User Content -->
            </div>

            <!-- Modal -->
            <div class="modal fade" id="activate1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><b>Verifing...</b></h4>
                    <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal" method="POST" action="driver_activate">
                        <input type="hidden" value="<?php echo $driver['id']; ?>"  name="id">
                        <div class="text-center">
                          <p>VERIFY DRIVER</p>
                          <h2 class="bold"><?php echo $driver['username']; ?></h2>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-rounded pull-left" data-bs-dismiss="modal"><i class="bx bx-close"></i> Close</button>
                        <button type="submit" class="btn btn-warning btn-rounded" name="activate"><i class="bx bx-check"></i> Activate</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Unblock -->
              <div class="modal fade" id="unblock">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title"><b>Unsuspending...</b></h4>
                      <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal" method="POST" action="driver_unblock">
                          <input type="hidden" value="<?php echo $driver['id']; ?>"  name="id">
                          <div class="text-center">
                            <p>UNSUSPEND DRIVER</p>
                            <h2 class="bold"><?php echo $driver['username']; ?></h2>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-rounded pull-left" data-bs-dismiss="modal"><i class="bx bx-close"></i> Close</button>
                          <button type="submit" class="btn btn-warning btn-rounded" name="unblock"><i class="bx bx-block"></i> Unsuspend</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Block -->
                <div class="modal fade" id="block">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title"><b>Suspending...</b></h4>
                        <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal" method="POST" action="driver_block">
                            <input type="hidden" value="<?php echo $driver['id']; ?>"  name="id">
                            <div class="text-center">
                              <p>SUSPEND DRIVER</p>
                              <h2 class="bold"><?php echo $driver['username']; ?></h2>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-rounded pull-left" data-bs-dismiss="modal"><i class="bx bx-close"></i> Close</button>
                            <button type="submit" class="btn btn-warning btn-rounded" name="block"><i class="bx bx-block"></i> Suspend</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /Modal -->

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
      </body>
      </html>
