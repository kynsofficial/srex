  <!-- accept order Modal -->
  <div class="modal fade" id="acceptOrder" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="acceptOrder">Are you sure you want to accept this order?</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <hr>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <h5>Package should be on the way it is been described and full payment made.</h5>
              <p>If this is correct, click on the yes button to set the status to processing order.</p>
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
            <button type="submit" name="accept_order" value="accept_order" class="btn btn-success"><i class="bx bx-check"></i> Yes</button>
          </form>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bx bx-x"></i> No</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Assign driver Modal -->
  <div class="modal fade" id="assignDriver">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><b>Assign Driver for order <?php echo $details['ref_id']; ?></b></h4>
          <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <form action="order_action" method="post" accept-charset="utf-8">
              <div class="form-group mb-3">
                <label>Receiver State</label>
                <input type="text" readonly class="form-control" value="<?php echo $details['receiver_state']; ?>"><br>
                <input type="hidden" name="userid" value="<?php echo $user['id']; ?>">
                <input type="hidden" name="ref_id" value="<?php echo $details['ref_id']; ?>">
                <input type="hidden" name="id" value="<?php echo $details['id']; ?>">
                  <label for="subject">Assign to [Driver]</label>
                  <select name="driverid" class="select2 form-select" required>
                    <option value="" selected disabled hidden>Choose Here</option>
                    <?php
                    $conn = $pdo->open();

                    try{
                      $stmt = $conn->prepare("SELECT * FROM drivers WHERE status = 1");
                      $stmt->execute();
                      foreach($stmt as $driver){
                        echo "
                        <option value='".$driver['id']."'>".$driver['firstname'].' '.$driver['lastname']." - ".$driver['state']." (".$driver['country'].")</option>
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
              <button class="btn btn-primary w-100" name="assign_driver"><i class="bx bx-plus"></i> Assign</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-rounded pull-left" data-bs-dismiss="modal"><i class="bx bx-x"></i> Close</button>
          </div>
        </div>
      </div>
  </div>

  <!-- Update Status Modal -->
  <div class="modal fade" id="updateStatus">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><b>Update Status for order <?php echo $details['ref_id']; ?></b></h4>
          <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <form action="order_action" method="post" accept-charset="utf-8">
              <div class="form-group mb-3">
                <input type="hidden" name="userid" value="<?php echo $user['id']; ?>">
                <input type="hidden" name="ref_id" value="<?php echo $details['ref_id']; ?>">
                <input type="hidden" name="id" value="<?php echo $details['id']; ?>">

                  <label for="">Update Status</label>
                  <?php if($details['status'] == '4'): ?>
                    <select name="status" id="status_2" class="select2 form-select">
                        <option value="" selected disabled hidden>Choose Here</option>
                        <option value="5">Delivered</option>
                        <option value="6">Return</option>
                    </select>
                  <?php else: ?>
                    <?php $status_arr = array("Item Accepted by Driver","Collected","Shipped","In-Transit","Arrived At Destination","Delivered","Return"); ?>
                    <select name="status" id="status_2" class="select2 form-select">
                        <option value="" selected disabled hidden>Choose Here</option>
                        <?php foreach($status_arr as $k => $v): ?>
                            <option value="<?php echo $k ?>"><?php echo $v; ?></option>
                        <?php endforeach; ?>
                    </select>
                  <?php endif; ?>
              </div>
              <div class="form-group mb-3">
                <label>Comment</label>
                <!--<textarea class="form-control" id="coment_2" name="comment" required></textarea>-->
                <input list="languages" name="comment" class="form-control" required>
                <datalist id="languages">
                <?php
                    $conn = $pdo->open();

                    try{
                      $stmt = $conn->prepare("SELECT * FROM suggestions");
                      $stmt->execute();
                      foreach($stmt as $suggestion){
                        echo "
                        <option value='".$suggestion['suggestion']."'>".$suggestion['suggestion']."</option>
                        ";
                      }
                    }
                    catch(PDOException $e){
                      echo $e->getMessage();
                    }

                    $pdo->close();
                ?>
                </datalist>
              </div>
              <button class="btn btn-primary w-100" name="update_track_status"><i class="bx bx-save"></i> Update</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-rounded pull-left" data-bs-dismiss="modal"><i class="bx bx-x"></i> Close</button>
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
  
  <!-- Ticket Modal -->
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