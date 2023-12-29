<?php include 'includes/head.php'; ?>
<link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/vendor/libs/tagify/tagify.css" />
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
              <span class="text-muted fw-light">Misc / </span> Emails
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
                    <h4 class="card-title">Emails</h4>
                    <p class="card-description">
                      Send email to users
                    </p>
                    <!-- <form class="form" action="show-post" method="POST"> -->
                    <form class="form" action="email-action" method="POST">
                      <div class="mb-3">
                        <label class="form-label">From [Sender Name]</label>
                        <input type="text" name="sender_name" value="<?php echo $settings['site_name']; ?>" class="form-control" placeholder="Enter Sender Name" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">From Email [Sender Email]</label>
                        <input type="email" name="sender_email" class="form-control" placeholder="Enter Sender Email" value="<?php echo $admin['email']; ?>" required>
                        <small>This would also be the email they can reply to.</small>
                      </div>
                      <div class="mb-3">
                        <div class="col-md-12 mb-4">
                          <label for="TagifyUserList" class="form-label">Users List</label>
                          <input id="TagifyUserList" name="TagifyUserList" class="form-control" placeholder="Select users"/>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Enter Subject of Email" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea id="tinyMceExample" name="message" placeholder="Textarea" class="form-control">
                        <?php echo $settings['email_sample']; ?>
                        </textarea>
                      </div>

                      <button type="submit" name="send" class="btn btn-primary btn-rounded btn-icon-text mb-4 mt-4">
                        <i class="bx bx-send"></i>
                        Send
                      </button>
                    </form>
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
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/tinymce/tinymce.min.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/js/editor-demo.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/tagify/tagify.js"></script>
<script>
<?php include 'includes/forms-tagify.js'; ?>
</script>
</body>
</html>
