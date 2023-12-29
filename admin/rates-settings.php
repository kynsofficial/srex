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
              <span class="text-muted fw-light">Settings / Main Settings /</span> Rates Settings
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
                        <h4 class="card-title"><?php echo $settings['site_name']; ?> Rates Settings</h4>
                        <p class="card-description">
                          <?php echo $settings['site_name']; ?> Rates Settings
                        </p>
                        <?php
                        $result = $conn->prepare("SELECT * FROM rates WHERE id = 1");
                        $result->execute();

                        $result1 = $conn->prepare("SELECT * FROM currency WHERE id = 1");
                        $result1->execute();
                        $dollar = $result1->fetch();

                        $result2 = $conn->prepare("SELECT * FROM currency WHERE id = 2");
                        $result2->execute();
                        $yuan = $result2->fetch();

                        for($i=0; $row = $result->fetch(); $i++){
                        ?>
                        <form class="forms-sample" action="rates-settings_edit" method="post">
                          <input type="hidden" name="id" value="1">
                          <h4>Currency Conversion Rates</h4>
                          <div class="mb-3">
                            <label>Naira to Dollar Rate (<b><?php echo $settings['currency']; ?>1 ~ <?php echo $dollar['sign']; echo $row['naira_dollar_rate']; ?></b>)</label>
                              <input type="number" step="0.01" name="naira_dollar_rate" class="form-control" placeholder="Enter Naira to Dollar Rate (<?php echo $settings['currency']; ?> ~ <?php echo $dollar['sign']; ?>)" value="<?php echo $row['naira_dollar_rate']; ?>">
                          </div>
                          <div class="mb-3">
                            <label>Naira to Yuan Rate (<b><?php echo $settings['currency']; ?>1 ~ <?php echo $yuan['sign']; echo $row['naira_yuan_rate']; ?></b>)</label>
                              <input type="number" step="0.01" name="naira_yuan_rate" class="form-control" placeholder="Enter Naira to Yuan Rate (<?php echo $settings['currency']; ?> ~ <?php echo $yuan['sign']; ?>)" value="<?php echo $row['naira_yuan_rate']; ?>">
                          </div>
                          <div class="mb-3">
                            <label>Dollar to Naira Rate (<b><?php echo $dollar['sign']; ?>1 ~ <?php echo $settings['currency']; echo $row['dollar_naira_rate']; ?></b>)</label>
                              <input type="number" step="0.01" name="dollar_naira_rate" class="form-control" placeholder="Enter Dollar to Naira Rate (<?php echo $dollar['sign']; ?> ~ <?php echo $settings['currency']; ?>)" value="<?php echo $row['dollar_naira_rate']; ?>">
                          </div>
                          <div class="mb-3">
                            <label>Dollar to Yuan Rate (<b><?php echo $dollar['sign']; ?>1 ~ <?php echo $yuan['sign']; echo $row['dollar_yuan_rate']; ?></b>)</label>
                              <input type="number" step="0.01" name="dollar_yuan_rate" class="form-control" placeholder="Enter Dollar to Yuan Rate (<?php echo $dollar['sign']; ?> ~ <?php echo $yuan['sign']; ?>)" value="<?php echo $row['dollar_yuan_rate']; ?>">
                          </div>
                          <div class="mb-3">
                            <label>Yuan to Naira Rate (<b><?php echo $yuan['sign']; ?>1 ~ <?php echo $settings['currency']; echo $row['yuan_naira_rate']; ?></b>)</label>
                              <input type="number" step="0.01" name="yuan_naira_rate" class="form-control" placeholder="Enter Yuan to Naira Rate (<?php echo $yuan['sign']; ?> ~ <?php echo $settings['currency']; ?>)" value="<?php echo $row['yuan_naira_rate']; ?>">
                          </div>
                          <div class="mb-3">
                            <label>Yuan to Dollar Rate (<b><?php echo $yuan['sign']; ?>1 ~ <?php echo $dollar['sign']; echo $row['yuan_dollar_rate']; ?></b>)</label>
                              <input type="number" step="0.01" name="yuan_dollar_rate" class="form-control" placeholder="Enter Yuan to Dollar Rate (<?php echo $yuan['sign']; ?> ~ <?php echo $dollar['sign']; ?>)" value="<?php echo $row['yuan_dollar_rate']; ?>">
                          </div>
                          <h4>Pay Supplier Settings</h4>
                          <div class="mb-3">
                            <label>Pay Supplier Rate (<?php echo $row['suppling_rate']; ?>% of total order)</label>
                              <input type="number" step="0.01" name="suppling_rate" class="form-control" min="0" max="100" placeholder="Enter Pay Supplier Rate (%)" value="<?php echo $row['suppling_rate']; ?>">
                          </div>
                          <div class="mb-3">
                            <label>Pay Supplier Min Amount (<?php echo $settings['currency']; ?><?php echo $row['suppling_min']; ?>)</label>
                              <input type="number" step="0.01" name="suppling_min" class="form-control" placeholder="Enter Pay Supplier Min Amount (<?php echo $settings['currency']; ?>)" value="<?php echo $row['suppling_min']; ?>">
                          </div>
                          <h4>Ordering Settings</h4>
                          <div class="mb-3">
                            <label>Ordering Rate (<?php echo $row['order_rate']; ?>% of total order)</label>
                              <input type="number" step="0.01" name="order_rate" class="form-control" min="0" max="100" placeholder="Enter Ordering Rate (%)" value="<?php echo $row['order_rate']; ?>">
                          </div>
                          <div class="mb-3">
                            <label>Ordering Min Amount (<?php echo $settings['currency']; echo $row['order_min']; ?>)</label>
                              <input type="number" step="0.01" name="order_min" class="form-control" placeholder="Enter Ordering Min Amount (<?php echo $settings['currency']; ?>)" value="<?php echo $row['order_min']; ?>">
                          </div>
                          <div class="mb-3">
                            <label>Commitment Fee (<?php echo $settings['currency']; echo $row['commitment_fee']; ?>)</label>
                              <input type="number" step="0.01" name="commitment_fee" class="form-control" placeholder="Enter Commitment Fee (<?php echo $settings['currency']; ?>)" value="<?php echo $row['commitment_fee']; ?>">
                          </div>
                          <h4>Shipping Settings</h4>
                          <div class="mb-3">
                            <label>Domestic Transportation Cost (<?php echo $dollar['sign']; echo $row['domestic_transportation_cost']; ?>)</label>
                              <input type="number" step="0.01" name="domestic_transportation_cost" class="form-control" placeholder="Enter Ordering Rate (<?php echo $dollar['sign']; ?>)" value="<?php echo $row['domestic_transportation_cost']; ?>">
                          </div>
                          <div class="mb-3">
                            <label>International Transportation Cost (<?php echo $dollar['sign']; echo $row['international_transportation_cost']; ?>)</label>
                              <input type="number" step="0.01" name="international_transportation_cost" class="form-control" placeholder="Enter International Transportation Cost (<?php echo $settings['currency']; ?>)" value="<?php echo $row['international_transportation_cost']; ?>">
                          </div>
                          <div class="mb-3">
                            <label>Value Added Tax [VAT] (<?php echo $row['vat']; ?>% VAT)</label>
                              <input type="number" step="0.01" name="vat" class="form-control" placeholder="Value Added Tax [VAT] (%)" value="<?php echo $row['vat']; ?>">
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
