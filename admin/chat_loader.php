<?php
include 'includes/head.php';

$conn = $pdo->open();
try{
  $admin_userid = $_GET['send'];
  $stmt = $conn->prepare("SELECT * FROM users WHERE type=:type AND id = $admin_userid LIMIT 1");
  $stmt->execute(['type'=>0]);
  $admin_user = $stmt->fetch();

  $ticketid = $admin['id'];
  $stmt1 = $conn->prepare("SELECT * FROM tbl_ticket_replies as BaseTbl LEFT JOIN users as User ON User.id = BaseTbl.repliedById WHERE ticketID = $ticketid ORDER BY BaseTbl.replyId ASC");
  $stmt1->execute();
}
catch(PDOException $e){
  echo $e->getMessage();
}

  $pdo->close();
?>
<?php foreach ($stmt1 as $reply): ?>
  <?php if ($reply['repliedById'] == $admin_user['id']): ?>
    <li class="chat-message">
      <div class="d-flex overflow-hidden">
        <div class="user-avatar flex-shrink-0 me-3">
          <div class="avatar avatar-sm">
            <img src="<?php echo $settings['site_url']; ?>assets/img/avatars/<?php echo $admin_user['photo']; ?>" alt="Avatar" class="rounded-circle">
          </div>
        </div>
        <div class="chat-message-wrapper flex-grow-1">
          <div class="chat-message-text">
            <p class="mb-0"><?php echo $reply['message']; ?></p>
          </div>
          <div class="text-muted mt-1">
            <small><?php echo $reply['createdDtm']; ?></small>
          </div>
        </div>
      </div>
    </li>
  <?php endif; ?>

  <?php if ($reply['repliedById'] == $admin['id']): ?>
    <li class="chat-message chat-message-right">
      <div class="d-flex overflow-hidden">
        <div class="chat-message-wrapper flex-grow-1 w-50">
          <div class="chat-message-text bg-primary">
            <p class="mb-0"><?php echo $reply['message']; ?></p>
          </div>
          <div class="text-end text-muted mt-1">
            <i class='bx bx-check-double'></i>
            <small><?php echo $reply['createdDtm']; ?></small>
          </div>
        </div>
        <div class="user-avatar flex-shrink-0 ms-3">
          <div class="avatar avatar-sm">
            <img src="<?php echo $settings['site_url']; ?>assets/img/avatars/<?php echo $admin['photo']; ?>" alt="Avatar" class="rounded-circle">
          </div>
        </div>
      </div>
    </li>
  <?php endif; ?>
<?php endforeach; ?>
