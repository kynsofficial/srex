<?php
include 'includes/head.php';

$conn = $pdo->open();
try{
  $adminid = $_POST['send'];
  $ticketId = $user['id'];
  $message = htmlspecialchars($_POST['message']);

  $ticketid = $user['id'];
  $stmt = $conn->prepare("INSERT INTO tbl_ticket_replies (ticketId, message, repliedById) VALUES (:ticketId, :message, :adminid)");
  $stmt->execute(['ticketId'=>$ticketId, 'message'=>$message, 'adminid'=>$ticketId]);
}
catch(PDOException $e){
  echo $e->getMessage();
}

  $pdo->close();
?>
