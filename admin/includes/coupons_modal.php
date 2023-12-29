<!-- Add -->
<div class="modal fade" id="addnew1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><b>Add New Coupon</b></h4>
        <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="POST" action="coupon_add" enctype="multipart/form-data">
            <div class="form-group mb-3">
              <label for="coupon_code" class="col-sm-6 control-label">Coupon Code</label>
              <input type="text" class="form-control" id="new_coupon_code" name="coupon_code" required>
              <button type="button" class="btn btn-sm btn-warning mt-2" onclick="generate()" name="button">Generate</button>
            </div>
            <div class="form-group mb-3">
              <label for="value" class="col-sm-6 control-label">Type</label>
              <select class="form-select" name="type" required>
                <option value="">Choose Type</option>
                <option value="0">Shippments</option>
                <option value="1">Pay Supplier</option>
              </select>
            </div>
            <div class="form-group mb-3">
              <label class="col-sm-6 control-label">Coupon Value Type</label>
              <div class="col mt-2">
                <div class="form-check form-check-inline">
                  <input name="value_type" class="form-check-input" onchange="chooseAmount()" type="radio" value="1" id="amount" checked required />
                  <label class="form-check-label" for="amount">Amount Off</label>
                </div>
                <div class="form-check form-check-inline">
                  <input name="value_type" class="form-check-input" onchange="choosePercentage()" type="radio" value="0" id="percentage" required />
                  <label class="form-check-label" for="percentage">Percentage Off</label>
                </div>
              </div>
            </div>
            <script>
            function chooseAmount(){
              var currency_select =  document.getElementById('currency_select');
              currency_select.style.display = "block";
              var value_input = document.getElementById('value');
              value_input.removeAttribute("max", 0);
            }
              function choosePercentage(){
               var currency_select =  document.getElementById('currency_select');
               currency_select.style.display = "none";
               document.getElementById('currency').required = false;
               var value_input = document.getElementById('value');
               value_input.max = 100;
              }
            </script>
            <div class="form-group mb-3" id="currency_select">
              <label for="currency" class="col-sm-6 control-label">Currency</label>
              <select id="currency" name="currency" class="form-select" required>
                <option value=""> - Select - </option>
                <?php

                $conn = $pdo->open();
                try{
                  $stmt = $conn->prepare("SELECT * FROM currency");
                  $stmt->execute();
                  foreach($stmt as $row){
                    echo "
                    <option value='".$row['id']."'>(".$row['sign'].") ".$row['name']."</option>
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
            <div class="form-group mb-3">
              <label for="value" class="col-sm-6 control-label">Value</label>
              <input type="number" class="form-control" id="value" step="any" name="value" required>
            </div>
            <div class="form-group mb-3">
              <label for="validity" class="col-sm-6 control-label">Validity [Times of Usage]</label>
              <input type="number" value="1" class="form-control" id="validity" name="validity" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-rounded pull-left" data-bs-dismiss="modal"><i class="bx bx-x"></i> Close</button>
            <button type="submit" class="btn btn-primary btn-rounded" name="add"><i class="bx bx-save"></i> Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    function generate() {
      let length = 16;
      const characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMANOPRSTUVWXYZ0123456789';
      let result = '';
      const charactersLength = characters.length;
      for (let i = 0; i < length; i++) {
        result +=
        characters.charAt(Math.floor(Math.random() * charactersLength));
      }
      document.getElementById('new_coupon_code').value =result
    }
  </script>

  <!-- Edit -->
  <div class="modal fade" id="edit1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title"><b>Edit Coupon Code</b></h4>
          <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" method="POST" action="coupon_edit">
              <input type="hidden" class="userid" name="id">
              <div class="form-group mb-3">
                <label for="coupon_code" class="col-sm-6 control-label">Coupon Code</label>
                <input type="text" class="form-control" id="edit_coupon_code" name="coupon_code" required>
              </div>
              <div class="form-group mb-3">
                <label class="col-sm-6 control-label">Type</label>
                <select class="form-select" id="edit_type" name="type" required>
                  <option value="">Choose Type</option>
                  <option value="0">Shippments</option>
                  <option value="1">Pay Supplier</option>
                </select>
              </div>
              <div class="form-group mb-3">
                <label class="col-sm-6 control-label">Coupon Value Type</label>
                <div class="col mt-2">
                  <div class="form-check form-check-inline">
                    <input name="value_type" class="form-check-input" onchange="chooseAmount1()" type="radio" value="1" id="edit_value_typea" required />
                    <label class="form-check-label" for="edit_value_typea">Amount Off</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input name="value_type" class="form-check-input" onchange="choosePercentage1()" type="radio" value="0" id="edit_value_typep" required />
                    <label class="form-check-label" for="edit_value_typep">Percentage Off</label>
                  </div>
                </div>
              </div>
              <script>
              function chooseAmount1(){
                var edit_currency_select =  document.getElementById('edit_currency_select');
                edit_currency_select.style.display = "block";
                var edit_value = document.getElementById('edit_value');
                edit_value.removeAttribute("max", 0);
              }
                function choosePercentage1(){
                 var edit_currency_select =  document.getElementById('edit_currency_select');
                 edit_currency_select.style.display = "none";
                 document.getElementById('edit_currency').required = false;
                 var edit_value = document.getElementById('edit_value');
                 edit_value.max = 100;
                }
              </script>
              <div class="form-group mb-3" id="edit_currency_select">
                <label for="currency" class="col-sm-6 control-label">Currency</label>
                <select id="edit_currency" name="currency" class="form-select" required>
                  <option value=""> - Select - </option>
                  <?php

                  $conn = $pdo->open();
                  try{
                    $stmt = $conn->prepare("SELECT * FROM currency");
                    $stmt->execute();
                    foreach($stmt as $row){
                      echo "
                      <option value='".$row['id']."'>(".$row['sign'].") ".$row['name']."</option>
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
              <div class="form-group mb-3">
                <label for="value" class="col-sm-6 control-label">Value</label>
                <input type="number" class="form-control" id="edit_value" step="any" name="value" required>
              </div>
              <div class="form-group mb-3">
                <label for="validity" class="col-sm-6 control-label">Validity [Times of Usage]</label>
                <input type="number" value="1" class="form-control" id="edit_validity" name="validity" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-rounded pull-left" data-bs-dismiss="modal"><i class="bx bx-x"></i> Close</button>
              <button type="submit" class="btn btn-success btn-rounded" name="edit"><i class="bx bx-check"></i> Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Delete -->
    <div class="modal fade" id="delete1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
          <h4 class="modal-title"><b>Deleting...</b></h4>
            <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="coupon_delete">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                  <p>DELETE COUPON</p>
                  <h2 class="bold fullname"></h2>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-rounded pull-left" data-bs-dismiss="modal"><i class="bx bx-x"></i> Close</button>
                <button type="submit" class="btn btn-danger btn-rounded" name="delete"><i class="bx bx-trash"></i> Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>
