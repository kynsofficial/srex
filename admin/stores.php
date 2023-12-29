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
              <span class="text-muted fw-light">Settings / Frontend Settings /</span> FAQ Settings
            </h4>
            <div class="row mb-3">
              <div class="col-12 mb-2">
                <?php include 'includes/alert.php'; ?>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-header border-bottom">
                    <h4 class="card-title">Stores</h4>
                    <a data-bs-target="#addnew" href="" data-bs-toggle="modal" class="btn btn-primary btn-sm btn-flat mb-3"><i class="bx bx-plus"></i> New</a>
                  </div>
                  <div class="card-datatable table-responsive text-nowrap">
                    <table class="datatables-users table border-top" id="example1">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Image</th>
                          <th>Link</th>
                          <th>About</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        <?php
                        $conn = $pdo->open();
                        try{
                          $stmt = $conn->prepare("SELECT * FROM stores ORDER BY id ASC");
                          $stmt->execute();
                          $i = 0;
                          foreach($stmt as $row){
                            if ($row['image'] == "") {
                              $img = '
                                <div class="avatar avatar-md d-block m-2">
                                  <span class="avatar-initial rounded-circle bg-label-'.$colors[array_rand($colors)].'">'.$row['name'][0].'</span>
                                </div>
                              ';
                            }
                            else{
                              $img = '
                                <img src="'.$settings['site_url'].'assets/img/stores/'.$row['image'].'" alt="user-avatar" class="d-block rounded m-2" height="50" width="50" id="uploadedAvatar" />
                              ';
                            }
                            $i++;
                            echo "
                            <tr>
                              <td>".$i."</td>
                              <td>".$row['name']."</td>
                              <td>".$img."</td>
                              <td>".$row['link']."</td>
                              <td><a href='' data-bs-target='#details' data-bs-toggle='modal' class='btn btn-info btn-sm btn-flat details' data-id='".$row['id']."'><i class='show show-eye'></i> View</a></td>
                              <td>
                                <div class='dropdown'>
                                  <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'><i class='bx bx-dots-vertical-rounded'></i></button>
                                  <div class='dropdown-menu'>
                                    <button class='dropdown-item text-warning edit' data-id='".$row['id']."'><i class='bx bx-edit me-1'></i> Edit</btn>
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
            </div>
          </div>
          <!-- / Content -->

          <!-- Footer -->
          <?php include 'includes/footer.php'; ?>
          <?php include 'includes/stores_modal.php'; ?>
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

  $(document).on('click', '.details', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'stores_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.userid').val(response.id);
      $('#name').html(response.name);
      $('#link').html(response.link);
      $('#about').html(response.about);
      $('#get_name').val(response.name);
      $('#get_link').val(response.link);
      $('#get_about').val(response.about);
      $('.fullname').html(response.name);
    }
  });
}
</script>
</body>
</html>
