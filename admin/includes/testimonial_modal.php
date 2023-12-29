<!-- Description -->
<div class="modal fade" id="details">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4>Testimonial from <span class="fullname"></span> </h4>
            <h4 class="modal-title"><b><span class="name"></span></b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <b>Title:</b> <p id="title"></p>
              <b>Details:</b> <p id="desc"></p>
              <b>Role:</b> <p id="role"></p>
              <b>Date Added:</b> <p id="date"></p>
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
              <form class="form-horizontal" method="POST" action="testimonials_delete">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>DELETE REVIEW</p>
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

<!-- Activate -->
<div class="modal fade" id="activate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Publishing...</b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="testimonials_activate">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>PUBLISH REVIEW</p>
                    <h2 class="bold fullname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-bs-dismiss="modal"><i class="bx bx-x"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="activate"><i class="bx bx-check"></i> Activate</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Activate -->
<div class="modal fade" id="block">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Unpublishing...</b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="testimonials_activate">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>UNPUBLISH REVIEW</p>
                    <h2 class="bold fullname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-bs-dismiss="modal"><i class="bx bx-x"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat" name="activate"><i class="bx bx-check"></i> Activate</button>
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
              <h4 class="modal-title"><b>Edit Testimonial</b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="testimonials_edit">
                <input type="hidden" class="userid" name="id">
                <div class="form-group mb-2">
                    <label for="get_name" class="col-sm-3 control-label">Name</label>

                      <input type="text" required class="form-control" id="get_name" name="name">
                </div>
                <div class="form-group mb-2">
                    <label for="get_email" class="col-sm-3 control-label">Email</label>

                      <input type="text" required class="form-control" id="get_email" name="email">
                </div>
                <div class="form-group mb-2">
                    <label for="get_role" class="col-sm-3 control-label">Role</label>

                      <input type="text" required class="form-control" id="get_role" name="role">
                </div>
                <div class="form-group mb-2">
                    <label for="get_role" class="col-sm-3 control-label">Title</label>

                      <input type="text" required class="form-control" id="get_title" name="title">
                </div>
                <div class="form-group mb-2">
                    <label for="get_review" class="col-sm-3 control-label">Message</label>

                      <textarea class="form-control" id="get_review" name="message" rows="8" cols="80" required></textarea>
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
