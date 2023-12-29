<?php
	include 'include/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$title = $_POST['title'];
		$link = $_POST['link'];

		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("UPDATE videos SET title=:title, link=:link WHERE id=:id");
			$stmt->execute(['title'=>$title, 'link'=>$link, 'id'=>$id]);
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
