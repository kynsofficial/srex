<?php include 'includes/head.php'; ?>
<?php
$conn = $pdo->open();

$slug = $_GET['id'];
$i = $_GET['i'];

try{

  $stmt = $conn->prepare("SELECT * FROM products WHERE ref_id = :slug AND id = :id");
  $stmt->execute(['slug' => $slug, 'id'=>$i]);
  $producs = $stmt->fetch();

  $stmt = $conn->prepare("SELECT * FROM orders WHERE ref_id = :slug");
  $stmt->execute(['slug' => $slug]);
  $order = $stmt->fetch();

  $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
  $stmt->execute(['id' => $order['userid']]);
  $user = $stmt->fetch();

  if ($producs != TRUE) {
    // echo "Not Valid";
    // header('location: 404');
    echo "<script>window.location.assign('404')</script>";
  }

}
catch(PDOException $e){
  echo "There is some problem in connection: " . $e->getMessage();
}

?>
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
              <span class="text-muted fw-light">Services / Shippments /</span> Edit Products
            </h4>

              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">

                      <div class="row mb-0">
                        <div class="col-8">
                          <h5 class="card-title"><?php echo $order['orders_name']; ?></h5>
                          <p>Order ID - <b><?php echo $producs['ref_id']; ?></b></p>
                        </div>
                        <div class="col-4">
                          <div class="text-end">
                            <a href="order-details?id=<?php echo $producs['ref_id']; ?>" class="btn btn-outline-dark btn-sm mb-2 mr-5">
                              <i class="bx bx-show"></i>
                              <span class="ml-1">View Order</span>
                            </a>
                          </div>
                        </div>
                      </div>

                      <hr class="my-3">
                      <form method="POST" action="<?php echo htmlspecialchars('order-edit-products_update'); ?>" onsubmit="return true">
                        <?php include 'includes/alert.php'; ?>
                        <input type="hidden" name="ref_id" value="<?php echo $producs['ref_id']; ?>">
                        <input type="hidden" name="id" value="<?php echo $producs['id']; ?>">
                        <input type="hidden" name="userid" value="<?php echo $user['id']; ?>">
                        <div class="row">
                          <div class="mb-3 col-md-12">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Enter the Product Name" value="<?php echo $producs['product_name']; ?>" required>
                          </div>
                          <div class="mb-3 col-md-12">
                            <label for="product_link" class="form-label">Product Link</label>
                            <input type="url" name="link" id="product_link" class="form-control" placeholder="Enter the Product Link" value="<?php echo $producs['product_link']; ?>" required>
                          </div>
                          <div class="mb-3 col-md-12">
                            <label for="product_category" class="form-label">Product Category</label>
                            <select id="product_category" name="product_category" class="form-select" onchange="productCategory()" required>
                              <option value=""> - Select - </option>
                              <?php
                                $conn = $pdo->open();
                                try{
                                  $stmt = $conn->prepare("SELECT * FROM product_category");
                                  $stmt->execute();
                                  foreach($stmt as $row){
                                    echo "
                                    <option value='".$row['slug']."' info='".$row['info']."'"; if ($producs['product_category'] === $row['slug']) { echo " selected"; } echo ">".$row['title'].": ".$row['contains']."</option>
                                    ";
                                  }
                                  $row1 = $stmt->fetch();
                                }
                                catch(PDOException $e){
                                  echo "There is some problem in connection: " . $e->getMessage();
                                }

                                $pdo->close();
                              ?>
                            </select>
                            <small id="warning" class="text-danger mt-2 mb-0"></small>
                          </div>
                          <div class="mb-3 col-md-12">
                            <label for="product_price" class="form-label">Product Price (in <?php echo $order['currency']; ?>)</label>
                            <input type="number" name="product_price" id="product_price" step="0.01" min="0.00" max="9999999999" class="form-control" placeholder="Enter the Product Price (In <?php echo $order['currency']; ?>)" value="<?php echo $producs['product_price']; ?>" required>
                          </div>
                          <div class="mb-3 col-md-12">
                            <label for="product_qty" class="form-label">Product Quantity</label>
                            <input type="number" name="product_qty" id="product_qty" class="form-control" step="1" min="0" max="9999999999" placeholder="Enter the Product Quantity" value="<?php echo $producs['product_qty']; ?>" required>
                          </div>
                          <div class="mb-3 col-md-12">
                            <label for="product_weight" class="form-label">Product Weight in KG</label>
                            <input type="number" name="product_weight" id="product_weight" class="form-control" placeholder="Enter the Product Weight in KG" step="0.01" min="0.00" max="9999999999" value="<?php echo $producs['product_weight']; ?>" required>
                          </div>
                          <div class="mb-3 col-md-12">
                            <label for="product_info" class="form-label">Product Info</label>
                            <textarea name="product_info" id="product_info" class="form-control" rows="3" cols="80" placeholder="Enter the Product Info [Max. 40 characters]" maxlength="40"><?php echo $producs['product_info']; ?></textarea>
                          </div>
                        </div>
                        <div class="mt-2">
                          <button type="submit" name="save" value="save" class="btn btn-primary me-2"><i class="bx bx-cart-add"></i> Update Product</button>
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
<script type="text/javascript">
  function productCategory() {
    var e = document.getElementById("product_category");
    var info = e.options[e.selectedIndex].getAttribute('info');
    document.getElementById("warning").innerHTML = info;
  }
</script>
</body>
</html>
