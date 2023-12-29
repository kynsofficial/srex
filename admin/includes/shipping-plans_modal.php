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
              <form class="form-horizontal" method="POST" action="shipping-plans_delete">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>DELETE SHIPPING PLAN</p>
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
              <h4 class="modal-title"><b>Add Shipping Plan</b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="shipping-plans_add">
                <div class="form-group mb-2">
                    <label class="col-sm-3 control-label">Name</label>

                      <input type="text" required class="form-control" name="name">
                </div>
                <div class="form-group mb-2">
                    <label class="col-sm-3 control-label">Unit</label>

                      <input type="text" required class="form-control" name="unit">
                </div>
                <div class="form-group mb-2">
                    <label class="col-sm-3 control-label">SI Unit</label>

                      <input type="text" required class="form-control" name="si_unit">
                </div>
                <div class="form-group mb-2">
                    <label class="col-sm-3 control-label">Price ($)</label>

                      <input type="number" required class="form-control" name="price">
                </div>
                <div class="form-group mb-2">
                    <label class="col-sm-3 control-label">Info</label>
                    <textarea class="form-control" name="info" rows="8" cols="80"></textarea>
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
              <h4 class="modal-title"><b>Edit Shipping Plan</b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="shipping-plans_edit">
                <input type="hidden" class="userid" name="id">
                <div class="form-group mb-2">
                    <label for="get_name" class="col-sm-3 control-label">Name</label>

                      <input type="text" required class="form-control" id="get_name" name="name">
                </div>
                <div class="form-group mb-2">
                    <label for="get_unit" class="col-sm-3 control-label">Unit</label>

                      <input type="text" required class="form-control" id="get_unit" name="unit">
                </div>
                <div class="form-group mb-2">
                    <label for="get_si_unit" class="col-sm-3 control-label">SI Unit</label>
                    <input type="text" required class="form-control" id="get_si_unit" name="si_unit">
                    <!-- <i class="bx bx-cog"></i> -->
                </div>
                <div class="form-group mb-2">
                    <label class="col-sm-3 control-label">Price ($)</label>

                      <input type="number" required class="form-control" id="get_price"  name="price">
                </div>
                <div class="form-group mb-2">
                    <label class="col-sm-3 control-label">Info</label>
                    <textarea class="form-control" id="get_info" rows="8" cols="80" name="info"></textarea>
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
