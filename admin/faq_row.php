<?php
	include 'include/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];

		$conn = $pdo->open();

		// $stmt = $conn->prepare("SELECT * FROM faq WHERE id=:id");
		// $stmt->execute(['id'=>$id]);

		$stmt = $conn->prepare("SELECT *, faq_category.title AS catname FROM faq LEFT JOIN faq_category ON faq_category.id=faq.category_id WHERE faq.id=:id");
		$stmt->execute(['id'=>$id]);

		// $stmt = $conn->prepare("SELECT *, work_content.id AS prodid, work_content.name AS prodname, category.name AS catname FROM work_content LEFT JOIN category ON category.id=work_content.category_id WHERE work_content.id=:id");
		// $stmt->execute(['id'=>$id]);

		$row = $stmt->fetch();

		$pdo->close();

		echo json_encode($row);
	}
?>
