<?php
	include 'include/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$questions = $_POST['questions'];
		$category_id = $_POST['category_id'];
		$answers = $_POST['answers'];

		$conn = $pdo->open();
		try{
			$stmt = $conn->prepare("UPDATE faq SET category_id=:category_id, answers=:answers, questions=:questions WHERE id=:id");
			$stmt->execute(['category_id'=>$category_id, 'answers'=>$answers, 'questions'=>$questions, 'id'=>$id]);
			$_SESSION['success'] = 'FAQ updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit review form first';
	}

	header('location: faq');

	var_dump($_POST);

?>
