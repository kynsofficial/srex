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
              <span class="text-muted fw-light">Settings / Main Settings /</span> API Settings
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
                        <h4 class="card-title"><?php echo $settings['site_name']; ?> API Keys Settings</h4>
                        <p class="card-description">
                          <?php echo $settings['site_name']; ?> API Keys Settings
                        </p>
                        <?php
                        $result = $conn->prepare("SELECT * FROM settings WHERE id = 1");
                        $result->execute();
                        for($i=0; $row = $result->fetch(); $i++){
                        ?>
                        <form class="forms-sample"  action="settings_edit2" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="id" value="1">
                          <h2>SMS API <small style="font-size:20px;">from <a href="#" onclick="window.open('https://www.bulksmsnigeria.com/my-accounts','popUpWindow','height=900,width=900,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">BulksmsNigeria</a> </small></h2>
                          <div class="mb-3">
                            <label>Sender ID</label>
                              <input type="text" name="text_api_sender_id" class="form-control" placeholder="Enter Sending ID" required value="<?php echo $row['text_api_sender_id'];?>">
                          </div>
                          <div class="mb-3">
                            <label>API Key</label>
                              <input type="text" name="text_api_key" class="form-control" placeholder="Enter API Key" required value="<?php echo $row['text_api_key'];?>">
                          </div>
                          <div class="mb-3">
                            <label>DND Mode</label>
                              <input type="number" name="text_api_dnd" class="form-control" placeholder="Enter API DND Mode" required value="<?php echo $row['text_api_dnd'];?>">
                          </div>
                          <div class="m-3">
                            <?php
                            $curl = curl_init();
                            curl_setopt_array($curl, array(
                                CURLOPT_URL => "https://www.bulksmsnigeria.com/api/v2/balance/get?api_token={$settings['text_api_key']}",
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => "",
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => "GET",
                              ));
                              $response = curl_exec($curl);
                              curl_close($curl);
                              $res = json_decode($response);

                              if($res->data->status)
                              {
                                $code = $res->data->status;
                                $balance = $res->balance->total_balance;
                                if ($code == 'success') {
                                  echo "API Status - <span class='badge bg-label-success'>Success</span> <br>";
                                  echo "Balance - <span class='text-success'>".$settings['currency']."$balance</span> <a target='_blank' href='https://www.bulksmsnigeria.com/my-accounts'>Fund <i class='mdi mdi-pencil-box-outline'></i></a>";
                                }
                              }
                             ?>
                          </div>
                          <h2>Flutterwave API <small style="font-size:20px;">from <a href="#" onclick="window.open('https://flutterwave.com/','popUpWindow','height=900,width=900,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Flutterwave</a> </small></h2>
                          <div class="mb-3">
                            <label>Public Key</label>
                              <input type="text" name="public_key" class="form-control" placeholder="Enter Sending ID" required value="<?php echo $row['public_key'];?>">
                          </div>
                          <div class="mb-3">
                            <label>Secret Key</label>
                              <input type="text" name="secret_key" class="form-control" placeholder="Enter API Key" required value="<?php echo $row['secret_key'];?>">
                          </div>
                          <h2>Google Signin API <small style="font-size:20px;">from <a href="#" onclick="window.open('https://console.cloud.google.com/','popUpWindow','height=900,width=900,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">Google Console</a> </small></h2>
                          <div class="mb-3">
                            <label>Client ID</label>
                              <input type="text" name="client_id" class="form-control" placeholder="Enter Sending ID" required value="<?php echo $row['client_id'];?>">
                          </div>
                          <div class="mb-3">
                            <label>Client Secret</label>
                              <input type="text" name="client_secret" class="form-control" placeholder="Enter API Key" required value="<?php echo $row['client_secret'];?>">
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
