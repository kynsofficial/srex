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
              <span class="text-muted fw-light">Services /</span> Coupons
            </h4>
              <div class="row">
                <div class="col-12">
                  <?php include 'includes/alert.php'; ?>
                </div>
                <div class="col-12 mb-4 mb-md-0">
                  <div class="card">
                    <div class="card-header border-bottom">
                      <h4 class="card-title">List of all Coupon.</h4>
                      <a data-bs-target="#addnew1" href="" data-bs-toggle="modal" class="btn btn-primary btn-sm btn-flat mb-3"><i class="bx bx-plus"></i> New</a>
                    </div>
                    <div class="card-datatable table-responsive text-nowrap">
                      <table class="table border-top" id="example1">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Coupon Code</th>
                            <th>Type</th>
                            <th>Value Type</th>
                            <th>Value</th>
                            <th>Validity</th>
                            <th>Date Uploaded</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                          <?php
                          $conn = $pdo->open();

                          try{
                            $stmt = $conn->prepare("SELECT * FROM coupon WHERE status = 0 ORDER BY id DESC");
                            $stmt->execute();
                            $i = 0;
                            foreach($stmt as $row){
                              if ($row['type'] == 0) {
                                $type = "Shippments";
                              }elseif ($row['type'] == 1) {
                                $type = "Pay Supplier";
                              }

                              $stmt1 = $conn->prepare("SELECT * FROM currency WHERE id = :id");
                              $stmt1->execute(['id'=>$row['currency']]);
                              $currency = $stmt1->fetch();

                              if ($row['value_type'] == 0) {
                                $value_type = "Percentage Off";
                                $value = $row['value']."%"; // "Percentage"
                              }elseif ($row['value_type'] == 1) {
                                $value_type = "Amount Off";
                                $value =  $currency['sign']."".$row['value']; // "Amount"
                              }

                              // $status = ($row['status']) ? '<div class="badge bg-label-success">Successfull</div>' : '<div class="badge bg-label-danger">Cancelled</div>';
                              $i++;
                              echo "
                                <tr>
                                  <td>".$i."</td>
                                  <td class='fw-bold'>".$row['coupon_code']."</td>
                                  <td>".$type."</td>
                                  <td>".$value_type."</td>
                                  <td>".$value."</td>
                                  <td>".$row['validity']."</td>
                                  <td>".date('M d, Y', strtotime($row['upload_date']))."</td>
                                  <td>
                                    <div class='dropdown'>
                                      <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'><i class='bx bx-dots-vertical-rounded'></i></button>
                                      <div class='dropdown-menu'>
                                        <a class='dropdown-item text-info' href='coupon_print?order_id=".$row['coupon_code']."' target='_blank'>
                                          <i class='bx bx-printer me-1'></i> Print
                                        </a>
                                        <a class='dropdown-item edit' data-id='".$row['id']."'>
                                          <i class='bx bx-pencil me-1'></i> Edit
                                        </a>
                                        <a class='dropdown-item delete text-danger' data-id='".$row['id']."'>
                                          <i class='bx bx-trash me-1'></i> Delete
                                        </a>
                                      </div>
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

                <div class="col-12 mb-4 mt-4 mb-md-0">
                  <div class="card">
                    <h4 class="card-header">List of all used Coupon.</h4>
                    <div class="card-datatable table-responsive text-nowrap">
                      <table class="table border-top" id="example2">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Coupon Code</th>
                            <th>Type</th>
                            <th>Value Type</th>
                            <th>Value</th>
                            <th>Used By (User ID)</th>
                            <th>Validity</th>
                            <th>Date of Use</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                          <?php
                          $conn = $pdo->open();

                          try{
                            $stmt = $conn->prepare("SELECT * FROM coupon WHERE status = 1 ORDER BY id DESC");
                            $stmt->execute();
                            $i = 0;
                            foreach($stmt as $row){
                              if ($row['type'] == 0) {
                                $type = "Shippments";
                              }elseif ($row['type'] == 1) {
                                $type = "Pay Supplier";
                              }

                              $stmt1 = $conn->prepare("SELECT * FROM currency WHERE id = :id");
                              $stmt1->execute(['id'=>$row['currency']]);
                              $currency = $stmt1->fetch();

                              if ($row['value_type'] == 0) {
                                $value_type = "Percentage Off";
                                $value = $row['value']."%"; // "Percentage"
                              }elseif ($row['value_type'] == 1) {
                                $value_type = "Amount Off";
                                $value =  $currency['sign']."".$row['value']; // "Amount"
                              }
                              $i++;
                              echo "
                              <tr>
                                <td>".$i."</td>
                                <td class='fw-bold'>".$row['coupon_code']."</td>
                                <td>".$type."</td>
                                <td>".$value_type."</td>
                                <td>".$value."</td>
                                <td><a href='coupon_receipt?order_id=".$row['coupon_code']."' class='btn btn-success btn-sm btn-flat' target='_blank'><i class='mdi mdi-eye'></i> View</a></td>
                                <td>".$row['validity']."</td>
                                <td>".date('M d, Y', strtotime($row['used_date']))."</td>
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
          <?php include 'includes/coupons_modal.php'; ?>
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
<script>
$(function(){

  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit1').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete1').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'coupons_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.userid').val(response.id);
      $('#edit_coupon_code').val(response.coupon_code);
      $('#edit_type').val(response.type);
      $('#edit_value').val(response.value);
      // $('#edit_value_type').val(response.value_type);
      if (response.value_type == 0) {
        var edit_currency_select =  document.getElementById('edit_currency_select');
        edit_currency_select.style.display = "none";
        document.getElementById('edit_currency').required = false;
        document.getElementById('edit_value_typep').checked = true;
      }
      if (response.value_type == 1) {
        var edit_currency_select =  document.getElementById('edit_currency_select');
        edit_currency_select.style.display = "block";
        document.getElementById('edit_value_typea').checked = true;
      }
      $('#edit_currency').val(response.currency);
      $('#edit_validity').val(response.validity);
      $('.fullname').html(response.coupon_code);
    }
  });
}
</script>
</body>
</html>
