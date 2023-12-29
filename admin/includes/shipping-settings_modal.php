<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Deleting...</b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="shipping-settings_delete">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>DELETE SHIPPING RATE</p>
                    <h2 class="bold fullname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-bs-dismiss="modal"><i class="bx bx-x"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="bx bx-trash"></i> Delete</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Add Shipping Rate</b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="shipping-settings_add">
                <div class="form-group mb-2">
                    <label class="col-sm-3 control-label">State</label>

                      <input type="text" required class="form-control" name="name">
                </div>
                <div class="form-group mb-2">
                    <label class="col-sm-3 control-label">Equal Amount (<?php echo $settings['currency'] ?>)</label>

                      <input type="number" step="any" required class="form-control" name="equal_amount">
                </div>
                <div class="form-group mb-2">
                    <label class="col-sm-3 control-label">Great Amount (<?php echo $settings['currency'] ?>)</label>

                      <input type="number" step="any" required class="form-control" name="great_amount">
                </div>
                <div class="form-group mb-2">
                    <label class="col-sm-3 control-label">Yourba State</label>
                    <select name="yourba_state" required class="form-control" id="yourba_state">
                      <option value="" disabled selected hidden>-- Select --</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-bs-dismiss="modal"><i class="bx bx-x"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="add"><i class="bx bx-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Edit Shipping Rate</b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="shipping-settings_edit">
                <input type="hidden" class="userid" name="id">
                <div class="form-group mb-2">
                    <label for="get_name" class="col-sm-3 control-label">State</label>

                      <input type="text" required class="form-control" id="get_name" name="name">
                </div>
                <div class="form-group mb-2">
                    <label for="get_equal_amount" class="col-sm-3 control-label">Equal Amount (<?php echo $settings['currency'] ?>)</label>

                      <input type="number" step="any" required class="form-control" id="get_equal_amount" name="equal_amount">
                </div>
                <div class="form-group mb-2">
                    <label for="get_great_amount" class="col-sm-3 control-label">Great Amount (<?php echo $settings['currency'] ?>)</label>

                      <input type="number" step="any" required class="form-control" id="get_great_amount" name="great_amount">
                </div>
                <div class="form-group mb-2">
                    <label for="get_yourba_state" class="col-sm-3 control-label">Yourba State</label>
                    <select name="yourba_state" required class="form-control" id="get_yourba_state">
                      <option value="" disabled selected hidden>-- Select --</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                    <!-- <i class="bx bx-cog"></i> -->
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-bs-dismiss="modal"><i class="bx bx-x"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="bx bx-check"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>
