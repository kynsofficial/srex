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
              <span class="text-muted fw-light">Misc / </span> Contact
            </h4>
            <div class="row">
              <div class="col-12">
                <?php include 'includes/alert.php'; ?>
              </div>
            </div>
            <!-- Users List Table -->
            <div class="card">
              <div class="card-header border-bottom">
                <h4 class="card-title">Contact List</h4>
                <a data-bs-target="#deleteall" href="" data-bs-toggle="modal" class="btn btn-danger btn-sm btn-flat deleteall mb-3"><i class="bx bx-trash"></i> Delete All</a>
              </div>
              <div class="card-datatable table-responsive text-nowrap">
                <table class="datatables-users table border-top" id="example1">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone No.</th>
                      <th>Message</th>
                      <th>Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php
                    $conn = $pdo->open();
                    try{
                      $stmt = $conn->prepare("SELECT * FROM contact ORDER BY id DESC");
                      $stmt->execute();
                      $i = 0;
                      foreach($stmt as $row){
                        if ($row['status'] == 0) {
                          $status = '<span class="badge bg-label-warning">Not Active</span>';
                          // $active = '<span class="pull-right"><a data-bs-target="#activate" href="" class="status" data-bs-toggle="modal" data-id="'.$row['id'].'"><i class="bx bx-check"></i></a></span>';
                          // echo '<span class="badge bg-label-warning">Pending</span>';
                        }
                        if ($row['status'] == 1) {
                          $status = '<span class="badge bg-label-success">Active</span>';
                          // $active = '<span class="pull-right"><a data-bs-target="#block" href="" class="status" data-bs-toggle="modal" data-id="'.$row['id'].'"><i class="bx bx-block"></i></a></span>';
                          // $active = '';
                          // echo '<span class="badge bg-label-success">Successfull</span>';
                        }
                        $i++;
                        echo "
                        <tr>
                          <td>".$i."</td>
                          <td>".$row['name']."</td>
                          <td>".$row['email']."</td>
                          <td>".$row['phonenumber']."</td>
                          <td><a href='' data-bs-target='#details' data-bs-toggle='modal' class='btn btn-info btn-sm btn-flat details' data-id='".$row['id']."'><i class='bx bx-show'></i> View</a></td>
                          <td>".$row['created_on']."</td>
                          <td>
                            <div class='dropdown'>
                              <button class='dropdown-item text-danger delete' data-id='".$row['id']."'><i class='bx bx-trash me-1'></i> Delete</btn>
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
          <?php include 'includes/message_modal.php'; ?>
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

  $(document).on('click', '.deleteall', function(e){
    e.preventDefault();
    $('#deleteall').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete1').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.details', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });


});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'message_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.userid').val(response.id);
      $('#desc').html(response.message);
      $('#name').html(response.name);
      $('#emailre').html(response.email);
      $('#phonenumber').html(response.phonenumber);
      $('.fullname').html(response.name);
    }
  });
}
</script>
</body>
</html>
