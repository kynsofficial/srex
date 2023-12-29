<?php
include 'include/session.php';
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=SendASAP Users List.csv');
$conn = $pdo->open();
$output = fopen("php://output", "w");
fputcsv($output, array('S/N', 'Username', 'First Name', 'Last Name', 'Email', 'Phone Number', 'Date Added'));
$stmt = $conn->prepare("SELECT * FROM users WHERE type=:type");
$stmt->execute(['type'=>0]);
$i = 0;
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
	$i++;
	fputcsv($output, array($i,$row['username'],$row['firstname'],$row['lastname'],$row['email'],$row['contact_info'],date('M d, Y', strtotime($row['created_on']))));
	// $_SESSION['success'] = 'List exported successfully';
	// header('location: users');
}
fclose($output);
?>
