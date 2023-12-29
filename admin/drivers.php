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
              <span class="text-muted fw-light">Manage /</span> Drivers
            </h4>


            <?php
              $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM drivers WHERE status=1");
              $stmt->execute();

              $active_users = 0;
              foreach ($stmt as $key1) {
                $subactive_users = $key1['numrows'];
                $active_users += $subactive_users;
              }

              $stmt1 = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM drivers WHERE status=0 OR status=2");
              $stmt1->execute();

              $pending_users = 0;
              foreach ($stmt1 as $key2) {
                $subpending_users = $key2['numrows'];
                $pending_users += $subpending_users;
              }

              $stmt1 = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM drivers");
              $stmt1->execute();

              $total_users = 0;
              foreach ($stmt1 as $key2) {
                $subtotal_users = $key2['numrows'];
                $total_users += $subtotal_users;
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
                        <span>Session</span>
                        <div class="d-flex align-items-end mt-2">
                          <h4 class="mb-0 me-2"><?php echo number_format($about['visitors'], 0); ?></h4>
                          <!-- <small class="text-success">(+29%)</small> -->
                        </div>
                        <small>No. of Visitors</small>
                      </div>
                      <span class="badge bg-label-info rounded p-2">
                        <i class="bx bx-show bx-sm"></i>
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
                        <span>Drivers</span>
                        <div class="d-flex align-items-end mt-2">
                          <h4 class="mb-0 me-2"><?php echo number_format($total_users, 0); ?></h4>
                          <!-- <small class="text-success">(+29%)</small> -->
                        </div>
                        <small>Total Drivers</small>
                      </div>
                      <span class="badge bg-label-primary rounded p-2">
                        <i class="bx bx-user bx-sm"></i>
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
                        <span>Active Drivers</span>
                        <div class="d-flex align-items-end mt-2">
                          <h4 class="mb-0 me-2"><?php echo number_format($active_users, 0); ?></h4>
                          <!-- <small class="text-danger">(-14%)</small> -->
                        </div>
                        <small>Verified Drivers</small>
                      </div>
                      <span class="badge bg-label-success rounded p-2">
                        <i class="bx bx-group bx-sm"></i>
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
                        <span>Suspended Drivers</span>
                        <div class="d-flex align-items-end mt-2">
                          <h4 class="mb-0 me-2"><?php echo number_format($pending_users, 0); ?></h4>
                          <!-- <small class="text-success">(+42%)</small> -->
                        </div>
                        <small>Suspended Drivers</small>
                      </div>
                      <span class="badge bg-label-warning rounded p-2">
                        <i class="bx bx-user-voice bx-sm"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Drivers List Table -->
            <div class="card">
              <div class="card-header border-bottom">
                <h5 class="card-title">All Drivers List</h5>
                <a data-bs-target="#addnew1" href="" data-bs-toggle="modal" class="btn btn-primary btn-sm btn-flat mb-3"><i class="bx bx-plus"></i> New</a>
                <a data-bs-target="#export" href="" data-bs-toggle="modal" class="btn btn-primary btn-sm btn-flat mb-3"><i class="bx bx-upload"></i> Export all as CSV</a>
              </div>
              <div class="card-datatable table-responsive text-nowrap">
                <table class="datatables-users table border-top" id="example1">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Date Joined</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php
                    $conn = $pdo->open();
                    try{
                      $stmt = $conn->prepare("SELECT * FROM drivers ORDER BY id DESC");
                      $stmt->execute();
                      $i = 0;
                      foreach($stmt as $row){
                        // $i++;
                        if ($row['photo'] == "") {
                          $img = '
                            <div class="avatar avatar-md avatar-online d-block m-2">
                              <span class="avatar-initial rounded-circle bg-label-'.$colors[array_rand($colors)].'">'.$row['username'][0].'</span>
                            </div>
                          ';
                        }
                        else{
                          $img = '
                            <img src="'.$settings['site_url'].'assets/img/avatars/'.$row['photo'].'" alt="user-avatar" class="d-block rounded m-2" height="50" width="50" id="uploadedAvatar" />
                          ';
                        }
                        if ($row['firstname'] == "") {
                          $name = $row['username'];
                        }else {
                          $name = $row['firstname']." ".$row['lastname'];
                        }
                        // $image = (!empty($row['photo'])) ? '/user/images/'.$row['photo'] : '/user/images/profile.jpg';
                        if ($row['status'] == 0) {
                          $status = '<span class="badge bg-label-warning">Not Verified</span>';
                          $active = '<span class="pull-right"><a data-bs-target="#activate1" href="" class="status" data-bs-toggle="modal" data-id="'.$row['id'].'"><i class="bx bx-check"></i></a></span>';
                          // echo '<span class="badge bg-label-warning">Pending</span>';
                        }
                        if ($row['status'] == 1) {
                          $status = '<span class="badge bg-label-success">Active</span>';
                          $active = '<span class="pull-right"><a data-bs-target="#block" href="" class="status" data-bs-toggle="modal" data-id="'.$row['id'].'"><i class="bx bx-block"></i></a></span>';
                          // $active = '';
                          // echo '<span class="badge bg-label-success">Successfull</span>';
                        }
                        if ($row['status'] == 2) {
                          $status = '<span class="badge bg-label-danger">Suspended</span>';
                          $active = '<span class="pull-right"><a data-bs-target="#unblock" href="" class="status" data-bs-toggle="modal" data-id="'.$row['id'].'"><i class="bx bx-block"></i></a></span>';
                          // echo '<span class="badge bg-label-danger">Rejected</span>';
                        }
                        // $status = ($row['status']) ? '<div class="badge bg-label-success">Successfull</div>' : '<div class="badge bg-label-danger">Cancelled</div>';
                        $i++;
                        echo "
                        <tr>
                          <td>".$i."</td>
                          <td>".$img."</td>
                          <td>".$name."</td>
                          <td>".$row['email']."</td>
                          <td>".$status." ".$active."</td>
                          <td>".date('M d, Y', strtotime($row['date_created']))."</td>
                          <td>
                            <div class='dropdown'>
                              <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'><i class='bx bx-dots-vertical-rounded'></i></button>
                              <div class='dropdown-menu'>
                                <a class='dropdown-item' href='driver-details?userid=".$row['id']."'><i class='bx bx-show me-1'></i> View Details</a>
                                <button class='dropdown-item text-danger delete' data-id='".$row['id']."'><i class='bx bx-trash me-1'></i> Delete</btn>
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
          <!-- / Content -->

          <!-- Footer -->
          <?php include 'includes/footer.php'; ?>
          <?php include 'includes/drivers_modal.php'; ?>
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
$(function(){

  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete1').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.status', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'driver_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.userid').val(response.id);
      $('#edit_email').val(response.email);
      $('#edit_password').val(response.password);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_address').val(response.address);
      $('#edit_contact').val(response.contact_info);
      $('.fullname').html(response.firstname+' '+response.lastname);
      // $('.username').html(response.username);
    }
  });
}
</script>
</body>
</html>
