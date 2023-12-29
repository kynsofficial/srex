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
            <span class="text-muted fw-light">Services / Shippments /</span> Create Order
          </h4>

            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">New Order Details</h5>
                    <p>Create order (Shippments)</p>
                    <hr class="my-3">
                    <form method="POST" action="<?php echo htmlspecialchars('order-new_insert'); ?>" onsubmit="return true">
                      <?php include 'includes/alert.php'; ?>
                      <div class="row">
                        <div class="mb-3 col-md-12">
                          <label for="subject">Assign to [User]</label>
                          <select name="userid" class="select2 form-select" required>
                            <option value="" selected disabled hidden>Choose Here</option>
                            <?php
                            $conn = $pdo->open();

                            try{
                              $stmt = $conn->prepare("SELECT * FROM users WHERE type = 0");
                              $stmt->execute();
                              foreach($stmt as $users_order){
                                echo "
                                <option value='".$users_order['id']."'>".$users_order['firstname'].' '.$users_order['lastname'].' ('.$users_order['username'].")</option>
                                ";
                              }
                            }
                            catch(PDOException $e){
                              echo $e->getMessage();
                            }

                            $pdo->close();
                            ?>
                          </select>
                        </div>
                        <div class="mb-3 col-md-12">
                          <label for="order_name" class="form-label">Order's Name</label>
                          <input type="text" name="order_name" id="order_name" class="form-control" placeholder="Give your order a name" <?php if (isset($_SESSION['order_name'])) { echo 'value="'.$_SESSION['order_name'].'"'; unset($_SESSION['order_name']); } ?> required>
                        </div>
                        <div class="mb-3 col-md-12">
                          <label for="currency" class="form-label">Currency</label>
                          <select id="currency" name="currency" class="select2 form-select" required>
                            <option value=""> - Select - </option>
                            <?php

                            $conn = $pdo->open();
                            try{
                              $stmt = $conn->prepare("SELECT * FROM currency");
                              $stmt->execute();
                              foreach($stmt as $row){
                                echo "
                                <option value='".$row['slug']."' "; if (isset($_SESSION['currency'])) { echo " selected"; unset($_SESSION['currency']); }; echo ">(".$row['sign'].") ".$row['name']."</option>
                                ";
                              }
                            }
                            catch(PDOException $e){
                              echo "There is some problem in connection: " . $e->getMessage();
                            }

                            $pdo->close();

                            ?>
                          </select>
                        </div>
                        <div class="mb-3 col-md-12">
                          <label for="destination_country" class="form-label">Destinaion Country</label>
                          <select id="destination_country" name="destination_country" onchange="hide_feature(this)" class="select2 form-select" required>
                            <option value=""> -Select- </option>
                            <?php

                            $conn = $pdo->open();
                            try{
                              $stmt = $conn->prepare("SELECT * FROM shipping_rate");
                              $stmt->execute();
                              foreach($stmt as $row){
                                echo "
                                <option myid='".$row['myid']."' value='".$row['myid']."'"; if (isset($_SESSION['destination_country'])) { echo " selected"; unset($_SESSION['destination_country']); }; echo ">".$row['title']."</option>
                                ";
                              }
                            }
                            catch(PDOException $e){
                              echo "There is some problem in connection: " . $e->getMessage();
                            }

                            $pdo->close();

                            ?>
                          </select>
                        </div>
                        <div class="mb-3 col-md-12">
                          <label for="shipping_plan" class="form-label">Shipping Plans</label>
                          <select id="shipping_plan" name="shipping_plan" class="select2 form-select" onchange="show_warning(this)" required>
                            <option value=""> -Select- </option>
                            <?php

                            $conn = $pdo->open();
                            try{
                              $stmt = $conn->prepare("SELECT * FROM shipping_plan");
                              $stmt->execute();
                              foreach($stmt as $row){
                                echo "
                                <option myid='".$row['slug']."' info='".$row['info']."' name='".$row['name']."' value='".$row['slug']."'"; if (isset($_SESSION['shipping_plan'])) { echo " selected"; unset($_SESSION['shipping_plan']); }; echo ">
                                ".$row['name']."
                                </option>
                                ";
                              }
                            }
                            catch(PDOException $e){
                              echo "There is some problem in connection: " . $e->getMessage();
                            }

                            $pdo->close();

                            ?>
                          </select>
                          <p id="info11" class="mt-2 text-danger"></p>
                        </div>
                        <div class="mb-3 col-md-12">
                          <label for="shipping_address" class="form-label">Shipping Address</label>
                          <textarea name="shipping_address" id="shipping_address" class="form-control" rows="3" cols="80" placeholder="Enter Shipping Address" required><?php if (isset($_SESSION['shipping_address'])) { echo $_SESSION['shipping_address']; unset($_SESSION['shipping_address']); } ?></textarea>
                          <small>
                            Please, provide your exact delivery address including phone number(s) for orders going to Canada, US, Mexico, UK, as they are delivered by DHL.
                            Orders going to Ghana, Zimbabwe, Cameroon, etc., are delivered by our Chinese shipping partners straight to your delivery address.
                            Orders to Nigeria are delivered to our Lagos office. You can pick up or we forward to your location at an extra cost.
                          </small>
                        </div>
                        <hr class="my-3">
                        <div class="col mt-2 mb-3">
                          <div class="form-check form-check-inline">
                            <input name="terms" class="form-check-input" type="checkbox" value="on" id="terms" required />
                            <label class="form-check-label" for="terms">I agree to the <a href="" data-bs-toggle="modal" data-bs-target="#termsConditions">Terms & Conditions</a></label>
                          </div>
                        </div>
                      </div>
                      <div class="mt-2">
                        <button type="submit" name="save" value="save" class="btn btn-primary me-2"><i class="bx bx-plus"></i> Create Order</button>
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
<script src="includes/product_validation.js" charset="utf-8"></script>
<?php
$conn = $pdo->open();

