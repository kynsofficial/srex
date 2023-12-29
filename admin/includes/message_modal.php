<div class="modal fade" id="details">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Message From <span class="fullname"></span></b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <b>Full Name:</b> <p id="name"></p>
                <b>Email:</b> <p id="emailre"></p>
                <b>Phone Number:</b> <p id="phonenumber"></p>
                <b>Message:</b> <p id="desc"></p>
            </div>
            <div class="modal-footer">
              <form class="form-horizontal" method="POST" action="message_read">
                <input type="hidden" class="userid" name="id">
                <button type="button" class="btn btn-default btn-rounded pull-left" data-bs-dismiss="modal"><i class="bx bx-x"></i> Close</button>
                <button type="submit" class="btn btn-success btn-rounded" name="read"><i class="bx bx-check"></i> Mark as read</button>
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
              <form class="form-horizontal" method="POST" action="message_delete">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                  <p>DELETE MESSAGE FOR</p>
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

      <div class="modal fade" id="deleteall">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title"><b>Deleting...</b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" method="POST" action="message_delete_all">
                  <div class="text-center">
                    <p>DELETE ALL MESSAGES</p>
                    <h2 class="bold">Are you sure you want to delete all messages?</h2>
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
