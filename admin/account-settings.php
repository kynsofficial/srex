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
              <span class="text-muted fw-light">Account Settings /</span> Account
            </h4>

            <div class="row">
              <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                  <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a></li>
                  <li class="nav-item"><a class="nav-link" href="account-settings-security"><i class="bx bx-lock-alt me-1"></i> Security</a></li>
                </ul>
                <div class="card mb-4">
                  <h5 class="card-header">Profile Details</h5>
                  <!-- Account -->
                  <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                      <?php
                        if ($admin['photo'] == "") {
                          echo '
                            <div class="avatar avatar-xl avatar-online me-2 d-block ms-0 ms-sm-4">
                              <span class="avatar-initial rounded-circle bg-label-'.$colors[array_rand($colors)].'">'.$admin['username'][0].'</span>
                            </div>
                          ';
                        }
                        else{
                          echo '
                            <img src="'.$settings['site_url'].'assets/img/avatars/'.$admin['photo'].'" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                          ';
                        }
                      ?>

                      <div class="button-wrapper">
                        <form action="<?php echo htmlspecialchars('account-settings_photo'); ?>" method="POST" enctype="multipart/form-data">
                          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-sm-block">Upload new photo</span>
                            <!-- <i class="bx bx-upload d-block d-sm-none"></i> -->
                            <input type="file" name="photo" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" required />
                          </label>
                          <button type="submit" name="save" value="save" class="btn btn-label-secondary account-image-reset mb-4">
                            <span class="d-sm-block">Save</span>
                            <!-- <i class="bx bx-save d-block d-sm-none"></i> -->
                          </button>
                        </form>

                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800KB</p>
                      </div>
                    </div>
                  </div>
                  <hr class="my-0">
                  <div class="card-body">
                    <form id="formAccountSettings" method="POST" action="<?php echo htmlspecialchars('account-settings_update'); ?>" onsubmit="return true">
                      <?php include 'includes/alert.php'; ?>
                      <div class="row">
                        <div class="mb-3 col-md-6">
                          <label for="firstName" class="form-label">First Name</label>
                          <input class="form-control" type="text" id="firstName" name="firstname" value="<?php echo $admin['firstname']; ?>" required />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="lastName" class="form-label">Last Name</label>
                          <input class="form-control" type="text" name="lastname" id="lastName" value="<?php echo $admin['lastname']; ?>" required />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="email" class="form-label">E-mail</label>
                          <input class="form-control" type="text" id="email" name="email" value="<?php echo $admin['email']; ?>" placeholder="john.doe@example.com" readonly required />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label" for="phoneNumber">Phone Number</label>
                          <input type="text" id="phoneNumber" name="contact_info" class="form-control" value="<?php echo $admin['contact_info']; ?>" placeholder="202 555 0111" required />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label">Gender</label>
                          <div class="col mt-2">
                            <div class="form-check form-check-inline">
                              <input name="gender" class="form-check-input" type="radio" value="Male" id="gender-male" <?php if ($admin['gender'] == "Male") { echo 'checked'; } ?> required />
                              <label class="form-check-label" for="gender-male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input name="gender" class="form-check-input" type="radio" value="Female" id="gender-female" <?php if ($admin['gender'] == "Female") { echo 'checked'; } ?> required />
                              <label class="form-check-label" for="gender-female">Female</label>
                            </div>
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="address" class="form-label">Address</label>
                          <input type="text" class="form-control" id="address" name="address" value="<?php echo $admin['address']; ?>" placeholder="Address" required />
                        </div>
                      </div>
                      <div class="mt-2">
                        <button type="submit" name="save" value="save" class="btn btn-primary me-2">Save changes</button>
                        <button type="reset" class="btn btn-label-secondary">Reset</button>
                      </div>
                    </form>
                  </div>
                  <!-- /Account -->
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
</body>
</html>
