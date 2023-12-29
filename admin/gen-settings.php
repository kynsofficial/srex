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
              <span class="text-muted fw-light">Settings / Main Settings /</span> General Settings
            </h4>
            <div class="row">
              <div class="col-12">
                <?php include 'includes/alert.php'; ?>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"><?php echo $settings['site_name']; ?> General Settings</h4>
                    <p class="card-description">
                      <?php echo $settings['site_name']; ?> General Settings
                    </p>
                    <?php
                    $result = $conn->prepare("SELECT * FROM settings WHERE id = 1");
                    $result->execute();
                    for($i=0; $row = $result->fetch(); $i++){
                    ?>
                    <form class="form"  action="settings_edit" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="id" value="1">
                      <div class="mb-3">
                        <label>Site Name</label>
                        <input type="text" name="site_name" class="form-control" placeholder="Enter site_name" value="<?php echo $row['site_name'];?>">
                      </div>
                      <div class="mb-3">
                        <label>Site Title</label>
                        <input type="text" name="site_title" class="form-control" placeholder="Enter site_title" value="<?php echo $row['site_title'];?>">
                      </div>
                      <div class="mb-3">
                        <label>Site  URL</label>
                        <input type="text" name="site_url" class="form-control" placeholder="Enter site_url" value="<?php echo $row['site_url'];?>" readonly>
                      </div>
                      <div class="mb-3">
                        <label>Site Description</label>
                        <textarea name="site_desc" class="form-control" rows="4" cols="80"><?php echo $row['site_desc'];?></textarea>
                      </div>
                      <div class="mb-3">
                        <label>Site Keywords</label>
                          <textarea name="site_keyword" class="form-control" rows="4" cols="80"><?php echo $row['site_keyword'];?></textarea>
                      </div>
                      <div class="mb-3">
                        <label>Location</label>
                          <textarea name="location" class="form-control" rows="4" cols="80"><?php echo $row['location'];?></textarea>
                      </div>

                      <div class="mb-3">
                        <label>Country</label>
                          <textarea name="country" class="form-control" rows="4" cols="80"><?php echo $row['country'];?></textarea>
                      </div>

                      <div class="mb-3">
                        <label>Admin Email</label>
                        <input type="email" name="admin_email" class="form-control" placeholder="Enter admin_email" value="<?php echo $row['admin_email'];?>">
                      </div>
                      
                      <!-- <div class="mb-3">
                        <label>Store Link</label>
                        <input type="url" name="store_link" class="form-control" placeholder="Enter store_link" value="<?php echo $row['store_link'];?>">
                      </div>
                      
                      <div class="mb-3">
                        <label>Academy Link</label>
                        <input type="url" name="academy_link" class="form-control" placeholder="Enter academy_link" value="<?php echo $row['academy_link'];?>">
                      </div> -->

                      <div class="mb-3">
                        <label>Favicon</label>
                          <img src="<?php echo $row['site_url'];?>assets/img/core/<?php echo $row['favicon'];?>" class="img-fluid" alt="file" width="50px">
                          <span class='pull-right'><a href="" data-bs-target='#edit_favicon' class='photo' data-bs-toggle='modal' data-id='<?php echo $row['id'];?>'><i class='bx bx-pencil'></i></a></span><br>
                      </div>
                      <!-- <div class="mb-3">
                        <label>Logo1</label>
                          <img src="<?php echo $row['site_url'];?>assets/img/core/<?php echo $row['logo'];?>" class="img-fluid" alt="file" width="50px">
                          <span class='pull-right'><a href="" data-bs-target='#edit_logo1' class='photo' data-bs-toggle='modal' data-id='<?php echo $row['id'];?>'><i class='bx bx-pencil'></i></a></span><br>
                      </div>
                      <div class="mb-3">
                        <label>Logo2</label>
                          <img src="<?php echo $row['site_url'];?>assets/img/core/<?php echo $row['logo_line'];?>" class="img-fluid" alt="file" width="200px">
                          <span class='pull-right'><a href="" data-bs-target='#edit_logo2' class='photo' data-bs-toggle='modal' data-id='<?php echo $row['id'];?>'><i class='bx bx-pencil'></i></a></span><br>
                      </div> -->
                      <div class="mb-3">
                          <label for="color">Theme Color</label>
                          <input type="color" name="color" class="form-control" value="<?php echo $row['theme'];?>" id="color">
                      </div>
                      <button type="submit" name="edit" class="btn btn-primary btn-rounded mr-2 btn-icon-text">
                        <i class="bx bx-save btn-icon-prepend"></i>
                        Save
                      </button>
                    </form>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- / Content -->

          <!-- Footer -->
          <?php include 'includes/footer.php'; ?>
          <?php include 'includes/settings_modal.php'; ?>
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
$(document).on('click', '.edit3', function(e){
  e.preventDefault();
  $('#edit3').modal('show');
  var id = $(this).data('id');
  getRow(id);
});
$(document).on('click', '.edit4', function(e){
  e.preventDefault();
  $('#edit4').modal('show');
  var id = $(this).data('id');
  getRow(id);
});
});
</script>
</body>
</html>
