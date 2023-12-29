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
            <span class="text-muted fw-light">User Profile /</span> Profile
          </h4>
          <!-- Header -->
          <div class="row">
            <div class="col-12">
              <div class="card mb-4">
                <div class="user-profile-header-banner">
                  <img src="<?php echo $settings['site_url']; ?>assets/img/pages/profile-banner.png" alt="Banner image" class="rounded-top">
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
                        if ($admin['firstname'] == "" OR $admin['lastname'] == "") {
                          echo "<h4 class='text-danger'>Update your profile</h4>";
                        }
                        else{
                          echo "<h4>".$admin['firstname']." ".$admin['lastname']."</h4>";
                        }
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
                      if ($admin['status'] == 1) {
                        echo '
                        <a href="javascript:void(0)" class="btn btn-success text-nowrap">
                        <i class="bx bx-user-check"></i> Verified
                        </a>
                        ';
                      }
                      elseif ($admin['status'] == 2) {
                        echo '
                        <a href="javascript:void(0)" class="btn btn-warning text-nowrap">
                        <i class="bx bx-user-x"></i> Deactivated
                        </a>
                        ';
                      }
                      else{
                        echo '
                        <a href="javascript:void(0)" class="btn btn-danger text-nowrap">
                        <i class="bx bx-user-x"></i> Unverified
                        </a>
                        ';
                      }
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
                <li class="nav-item"><a class="nav-link" href="profile"><i class='bx bx-user'></i> Profile</a></li>
                <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class='bx bx-grid-alt'></i> Orders</a></li>
              </ul>
            </div>
          </div>
          <!--/ Navbar pills -->

          <!-- Project Cards -->
          <div class="row g-4">
            <div class="col-xl-4 col-lg-6 col-md-6">
              <div class="card">
                <div class="card-header">
                  <div class="d-flex align-items-start">
                    <div class="d-flex align-items-start">
                      <div class="avatar me-3">
                        <img src="../assets/img/icons/brands/social-label.png" alt="Avatar" class="rounded-circle" />
                      </div>
                      <div class="me-2">
                        <h5 class="mb-1"><a href="javascript:;" class="h5 stretched-link">Social Banners</a></h5>
                        <div class="client-info d-flex align-items-center">
                          <h6 class="mb-0 me-1">Client:</h6><span>Christian Jimenez</span>
                        </div>
                      </div>
                    </div>
                    <div class="ms-auto">
                      <div class="dropdown zindex-2">
                        <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                        <ul class="dropdown-menu dropdown-menu-end">
                          <li><a class="dropdown-item" href="javascript:void(0);">Rename project</a></li>
                          <li><a class="dropdown-item" href="javascript:void(0);">View details</a></li>
                          <li><a class="dropdown-item" href="javascript:void(0);">Add to favorites</a></li>
                          <li>
                            <hr class="dropdown-divider">
                          </li>
                          <li><a class="dropdown-item text-danger" href="javascript:void(0);">Leave Project</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="d-flex align-items-center flex-wrap">
                    <div class="bg-lighter p-2 rounded me-auto mb-3">
                      <h6 class="mb-1">$24.8k <span class="text-body fw-normal">/ $18.2k</span></h6>
                      <span>Total Budget</span>
                    </div>
                    <div class="text-end mb-3">
                      <h6 class="mb-1">Start Date: <span class="text-body fw-normal">14/2/21</span></h6>
                      <h6 class="mb-1">Deadline: <span class="text-body fw-normal">28/2/22</span></h6>
                    </div>
                  </div>
                  <p class="mb-0">We are Consulting, Software Development and Web Development Services.</p>
                </div>
                <div class="card-body border-top">
                  <div class="d-flex align-items-center mb-3">
                    <h6 class="mb-1">All Hours: <span class="text-body fw-normal">380/244</span></h6>
                    <span class="badge bg-label-success ms-auto">28 Days left</span>
                  </div>
                  <div class="d-flex justify-content-between align-items-center mb-1">
                    <small>Task: 290/344</small>
                    <small>95% Completed</small>
                  </div>
                  <div class="progress mb-3" style="height: 8px;">
                    <div class="progress-bar" role="progressbar" style="width: 95%;" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center">
                      <ul class="list-unstyled d-flex align-items-center avatar-group mb-0 zindex-2">
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Vinnie Mostowy" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="../assets/img/avatars/5.png" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Allen Rieske" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="../assets/img/avatars/12.png" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Julee Rossignol" class="avatar avatar-sm pull-up me-2">
                          <img class="rounded-circle" src="../assets/img/avatars/6.png" alt="Avatar">
                        </li>
                        <li><small class="text-muted">280 Members</small></li>
                      </ul>
                    </div>
                    <div class="ms-auto">
                      <a href="javascript:void(0);" class="text-body"><i class="bx bx-purchase-tag-alt"></i> 15</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--/ Project Cards -->

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
