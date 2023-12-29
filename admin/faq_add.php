<?php
	include 'include/session.php';
	include 'includes/slugify.php';

	if(isset($_POST['add'])){
		$questions = $_POST['questions'];
		$category_id = $_POST['category_id'];
		$answers = htmlspecialchars($_POST['answers']);

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM faq WHERE questions=:questions");
		$stmt->execute(['questions'=>$questions]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM faq WHERE answers=:answers");
		$stmt->execute(['answers'=>$answers]);
		$iow = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Question already Exist';
		}elseif ($iow['numrows'] > 0) {
			$_SESSION['error'] = 'Answer already Exist';
		}
		else{
			try{
				$stmt = $conn->prepare("INSERT INTO faq (questions, answers, category_id) VALUES (:questions, :answers, :category_id)");
				$stmt->execute(['questions'=>$questions, 'answers'=>$answers, 'category_id'=>$category_id]);
				$_SESSION['success'] = 'FAQ added successfully';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up form';
	}

	header('location: faq');

?>
