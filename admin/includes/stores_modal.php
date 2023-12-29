<!-- Description -->
<div class="modal fade" id="details">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4>Name - <span class="fullname"></span> </h4>
            <h4 class="modal-title"><b><span class="name"></span></b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <b>Name:</b> <p id="name"></p>
              <b>Link:</b> <p id="link"></p>
              <b>About:</b> <p id="about"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-bs-dismiss="modal"><i class="bx bx-x"></i> Close</button>
            </div>
        </div>
    </div>
</div>

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
              <form class="form-horizontal" method="POST" action="stores_delete">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>DELETE STORE</p>
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

<!-- New -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Add Store</b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="stores_add">
                <div class="form-group mb-2">
                    <label for="name" class="col-sm-3 control-label">Name</label>

                      <input type="text" required class="form-control" name="name">
                </div>
                <div class="form-group mb-2">
                    <label for="link" class="col-sm-3 control-label">Link</label>

                      <input type="url" required class="form-control" name="link">
                </div>
                <div class="form-group mb-2">
                    <label for="image" class="col-sm-3 control-label">Image</label>

                      <input type="file" required class="form-control" name="image">
                </div>
                <div class="form-group mb-2">
                    <label for="about" class="col-sm-3 control-label">About</label>
                      <textarea name="about" class="form-control" rows="8" cols="80" required></textarea>
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
              <h4 class="modal-title"><b>Edit Store</b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="stores_edit">
                <input type="hidden" class="userid" name="id">
                <div class="form-group mb-2">
                    <label for="get_name" class="col-sm-3 control-label">Name</label>

                      <input type="text" required class="form-control" id="get_name" name="name">
                </div>
                <div class="form-group mb-2">
                    <label for="get_link" class="col-sm-3 control-label">Link</label>

                      <input type="url" class="form-control" id="get_link" name="link">
                </div>
                <div class="form-group mb-2">
                    <label for="get_about" class="col-sm-3 control-label">About</label>
                      <textarea name="about" class="form-control" id="get_about" rows="8" cols="80"></textarea>
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
