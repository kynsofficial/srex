<?php include 'includes/head.php'; ?>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar  ">
    <div class="layout-container">
      <!-- Menu -->
      <?php include 'includes/sidebar.php'; ?>
      <!-- / Menu -->
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>
          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
              <div class="nav-item navbar-search-wrapper mb-0">
                <!-- <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);">
                  <i class="bx bx-search bx-sm"></i>
                  <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
                </a> -->
              </div>
            </div>
            <!-- /Search -->
            <ul class="navbar-nav flex-row align-items-center ms-auto">

              <!-- Style Switcher -->
              <li class="nav-item me-2 me-xl-0">
                <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                  <i class='bx bx-sm'></i>
                </a>
              </li>
              <!--/ Style Switcher -->

              <?php include 'includes/notification.php'; ?>

              <?php include 'includes/user-profile.php'; ?>
            </ul>
          </div>

          <!-- Search Small Screens -->
          <div class="navbar-search-wrapper search-input-wrapper  d-none">
            <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..." aria-label="Search...">
            <i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
          </div>
        </nav>
        <!-- / Navbar -->
        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="app-chat overflow-hidden card">
              <div class="row g-0">
                <!-- Sidebar Left -->
                <div class="col app-chat-sidebar-left app-sidebar overflow-hidden" id="app-chat-sidebar-left">
                  <div class="chat-sidebar-left-user sidebar-header d-flex flex-column justify-content-center align-items-center flex-wrap p-4 mt-2">
                    <?php
                      if ($admin['photo'] == "") {
                        echo '
                            <div class="avatar avatar-xl avatar-online">
                              <span class="avatar-initial rounded-circle bg-label-success">'.$admin['username'][0].'</span>
                            </div>
                        ';
                      }
                      else{
                        echo '
                          <div class="avatar avatar-xl avatar-online">
                            <img src="'.$settings['site_url'].'assets/img/avatars/'.$admin['photo'].'" alt="Avatar" class="rounded-circle">
                          </div>
                        ';
                      }
                    ?>
                    <h5 class="mt-3 mb-1"><?php echo $admin['firstname']." ".$admin['lastname']; ?></h5>
                    <small class="text-muted"><?php echo $admin['username']; ?></small>
                    <i class="bx bx-x bx-sm cursor-pointer close-sidebar me-1 fs-4 " data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-left"></i>
                  </div>
                  <div class="sidebar-body px-4 pb-4">
                    <div class="my-3">
                      <span class="text-muted text-uppercase">About</span>
                      <textarea id="chat-sidebar-left-user-about" class="form-control chat-sidebar-left-user-about mt-2" rows="4" maxlength="120"><?php echo $admin['about']; ?></textarea>
                    </div>
                    <div class="my-4">
                      <span class="text-muted text-uppercase">Settings</span>
                      <ul class="list-unstyled d-grid gap-2 mt-2">
                        <li class="d-flex justify-content-between align-items-center">
                          <div>
                            <i class='bx bx-bell me-1'></i>
                            <span class="align-middle">Notification</span>
                          </div>
                          <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" id="switchNotification" checked>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <div class="d-flex mt-4">
                      <button class="btn btn-primary" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-left">Save</button>
                    </div>
                  </div>
                </div>
                <!-- /Sidebar Left-->

                <!-- Chat & Contacts -->
                <div class="col app-chat-contacts app-sidebar flex-grow-0 overflow-hidden border-end" id="app-chat-contacts">
                  <div class="sidebar-header pt-3 px-3 mx-1">
                    <div class="d-flex align-items-center me-3 me-lg-0">

                      <?php
                        if ($admin['photo'] == "") {
                          echo '
                            <div class="flex-shrink-0 mt-n2" data-bs-toggle="sidebar" data-overlay="app-overlay-ex" data-target="#app-chat-sidebar-left">
                              <div class="avatar avatar-md avatar-online">
                                <span class="avatar-initial rounded-circle bg-label-success">'.$admin['username'][0].'</span>
                              </div>
                            </div>
                          ';
                        }
                        else{
                          echo '
                            <div class="flex-shrink-0 avatar avatar-online me-2" data-bs-toggle="sidebar" data-overlay="app-overlay-ex" data-target="#app-chat-sidebar-left">
                              <img class="user-avatar rounded-circle cursor-pointer" src="'.$settings['site_url'].'assets/img/avatars/'.$admin['photo'].'" alt="Avatar">
                            </div>
                          ';
                        }
                      ?>

                      <div class="flex-grow-1 input-group input-group-merge rounded-pill ms-1">
                        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search fs-4"></i></span>
                        <input type="text" class="form-control chat-search-input" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
                      </div>
                    </div>
                    <i class="bx bx-x cursor-pointer position-absolute top-0 end-0 mt-2 me-1 fs-4 d-lg-none d-block" data-overlay data-bs-toggle="sidebar" data-target="#app-chat-contacts"></i>
                  </div>
                  <hr class="container-m-nx mt-3 mb-0">
                  <div class="sidebar-body">

                    <!-- Chats -->
                    <ul class="list-unstyled chat-contact-list pt-1" id="chat-list">
                      <li class="chat-contact-list-item chat-contact-list-item-title">
                        <h5 class="text-primary mb-0">Chats</h5>
                      </li>
                      <li class="chat-contact-list-item chat-list-item-0 d-none">
                        <h6 class="text-muted mb-0">No Chats Found</h6>
                      </li>
                      <?php
                      $conn = $pdo->open();
                      try{
                        $stmt = $conn->prepare("SELECT * FROM users WHERE type=:type LIMIT 1");
                        $stmt->execute(['type'=>0]);
                      }
                      catch(PDOException $e){
                        echo $e->getMessage();
                      }

                        $pdo->close();
                      ?>
                      <?php foreach ($stmt as $admin_user): ?>
                        <li class="chat-contact-list-item">
                          <a class="d-flex align-items-center">

                            <?php
                              if ($admin_user['photo'] == "") {
                                echo '
                                  <div class="flex-shrink-0 mt-n2">
                                    <div class="avatar avatar-md avatar-online">
                                      <span class="avatar-initial rounded-circle bg-label-success">'.$admin_user['username'][0].'</span>
                                    </div>
                                  </div>
                                ';
                              }
                              else{
                                echo '
                                  <div class="flex-shrink-0 avatar avatar-online">
                                    <img src="'.$settings['site_url'].'assets/img/avatars/'.$admin_user['photo'].'" alt="Avatar" class="rounded-circle">
                                  </div>
                                ';
                              }
                            ?>



                            <div class="chat-contact-info flex-grow-1 ms-3">
                              <h6 class="chat-contact-name text-truncate m-0"><?php echo $admin_user['firstname']." ".$admin_user['lastname']; ?></h6>
                              <p class="chat-contact-status text-truncate mb-0 text-muted"><?php echo $admin_user['username']; ?></p>
                            </div>
                            <small class="text-muted mb-auto">Online</small>
                          </a>
                        </li>
                      <?php endforeach; ?>

                    </ul>
                  </div>
                </div>
                <!-- /Chat contacts -->

                <!-- Chat History -->
                <div class="col app-chat-history">
                  <div class="chat-history-wrapper">
                    <div class="chat-history-header border-bottom">
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex overflow-hidden align-items-center">
                          <i class="bx bx-menu bx-sm cursor-pointer d-lg-none d-block me-2" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-contacts"></i>
                          <?php
                            if ($admin_user['photo'] == "") {
                              echo '
                                <div class="flex-shrink-0 mt-n2">
                                  <div class="avatar avatar-md avatar-online">
                                    <span class="avatar-initial rounded-circle bg-label-success" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right">'.$admin_user['username'][0].'</span>
                                  </div>
                                </div>
                              ';
                            }
                            else{
                              echo '
                                <div class="flex-shrink-0 avatar avatar-online">
                                  <img src="'.$settings['site_url'].'assets/img/avatars/'.$admin_user['photo'].'" alt="Avatar" class="rounded-circle" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right">
                                </div>
                              ';
                            }
                          ?>
                          <div class="chat-contact-info flex-grow-1 ms-3">
                            <h6 class="m-0"><?php echo $admin_user['firstname']." ".$admin_user['lastname']; ?></h6>
                            <small class="user-status text-muted"><?php echo $admin_user['username']; ?></small>
                          </div>
                        </div>
                        <div class="d-flex align-items-center">
                          <a href="<?php echo $about['whatsapp']; ?>" target="_blank" class="text-muted"><i class="bx bxl-whatsapp cursor-pointer d-sm-block d-none me-3 fs-4"></i></a>
                        </div>
                      </div>
                    </div>
                    <div class="chat-history-body">
                      <ul class="list-unstyled chat-history mb-0">

                        <div id="chat_load"></div>

                      </ul>
                    </div>
                    <!-- Chat message form -->
                    <div class="chat-history-footer">
                      <form class="form-send-message d-flex justify-content-between align-items-center" method="POST" id="chatForm">
                        <input class="form-control message-input border-0 me-3 shadow-none" placeholder="Type your message here..." id="message">
                        <div class="message-actions d-flex align-items-center">
                          <i class="speech-to-text bx bx-microphone bx-sm cursor-pointer mx-3 mb-0"></i>
                          <button class="btn btn-primary d-flex send-msg-btn" onclick="return chat_validation()">
                            <i class="bx bx-paper-plane me-md-1 me-0"></i>
                            <span class="align-middle d-md-inline-block d-none">Send</span>
                          </button>
                        </div>
                        <div id="msg"></div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- /Chat History -->

                <!-- Sidebar Right -->
                <div class="col app-chat-sidebar-right app-sidebar overflow-hidden" id="app-chat-sidebar-right">
                  <div class="sidebar-header d-flex flex-column justify-content-center align-items-center flex-wrap p-4 mt-2">
                    <?php
                      if ($admin_user['photo'] == "") {
                        echo '
                          <div class="flex-shrink-0 mt-n2">
                            <div class="avatar avatar-md avatar-online">
                              <span class="avatar-initial rounded-circle bg-label-success">'.$admin_user['username'][0].'</span>
                            </div>
                          </div>
                        ';
                      }
                      else{
                        echo '
                          <div class="flex-shrink-0 avatar avatar-online">
                            <img src="'.$settings['site_url'].'assets/img/avatars/'.$admin_user['photo'].'" alt="Avatar" class="rounded-circle">
                          </div>
                        ';
                      }
                    ?>
                    <h6 class="mt-3 mb-1"><?php echo $admin_user['firstname']." ".$admin_user['lastname']; ?></h6>
                    <small class="text-muted"><?php echo $admin_user['username']; ?></small>
                    <i class="bx bx-x bx-sm cursor-pointer close-sidebar me-1 fs-4 d-block" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right"></i>
                  </div>
                  <div class="sidebar-body px-4 pb-4">
                    <div class="my-3">
                      <span class="text-muted text-uppercase">About</span>
                      <p class="mb-0 mt-2"><?php echo $admin_user['about']; ?></p>
                    </div>
                    <div class="my-4">
                      <span class="text-muted text-uppercase">Personal Information</span>
                      <ul class="list-unstyled d-grid gap-2 mt-2">
                        <li class="d-flex align-items-center">
                          <i class='bx bx-envelope'></i>
                          <span class="align-middle ms-2"><?php echo $admin_user['email']; ?></span>
                        </li>
                        <li class="d-flex align-items-center">
                          <i class='bx bx-phone-call'></i>
                          <span class="align-middle ms-2"><?php echo $admin_user['contact_info']; ?></span>
                        </li>
                        <li class="d-flex align-items-center">
                          <i class='bx bx-time-five'></i>
                          <span class="align-middle ms-2">Mon - Fri 10AM - 8PM</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <!-- /Sidebar Right -->

                <div class="app-overlay"></div>
              </div>
            </div>



          </div>
          <!-- / Content -->
          <?php include 'includes/footer.php'; ?>
          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>


    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>

  </div>
  <!-- / Layout wrapper -->
<?php include 'includes/scripts.php'; ?>
<script type="text/javascript">
 $(function(){
  const send    = <?php echo $admin_user['id']; ?>;
  const dataStr = 'send='+send;
   setInterval(function(){
    $.ajax({
      type:'GET',
      url:'chat_loader.php',
      data:dataStr,
      success: function(e){
        $('#chat_load').html(e);
      }
    });
  }, 5000);
 });
</script>

<script type="text/javascript">
 function chat_validation(){

  const textmsg = $('#message').val();
  const send    = <?php echo $admin_user['id']; ?>;

  if(textmsg == ""){
   alert('Type Message....');
   return false;
  }
  const datastr = 'message='+textmsg+'&send='+send;
   $.ajax({
    url:'chatlog.php',
    type:'POST',
    data:datastr,
    success:function(e){
      $('#msg').html(e);
    }
  });
  document.getElementById('chatForm').reset();
  return false;
 }
</script>
</body>
</html>
