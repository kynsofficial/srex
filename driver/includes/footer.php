<footer class="content-footer footer bg-footer-theme">
  <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
    <div class="mb-2 mb-md-0">
      &copy <?php echo date('Y'); ?>, made with ❤️ by <a href="https://harkone.com.ng/" target="_blank" class="footer-link fw-bolder">Harkone Designs</a>
    </div>
  </div>
</footer>

<div class="modal fade" id="ticket_new">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><b>Create New Ticket</b></h4>
        <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form action="ticket-new" method="post" accept-charset="utf-8">
            <div class="form-group mb-3">
              <label for="subject">Subject</label>
              <input type="text" placeholder="Subject" id="subject" name="subject" formcontrolname="subject" class="form-control ng-pristine ng-valid ng-touched" required>
            </div>
            <div class="row">
              <div class="form-group mb-3 col-md-6">
                <label for="subject">Assign to [User]</label>
                <select name="userId" class="select2 form-select" required>
                  <option value="" selected disabled hidden>Choose Here</option>
                  <?php
                  $conn = $pdo->open();

                  try{
                    $stmt = $conn->prepare("SELECT * FROM users WHERE type = 0");
                    $stmt->execute();
                    foreach($stmt as $users_ticket){
                      echo "
                      <option value='".$users_ticket['id']."'>".$users_ticket['firstname'].' '.$users_ticket['lastname'].' ('.$users_ticket['username'].")</option>
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
                      echo "
                      <option value='".$admin_ticket['id']."'>".$admin_ticket['firstname'].' '.$admin_ticket['lastname']."</option>
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
                <select name="category" class="form-select" required>
                  <option value="" selected disabled hidden>Choose Here</option>
                  <?php
                  $conn = $pdo->open();

                  try{
                    $stmt = $conn->prepare("SELECT * FROM tbl_ticket_categories");
                    $stmt->execute();
                    foreach($stmt as $category){
                      echo "
                      <option value='".$category['categoryId']."'>".$category['categoryName']."</option>
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
              <div class="form-group mb-3 col-md-6">
                <label for="priority">Priority</label>
                <select name="priority" class="form-select" required>
                  <option value="" selected disabled hidden>Choose Here</option>
                  <option value="high">High</option>
                  <option value="medium">Medium</option>
                  <option value="low">Low</option>
                </select>
              </div>
            </div>
            <div class="form-group mb-3">
              <label for="text-area-1">Message</label>
              <textarea name="message" id="text-area" rows="10" placeholder="Detail the issue here" class="form-control" required></textarea>
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

<div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="elcCalulator" aria-labelledby="elcCalulatorLabel">
  <div class="offcanvas-header">
    <h5 id="elcCalulatorLabel" class="offcanvas-title">ELC Calculator</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body my-auto mx-0 flex-grow-0">
    <form>
      <h1 style="text-align: center; padding: 7px;" class="frame text-primary fw-bold"  id="displayx">$0.00</h1>
      <!-- <span style="text-align: center; padding: 7px;"><i class="bx bx-transfer"></i></span> -->
      <h1 style="text-align: center; padding: 7px;" class="frame text-info fw-bold"  id="displayy">₦0.00</h1>
      <!-- ELC CALCULATOR DATA -->
      <input type="hidden" name="yuan_dollar_rate" id="yuan_dollar_rate" value="<?php echo $rates['yuan_dollar_rate']; ?>">
      <input type="hidden" name="naira_dollar_rate" id="naira_dollar_rate" value="<?php echo $rates['dollar_naira_rate']; ?>">
      <input type="hidden" name="domestic_transportation_cost" id="domestic_transportation_cost" value="<?php echo $rates['domestic_transportation_cost']; ?>">
      <input type="hidden" name="service_charge_percentage" id="service_charge_percentage" value="<?php echo $rates['order_rate']; ?>">
      <div class="mb-3">
        <!-- <label class="form-label" for="basic-icon-default-company">Company</label> -->
        <div class="input-group input-group-merge">
          <span class="input-group-text"><i class="bx bxs-ship"></i></span>
          <select id="shipping_plan" name="shipping_plan" class="form-select"  onChange="select_country(this)" required>
            <option value=""> - Shipping Plan- </option>
            <?php

            $conn = $pdo->open();
            try{
              $stmt = $conn->prepare("SELECT * FROM shipping_plan");
              $stmt->execute();
              foreach($stmt as $row){
                echo "
                <option myplan='".$row['slug']."' value='".$row['slug']."'>".$row['name']." (Measured by ".$row['unit']." in ".$row['si_unit'].")</option>
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
      </div>
      <div class="mb-3">
        <!-- <label class="form-label" for="basic-icon-default-company">Company</label> -->
        <div class="input-group input-group-merge">
          <span class="input-group-text"><i class='bx bx-money-withdraw'></i></span>
          <select id="currency_type" name="currency_type" class="form-select" required>
            <option value=""> - Currency - </option>
            <?php

            $conn = $pdo->open();
            try{
              $stmt = $conn->prepare("SELECT * FROM currency");
              $stmt->execute();
              foreach($stmt as $row){
                echo "
                <option value='".$row['slug']."'>(".$row['sign'].") ".$row['name']."</option>
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
      </div>
      <div class="mb-3">
        <!-- <label class="form-label" for="basic-icon-default-fullname">Full Name</label> -->
        <div class="input-group input-group-merge">
          <span class="input-group-text"><i class='bx bxs-package'></i></span>
          <input type="number" step="0.01" min="0.00" max="9999999999"  placeholder="Product (Unit) Cost ($) | (¥) in selected currency" id="costx" class="form-control" name="costx" required>
        </div>
      </div>
      <div class="mb-3">
        <!-- <label class="form-label" for="basic-icon-default-fullname">Full Name</label> -->
        <div class="input-group input-group-merge">
          <span class="input-group-text"><i class='bx bxs-arrow-to-bottom'></i></span>
          <input type="number" step="0.01" min="0.00" max="9999999999"  placeholder="Product (Unit) Weight(Kg) / Volume(CBM)" id="weightx" class="form-control" name="weightx" required>
        </div>
      </div>
      <div class="mb-3">
        <!-- <label class="form-label" for="basic-icon-default-fullname">Full Name</label> -->
        <div class="input-group input-group-merge">
          <span class="input-group-text"><i class='bx bx-cart-add'></i></span>
          <input type="number" step="1" min="0" max="9999999999"   placeholder="Product quantity to be purchased"  id="quantityx" class="form-control rounded" placeholder="e.g. 5" name="quantityx" required>
        </div>
      </div>
      <div class="mb-3">
        <!-- <label class="form-label" for="basic-icon-default-company">Company</label> -->
        <div class="input-group input-group-merge">
          <span class="input-group-text"><i class='bx bxs-analyse'></i></span>
          <select id="destination_country" name="destination_country" class="form-select" required>
            <option value=""> -Shipping Rate- </option>
            <?php

            $conn = $pdo->open();
            try{
              $stmt = $conn->prepare("SELECT * FROM shipping_rate");
              $stmt->execute();
              foreach($stmt as $row){
                echo "
                <option cbm='".$row['cbm']."' myid='".$row['myid']."' value='".$row['rate']."' rate='".$row['rate']."'>".$row['title']." ($".$row['rate']."/kg) or ($".$row['cbm']."/CBM)</option>
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
      </div>
      <div id="info1" style="color: #FFA400;"></div>
      <div id="warningxx" style="color: #FFA400;"></div><br>
      <button type="button" class="btn btn-primary" onClick="calculate_elc()"><i class="bx bx-calculator"></i> Calculate</button>
      <button type="button" class="btn btn-primary" onClick="resetx()"><i class="bx bx-reset"></i>  Reset</button>
    </form>

    <button type="button" class="btn btn-label-secondary d-grid w-100 mt-5" data-bs-dismiss="offcanvas">Close</button>
    <script src="includes/elc.js"></script>
  </div>
</div>

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
<div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="ratesSelector" aria-labelledby="ratesSelectorLabel">
  <div class="offcanvas-header">
    <h5 id="ratesSelectorLabel" class="offcanvas-title">Our Currency Conversion Rates</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body my-auto mx-0 flex-grow-0">
      <b>Naira to Dollar Rate</b> <br>
    <h2 class="text-danger">
      (<b><?php echo $settings['currency']; ?>1 ~ <?php echo $dollar['sign']; echo $row['naira_dollar_rate']; ?></b>)
    </h2>
      <b>Naira to Yuan Rate</b> <br>
    <h2 class="text-danger">
      (<b><?php echo $settings['currency']; ?>1 ~ <?php echo $yuan['sign']; echo $row['naira_yuan_rate']; ?></b>)
    </h2>
      <b>Dollar to Naira Rate</b> <br>
    <h2 class="text-danger">
      (<b><?php echo $dollar['sign']; ?>1 ~ <?php echo $settings['currency']; echo $row['dollar_naira_rate']; ?></b>)
    </h2>
      <b>Dollar to Yuan Rate</b> <br>
    <h2 class="text-danger">
      (<b><?php echo $dollar['sign']; ?>1 ~ <?php echo $yuan['sign']; echo $row['dollar_yuan_rate']; ?></b>)
    </h2>
      <b>Yuan to Naira Rate</b> <br>
    <h2 class="text-danger">
      (<b><?php echo $yuan['sign']; ?>1 ~ <?php echo $settings['currency']; echo $row['yuan_naira_rate']; ?></b>)
    </h2>
      <b>Yuan to Dollar Rate</b> <br>
    <h2 class="text-danger">
      (<b><?php echo $yuan['sign']; ?>1 ~ <?php echo $dollar['sign']; echo $row['yuan_dollar_rate']; ?></b>)
    </h2>
    <button type="button" class="btn btn-primary mt-2 d-grid w-100" data-bs-dismiss="offcanvas">Close</button>
  </div>
</div>
<?php } ?>

<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="normCalulator" aria-labelledby="normCalulatorLabel">
  <div class="offcanvas-header">
    <h5 id="ratesSelectorLabel" class="offcanvas-title">Calculator</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body my-auto mx-0 flex-grow-0">
    <style>
      .container {
        width: 100%;
        height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }

      .calculator {
        background: #1b0e39;
        padding: 20px;
        border-radius: 15px;
        margin-top: 25px;
      }

      .calculator form input {
        border: 0;
        outline: 0;
        width: 40px;
        /* height: 60px; */
        border-radius: 10px;
        box-shadow: -8px -8px 15px rgba(255, 255, 255, 0.1), 5px 5px 15px rgba(0, 0, 0, 0.2);
        font-size: 20px;
        background: transparent;
        color: #fff;
        cursor: pointer;
        margin: 8px;
      }

      form .display {
        display: flex;
        justify-content: flex-end;
        margin: 20px 0;
      }

      form .display input {
        text-align: right;
        flex: 1;
        font-size: 40px;
        /* height: 70px; */
        padding: 5px;
        border: .5px solid rgba(255, 255, 255, 0.5);
        margin-top: -4px;
        box-shadow: none;
      }

      form input.equal {
        width: 100px;
        background-color: #F5F5F5;
        color: black;
      }

      form input.yellow {
        background-color: #ff8d13e8;
        text-align: center;
      }

      form input.red {
        background-color:#FD5D5D;
      }
    </style>
    <div class="container">


      <div class="calculator">
        <form action="#">
          <div class="display">
            <input type="text" name="display">
          </div>

          <div>
            <input type="button" value="AC" class="red" onclick="display.value = ''">
            <input type="button" value="DE" class="red" onclick="display.value = display.value.toString().slice(0, -1)">
            <input type="button" value="." class="yellow" onclick="display.value += '.'">
            <input type="button" value="/" class="yellow" onclick="display.value += '/'">
          </div>


          <div>
            <input type="button" value="7" onclick="display.value += '7'">
            <input type="button" value="8" onclick="display.value += '8'">
            <input type="button" value="9" onclick="display.value += '9'">
            <input type="button" value="*" class="yellow" onclick="display.value += '*'">
          </div>


          <div>
            <input type="button" value="4" onclick="display.value += '4'">
            <input type="button" value="5" onclick="display.value += '5'">
            <input type="button" value="6" onclick="display.value += '6'">
            <input type="button" value="-" class="yellow" onclick="display.value += '-'">
          </div>


          <div>
            <input type="button" value="1" onclick="display.value += '1'">
            <input type="button" value="2" onclick="display.value += '2'">
            <input type="button" value="3" onclick="display.value += '3'">
            <input type="button" value="+" class="yellow"  onclick="display.value += '+'">
          </div>


          <div>
            <input type="button" value="00" onclick="display.value += '00'">
            <input type="button" value="0" onclick="display.value += '0'">
            <input type="button" value="=" class="equal"  onclick="display.value = eval(display.value)">
          </div>


        </form>
      </div>

    </div>
    <button type="button" class="btn btn-primary mt-2 d-grid w-100" data-bs-dismiss="offcanvas">Close</button>
  </div>
</div>
