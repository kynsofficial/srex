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
                <span class="text-muted fw-light">Admin Profile /</span> Profile
              </h4>


              <!-- Header -->
              <div class="row">
                <div class="col-12">
                  <div class="card mb-4">
                    <div class="user-profile-header-banner">
                      <img src="<?php echo $settings['site_url']; ?>assets/img/pages/profile-banner.gif" alt="Banner image" class="rounded-top">
                    </div>
                    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                      <?php
                        if ($admin['photo'] == "") {
                          echo '
                            <div class="flex-shrink-0 mt-n2">
                              <div class="avatar avatar-xl avatar-online me-2 d-block ms-0 ms-sm-4">
                                <span class="avatar-initial rounded-circle bg-label-success">'.$admin['username'][0].'</span>
                              </div>
                            </div>
                          ';
                        }
                        else{
                          echo '
                            <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                              <img src="'.$settings['site_url'].'assets/img/avatars/'.$admin['photo'].'" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                            </div>
                          ';
                        }
                      ?>
                      <div class="flex-grow-1 mt-3 mt-sm-5">
                        <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                          <div class="user-profile-info">
                            <?php
                              echo "<h4>".$admin['firstname']." ".$admin['lastname']."</h4>";
                            ?>
                            <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                              <li class="list-inline-item fw-semibold">
                                <i class='bx bx-user'></i> <?php echo $admin['username']; ?>
                              </li>
                              <li class="list-inline-item fw-semibold">
                                <i class='bx bx-calendar'></i> Joined <?php echo date('M Y', strtotime($admin['date_created'])); ?>
                              </li>
                              <li class="list-inline-item fw-semibold">
                                <a href="account-settings" class="text-muted"><i class='bx bx-pencil'></i> Edit Profile</a>
                              </li>
                            </ul>
                          </div>
                          <?php
                            echo '
                              <a href="javascript:void(0)" class="btn btn-success text-nowrap">
                                <i class="bx bx-user-check"></i> Verified
                              </a>
                            ';
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Header -->

              <!-- Navbar pills -->
              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-sm-row mb-4">
                    <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class='bx bx-user'></i> Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="account-settings"><i class='bx bx-pencil'></i> Edit Profile</a></li>
                  </ul>
                </div>
              </div>
              <!--/ Navbar pills -->

              <!-- User Profile Content -->
              <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6">
                  <!-- About User -->
                  <div class="card mb-4">
                    <div class="card-body">
                      <small class="text-muted text-uppercase">About</small>
                      <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3"><i class="bx bx-user"></i><span class="fw-semibold mx-2">Full Name:</span> <span><?php echo $admin['firstname']; ?> <?php echo $admin['lastname']; ?></span></li>
                        <li class="d-flex align-items-center mb-3"><i class='bx bx-male-female'></i></i><span class="fw-semibold mx-2">Gender:</span> <span><?php echo $admin['gender']; ?></span></li>
                        <li class="d-flex align-items-center mb-3"><i class="bx bx-check"></i><span class="fw-semibold mx-2">Status:</span> <span><?php
                          if ($admin['status'] == 1) {
                            echo '
                              <span class="text-success"><i class="bx bx-user-check"></i> Verified</span>
                            ';
                          }
                          elseif ($admin['status'] == 2) {
                            echo '
                              <span class="text-warning"><i class="bx bx-user-x"></i> Deactivated</span>
                            ';
                          }
                          else{
                            echo '
                              <span class="text-danger"><i class="bx bx-user-x"></i> Unverified</span>
                            ';
                          }
                        ?></span></li>
                      </ul>
                      <small class="text-muted text-uppercase">Contacts</small>
                      <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3"><i class="bx bx-phone"></i><span class="fw-semibold mx-2">Contact:</span> <span><?php echo $admin['contact_info']; ?></span></li>
                        <li class="d-flex align-items-center mb-3"><i class="bx bx-envelope"></i><span class="fw-semibold mx-2">Email:</span> <span><?php echo $admin['email']; ?></span></li>
                        <li class="d-flex align-items-center mb-3"><i class="bx bx-map-pin"></i><span class="fw-semibold mx-2">Address:</span> <span><?php echo $admin['address']; ?></span></li>
                      </ul>
                    </div>
                  </div>
                  <!--/ About User -->
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6">
                  <!-- About User -->
                  <div class="card mb-4">
                    <div class="card-body">
                      <small class="text-muted text-uppercase">Bank Account Details</small>
                      <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3"><i class="bx bxs-bank"></i><span class="fw-semibold mx-2">Bank Name:</span> <span><?php echo $admin['main_bank_name']; ?></span></li>
                        <li class="d-flex align-items-center mb-3"><i class="bx bxs-receipt"></i><span class="fw-semibold mx-2">Account Number:</span> <span><?php echo $admin['main_account_number']; ?></span></li>
                        <li class="d-flex align-items-center mb-3"><i class="bx bxs-user"></i><span class="fw-semibold mx-2">Account Name:</span> <span><?php echo $admin['name_on_account']; ?></span></li>
                        <li class="d-flex align-items-center mb-3"><i class="bx bx-receipt"></i><span class="fw-semibold mx-2">Short Code:</span> <span><?php echo $admin['short_code']; ?></span></li>
                      </ul>
                    </div>
                  </div>
                  <!--/ About User -->
                </div>
                <!--/ User Profile Content -->
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
