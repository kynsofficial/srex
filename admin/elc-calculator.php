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
          <h4 class="fw-bold py-3 mb-4"> <span class="text-muted fw-light">Misc / </span>ELC Calculator</h4>

          <!-- Basic Layout -->
          <div class="row">
            <div class="col-xl-8">
              <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">ELC Calculator</h5>
                  <small class="text-muted float-end">Estimated Landing Cost</small>
                </div>
                <div class="card-body">
                  <?php
                  $conn = $pdo->open();
                  try{
                    $stmt = $conn->prepare("SELECT * FROM elc_calculator WHERE id = 1");
                    $stmt->execute();
                    $calculator = $stmt->fetch();
                  }
                  catch(PDOException $e){
                    echo "There is some problem in connection: " . $e->getMessage();
                  }
                  $pdo->close();
                  ?>
                  <form>
                    <h1 style="text-align: center; padding: 7px;" class="frame text-primary fw-bold"  id="displayx">$0.00</h1>
                    <!-- <span style="text-align: center; padding: 7px;"><i class="bx bx-transfer"></i></span> -->
                    <h1 style="text-align: center; padding: 7px;" class="frame text-info fw-bold"  id="displayy">₦0.00</h1>
                    <!-- ELC CALCULATOR DATA -->
                    <input type="hidden" name="yuan_dollar_rate" id="yuan_dollar_rate" value="<?php echo $calculator['yuan_dollar_rate']; ?>">
                    <input type="hidden" name="naira_dollar_rate" id="naira_dollar_rate" value="<?php echo $calculator['naira_dollar_rate']; ?>">
                    <input type="hidden" name="domestic_transportation_cost" id="domestic_transportation_cost" value="<?php echo $calculator['domestic_transportation_cost']; ?>">
                    <input type="hidden" name="service_charge_percentage" id="service_charge_percentage" value="<?php echo $calculator['service_charge_percentage']; ?>">
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
                </div>
              </div>
            </div>
            <div class="col-xl-4">
              <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">About</h5> <small class="text-muted float-end">ELC Calculator</small>
                </div>
                <div class="card-body">
                  <p>The ELC Calculator is used for calculating in real time the Estimated Landing
                    Cost for procuring and shipping your inteded goods from various stores via our logistics
                    service.</p>
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
  <script>


  //ELC CALCULATOR
  function calculate_elc(select){

    //shipping plan
    var g = document.getElementById("shipping_plan");
    var shipping_plan = g.options[g.selectedIndex].value;

    //destination country & rate
    var e = document.getElementById("destination_country");
    var ratex = e.options[e.selectedIndex].value;
    var ratex_cbm = e.options[e.selectedIndex].getAttribute('cbm');
    var countryx = e.options[e.selectedIndex].getAttribute('myid');

    //currency type
    var f = document.getElementById("currency_type");
    var currencyx = f.options[f.selectedIndex].value;


    //shipping variables
    var costx = document.getElementById("costx").value;
    var quantityx = document.getElementById("quantityx").value;
    var weightx = document.getElementById("weightx").value;

    //verify input values
    if(costx == "" || quantityx == "" || weightx == "" || ratex == "" || currencyx == "" || shipping_plan == ""){

      //display warning
      document.getElementById("warningxx").innerHTML = "You have missing field(s), provide the value(s) above</span>"; exit;
    }
    else
    {
      //display warning
      document.getElementById("warningxx").innerHTML = "";
    }

    //calculation parameters
    var costx = parseFloat(document.getElementById("costx").value);
    var quantityx = parseFloat(document.getElementById("quantityx").value);
    var weightx = parseFloat(document.getElementById("weightx").value);



    //shipping & clearing rate (scr)
    var isc = ratex; //International shipping cost (Dollar/KG)
    var dtc = parseFloat(document.getElementById("domestic_transportation_cost").value); //Domestic transportation cost ($10 per product)
    var ex_rate_yuan_dollar = parseFloat(document.getElementById("yuan_dollar_rate").value); //yuan to dollar
    var ex_rate_naira_dollar = parseFloat(document.getElementById("naira_dollar_rate").value); //yuan to dollar
    var percentage = parseFloat(document.getElementById("service_charge_percentage").value);
    var service_charge_percentage = parseFloat(percentage/100);


    //CONDITION TO MANAGE SEA SHIPPING ONLY TO NIGERIA FOR NOW
    if(shipping_plan == "air"){}
    if(shipping_plan == "sea"){ratex = ratex_cbm;}
    if((shipping_plan == "sea") && (countryx !== "nigeria")){
      document.getElementById("info1").innerHTML = "The selected Shipping Plan can only be calculated for Nigeria ";exit;
    }


    //calculate for Dollar price
    if(currencyx == "Dollar")
    {
      var elc = costx + (costx * service_charge_percentage) + (weightx * ratex) + dtc;
      elc = (parseFloat(elc) * quantityx).toFixed(2);
      elc = parseFloat(elc);

      var elcn = (costx + (costx * service_charge_percentage) + (weightx * ratex) + dtc) * ex_rate_naira_dollar;
      elcn = (parseFloat(elcn) * quantityx).toFixed(2);
      elcn = parseFloat(elcn);

      //format for proper display in dollar currency
      var elcx = '$' + elc.toLocaleString();
      var toNaira = '<?php echo $settings['currency']; ?>' + elcn.toLocaleString();

      //display result
      document.getElementById("displayx").innerHTML = elcx;
      document.getElementById("displayy").innerHTML = toNaira;
      document.getElementById("info1").innerHTML = "";
    }

    //calculate for Yuan price
    if(currencyx == "Yuan")
    {
      var elc = (costx * ex_rate_yuan_dollar) + ((costx * ex_rate_yuan_dollar) * service_charge_percentage) + (weightx * ratex) + dtc;
      elc = (parseFloat(elc) * quantityx).toFixed(2);
      elc = parseFloat(elc);

      var elcn = ((costx * ex_rate_yuan_dollar) + ((costx * ex_rate_yuan_dollar) * service_charge_percentage) + (weightx * ratex) + dtc) * ex_rate_naira_dollar;
      elcn = (parseFloat(elcn) * quantityx).toFixed(2);
      elcn = parseFloat(elcn);

      //format for proper display in dollar currency
      var elcx = '$' + elc.toLocaleString();
      var toNaira = '<?php echo $settings['currency']; ?>' + elcn.toLocaleString() ;

      //display result
      document.getElementById("displayx").innerHTML = elcx;
      document.getElementById("displayy").innerHTML = toNaira;
      document.getElementById("info1").innerHTML = "";
    }
  }

  //DYNAMICALLY SELECT A COUNTRY FOR USER
  function select_country(select)
  {
    var my_planx = select.options[select.selectedIndex].getAttribute("myplan");

    if(my_planx == "sea"){
      //dynamically select a country for user
      $("#destination_country [myid='nigeria']").attr("selected","selected");
      document.getElementById("info1").innerHTML = "For now, our calculator does not provide calculation for Sea Shiping outside Nigeria. This means, for a Sea Shipping Plan, destination must be Nigeria as selected.";
    }
    else{
      //document.getElementById("info1").innerHTML = "";
    }
  }

  //RESET BUTTON
  function resetx()
  {
    //reset and empty fields
    document.getElementById("costx").value = "";
    document.getElementById("quantityx").value = "";
    document.getElementById("weightx").value = "";
    document.getElementById("destination_country").value = "";
    document.getElementById("shipping_plan").value = "";
    document.getElementById("currency_type").value = "";
    document.getElementById("displayx").innerHTML = "$0.00";
    document.getElementById("displayy").innerHTML = "<?php echo $settings['currency']; ?>0.00";
  }

</script>
</body>
</html>
