<!-- Description -->
<div class="modal fade" id="details">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4>Answer to <span class="fullname"></span> </h4>
            <h4 class="modal-title"><b><span class="name"></span></b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <b>Question:</b> <p id="questions"></p>
              <b>Answer:</b> <p id="answers"></p>
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
              <form class="form-horizontal" method="POST" action="faq_cat_delete">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>DELETE CATEGORY</p>
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
              <form class="form-horizontal" method="POST" action="faq_delete">
                <input type="hidden" class="userid" name="id">
                <div class="text-center">
                    <p>DELETE QUESTION</p>
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
              <h4 class="modal-title"><b>Add FAQ Category</b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="faq_cat_add">
                <div class="form-group mb-2">
                    <label class="col-sm-3 control-label">Title</label>

                      <input type="text" required class="form-control" name="title">
                </div>
                <div class="form-group mb-2">
                    <label class="col-sm-3 control-label">Subtitle</label>

                      <input type="text" required class="form-control" name="subtitle">
                </div>
                <div class="form-group mb-2">
                    <label class="col-sm-3 control-label">Icon</label>

                      <input type="text" required class="form-control" name="icon">
                      <small>Get icons from <a href="https://boxicons.com" target="_blank">Boxicons</a></small>
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
              <h4 class="modal-title"><b>Edit FAQ Catrgory</b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="faq_cat_edit">
                <input type="hidden" class="userid" name="id">
                <div class="form-group mb-2">
                    <label for="get_title" class="col-sm-3 control-label">Title</label>

                      <input type="text" required class="form-control" id="get_title" name="title">
                </div>
                <div class="form-group mb-2">
                    <label for="get_subtitle" class="col-sm-3 control-label">Subtitle</label>

                      <input type="text" required class="form-control" id="get_subtitle" name="subtitle">
                </div>
                <div class="form-group mb-2">
                    <label for="get_icon" class="col-sm-3 control-label">Icon</label>
                    <input type="text" required class="form-control" id="get_icon" name="icon">
                    <small>Get icons from <a href="https://boxicons.com" target="_blank">Boxicons</a></small>
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

<!-- Add -->
<div class="modal fade" id="addnew1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Add FAQ</b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="faq_add">
                <div class="form-group mb-2">
                    <label class="col-sm-3 control-label">Question</label>
                    <input type="text" required class="form-control" name="questions">
                </div>
                <div class="form-group mb-2">
                    <label class="col-sm-3 control-label">Category</label>
                    <select class="form-control" id="category2" name="category_id" required>
                      <option value="" selected>- Select -</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label class="col-sm-3 control-label">Answer</label>
                    <textarea class="form-control" name="answers" rows="8" cols="80"></textarea>
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
<div class="modal fade" id="edit1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Edit FAQ</b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="faq_edit">
                <input type="hidden" class="userid" name="id">
                <div class="form-group mb-2">
                    <label for="get_questions" class="col-sm-3 control-label">Question</label>
                    <input type="text" required class="form-control" id="get_questions" name="questions">
                </div>
                <div class="form-group mb-2">
                    <label for="get_category_id" class="col-sm-3 control-label">Category</label>
                    <select class="form-control" id="edit_category" name="category_id" required>
                      <option selected id="catselected"></option>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="get_answers" class="col-sm-3 control-label">Answer</label>
                    <textarea class="form-control" name="answers" id="get_answers" rows="8" cols="80"></textarea>
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
