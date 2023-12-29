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
              <span class="text-muted fw-light">Settings / Main Settings /</span> Shipping Plans
            </h4>
            <div class="row">
              <div class="col-12">
                <?php include 'includes/alert.php'; ?>
              </div>
            </div>
            <!-- Users List Table -->
            <div class="card mb-4">
              <div class="card-header border-bottom">
                <h4 class="card-title">Shipping Plans</h4>
                <!-- <a data-bs-target="#addnew" href="" data-bs-toggle="modal" class="btn btn-primary btn-sm btn-flat mb-3"><i class="bx bx-plus"></i> New</a> -->
                <!-- <a data-bs-target="#export" href="" data-bs-toggle="modal" class="btn btn-primary btn-sm btn-flat mb-3"><i class="bx bx-upload"></i> Export all as CSV</a> -->
              </div>
              <div class="card-datatable table-responsive text-nowrap">
                <table class="datatables-users table border-top" id="example1">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Title</th>
                      <th>SI Unit</th>
                      <th>Price ($)</th>
                      <th>Info</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php
                    $conn = $pdo->open();
                    try{
                      $stmt = $conn->prepare("SELECT * FROM shipping_plan ORDER BY id");
                      $stmt->execute();
                      $i = 0;
                      foreach($stmt as $row){
                        $i++;
                        echo "
                        <tr>
                          <td>".$row['name']."</td>
                          <td>".$row['type']."</td>
                          <td>".$row['unit']."</td>
                          <td>".$row['si_unit']."</td>
                          <td>".$row['price']."</td>
                          <td>".$row['info']."</td>
                          <td>
                            <div class='dropdown'>
                              <button type='button' class='btn p-0 dropdown-toggle hide-arrow' data-bs-toggle='dropdown'><i class='bx bx-dots-vertical-rounded'></i></button>
                              <div class='dropdown-menu'>
                                <button class='dropdown-item text-warning edit' data-id='".$row['id']."'><i class='bx bx-edit me-1'></i> Edit</btn>
                                <button class='dropdown-item text-danger delete' data-id='".$row['id']."'><i class='bx bx-trash me-1'></i> Delete</btn>
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
          <!-- / Content -->

          <!-- Footer -->
          <?php include 'includes/footer.php'; ?>
          <?php include 'includes/shipping-plans_modal.php'; ?>
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

  // For FAQ category
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'shipping-plans_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.userid').val(response.id);
      $('#name').html(response.name);
      $('#unit').html(response.unit);
      $('#si_unit').html(response.si_unit);
      $('#price').html(response.price);
      $('#info').html(response.info);
      $('#get_name').val(response.name);
      $('#get_unit').val(response.unit);
      $('#get_si_unit').val(response.si_unit);
      $('#get_price').val(response.price);
      $('#get_info').val(response.info);
      $('.fullname').html(response.name);
      // getCategory();
    }
  });
}
</script>
</body>
</html>
