<!-- Description -->
<div class="modal fade" id="details">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4>Title <span class="fullname"></span> </h4>
            <h4 class="modal-title"><b><span class="name"></span></b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <b>Title:</b> <p id="title"></p>
              <b>Details:</b> <p id="link"></p>
              <b>Preview:</b>
              <iframe id="vid" width="100%" height='200px' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen>Loading Preview...</iframe>
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
              <form class="form-horizontal" method="POST" action="videos_delete">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>DELETE VIDEO</p>
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
              <h4 class="modal-title"><b>Add Video</b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="videos_add">
                <div class="form-group mb-2">
                    <label for="title" class="col-sm-3 control-label">Title</label>

                      <input type="text" required class="form-control" name="title">
                </div>
                <div class="form-group mb-2">
                    <label for="link" class="col-sm-3 control-label">Link</label>

                      <input type="url" required class="form-control" name="link">
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
              <h4 class="modal-title"><b>Edit Video</b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="videos_edit">
                <input type="hidden" class="userid" name="id">
                <div class="form-group mb-2">
                    <label for="get_title" class="col-sm-3 control-label">Title</label>

                      <input type="text" required class="form-control" id="get_title" name="title">
                </div>
                <div class="form-group mb-2">
                    <label for="get_link" class="col-sm-3 control-label">Link</label>

                      <input type="url" required class="form-control" id="get_link" name="link">
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
