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
              <span class="text-muted fw-light">Misc / </span> SMS
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
                    <h4 class="card-title">SMS</h4>
                    <p class="card-description">
                      Send SMS to users
                    </p>
                    <!-- <form class="form" action="show-post" method="POST"> -->
                    <form class="form" action="sms-action" method="POST">
                      <div class="mb-3">
                        <label class="form-label">From [Sender Name]</label>
                        <input type="text" name="sender_name" value="SendASAP" class="form-control" placeholder="Enter Sender Name" required>
                      </div>
                      <div class="mb-3">
                        <div class="col-md-12 mb-4">
                          <label for="TagifyUserList" class="form-label">Users List</label>
                          <input id="TagifyUserList" name="TagifyUserList" class="form-control" placeholder="Select users"/>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Enter Subject" required>
                        <small>This won't be sent, it is just for you to know and keep record of what you're sending.</small>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea name="message" placeholder="Enter message to be sent" rows="8" cols="80" class="form-control"></textarea>
                        <small>Kindly note that this service is usually closed from 08:00PM - 06:00AM. Any message sent during these times would appear the next day.</small>
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
                              echo "Balance - <span class='text-success'>".$settings['currency']."".number_format($balance, 2)."</span> <a target='_blank' href='https://www.bulksmsnigeria.com/my-accounts'>Fund <i class='mdi mdi-pencil-box-outline'></i></a>";
                            }
                          }
                         ?>
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
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/tagify/tagify.js"></script>
<script>
<?php include 'includes/forms-tagify1.js'; ?>
</script>
</body>
</html>
