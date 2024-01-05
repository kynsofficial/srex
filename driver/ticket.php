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
              <span class="text-muted fw-light">Misc /</span> Ticket
            </h4>

              <div class="row">
                <div class="col-12">
                  <?php include 'includes/alert.php'; ?>
                </div>
                <div class="col-12 mb-4 mb-md-0">
                  <div class="card">
                    <h4 class="card-header">Tickets List</h4>
                    <div class="card-datatable table-responsive text-nowrap">
                      <table class="table border-top" id="example1">
                        <thead>
                          <tr>
                            <th>Info</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                          <?php
                          $conn = $pdo->open();

                          try{
                            $stmt = $conn->prepare("SELECT * FROM tbl_tickets AS BaseTbl LEFT JOIN users AS User ON User.id = BaseTbl.userId ORDER BY BaseTbl.id DESC");
                            $stmt->execute();
                            $i = 0;
                            foreach($stmt as $row){
                              $stmt = $conn->prepare("SELECT * FROM users WHERE id = :asignedto");
                              $stmt->execute(['asignedto' => $row['assignedTo']]);
                              $userd = $stmt->fetch();

                              if ($row['resolved'] == 0) {
                                $status = '<div class="badge bg-warning">Pending</div>';

                                if ($row['priority'] == 'low') {
                                  $priority = '<div class="badge bg-primary">Low</div>';
                                }
                                if ($row['priority'] == 'high') {
                                  $priority = '<div class="badge bg-danger">High</div>';
                                }
                                if ($row['priority'] == 'medium') {
                                  $priority = '<div class="badge bg-warning">Medium</div>';
                                }
                              }
                              if ($row['resolved'] == 1) {
                                $status = '<div class="badge bg-success">Resolved</div>';
                                $priority = '';
                              }
                              $i++;
                              echo "
                                <tr>
                                  <td class='m-2'>
                                  <a href='ticket-view?ticket_id=".$row['ticket_id']."' class='text-dark'>
                                    <div class='mb-0'>
                                      <span class='h5 m-2'>".$row['username']."</span> | <span class='text-secondary m-2'>".$row['email']."</span><br><br>
                                      <span class='text-secondary m-2'>Subject: </span> <span class='h5 ml-2'>".$row['subject']."</span>
                                    </div>
                                  </a>
                                  </td>
                                  <td class='m-2'>
                                    <div class='m-2'>
                                      ".$status."
                                      ".$priority."
                                      <span class='badge bg-primary'>Assigned to: ".$userd['username']."</span><br>
                                      <span class='h6 float-right m-2'>".date('d M, Y - h:i a', strtotime($row['createdDtm']))."</span>
                                    </div>
                                  </td>
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
