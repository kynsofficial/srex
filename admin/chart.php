<?php include 'includes/head.php'; ?>
<link rel="stylesheet" href="../assets/vendor/libs/tagify/tagify.css" />
<?php
  // Total Pay Supplier Amount
  $stmt = $conn->prepare("SELECT amount FROM pay_supplier WHERE status = 1 ");
  $stmt->execute();

  $total_paysuppliers_amount_o = 0;
  foreach ($stmt as $key1) {
    $subtotal_paysuppliers_amount_o = $key1['amount'];
    $total_paysuppliers_amount_o += $subtotal_paysuppliers_amount_o;
  }

  $total_paysuppliers_amount = $total_paysuppliers_amount_o * $rates['yuan_dollar_rate'];

  // Total Order Amount in USD
  $stmt1 = $conn->prepare("SELECT usd_amount FROM orders WHERE status = 1 ");
  $stmt1->execute();

  $total_orders_amount = 0;
  foreach ($stmt1 as $key2) {
    $subtotal_orders_amount = $key2['usd_amount'];
    $total_orders_amount += $subtotal_orders_amount;
  }

  $total_used_in_chart = $total_orders_amount + $total_paysuppliers_amount;
?>
    <div class="row">
      <!-- Total Income -->
      <div class="col-md-12 col-lg-12 mb-4">
        <div class="card">
          <div class="row row-bordered g-0">
            <div class="col-md-8">
              <div class="card-header">
                <h5 class="card-title mb-0">Total Income</h5>
                <small class="card-subtitle">Yearly report overview</small>
              </div>
              <div class="card-body">
                <div id="totalIncomeChart"></div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card-header d-flex justify-content-between">
                <div>
                  <h5 class="card-title mb-0">Report</h5>
                  <small class="card-subtitle">Monthly Avg. <?php echo $settings['currency']; ?><?php echo number_format_short($total_orders_amount + $total_paysuppliers_amount / 12, 2); ?></small>
                </div>
              </div>
              <div class="card-body">
                <div class="report-list">
                  <div class="report-list-item rounded-2 mb-3">
                    <div class="d-flex align-items-start">
                      <div class="report-list-icon shadow-sm me-2">
                        <img src="../assets/img/icons/unicons/cube-secondary.png" width="22" height="22" alt="Paypal">
                      </div>
                      <div class="d-flex justify-content-between align-items-end w-100 flex-wrap gap-2">
                        <div class="d-flex flex-column">
                          <span>Orders</span>
                          <h5 class="mb-0"><?php echo $settings['currency']; ?><?php echo number_format_short($total_orders_amount, 2); ?></h5>
                        </div>
                        <!-- <small class="text-success">+2.34k</small> -->
                      </div>
                    </div>
                  </div>
                  <div class="report-list-item rounded-2">
                    <div class="d-flex align-items-start">
                      <div class="report-list-icon shadow-sm me-2">
                        <span class="avatar-initial text-success"><i class='bx bx-dollar'></i></span>
                      </div>
                      <div class="d-flex justify-content-between align-items-end w-100 flex-wrap gap-2">
                        <div class="d-flex flex-column">
                          <span>Pay Supplier</span>
                          <h5 class="mb-0"><?php echo $settings['currency']; ?><?php echo number_format_short($total_paysuppliers_amount, 2); ?></h5>
                        </div>
                        <!-- <small class="text-danger">-1.15k</small> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/ Total Income -->
      </div>
      <!--/ Total Income -->
    </div>

    <?php
      $today = date('Y-m-d');
      $year = date('Y');
      if(isset($_GET['year'])){
        $year = $_GET['year'];
      }
      $months = array();
      $sales = array();
      $one = 1;
      $two = 2;
      for( $m = 1; $m <= 12; $m++ ) {
        try{

          $stmt = $conn->prepare(
            "SELECT usd_amount FROM orders WHERE MONTH(date_created)=:month AND YEAR(date_created)=:year AND status = 1 UNION SELECT amount*:rates AS payAmount FROM pay_supplier WHERE MONTH(date_created)=:month AND YEAR(date_created)=:year AND status = 1 "
          );
          $stmt->execute(['month'=>$m, 'year'=>$year, 'rates'=>$rates['yuan_dollar_rate']]);

          $total = 0;
          foreach($stmt as $srow){
            $subtotal = $srow['usd_amount'];
            $total += $subtotal;
          }
          array_push($sales, $total);
          $sales = array_map(function($num){return $num;}, $sales);
        }
        catch(PDOException $e){
          echo $e->getMessage();
        }

        $num = str_pad( $m, 2, 0, STR_PAD_LEFT );
        $month =  date('M', mktime(0, 0, 0, $m, 1));

        array_push($months, $month);
      }

      // echo "Max is ". $total;
      $months = json_encode($months);
      $sales = json_encode($sales);

      echo $months;
      echo $sales;

    ?>
