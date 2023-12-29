<!-- Add -->
<div class="modal fade" id="addnew1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><b>Add New Admin</b></h4>
        <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="POST" action="admin_add" enctype="multipart/form-data">
            <div class="form-group mb-2">
              <label for="username" class="col-sm-3 control-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group mb-2">
              <label for="email" class="col-sm-3 control-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group mb-2">
              <label for="password" class="col-sm-3 control-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group mb-2">
              <label for="firstname" class="col-sm-3 control-label">Firstname</label>
              <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>
            <div class="form-group mb-2">
              <label for="lastname" class="col-sm-3 control-label">Lastname</label>
              <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
            <div class="form-group mb-2">
              <label for="address" class="col-sm-3 control-label">Address</label>
              <textarea class="form-control" id="address" name="address"></textarea>
            </div>
            <div class="form-group mb-2">
              <label for="contact" class="col-sm-3 control-label">Phone Number</label>
              <input type="tel" class="form-control" id="contact" name="contact">
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

    <!-- Export -->
    <div class="modal fade" id="export">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
          <h4 class="modal-title"><b>Export</b></h4>
            <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="admin_export">
                <div class="text-center">
                  <p>Export Admins Details</p>
                  <h2 class="bold">Export all admins data as CSV file?</h2>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-rounded pull-left" data-bs-dismiss="modal"><i class="bx bx-x"></i> Close</button>
                <button type="submit" class="btn btn-info btn-rounded" name="export"><i class="bx bx-check"></i>  Yes</button>
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
              <form class="form-horizontal" method="POST" action="admin_delete">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                  <p>DELETE ADMIN</p>
                  <h2 class="bold fullname username"></h2>
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

        <!-- Activate -->
        <div class="modal fade" id="activate1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              <h4 class="modal-title"><b>Verifing...</b></h4>
                <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" method="POST" action="admin_activate">
                    <input type="hidden" class="userid" name="id">
                    <div class="text-center">
                      <p>VERIFY ADMIN</p>
                      <h2 class="bold fullname"></h2>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-rounded pull-left" data-bs-dismiss="modal"><i class="bx bx-x"></i> Close</button>
                    <button type="submit" class="btn btn-success btn-rounded" name="activate"><i class="bx bx-check"></i> Activate</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!-- Unblock -->
          <div class="modal fade" id="unblock">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title"><b>Unblocking...</b></h4>
                  <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="admin_unblock">
                      <input type="hidden" class="userid" name="id">
                      <div class="text-center">
                        <p>UNBLOCK ADMIN</p>
                        <h2 class="bold fullname"></h2>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default btn-rounded pull-left" data-bs-dismiss="modal"><i class="bx bx-x"></i> Close</button>
                      <button type="submit" class="btn btn-warning btn-rounded" name="unblock"><i class="bx bx-check"></i> Unblock</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <!-- Block -->
            <div class="modal fade" id="block">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                  <h4 class="modal-title"><b>Blocking...</b></h4>
                    <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal" method="POST" action="admin_block">
                        <input type="hidden" class="userid" name="id">
                        <div class="text-center">
                          <p>BLOCK ADMIN</p>
                          <h2 class="bold fullname"></h2>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-rounded pull-left" data-bs-dismiss="modal"><i class="bx bx-x"></i> Close</button>
                        <button type="submit" class="btn btn-warning btn-rounded" name="block"><i class="bx bx-check"></i> Block</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
