<?php include 'includes/head.php'; ?>
<?php
$conn = $pdo->open();

$slug = $_GET['id'];

try{

  $stmt = $conn->prepare("SELECT * FROM shippments WHERE ref_id=:slug AND driver_assigned_id=:driver_assigned_id");
  $stmt->execute(['slug' => $slug, 'driver_assigned_id'=>$admin['id']]);
  $details = $stmt->fetch();

  $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
  $stmt->execute(['id' => $details['userid']]);
  $user = $stmt->fetch();

  $stmt1 = $conn->prepare("SELECT * FROM rates WHERE id = 1");
  $stmt1->execute();
  $rates = $stmt1->fetch();

  // if driver is assigned
  if($details['driver_assigned'] == 1){
    $stmt = $conn->prepare("SELECT * FROM drivers WHERE id = :id");
    $stmt->execute(['id' => $details['driver_assigned_id']]);
    $driver = $stmt->fetch();
  }

  if ($details != TRUE) {
    // echo "Not Valid";
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
      <input type="hidden" id="id" name="id" value="<?php echo $details['ref_id']; ?>">
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
          <?php
          $conn = $pdo->open();
          try{
            $stmt = $conn->prepare("SELECT * FROM shippments WHERE ref_id = :slug LIMIT 1");
            $stmt->execute(['slug' => $details['ref_id']]);
            $i = 0;
          }
          catch(PDOException $e){
            echo $e->getMessage();
          }

            $pdo->close();
          ?>
          <?php foreach ($stmt as $orders): ?>
            <?php $i++;
            $currency = $settings['currency'];
            ?>
          <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
              <span class="text-muted fw-light">Services / Shippments /</span> View Order
            </h4>

            <div class="row invoice-preview">
              <div class="col-12">
                <?php include 'includes/alert.php'; ?>
              </div>
              <!-- Invoice -->
              <div class="col-xl-12 col-md-12 col-12 mb-md-0 mb-4" id="myInvoice">
                <div class="card invoice-preview-card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-sm-3 p-0">
                      <div class="mb-xl-0 mb-4">
                        <div class="d-flex svg-illustration mb-3 gap-2">
                          <span class="app-brand-logo demo">

                            <img src="<?php echo $settings['site_url']; ?>assets/img/core/<?php echo $settings['logo_line']; ?>" class="img-fluid brand_img" alt="logo">

                          </span>
                          <!-- <span class="app-brand-text demo text-body fw-bolder">Sneat</span> -->
                        </div>
                        <p class="mb-1"><?php echo $settings['location']; ?></p>
                        <p class="mb-1"><?php echo $settings['country']; ?>.</p>
                        <p class="mb-0"><?php echo $about['phone']; ?>.</p>
                      </div>
                      <div>
                        <h4>Invoice #<?php echo strtotime($orders['date_created']); ?></h4>
                        <div class="mb-2">
                          <span class="me-1">Date Issued:</span>
                          <span class="fw-semibold"><?php echo date('d/m/Y - h:ia', strtotime($orders['date_created'])); ?></span>
                        </div>
                        <div class="mb-2">
                          <span class="me-1">Order ID:</span>
                          <span class="fw-semibold"><?php echo $orders['ref_id']; ?></span>
                        </div>
                        <div>
                          <span class="me-1">Order Status:</span>
                          <?php

                          if ($details['status'] == 0) {
                            // Goods is awaiting pickup/drop from driver/agency
                            echo "<span class='fw-semibold badge bg-warning'>Awaiting Pickup/Drop</span>";
                          }
                          elseif ($details['status'] == 1) {
                            // Order has been delivered successfully
                            echo "<span class='fw-semibold badge bg-success'>Successfully Delivered</span>";
                          }
                          elseif ($details['status'] == 2) {
                            // Order has been approved by Srex and has beem given to a driver
                            echo "<span class='fw-semibold badge bg-info'>Proccessing Order</span>";
                          }
                          elseif ($details['status'] == 3) {
                            // Order has been returned because it was not delivered
                            echo "<span class='fw-semibold badge bg-secondary'>Order Returned</span>";
                          }
                          elseif ($details['status'] == 4) {
                            // Order has reached the destination and is awaiting delivery/pickup
                            echo "<span class='fw-semibold badge bg-danger'>Reached Destination Awaiting Pickup</span>";
                          }
                          elseif ($details['status'] == 5) {
                            // Order is on the way
                            echo "<span class='fw-semibold badge bg-primary'>Shipping in Progress</span>";
                          }
                          elseif ($details['status'] == 6) {
                            // Order is on the way
                            echo "<span class='fw-semibold badge bg-danger'>Order Canceled</span>";
                          }
                          else{
                            // We no know, something just sup sha
                            echo "<span class='fw-semibold badge bg-dark'>Error</span>";
                          }

                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr class="my-0" />
                  <div class="card-body">
                    <div class="row p-sm-3 p-0">
                      <div class="col-xl-6 col-md-12 col-sm-6 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                        <h6 class="pb-2">Sender:</h6>
                        <b class="mb-1"><?php echo $details['sender_name']; ?></b>
                        <p class="mb-1"><?php echo $details['sender_postal_code'].", ".$details['sender_address'].", ".$details['sender_city']; ?></p>
                        <p class="mb-1"><?php echo $details['sender_state'].", ".$details['sender_country']; ?></p>
                        <p class="mb-1"><?php echo $details['sender_phone']; ?></p>
                        <p class="mb-0"><?php echo $details['sender_email']; ?></p>
                      </div>
                      <div class="col-xl-6 col-md-12 col-sm-6 col-12">
                        <h6 class="pb-2">Receiver:</h6>
                        <b class="mb-1"><?php echo $details['receiver_name']; ?></b>
                        <p class="mb-1"><?php echo $details['receiver_postal_code'].", ".$details['receiver_address'].", ".$details['receiver_city']; ?></p>
                        <p class="mb-1"><?php echo $details['receiver_state'].", ".$details['receiver_country']; ?></p>
                        <p class="mb-1"><?php echo $details['receiver_phone']; ?></p>
                        <p class="mb-0"><?php echo $details['receiver_email']; ?></p>
                      </div>
                      <?php if($details['driver_assigned'] == 1): ?>
                      <div class="col-xl-6 col-md-12 col-sm-6 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4 mt-4">
                        <h6 class="pb-2">Driver:</h6>
                        <b class="mb-1"><?php echo $driver['firstname']." ".$driver['lastname']; ?></b>
                        <p class="mb-1"><?php echo $driver['state'].", ".$driver['country']; ?></p>
                        <p class="mb-1"><?php echo $driver['contact_info']; ?></p>
                        <p class="mb-0"><?php echo $driver['email']; ?></p>
                      </div>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="table-responsive text-nowrap">
                    <table class="table border-top m-0">
                      <thead>
                        <tr>
                          <th>Delivery Type</th>
                          <th>Delivery Method</th>
                          <th>Destination Option</th>
                          <th>Item Category</th>
                          <th>Item Value</th>
                          <th>Item Desc</th>
                          <th>Item Quantity</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $conn = $pdo->open();

                        echo "
                        <tr>
                          <td>".ucwords($orders['delivery_type'])."</td>
                          <td>".ucwords($orders['delivery_method'])."</td>
                          <td>".ucwords($orders['destination_option'])."</td>
                          <td>".$orders['item_category']."</td>
                          <td>".$settings['currency'].number_format($orders['item_value'], 2)."</td>
                          <td><a class='btn btn-sm bg-label-primary' data-bs-toggle='modal' data-bs-target='#descriptionOrder' target='_blank'><i class='bx bx-show'></i> View</a></td>
                          <td>".$orders['item_quantity']."</td>
                        </tr>
                        ";
                        ?>

                        <?php
                        // Variables
                        if($settings['service_charge'] == 0){
                          $service_charge = "<span class='badge bg-success'>Free</span>";
                        }else{
                          $service_charge = $currency.number_format($settings['service_charge']);
                        }

                        if($rates['vat'] == 0){
                          $vat = "<span class='badge bg-success'>Free</span>";
                        }else{
                          $vat = $rates['vat']."%";
                        }

                        if ($orders['item_weight'] == 'equal') { // 0.2KG to 2KG
                          $order_weight_text = '0.2KG to 2KG';

                          $stmt1 = $conn->prepare("SELECT * FROM states WHERE name=:shipping_rate");
                          $stmt1->execute(['shipping_rate'=>$orders['receiver_state']]);
                          $shipping_rate = $stmt1->fetch();

                          $order_weight_amount = $shipping_rate['equal_amount'];

                        }elseif ($orders['item_weight'] == 'great') { // Above 2KG
                          $order_weight_text = 'Above 2KG';
                          
                          $stmt1 = $conn->prepare("SELECT * FROM states WHERE name=:shipping_rate");
                          $stmt1->execute(['shipping_rate'=>$orders['receiver_state']]);
                          $shipping_rate = $stmt1->fetch();

                          $order_weight_amount = $shipping_rate['great_amount'];
                        }
                        ?>
                        <tr>
                          <td colspan="5" class="align-top px-4 py-5">
                            <p class="mb-2">
                              <span class="me-1">Est. Total Weight of Order: <b><?php echo $order_weight_text; ?></b><br>
                              <span class="me-1">Shipping Plan: <b><?php echo ucwords($orders['shipping_rate_type']); ?></b><br>
                              <span class="me-1">Shipping Rate: <b><?php echo $settings['currency'].number_format($order_weight_amount, 2); ?></b><br>
                              <span class="me-1">Shipping Period: <b><?php echo $orders['shipping_rate_period']; ?> Day(s)</b><br>
                              <span class="me-1">Estimated Delivery Date: <b><?php echo $orders['date_estimate_delivery']; ?></b><br>
                            </p>
                          </td>
                          <td class="text-end px-4 py-5">
                            <p class="mb-2">Subtotal:</p>
                            <p class="mb-2">Shipping:</p>
                            <p class="mb-2">S.Charge:</p>
                            <p class="mb-2">VAT:</p>
                            <p class="mb-2 fw-bold">Grand Total:</p>
                          </td>
                          <td class="px-4 py-5">
                              <p class="fw-semibold mb-2"><?php echo $currency; ?><?php echo number_format($order_weight_amount, 2); ?></p>
                              <p class="fw-semibold mb-2"><?php echo $currency; ?><?php echo number_format($order_weight_amount, 2); ?></p>
                              <p class="fw-semibold mb-2"><?php echo $service_charge; ?></p>
                              <p class="fw-semibold mb-2"><?php echo $vat; ?></p>
                              <p class="fw-bold mb-0"><?php echo $settings['currency']; ?><?php echo $order_weight_amount; ?></p>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="card-body">
                    <div class="row">
                      <div class="col-12">
                        <span class="fw-semibold">Note:</span>
                        <!-- <span>If this Estimated Shipping Cost is higher than the actual Estimated Shipping Cost which will be determined later at the China office, we will refund you. If the actual Estimated Shipping Cost is higher than this Estimated Shipping Cost, you will be required to make a balance payment. Thank You!</span> -->
                        <span>This is for your notification only</span><br>
                        <a href='tracking?tracking_id=<?php echo $details['ref_id'] ?>' class="btn btn-outline-primary mt-2"><i class="tf-icons bx bx-current-location"></i> Track Shipping</a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /Invoice -->


                <!-- Invoice Actions -->
                <div class="col-12 mt-4 invoice-actions">
                  <div class="card">
                    <div class="bs-stepper-content p-3 mb-5">
                      <div id="checkout-confirmation" class="content">
                        <h3>Actions</h3>

                        <div class="row">
                          <div class="col-12 mb-xl-0 mb-3 mt-3">
                            <h6 class="fw-bold mb-0">Order Actions</h6>
                            <div class="btn-toolbar demo-inline-spacing" role="toolbar" aria-label="Toolbar with button groups">
                                  
                                <!-- <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#acceptOrder"><i class="tf-icons bx bx-check"></i> Accept Order</button>
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#assignDriver"><i class="tf-icons bx bx-user"></i> Assign Driver</button>
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#approveOrder"><i class="tf-icons bx bx-check"></i> Set as Delivered</button>
                                <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#refundOrder"><i class="tf-icons bx bx-redo"></i> Refund Order</button>
                                <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#ticket_supplier" onclick="orderMsg()"><i class="tf-icons bx bx-purchase-tag-alt"></i> Create Ticket</button>
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#cancelOrder"><i class="tf-icons bx bx-x"></i> Cancel Order</button> -->

                              <div class="btn-group" role="group" aria-label="Second group">
                                <?php if($orders['status'] == 1): ?>
                                  <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#ticket_supplier" onclick="orderMsg()"><i class="tf-icons bx bx-purchase-tag-alt"></i> Create Ticket</button>
                                <?php elseif($orders['status'] == 3): ?>
                                  <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#ticket_supplier" onclick="orderMsg()"><i class="tf-icons bx bx-purchase-tag-alt"></i> Create Ticket</button>
                                <?php elseif($orders['status'] == 4): ?>
                                  <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#approveOrder"><i class="tf-icons bx bx-check"></i> Set as Delivered</button>
                                  <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#updateStatus"><i class="tf-icons bx bx-current-location"></i> Update Status</button>
                                  <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#ticket_supplier" onclick="orderMsg()"><i class="tf-icons bx bx-purchase-tag-alt"></i> Create Ticket</button>
                                <?php elseif($orders['status'] == 5): ?> 
                                  <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#approveOrder"><i class="tf-icons bx bx-check"></i> Set as Delivered</button>
                                  <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#updateStatus"><i class="tf-icons bx bx-current-location"></i> Update Status</button>
                                  <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#cancelOrder"><i class="tf-icons bx bx-x"></i> Cancel Order</button>
                                  <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#ticket_supplier" onclick="orderMsg()"><i class="tf-icons bx bx-purchase-tag-alt"></i> Create Ticket</button>
                                <?php elseif($orders['status'] == 6): ?>
                                  <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#ticket_supplier" onclick="orderMsg()"><i class="tf-icons bx bx-purchase-tag-alt"></i> Create Ticket</button>
                                <?php endif; ?>
                                <!-- <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#ticket_supplier" onclick="orderMsg()"><i class="tf-icons bx bx-purchase-tag-alt"></i> Create Ticket</button> -->
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12 mb-xl-0 mb-3 mt-3">
                            <h6 class="fw-bold mb-0">Other Actions</h6>
                            <div class="btn-toolbar demo-inline-spacing" role="toolbar" aria-label="Toolbar with button groups">
                              <div class="btn-group" role="group" aria-label="Third Group">
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#shareLink"><i class="tf-icons bx bx-share"></i> Share</button>

                                <div class="btn-group" role="group">
                                  <button id="btnGroupDrop3" type="button" class="btn btn-outline-success dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="tf-icons bx bx-printer"></i> Print</button>
                                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop3">
                                    <a class="dropdown-item bg-label-primary" target="_blank" href="order-print-invoice?id=<?php echo $details['ref_id']; ?>"><i class="bx bx-printer"></i> Print Invoice</a>
                                    <a class="dropdown-item bg-label-primary" target="_blank" href="order-print-receipt?id=<?php echo $details['ref_id']; ?>"><i class="bx bx-printer"></i> Print Receipt</a>
                                    <a class="dropdown-item bg-label-primary" target="_blank" href="order-print?id=<?php echo $details['ref_id']; ?>"><i class="bx bx-printer"></i> Print Delivery Note</a>
                                  </div>
                                </div>

                                <div class="btn-group" role="group">
                                  <button id="btnGroupDrop4" type="button" class="btn btn-outline-success dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="tf-icons bx bx-download"></i> Download</button>
                                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop4">
                                    <a class="dropdown-item bg-label-primary" href="order-download-invoice?id=<?php echo $details['ref_id']; ?>" target="_blank"><i class="bx bx-download"></i> Download Invoice</a>
                                    <a class="dropdown-item bg-label-primary" href="order-download-receipt?id=<?php echo $details['ref_id']; ?>" target="_blank"><i class="bx bx-download"></i> Download Receipt</a>
                                    <a class="dropdown-item bg-label-primary" href="order-download?id=<?php echo $details['ref_id']; ?>" target="_blank"><i class="bx bx-download"></i> Download Delivery Note</a>
                                  </div>
                                </div>

                                <!-- <button type="button" class="btn btn-outline-success" onclick="downloadPdf()"><i class="tf-icons bx bx-download"></i> Download</button> -->
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <!-- /Invoice Actions -->

              </div>



              <div class="content-backdrop fade"></div>
            </div>
            <?php endforeach; ?>
            <!-- Content wrapper -->
          </div>

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
  <!-- </div> -->

  <?php include 'includes/order_modal.php'; ?>


  <!-- / Layout wrapper -->
<?php include 'includes/scripts.php'; ?>
<script>
function paymentMsg() {
  var title = "Payment Issue for Order <?php echo $details['ref_id']; ?>";
  var msg = "An issue occur with the Payment of Order with ID <?php echo $details['ref_id']; ?>";

  document.getElementById('subject_supplier').value = title;
  document.getElementById('message_supplier').innerHTML = msg;
}

function orderMsg() {
  var title = "Issue for Order <?php echo $details['ref_id']; ?>";
  var msg = "An issue occur with Order ID <?php echo $details['ref_id']; ?>";

  document.getElementById('subject_supplier').value = title;
  document.getElementById('message_supplier').innerHTML = msg;
}


function copyLink() {
  var copyText = document.getElementById('modalRnFLink');
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  navigator.clipboard.writeText(copyText.value);
  document.getElementById("basic-addon33").innerHTML = "<span class='text-success'><i class='bx bx-copy bx-xs'></i> Copied!</span>";
  setTimeout(function () {
    document.getElementById("basic-addon33").innerHTML = "<i class='bx bx-copy bx-xs'></i> Copy Link";
  },2000);
}
</script>
</body>
</html>
