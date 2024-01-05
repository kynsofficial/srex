<?php include 'includes/head.php'; ?>
<?php
$conn = $pdo->open();

$userid = $_GET['userid'];

try{

  $stmt = $conn->prepare("SELECT * FROM shippments WHERE driver_assigned_id=:driver_assigned_id");
  $stmt->execute(['driver_assigned_id'=>$admin['id']]);
  $useridfromorder = $stmt->fetch();

  $stmt = $conn->prepare("SELECT * FROM users WHERE id = :userid");
  $stmt->execute(['userid' => $userid]);
  $user = $stmt->fetch();

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
            <span class="text-muted fw-light">Manage / Users /</span> User Account
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

                      if ($user['photo'] == "") {
                        $img = '
                        <div class="avatar avatar-xl avatar-online d-block m-2">
                        <span class="avatar-initial rounded-circle bg-label-'.$colors[array_rand($colors)].'">'.$user['username'][0].'</span>
                        </div>
                        ';
                      }
                      elseif ($user['google_id'] !== "") {
                        $img = '
                        <img src="'.$user['photo'].'" height="110" width="110" alt="User avatar" class="img-fluid rounded my-4" />
                        ';
                      }
                      else{
                        $img = '
                        <img src="'.$settings['site_url'].'assets/img/avatars/'.$user['photo'].'" height="110" width="110" alt="User avatar" class="img-fluid rounded my-4" />
                        ';
                      }

                      echo $img;

                      if ($user['status'] == 0) {
                        $mark = 'bx bx-badge-check text-warning';
                        $color = 'text-warning';
                        $status = '<span class="badge bg-label-warning">Not Verified</span>';
                        $active = '<span class="float-right"><a href="#activate1" class="status" data-bs-toggle="modal" data-id="'.$user['id'].'"><i class="bx bx-check"></i></a></span>';
                        // href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser" data-bs-toggle="modal"
                        $block = '<a href="" data-bs-target="#activate1" data-bs-toggle="modal" data-id="'.$user['id'].'" class="btn btn-success me-3"><i class="bx bx-check"></i> Verify User</a>';
                        // echo '<span class="badge bg-label-warning">Pending</span>';
                      }
                      if ($user['status'] == 1) {
                        $mark = 'bx bx-badge-check text-success';
                        $color = 'text-success';
                        $status = '<span class="badge bg-label-success">Active</span>';
                        $active = '';
                        $block = '<a href="" data-bs-target="#block" data-bs-toggle="modal" data-id="'.$user['id'].'" class="btn btn-danger me-3"><i class="bx bx-block"></i> Suspend User</a>';
                        // echo '<span class="badge bg-label-success">Successfull</span>';
                      }
                      if ($user['status'] == 2) {
                        $mark = 'bx bx-badge-check text-danger';
                        $color = 'text-danger';
                        $status = '<span class="badge bg-label-danger">Blocked</span>';
                        $active = '<span class="float-right"><a href="" data-bs-target="#unblock" class="status" data-bs-toggle="modal" data-id="'.$user['id'].'"><i class="bx bx-check"></i></a></span>';
                        $block = '<a href="" data-bs-target="#unblock" data-bs-toggle="modal" data-id="'.$user['id'].'" class="btn btn-warning me-3"><i class="bx bx-block"></i> Unblock User</a>';
                        // echo '<span class="badge bg-label-danger">Rejected</span>';
                      }
                      ?>
                      <div class="user-info text-center">
                        <h4 class="mb-2"><?php echo $user['firstname'].' '.$user['lastname']; ?><sup><i class="<?php echo $mark; ?>" style="font-size:10px;"></i></sup></h4>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-around flex-wrap my-1 py-3">
                  </div>
                  <h5 class="pb-2 border-bottom mb-4">Details
                    <span class="btn btn-xs float-end"></span>
                  </h5>
                  <div class="info-container">
                    <ul class="list-unstyled">
                      <li class="mb-3">
                        <span class="fw-bold me-2">Email:</span>
                        <span><?php echo $user['email'];?></span>
                      </li>
                      <li class="mb-3">
                        <span class="fw-bold me-2">Phone No:</span>
                        <span><?php echo $user['contact_info'];?></span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- /User Card -->
            </div>
            <!--/ User Sidebar -->


            <!-- User Content -->
            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">

                <!-- Invoice table -->
                <div class="card mb-4">
                  <h5 class="card-header">User's Addresses</h5>
                  <div class="card-datatable table-responsive text-nowrap mb-3">
                    <table class="table table-hover border-top" id="example2">
                      <thead>
                        <tr>
                          <th>Fullname</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Location</th>
                          <th>LGA & State</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $conn = $pdo->open();

                        try{
                          $stmt = $conn->prepare("SELECT * FROM users_address WHERE userid=:userid ORDER BY id DESC");
                          $stmt->execute(['userid'=>$user['id']]);
                          $i = 0;
                          foreach($stmt as $row){
                            // $status = ($row['status']) ? '<div class="badge badge-success">Successfull</div>' : '<div class="badge badge-danger">Cancelled</div>';
                            $i++;
                            echo "
                            <tr>
                            <td>".$row['firstname']." ".$row['lastname']."</td>
                            <td>".$row['email']."</td>
                            <td>".$row['phonenumber']."</td>
                            <td>".$row['location']."</td>
                            <td>".$row['lga'].", ".$row['state']."</td>
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
                <!-- /Invoice table -->

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
                      <form class="form-horizontal" method="POST" action="user_activate">
                        <input type="hidden" value="<?php echo $user['id']; ?>"  name="id">
                        <div class="text-center">
                          <p>VERIFY USER</p>
                          <h2 class="bold"><?php echo $user['username']; ?></h2>
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

              <div class="modal fade" id="delete">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title"><b>Deleting...</b></h4>
                      <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal" method="POST" action="user_delete">
                          <input type="hidden" value="<?php echo $user['id']; ?>"  name="id">
                          <div class="text-center">
                            <p>DELETE USER</p>
                            <h2 class="bold"><?php echo $user['username']; ?></h2>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-rounded pull-left" data-bs-dismiss="modal"><i class="bx bx-close"></i> Close</button>
                          <button type="submit" class="btn btn-danger btn-rounded" name="delete"><i class="bx bx-check"></i> Delete</button>
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
                        <form class="form-horizontal" method="POST" action="user_unblock">
                          <input type="hidden" value="<?php echo $user['id']; ?>"  name="id">
                          <div class="text-center">
                            <p>UNSUSPEND USER</p>
                            <h2 class="bold"><?php echo $user['username']; ?></h2>
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
                          <form class="form-horizontal" method="POST" action="user_block">
                            <input type="hidden" value="<?php echo $user['id']; ?>"  name="id">
                            <div class="text-center">
                              <p>SUSPEND USER</p>
                              <h2 class="bold"><?php echo $user['username']; ?></h2>
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
