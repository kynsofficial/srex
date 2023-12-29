<?php
include 'include/session.php';

$conn = $pdo->open();
  $userid = $_GET['userid'];
  $ticketid = $_GET['ticketid'];
try{
  $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id LIMIT 1");
  $stmt->execute(['id'=>$userid]);
  $user = $stmt->fetch();

  // $ticketid = $ticket['id'];
  // $ticketid = 1;
  $stmt = $conn->prepare("SELECT * FROM tbl_ticket_replies as BaseTbl LEFT JOIN users as User ON User.id = BaseTbl.repliedById WHERE ticketID = $ticketid ORDER BY BaseTbl.replyId ASC");
  $stmt->execute();
}
catch(PDOException $e){
  echo $e->getMessage();
}

  $pdo->close();
?>
<?php foreach ($stmt as $reply): ?>
  <?php if ($reply['type'] == 0): ?>
    <li class="chat-message">
      <div class="d-flex overflow-hidden">
        <div class="user-avatar flex-shrink-0 me-3">
          <?php
            if ($user['photo'] == "") {
              echo '
                  <div class="avatar avatar-sm">
                    <span class="avatar-initial rounded-circle bg-label-success" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right">'.$user['username'][0].'</span>
                  </div>
              ';
            }
            else{
              echo '
                <div class="avatar avatar-sm">
                  <img src="'.$settings['site_url'].'assets/img/avatars/'.$user['photo'].'" alt="Avatar" class="rounded-circle" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right">
                </div>
              ';
            }
          ?>
        </div>
        <div class="chat-message-wrapper flex-grow-1">
          <div class="chat-message-text">
            <p class="m-0">
              <?php echo $reply['message']; ?>
            </p>
          </div>
          <div class="text-muted mt-1">
            <small><i class="text-danger bx bx-trash delete" data-id="<?php echo $reply['replyId']; ?>"></i> <?php echo time_elapsed_string($reply['createdDtm']); ?></small>
          </div>
        </div>
      </div>
    </li>
  <?php endif; ?>

  <?php if ($reply['type'] == 1): ?>
    <li class="chat-message chat-message-right">
      <div class="d-flex overflow-hidden">
        <div class="chat-message-wrapper flex-grow-1 w-50">
          <div class="chat-message-text bg-primary">
            <p class="m-0">
              <?php echo $reply['message']; ?>
            </p>
          </div>
          <div class="text-end text-muted mt-1">
            <i class='bx bx-check-double'></i>
            <small><?php echo time_elapsed_string($reply['createdDtm']); ?> <i class="text-danger bx bx-trash delete" data-id="<?php echo $reply['replyId']; ?>"></i></small>
          </div>
        </div>
        <div class="user-avatar flex-shrink-0 ms-3">
          <?php
            if ($admin['photo'] == "") {
              echo '
                  <div class="avatar avatar-sm">
                    <span class="avatar-initial rounded-circle bg-label-success" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right">'.$admin['username'][0].'</span>
                  </div>
              ';
            }
            else{
              echo '
                <div class="avatar avatar-sm">
                  <img src="'.$settings['site_url'].'assets/img/avatars/'.$admin['photo'].'" alt="Avatar" class="rounded-circle" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right">
                </div>
              ';
            }
          ?>
        </div>
      </div>
    </li>
  <?php endif; ?>
<?php endforeach; ?>
<?php
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>
<script>
$(function(){

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    // $('#delete1').modal('show');
    var id = $(this).data('id');
    // alert("Delete?");
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'ticket-delete.php',
    data: {id:id},
    success: function(response){
      // $('.username').html(response.username);
    }
  });
}
</script>
