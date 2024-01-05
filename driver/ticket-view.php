<?php include 'includes/head.php'; ?>
<?php
  date_default_timezone_set("Africa/Lagos");
  $conn = $pdo->open();

  $ticket_id = $_GET['ticket_id'];

  try{

      $stmt = $conn->prepare("SELECT * FROM tbl_tickets WHERE ticket_id = :ticket_id");
      $stmt->execute(['ticket_id' => $ticket_id]);
      $ticket = $stmt->fetch();

  }
  catch(PDOException $e){
    echo "There is some problem in connection: " . $e->getMessage();
  }
  $pdo->close();
?>
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

          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none ">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>
          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
              <div class="nav-item navbar-search-wrapper mb-0">
                <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);">
                  <i class="bx bx-search bx-sm"></i>
                  <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
                </a>
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
        <?php
        if ($ticket['resolved'] == 0) {
          $status = '<span class="badge bg-label-warning">Pending</span>';
          $status1 = '<span class="text-success"><i class="bx bx-check"></i> Mark as resolved</span>';
          $status2 = 'id="ticket-state" data-bs-url="ticket-resolve?ticket_id='.$ticket['ticket_id'].'"';

          if ($ticket['priority'] == 'low') {
            $priority = '<span class="badge bg-label-primary">Low</span>';
          }
          if ($ticket['priority'] == 'high') {
            $priority = '<span class="badge bg-label-danger">High</span>';
          }
          if ($ticket['priority'] == 'medium') {
            $priority = '<span class="badge bg-label-info">Medium</span>';
          }

        }
        if ($ticket['resolved'] == 1) {
          $status = '<span class="badge bg-label-success">Resolved</span>';
          $status1 = '<span class="text-warning"><i class="bx bx-x"></i> Reopen Ticket</span>';
          $status2 = 'id="ticket-state" data-bs-url="ticket-reopen?ticket_id='.$ticket['ticket_id'].'"';
          $priority = '';
        }

        ?>
        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
              <span class="text-muted fw-light">Tickets /</span> Ticket ID : <?php echo $ticket['ticket_id']; ?><br>
              <div class="mt-3"><span class="text-muted fw-light">Subject: <?php echo $ticket['subject']; ?></span></div>
            </h4>
            <!-- <hr> -->
            <!-- <hr> -->
            <div class="app-chat overflow-hidden card">
              <div class="row g-0">

                <!-- Chat History -->
                <div class="col app-chat-history">
                  <div class="chat-history-wrapper">
                    <div class="chat-history-header border-bottom">
                      <div class="d-flex justify-content-between align-items-center">
                        <?php
                        $conn = $pdo->open();
                        $ticketid = $ticket['id'];
                        try{
                          $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id LIMIT 1");
                          $stmt->execute(['id'=>$ticket['userId']]);
                          $user = $stmt->fetch();
                        }
                        catch(PDOException $e){
                          echo $e->getMessage();
                        }
                        $pdo->close();
                        ?>
                        <div class="d-flex overflow-hidden align-items-center">
                          <!-- <i class="bx bx-menu bx-sm cursor-pointer d-lg-none d-block me-2" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-contacts"></i> -->
                          <?php
                            if ($user['photo'] == "") {
                              echo '
                                <div class="flex-shrink-0 mt-n2">
                                  <div class="avatar avatar-md avatar-online">
                                    <span class="avatar-initial rounded-circle bg-label-success" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right">'.$user['username'][0].'</span>
                                  </div>
                                </div>
                              ';
                            }
                            elseif ($user['google_id'] !== "") {
                              echo '
                                <div class="flex-shrink-0 avatar avatar-online">
                                  <img src="'.$user['photo'].'" alt="Avatar" class="rounded-circle">
                                </div>
                              ';
                            }
                            else{
                              echo '
                                <div class="flex-shrink-0 avatar avatar-online">
                                  <img src="'.$settings['site_url'].'assets/img/avatars/'.$user['photo'].'" alt="Avatar" class="rounded-circle" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right">
                                </div>
                              ';
                            }
                          ?>
                          <div class="chat-contact-info flex-grow-1 ms-3">
                            <span class="h6 m-0"><?php echo $user['firstname']." ".$user['lastname']; ?></span> | Message: <span class="text-danger"><?php echo $ticket['message']; ?> </span><br>
                            <small class="user-status text-muted"><?php echo $user['username']; ?></small> | <?php echo $status; ?> <?php echo $priority; ?>
                          </div>
                        </div>
                        <div class="d-flex align-items-center">
                          <i class="bx bx-phone-call cursor-pointer d-sm-block d-none me-3 fs-4"></i>
                          <i class="bx bx-video cursor-pointer d-sm-block d-none me-3 fs-4"></i>
                          <i class="bx bx-search cursor-pointer d-sm-block d-none me-3 fs-4"></i>
                          <div class="dropdown">
                            <i class="bx bx-dots-vertical-rounded cursor-pointer fs-4" id="chat-header-actions" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </i>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="chat-header-actions">
                              <a class="dropdown-item" href="javascript:void(0);" <?php echo $status2; ?>><?php echo $status1; ?></a>
                              <a class="dropdown-item" href="user-details?userid=<?php echo $user['id']; ?>" target="_blank">View User</a>
                              <a class="dropdown-item" href="javascript:void(0);">Clear Chat</a>
                              <a class="dropdown-item" href="javascript:void(0);">Report</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="chat-history-body">
                      <ul class="list-unstyled chat-history mb-0">


                        <div id="ticket_load"></div>

                      </ul>
                      <!-- <div id="full-editor" class="form-control message-input border-0 me-3 shadow-none"></div> -->
                    </div>

                    <?php if ($ticket['resolved'] == 0): ?>
                      <!-- Chat message form -->
                      <div class="chat-history-footer">
                        <form class="form-send-message d-flex justify-content-between align-items-center" method="POST" id="chatForm">
                          <!-- <textarea name="name" rows="8" cols="80"></textarea> -->
                          <input class="form-control message-input border-0 me-3 shadow-none" placeholder="Type your message here..." id="message">
                          <div class="message-actions d-flex align-items-center">
                            <i class="speech-to-text bx bx-microphone bx-sm cursor-pointer"></i>
                            <label for="attach-doc" class="form-label mb-0">
                              <i class="bx bx-paperclip bx-sm cursor-pointer mx-3"></i>
                              <input type="file" id="attach-doc" hidden>
                            </label>
                            <button class="btn btn-primary d-flex send-msg-btn" onclick="chat_validation(); ">
                              <i class="bx bx-paper-plane me-md-1 me-0"></i>
                              <span class="align-middle d-md-inline-block d-none">Send</span>
                            </button>
                          </div>
                        </form>
                        <script>
                          // function getContents() {
                          //   var myEditor = document.querySelector('#full-editor');
                          //   var html = myEditor.children[0].innerHTML;
                          //   document.getElementById("message").value = html;
                          //   // alert(html);
                          // }
                        </script>
                      </div>
                    <?php endif; ?>

                  </div>
                </div>
                <!-- /Chat History -->

                <!-- Sidebar Right -->
                <div class="col app-chat-sidebar-right app-sidebar overflow-hidden" id="app-chat-sidebar-right">
                  <div class="sidebar-header d-flex flex-column justify-content-center align-items-center flex-wrap p-4 mt-2">
                    <?php
                      if ($user['photo'] == "") {
                        echo '
                          <div class="flex-shrink-0 mt-n2">
                            <div class="avatar avatar-md avatar-online">
                              <span class="avatar-initial rounded-circle bg-label-success">'.$user['username'][0].'</span>
                            </div>
                          </div>
                        ';
                      }
                      elseif ($user['google_id'] !== "") {
                        echo '
                          <div class="flex-shrink-0 avatar avatar-online">
                            <img src="'.$user['photo'].'" alt="Avatar" class="rounded-circle">
                          </div>
                        ';
                      }
                      else{
                        echo '
                          <div class="flex-shrink-0 avatar avatar-online">
                            <img src="'.$settings['site_url'].'assets/img/avatars/'.$user['photo'].'" alt="Avatar" class="rounded-circle">
                          </div>
                        ';
                      }
                    ?>
                    <h6 class="mt-3 mb-1"><?php echo $user['firstname']." ".$user['lastname']; ?></h6>
                    <small class="text-muted"><?php echo $user['username']; ?></small>
                    <i class="bx bx-x bx-sm cursor-pointer close-sidebar me-1 fs-4 d-block" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right"></i>
                  </div>
                  <div class="sidebar-body px-4 pb-4">
                    <div class="my-3">
                      <span class="text-muted text-uppercase">About</span>
                      <p class="mb-0 mt-2"><?php echo $user['about']; ?></p>
                    </div>
                    <div class="my-4">
                      <span class="text-muted text-uppercase">Personal Information</span>
                      <ul class="list-unstyled d-grid gap-2 mt-2">
                        <li class="d-flex align-items-center">
                          <i class='bx bx-envelope'></i>
                          <span class="align-middle ms-2"><?php echo $user['email']; ?></span>
                        </li>
                        <li class="d-flex align-items-center">
                          <i class='bx bx-phone-call'></i>
                          <span class="align-middle ms-2"><?php echo $user['contact_info']; ?></span>
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
<?php include 'includes/scripts.php';?>
<script>
$(function(){
  const userid = <?php echo $ticket['userId']; ?>;
  const ticketid = <?php echo $ticket['id']; ?>;
  const dataStr = 'userid='+userid+'&ticketid='+ticketid;
   setInterval(function(){
    $.ajax({
      type:'GET',
      url:'ticket_loader.php',
      data:dataStr,
      success: function(e){
        $('#ticket_load').html(e);
      }
    });
  }, 5000); // Reloads every 5 seconds
 });

 function chat_validation(){

  const message = $('#message').val();
  const repliedById = <?php echo $admin['id']; ?>;
  const ticketId = <?php echo $ticket['id']; ?>;

  if(message == ""){
   alert('Type Message....');
   return false;
  }
  const datastr = 'message='+message+'&ticketId='+ticketId+'&repliedById='+repliedById;
   $.ajax({
    url:'ticket-update.php',
    type:'POST',
    data:datastr,
    success:function(e){
      // $('#msg').html(e);
    }
  });
  document.getElementById('chatForm').reset();
  return false;
 }

 $('#ticket-state').on('click', function(e){
 var actionurl = $(this).attr('data-bs-url');

 $.ajax({
     url: actionurl,
     type: 'GET',
     success: function(data) {
         var content = JSON.parse(data);
         if(content.success == true){
             location.reload();
         }
     },
     error: function(data) {}
 })
 });
</script>
</body>
</html>

<!-- beautify ignore:end -->
