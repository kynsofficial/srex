<?php
	include 'include/session.php';

	$output = '';

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM faq_category");
	$stmt->execute();

	foreach($stmt as $row){
		$output .= "
			<option value='".$row['id']."' class='append_items'>".$row['title']."</option>
		";
	}

	$pdo->close();
	echo json_encode($output);

?>
