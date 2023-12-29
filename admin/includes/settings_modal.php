<!-- Update Favicon -->
<div class="modal fade" id="edit_favicon">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Edit Favicon Image</b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="settings_favicon_edit" enctype="multipart/form-data">
                <input type="hidden" value="1" name="id">
                <p class="text-danger">Recommend Image Size is 50px * 50px</p>
                <div class="mb-3">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="favicon" name="favicon" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-bs-dismiss="modal"><i class="bx bx-x"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="bx bx-check"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Logo 1 -->
<div class="modal fade" id="edit_logo1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title"><b>Edit Logo1 Image</b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="settings_logo1_edit" enctype="multipart/form-data">
                <input type="hidden" value="1" name="id">
                <p class="text-danger">Recommend Image Size is 250px * 44px</p>
                <div class="mb-3">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="logo" name="logo" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-bs-dismiss="modal"><i class="bx bx-x"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="bx bx-check"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Favicon -->
<div class="modal fade" id="edit_logo2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Edit Logo2 Image</b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="settings_logo2_edit" enctype="multipart/form-data">
                <input type="hidden" value="1" name="id">
                <p class="text-danger">Recommend Image Size is 250px * 44px</p>
                <div class="mb-3">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="logo_light" name="logo_light" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-bs-dismiss="modal"><i class="bx bx-x"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="bx bx-check"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit 3 -->
<div class="modal fade" id="edit3">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Edit Social Media</b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="about3_edit">
                <input type="hidden" class="userid" value="1" name="id">

                <div class="mb-3">
                    <label for="edit_name" class="col-sm-3 control-label">Whatsapp <i class="bx bxl-whatsapp"></i> </label>

                      <input type="text" class="form-control" value="<?php echo $about['whatsapp']; ?>" name="whatsapp" required>
                </div>

                <div class="mb-3">
                    <label for="edit_name" class="col-sm-3 control-label">Facebook <i class="bx bxl-facebook"></i> </label>

                      <input type="text" class="form-control" value="<?php echo $about['facebook']; ?>" name="facebook" required>
                </div>

                <div class="mb-3">
                    <label for="edit_name" class="col-sm-3 control-label">Twitter <i class="bx bxl-twitter"></i></label>

                      <input type="text" class="form-control" value="<?php echo $about['twitter']; ?>" name="twitter" required>
                </div>

                <div class="mb-3">
                    <label for="edit_name" class="col-sm-3 control-label">Instagram <i class="bx bxl-instagram"></i></label>

                      <input type="text" class="form-control" value="<?php echo $about['instagram']; ?>" name="instagram" required>
                </div>

                <div class="mb-3">
                    <label for="edit_name" class="col-sm-3 control-label">Email <i class="bx bx-envelope"></i></label>

                      <input type="text" class="form-control" value="<?php echo $about['email']; ?>" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="edit_name" class="col-sm-3 control-label">Tawk <i class="bx bx-comment"></i></label>

                      <input type="text" class="form-control" value="<?php echo $about['tawk_link']; ?>" name="tawk_link" required>
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

<!-- Edit 3 -->
<div class="modal fade" id="edit4">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Edit General Information</b></h4>
              <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="about3_edit">
                <input type="hidden" class="userid" value="1" name="id">
                <div class="mb-3">
                    <label for="edit_name" class="col-sm-3 control-label">Notification</label>
                    <textarea name="gen_notification" id="description" hidden><?php echo $settings['gen_notification']; ?></textarea>
                    <div id="full-editor">
                      <?php echo $settings['gen_notification']; ?>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-bs-dismiss="modal"><i class="bx bx-x"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" onclick="getContents()" name="edit_notification"><i class="bx bx-check"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>
<script>
  function getContents() {
    var myEditor = document.querySelector('#full-editor');
    var html = myEditor.children[0].innerHTML;
    document.getElementById("description").value = html;
    // alert(html);
  }
</script>
