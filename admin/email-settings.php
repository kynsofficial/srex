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
              <span class="text-muted fw-light">Settings / Main Settings /</span> Email Settings
            </h4>
            <div class="row">
              <div class="col-12">
                <?php include 'includes/alert.php'; ?>
              </div>
              <div class="col-md-12 col-lg-12 mb-4">
                <div class="card">
                  <div class="d-flex align-items-end row">
                    <div class="col-12">
                      <div class="card-body">
                        <h4 class="card-title"><?php echo $settings['site_name']; ?> Email Settings</h4>
                        <p class="card-description">
                          <?php echo $settings['site_name']; ?> Email Settings
                        </p>
                        <?php
                        $result = $conn->prepare("SELECT * FROM email_settings WHERE id = 1");
                        $result->execute();
                        for($i=0; $row = $result->fetch(); $i++){
                        ?>
                        <form class="form" action="email-settings_edit" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="id" value="1">
                          <div class="mb-3">
                            <label>Host</label>
                              <input type="text" name="stmphost" class="form-control" placeholder="Enter Host" value="<?php echo $row['stmphost'];?>">
                          </div>
                          <div class="mb-3">
                            <label>Username</label>
                              <input type="text" name="stmpuser" class="form-control" placeholder="Enter User" value="<?php echo $row['stmpuser'];?>">
                          </div>
                          <div class="mb-3">
                            <label>Password</label>
                              <input type="password" name="password" class="form-control" placeholder="Enter Password" value="<?php echo $row['password'];?>">
                          </div>
                          <div class="mb-3">
                            <label>Port No.</label>
                              <input type="text" name="portno" class="form-control" placeholder="Enter Port No" value="<?php echo $row['portno'];?>">
                          </div>
                          <div class="mb-3">
                            <label>Set From</label>
                              <input type="email" name="from_email" class="form-control" placeholder="Enter From Email" value="<?php echo $row['from_email'];?>">
                          </div>
                          <div class="mb-3">
                            <label>Set Reply To</label>
                              <input type="email" name="replyto" class="form-control" placeholder="Enter Reply To Email" value="<?php echo $row['replyto'];?>">
                          </div>
                          <button type="submit" name="edit" class="btn btn-primary btn-rounded mr-2 btn-icon-text">
                            <i class="bx bx-save btn-icon-prepend"></i>
                            Save
                          </button>

                          <a href="" data-bs-target="#emailsend" data-bs-toggle="modal" class="btn btn-warning btn-rounded float-end"><b><i class="bx bx-send"></i> Send Test Email</b></a>

                        </form>
                        <?php } ?>
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
          <div class="modal fade" id="emailsend">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title"><b>Send Test Email</b></h4>
                  <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="email_send">
                      <div class="form-group">
                          <label for="edit_name" class="col-sm-3 control-label">Email</label>
                          <input type="email" name="email" class="form-control" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default btn-rounded pull-left" data-bs-dismiss="modal"><i class="bx bx-x"></i> Close</button>
                      <button type="submit" class="btn btn-warning btn-rounded" name="send"><i class="bx bx-send"></i> Send</button>
                    </form>
                  </div>
              </div>
            </div>
          </div>
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
