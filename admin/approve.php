<?php
include 'include/session.php';
if(isset($_POST['approve'])){
  $id = $_POST['id'];
  $userid = $_POST['userid'];
  // $amount = $_POST['amount'];
  $ref_id = $_POST['ref_id'];

$conn = $pdo->open();

$stmt = $conn->prepare("SELECT * FROM pay_supplier WHERE ref_id=:ref_id");
$stmt->execute(['ref_id'=>$ref_id]);
$row = $stmt->fetch();

$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
$stmt->execute(['id'=>$userid]);
$iow = $stmt->fetch();

$stmt = $conn->prepare("UPDATE pay_supplier SET payment_stat = 1, status = 2 WHERE ref_id=:ref_id AND userid=:userid");
$stmt->execute(['ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);

$stmt = $conn->prepare("UPDATE transactions SET status = 1 WHERE ref_id=:ref_id");
$stmt->execute(['ref_id'=>$row['ref_id']]);

}
?>
