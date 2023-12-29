<?php include 'includes/head.php'; ?>
<?php
$conn = $pdo->open();

$slug = $_GET['id'];

try{

  $stmt = $conn->prepare("SELECT * FROM shippments WHERE ref_id = :slug");
  $stmt->execute(['slug' => $slug]);
  $details = $stmt->fetch();

  $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
  $stmt->execute(['id' => $details['userid']]);
  $user = $stmt->fetch();

  $stmt1 = $conn->prepare("SELECT * FROM rates WHERE id = 1");
  $stmt1->execute();
  $rates = $stmt1->fetch();

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
                            // Not made payment
                            echo "<span class='fw-semibold badge bg-warning'>Awaiting Pickup</span>";
                          }elseif ($details['status'] == 1) {
                            // We have settle the supplier
                            echo "<span class='fw-semibold badge bg-success'>Successfully Delivered</span>";
                          }elseif ($details['status'] == 2) {
                            // Made payment
                            echo "<span class='fw-semibold badge bg-info'>Proccessing Order</span>";
                          }elseif ($details['status'] == 3) {
                            // We refunded you back
                            echo "<span class='fw-semibold badge bg-secondary'>Funds Refunded</span>";
                          }elseif ($details['status'] == 4) {
                            // You cancelled the order
                            echo "<span class='fw-semibold badge bg-danger'>Order Cancelled</span>";
                          }elseif ($details['status'] == 5) {
                            // Shipping in progress
                            echo "<span class='fw-semibold badge bg-primary'>Shipping in Progress</span>";
                          }elseif ($details['status'] == 6) {
                            // Shipping in progress
                            echo "<span class='fw-semibold badge bg-warning'>Error in Product</span>";
                          }elseif ($details['status'] ==7) {
                            // Shipping in progress
                            echo "<span class='fw-semibold badge bg-danger'>Unsuccessfull Order</span>";
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

                              <div class="btn-group" role="group" aria-label="Second group">
                                <!-- <div class="btn-group" role="group">
                                  <button id="btnGroupDrop1" type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="tf-icons bx bx-info-circle"></i> Process Order</button>
                                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item bg-label-primary" data-bs-toggle="modal" data-bs-target="#deliveryOrder" href="javascript:void(0);"><i class="bx bx-package"></i> Set to Delivery in progress</a>
                                    <a class="dropdown-item bg-label-success" data-bs-toggle="modal" data-bs-target="#approveOrder" href="javascript:void(0);"><i class="bx bx-check"></i> Set as Delivered</a>
                                    <a class="dropdown-item bg-label-danger" data-bs-toggle="modal" data-bs-target="#disapproveOrder" href="javascript:void(0);"><i class="bx bx-x"></i> Set as Unsuccessfull</a>
                                  </div>
                                </div> -->
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#approveOrder"><i class="tf-icons bx bx-check"></i> Accept Order</button>
                                <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#refundOrder"><i class="tf-icons bx bx-redo"></i> Refund Order</button>
                                <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#ticket_supplier" onclick="orderMsg()"><i class="tf-icons bx bx-purchase-tag-alt"></i> Create Ticket</button>
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#cancelOrder"><i class="tf-icons bx bx-x"></i> Cancel Order</button>
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

  <!-- refund payment Modal -->
  <div class="modal fade" id="refundPayment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="refundPaymentTitle">Are you sure you want to refund this payment?</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <hr>
        <div class="modal-body">
          <form action="order_action" method="POST">
          <div class="row">
            <div class="col">
              <h5 class="text-center">You won't be able to revert this!</h5>
              <textarea name="reason" rows="8" cols="80" class="form-control" placeholder="Enter reason" required></textarea>
            </div>
          </div>
        </div>
        <hr>
        <div class="modal-footer">
            <input type="hidden" name="userid" value="<?php echo $user['id']; ?>">
            <input type="hidden" name="ref_id" value="<?php echo $details['ref_id']; ?>">
            <input type="hidden" name="id" value="<?php echo $details['id']; ?>">
            <button type="submit" name="refund" value="refund" class="btn btn-success"><i class="bx bx-check"></i> Yes</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x"></i> No</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- disapprove payment Modal -->
  <div class="modal fade" id="disapprovePayment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="disapprovePaymentTitle">Are you sure you want to disapprove this payment?</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <hr>
        <form action="order_action" method="POST">
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <h5 class="text-center">You won't be able to revert this!</h5>
              <textarea name="reason" rows="8" cols="80" class="form-control" placeholder="Enter reason" required></textarea>
            </div>
          </div>
        </div>
        <hr>
        <div class="modal-footer">
            <input type="hidden" name="userid" value="<?php echo $user['id']; ?>">
            <input type="hidden" name="ref_id" value="<?php echo $details['ref_id']; ?>">
            <input type="hidden" name="id" value="<?php echo $details['id']; ?>">
            <button type="submit" name="disapprove" value="disapprove" class="btn btn-success"><i class="bx bx-check"></i> Yes</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x"></i> No</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- approve payment Modal -->
  <div class="modal fade" id="approveGoodsPayment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="approveGoodsPaymentTitle">Are you sure you want to approve this Goods payment?</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <hr>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <h5 class="text-center">Be sure you have received the funds, You won't be able to revert this!</h5>
            </div>
          </div>
        </div>
        <hr>
        <div class="modal-footer">
          <form action="order_action" method="POST">
            <input type="hidden" name="userid" value="<?php echo $user['id']; ?>">
            <input type="hidden" name="ref_id" value="<?php echo $details['ref_id']; ?>">
            <input type="hidden" name="id" value="<?php echo $details['id']; ?>">
            <button type="submit" name="approve_goods" value="approve" class="btn btn-success"><i class="bx bx-check"></i> Yes</button>
          </form>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x"></i> No</button>
        </div>
      </div>
    </div>
  </div>

  <!-- approve payment Modal -->
  <div class="modal fade" id="approveShippingPayment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="approveShippingPaymentTitle">Are you sure you want to approve this Shipping payment?</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <hr>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <h5 class="text-center">Be sure you have received the funds, You won't be able to revert this!</h5>
            </div>
          </div>
        </div>
        <hr>
        <div class="modal-footer">
          <form action="order_action" method="POST">
            <input type="hidden" name="userid" value="<?php echo $user['id']; ?>">
            <input type="hidden" name="ref_id" value="<?php echo $details['ref_id']; ?>">
            <input type="hidden" name="id" value="<?php echo $details['id']; ?>">
            <button type="submit" name="approve_shipping" value="approve" class="btn btn-success"><i class="bx bx-check"></i> Yes</button>
          </form>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x"></i> No</button>
        </div>
      </div>
    </div>
  </div>

  <!-- approve payment Modal -->
  <div class="modal fade" id="approvePaymentNew" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="approvePaymentNewTitle">Are you sure you want to approve this payment?</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <hr>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <h5 class="text-center">Be sure you have received the funds, You won't be able to revert this!</h5>
            </div>
          </div>
        </div>
        <hr>
        <div class="modal-footer">
          <form action="order_action" method="POST">
            <input type="hidden" name="userid" value="<?php echo $user['id']; ?>">
            <input type="hidden" name="ref_id" value="<?php echo $details['ref_id']; ?>">
            <input type="hidden" name="id" value="<?php echo $details['id']; ?>">
            <button type="submit" name="approve" value="approve" class="btn btn-success"><i class="bx bx-check"></i> Yes</button>
          </form>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x"></i> No</button>
        </div>
      </div>
    </div>
  </div>

  <!-- approve commitment fee payment Modal -->
  <div class="modal fade" id="approvePaymentCommitment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="approvePaymentCommitmentTitle">Are you sure you want to approve this payment?</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <hr>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <h5 class="text-center">Be sure you have received the funds, You won't be able to revert this!</h5>
            </div>
          </div>
        </div>
        <hr>
        <div class="modal-footer">
          <form action="order_action" method="POST">
            <input type="hidden" name="userid" value="<?php echo $user['id']; ?>">
            <input type="hidden" name="ref_id" value="<?php echo $details['ref_id']; ?>">
            <input type="hidden" name="id" value="<?php echo $details['id']; ?>">
            <button type="submit" name="approve_commitment" value="approve_commitment" class="btn btn-success"><i class="bx bx-check"></i> Yes</button>
          </form>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x"></i> No</button>
        </div>
      </div>
    </div>
  </div>

  <!-- disapprove payment Modal -->
  <div class="modal fade" id="disapprovePaymentCommitment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="disapprovePaymentCommitmentTitle">Are you sure you want to disapprove this payment?</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <hr>
        <form action="order_action" method="POST">
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <h5 class="text-center">You won't be able to revert this!</h5>
              <textarea name="reason" rows="8" cols="80" class="form-control" placeholder="Enter reason"></textarea>
            </div>
          </div>
        </div>
        <hr>
        <div class="modal-footer">
            <input type="hidden" name="userid" value="<?php echo $user['id']; ?>">
            <input type="hidden" name="ref_id" value="<?php echo $details['ref_id']; ?>">
            <input type="hidden" name="id" value="<?php echo $details['id']; ?>">
            <button type="submit" name="disapprove_commitment" value="disapprove_commitment" class="btn btn-success"><i class="bx bx-check"></i> Yes</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x"></i> No</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- delivery order Modal -->
  <div class="modal fade" id="deliveryOrder" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="deliveryOrder">Are you sure you want to set this order status to Delivery in progress?</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <hr>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <h5>Package should be on it's way to the customer's location.</h5>
              <p>If this is correct, click on the yes button to set the status as delivery in progress.</p>
              <!-- <h5 class="text-center">You won't be able to revert this!</h5> -->
            </div>
          </div>
        </div>
        <hr>
        <div class="modal-footer">
          <form action="order_action" method="POST">
            <input type="hidden" name="userid" value="<?php echo $user['id']; ?>">
            <input type="hidden" name="ref_id" value="<?php echo $details['ref_id']; ?>">
            <input type="hidden" name="id" value="<?php echo $details['id']; ?>">
            <button type="submit" name="delivery_order" value="delivery_order" class="btn btn-success"><i class="bx bx-check"></i> Yes</button>
          </form>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x"></i> No</button>
        </div>
      </div>
    </div>
  </div>

  <!-- approve order Modal -->
  <div class="modal fade" id="approveOrder" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="approveOrder">Are you sure you want to set this order as completed?</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <hr>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <h5>Package should have arrived at the customer's location.</h5>
              <p>If completed, click on the yes button to confirm the order.</p>
              <!-- <h5 class="text-center">You won't be able to revert this!</h5> -->
            </div>
          </div>
        </div>
        <hr>
        <div class="modal-footer">
          <form action="order_action" method="POST">
            <input type="hidden" name="userid" value="<?php echo $user['id']; ?>">
            <input type="hidden" name="ref_id" value="<?php echo $details['ref_id']; ?>">
            <input type="hidden" name="id" value="<?php echo $details['id']; ?>">
            <button type="submit" name="approve_order" value="approve_order" class="btn btn-success"><i class="bx bx-check"></i> Yes</button>
          </form>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x"></i> No</button>
        </div>
      </div>
    </div>
  </div>

  <!-- disapprove order Modal -->
  <div class="modal fade" id="disapproveOrder" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="disapproveOrderTitle">Are you sure you want to set this order as Unsuccessfull?</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <hr>
        <form action="order_action" method="POST">
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <h5 class="text-center">You won't be able to revert this!</h5>
              <textarea name="reason" rows="8" cols="80" class="form-control" placeholder="Enter reason" required></textarea>
            </div>
          </div>
        </div>
        <hr>
        <div class="modal-footer">
            <input type="hidden" name="userid" value="<?php echo $user['id']; ?>">
            <input type="hidden" name="ref_id" value="<?php echo $details['ref_id']; ?>">
            <input type="hidden" name="id" value="<?php echo $details['id']; ?>">
            <button type="submit" name="disapprove_order" value="disapprove_order" class="btn btn-success"><i class="bx bx-check"></i> Yes</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x"></i> No</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- refund order Modal -->
  <div class="modal fade" id="refundOrder" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="refundOrderTitle">Are you sure you want to refund this order?</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <hr>
        <form action="order_action" method="POST">
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <h5 class="text-center">You won't be able to revert this!</h5>
              <textarea name="reason" rows="8" cols="80" class="form-control" placeholder="Enter reason" required></textarea>
            </div>
          </div>
        </div>
        <hr>
        <div class="modal-footer">
            <input type="hidden" name="userid" value="<?php echo $user['id']; ?>">
            <input type="hidden" name="ref_id" value="<?php echo $details['ref_id']; ?>">
            <input type="hidden" name="id" value="<?php echo $details['id']; ?>">
            <button type="submit" name="refund_order" value="refund_order" class="btn btn-success"><i class="bx bx-check"></i> Yes</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x"></i> No</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- cancel order Modal -->
  <div class="modal fade" id="cancelOrder" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="cancelOrderTitle">Are you sure you want to cancel this order?</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <hr>
        <form action="order_action" method="POST">
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <h5 class="text-center">You won't be able to revert this!</h5>
              <textarea name="reason" rows="8" cols="80" class="form-control" placeholder="Enter reason" required></textarea>
            </div>
          </div>
        </div>
        <hr>
        <div class="modal-footer">
            <input type="hidden" name="userid" value="<?php echo $user['id']; ?>">
            <input type="hidden" name="ref_id" value="<?php echo $details['ref_id']; ?>">
            <input type="hidden" name="id" value="<?php echo $details['id']; ?>">
            <button type="submit" name="cancel_order" value="cancel_order" class="btn btn-success"><i class="bx bx-check"></i> Yes</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x"></i> No</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Share Modal -->
  <div class="modal fade" id="shareLink" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-refer-and-earn">
      <div class="modal-content p-3 p-md-5">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

          <h5 class="mt-2">Share this invoice</h5>
          <form class="row g-3" onsubmit="return false">
            <div class="col-lg-8">
              <label class="form-label" for="modalRnFLink">You can also copy and share it on your social media 🥳</label>
              <div class="input-group input-group-merge">
                <input type="text" id="modalRnFLink" class="form-control" value="<?php echo $settings['site_url']; ?>view-order?id=<?php echo $orders['ref_id']; ?>">
                <span class="input-group-text text-primary cursor-pointer" onclick="copyLink()" id="basic-addon33"><i class='bx bx-copy bx-xs' ></i> Copy link</span>
              </div>
            </div>
            <div class="col-lg-4 d-flex align-items-end">
              <div class="btn-social">
                <?php
                $text1 = "Hey there, check out my invoice on ".$settings['site_name'].". ".$settings['site_url']."view-order?id=".$orders['ref_id'].".";
                $text = urlencode($text1);
                // echo urlencode($text);
                ?>
                <a href="https://wa.me?text=<?php echo $text; ?>" data-action="share/whatsapp/share" rel="noopener" target="_blank" class="btn btn-icon btn-success mr-2"><i class="tf-icons bx bxl-whatsapp"></i></a>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $settings['site_url']; ?>view-order?id=<?php echo $orders['ref_id']; ?>&t=<?php echo $text; ?>" rel="noopener" target="_blank" class="btn btn-icon btn-facebook mr-2"><i class="tf-icons bx bxl-facebook"></i></a>
                <a href="https://www.twitter.com/intent/tweet?text=<?php echo $text; ?>" rel="noopener" target="_blank" class="btn btn-icon btn-twitter mr-2"><i class="tf-icons bx bxl-twitter"></i></a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $settings['site_url']; ?>view-order?id=<?php echo $orders['ref_id']; ?>&title=<?php echo $text; ?>" target="_blank" class="btn btn-icon btn-linkedin"><i class="tf-icons bx bxl-linkedin"></i></a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="ticket_supplier">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><b>Create New Ticket for <?php echo $details['ref_id']; ?></b></h4>
          <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <form action="ticket-new" method="post" accept-charset="utf-8">
              <div class="form-group mb-3">
                <label for="subject">Subject</label>
                <input type="text" placeholder="Subject" id="subject_supplier" name="subject" formcontrolname="subject" class="form-control ng-pristine ng-valid ng-touched" required>
              </div>
              <div class="row">
                <div class="form-group mb-3 col-md-6">
                  <label for="subject">Assign to [User]</label>
                  <select name="userId" class="select2 form-select" required>
                    <option value="<?php echo $user['id']; ?>" selected><?php echo $user['firstname'].' '.$user['lastname']; ?></option>
                  </select>
                </div>
                <div class="form-group mb-3 col-md-6">
                  <label for="subject">Assign to [Admin]</label>
                  <select name="assignedTo" class="select2 form-select" required>
                    <option value="" selected disabled hidden>Choose Here</option>
                    <?php
                    $conn = $pdo->open();

                    try{
                      $stmt = $conn->prepare("SELECT * FROM users WHERE type = 1");
                      $stmt->execute();
                      foreach($stmt as $admin_ticket){
                        if ($admin_ticket['id'] == $admin['id']) {
                          $admin_cheked = "selected";
                        }else {
                          $admin_cheked = '';
                        }
                        echo "
                        <option value='".$admin_ticket['id']."' ".$admin_cheked.">".$admin_ticket['firstname'].' '.$admin_ticket['lastname']."</option>
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
              </div>
              <div class="row">
                <div class="form-group mb-3 col-md-6">
                  <label for="subject">Category</label>
                  <select name="category" class="select2 form-select" required>
                    <option value='Shippment' selected>Shippments</option>
                  </select>
                </div>
                <div class="form-group mb-3 col-md-6">
                  <label for="priority">Priority</label>
                  <select name="priority" class="select2 form-select" required>
                    <option value="" selected disabled hidden>Choose Here</option>
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                  </select>
                </div>
              </div>
              <div class="form-group mb-3">
                <label for="text-area-1">Message</label>
                <textarea name="message" id="message_supplier" rows="10" placeholder="Detail the issue here" class="form-control" required></textarea>
              </div>
              <button class="btn btn-primary w-100" name="save"><i class="bx bx-plus"></i> Create</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-rounded pull-left" data-bs-dismiss="modal"><i class="bx bx-x"></i> Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- description order Modal -->
    <div class="modal fade" id="descriptionOrder" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="descriptionOrder">Shipping Description</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <hr>
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <h5>Shippment Description</h5>
                <p><?php echo $orders['item_description']; ?></p>
                <!-- <h5 class="text-center">You won't be able to revert this!</h5> -->
              </div>
            </div>
          </div>
          <hr>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-bs-dismiss="modal"><i class="bx bx-x"></i> Close</button>
          </div>
        </div>
      </div>
    </div>


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