try{

  $stmt = $conn->prepare("SELECT * FROM frontend WHERE id=:id");
  $stmt->execute(['id'=>1]);
  $frontend = $stmt->fetch();

}
catch(PDOException $e){
  echo "There is some problem in connection: " . $e->getMessage();
}

?>
<div class="modal fade" id="termsConditions" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFullTitle">Terms and Conditions</h5>
      </div>
      <div class="modal-body">
        <?php echo $frontend['terms_condition']; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="bx bx-check"></i> I Agree</button>
      </div>
    </div>
    <div>
    </div>
    <script>
    function hide_feature(select){
      var valx = select.options[select.selectedIndex].getAttribute("myid");

      if(valx != "nigeria"){document.getElementById("info11").innerHTML = "<b>Normal Shipping </b> (<i>Delivery between 10 to 20 Working days</i>)";

      document.getElementById('shipping_plan').selectedIndex = 1;

      document.getElementById('shipping_plan').style.display = 'none';
      //document.getElementById("shipping_plan").disabled = true;

    }
    else{
      document.getElementById("info11").innerHTML = "";
      document.getElementById("shipping_plan").disabled = false;

      document.getElementById('shipping_plan').selectedIndex = 0;

      document.getElementById('shipping_plan').style.display = 'block';
    }


  }
</script>
<script>
function show_warning(select){
  var valx = select.options[select.selectedIndex].getAttribute("myid");
  var info = select.options[select.selectedIndex].getAttribute('info');
  var name = select.options[select.selectedIndex].getAttribute('name');

  if(valx == "air"){document.getElementById("info11").innerHTML = "<b>" + name +": </b>" + info + ""}
  if(valx == "sea"){document.getElementById("info11").innerHTML = "<b>" + name +": </b>" + info + ""}

}
</script>
</body>
</html>
