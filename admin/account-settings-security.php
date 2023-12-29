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
              <span class="text-muted fw-light">Account Settings /</span> Security
            </h4>

            <div class="row">
              <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                  <li class="nav-item"><a class="nav-link" href="account-settings"><i class="bx bx-user me-1"></i> Account</a></li>
                  <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-lock-alt me-1"></i> Security</a></li>
                </ul>
                <!-- Change Password -->
                <div class="card mb-4">
                  <h5 class="card-header">Change Password</h5>
                  <div class="card-body">
                    <form id="formAccountSettings" method="POST" action="<?php echo htmlspecialchars('account-settings-security_update'); ?>">
                      <?php include 'includes/alert.php'; ?>
                      <div class="row">
                        <div class="mb-3 col-md-6 form-password-toggle">
                          <label class="form-label" for="currentPassword">Current Password</label>
                          <div class="input-group input-group-merge">
                            <input class="form-control" type="password" name="currentPassword" id="currentPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="mb-3 col-md-6 form-password-toggle">
                          <label class="form-label" for="newPassword">New Password</label>
                          <div class="input-group input-group-merge">
                            <input class="form-control" type="password" id="newPassword" name="newPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                          </div>
                        </div>

                        <div class="mb-3 col-md-6 form-password-toggle">
                          <label class="form-label" for="confirmPassword">Confirm New Password</label>
                          <div class="input-group input-group-merge">
                            <input class="form-control" type="password" name="confirmPassword" id="confirmPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                          </div>
                        </div>
                        <div class="col-12 mb-4">
                          <p class="fw-semibold mt-2">Password Requirements:</p>
                          <ul class="ps-3 mb-0">
                            <li class="mb-1">
                              Minimum 8 characters long - the more, the better
                            </li>
                            <li class="mb-1">At least one lowercase character</li>
                            <li>At least one number, symbol, or whitespace character</li>
                          </ul>
                        </div>
                        <div class="col-12 mt-1">
                          <button type="submit" name="save" value="save" class="btn btn-primary me-2">Save changes</button>
                          <button type="reset" class="btn btn-label-secondary">Reset</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <!--/ Change Password -->
                <!-- Recent Devices -->
                <div class="card mb-4">
                  <h5 class="card-header">Recent Devices</h5>
                  <div class="card-datatable table-responsive text-nowrap">
                    <table class="table border-top" id="example1">
                      <thead>
                        <tr>
                          <th class="text-truncate">Browser</th>
                          <th class="text-truncate">Device</th>
                          <th class="text-truncate">IP</th>
                          <th class="text-truncate">Recent Activities</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php
                        $conn = $pdo->open();

                        try{
                          $stmt = $conn->prepare
                          ("SELECT * FROM userslog WHERE userid=:userid ORDER BY id DESC");
                          $stmt->execute(['userid'=>$admin['id']]);
                          $i = 0;
                          foreach($stmt as $row){
                            // if ($row['type'] == 'Bank Transfer') {
                            //   $link = 'transaction_banktransfer';
                            // }
                            // echo "<pre>";
                            // print_r(explode(" ", $row['deviceinfo'], 2));
                            // echo "</pre>";
                            $isMob = is_numeric(strpos(strtolower($row['deviceinfo']), "mobile"));
                            $isTab = is_numeric(strpos(strtolower($row['deviceinfo']), "tablet"));

                            $isWin = is_numeric(strpos(strtolower($row['deviceinfo']), "windows"));
                            $isAndroid = is_numeric(strpos(strtolower($row['deviceinfo']), "android"));
                            $isIphone = is_numeric(strpos(strtolower($row['deviceinfo']), "iphone"));
                            $isIpad = is_numeric(strpos(strtolower($row['deviceinfo']), "ipad"));

                            $isIos = $isIphone || $isIpad;

                            if ($isMob) {
                              if ($isTab) {
                                $device = "Tablet";
                              }else {
                                $device = "Mobile";
                              }
                            }else {
                              $device = "Desktop";
                            }

                            if ($isIos) {
                              $platform = "bxl-apple";
                            }elseif ($isAndroid) {
                              $platform = "bxl-android text-success";
                            }elseif ($isWin) {
                              $platform = "bxl-windows text-info";
                            }

                            $i++;
                            echo "
                              <tr>
                                <td class='text-truncate'><i class='bx ".$platform." me-3'></i> <span class='fw-semibold'>Logged in on ".$device."</span></td>
                                <td class='text-truncate'>".$device."</td>
                                <td class='text-truncate'>".$row['userip']."</td>
                                <td class='text-truncate'>".date('d, M Y h:i a', strtotime($row['loginTime']))."</td>
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
                <!--/ Recent Devices -->
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
