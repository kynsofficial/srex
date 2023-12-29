<?php
	include 'include/session.php';

	if(isset($_POST['upload'])){
		$id = 1;
		$link = $_POST['demovid'];
		// $filename = $_FILES['demovid']['name'];
		// $prefix = 'sendasap';

		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("UPDATE frontend SET video=:video WHERE id=:id");
			$stmt->execute(['video'=>$link, 'id'=>$id]);
			$_SESSION['success'] = 'Video updated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();

	}
	else{
		$_SESSION['error'] = 'Enter link first';
	}

	header('location: video-settings');
?>
