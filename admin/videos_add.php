<?php
	include 'include/session.php';

	if(isset($_POST['add'])){
		$title = $_POST['title'];
		$link = $_POST['link'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM videos WHERE title=:title");
		$stmt->execute(['title'=>$title]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM videos WHERE link=:link");
		$stmt->execute(['link'=>$link]);
		$iow = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Title already Exist';
		}elseif ($iow['numrows'] > 0) {
			$_SESSION['error'] = 'Link already Exist';
		}
		else{
			try{
				$stmt = $conn->prepare("INSERT INTO videos (title, link) VALUES (:title, :link)");
				$stmt->execute(['title'=>$title, 'link'=>$link]);
				$_SESSION['success'] = 'Video added successfully';

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

	header('location: video-settings');

?>