<br>
<div class="mb-3">
      <?php
      // $conn = $pdo->open();
      //
      // try{
      //   $i = 1;
      //   $stmt = $conn->prepare("SELECT * FROM users WHERE type = 0");
      //   $stmt->execute();
      //   // $stmt = $conn->prepare("SELECT * FROM settings WHERE id = 1");
      //   // $stmt->execute();
      //   // $settings = $stmt->fetch();
      //   echo "[";
      //   foreach($stmt as $users){ $i++;
      //     if ($users['photo'] == "") {
      //       $img = $settings['site_url'].'assets/img/avatars/profile.jpg';
      //     }
      //     elseif ($users['google_id'] !== "") {
      //       $img = $users['photo'];
      //     }
      //     else{
      //       $img = $settings['site_url'].'assets/img/avatars/'.$users['photo'];
      //     }
          ?>
          <!-- {
            value:<?php //echo $i++; ?>,
            name:"<?php //echo $users['firstname'].' '.$users['lastname']; ?>",
            avatar:"<?php //echo $img; ?>",
            email:"<?php //echo $users['email']; ?>"
          }, -->
      <?php
    // }
    // echo '{
    //   value:1,
    //   name:"Default",
    //   avatar:"'.$settings['site_url'].'assets/img/core/'.$settings['favicon'].'",
    //   email:"'.$settings['admin_email'].'"
    // }]';
    //   }
    //   catch(PDOException $e){
    //     echo $e->getMessage();
    //   }
    //
    //   $pdo->close();
      ?>
</div>
<!-- <div class="mb-3">
  <div class="col-md-12 mb-4">
    <label for="TagifyUserList" class="form-label">Users List</label>
    <input id="TagifyUserList" name="TagifyUserList" class="form-control" />
  </div>
</div> -->
<?php echo "<b>Total is ". $total_used_in_chart. "</b>"; ?>
<br>
<?php

if ($total_used_in_chart < 10) {
  echo "<br>Max 10";
  echo "<br>Min 10";
  $new_max = 10;
  $new_min = 10;
}elseif ($total_used_in_chart < 50) {
  echo "<br>Max 50";
  echo "<br>Min 10";
  $new_max = 50;
  $new_min = 10;
}elseif ($total_used_in_chart < 100) {
  echo "<br>Max 100";
  echo "<br>Min 10";
  $new_max = 100;
  $new_min = 10;
}elseif ($total_used_in_chart < 1000) {
  echo "<br>Max 1000";
  echo "<br>Min 10";
  $new_max = 1000;
  $new_min = 10;
}elseif ($total_used_in_chart > 1000) {
  echo "<br>Max ".floor($total_used_in_chart + 200);
  echo "<br>Min 10";
  $new_max = floor($total_used_in_chart + 200);
  $new_min = 5;
}

?>


<?php include 'includes/scripts.php'; ?>
<script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>
<script src="../assets/vendor/libs/tagify/tagify.js"></script>
<script>
<?php include 'includes/forms-tagify.js'; ?>
</script>
<script>
<?php include 'includes/script.js'; ?>
</script>
