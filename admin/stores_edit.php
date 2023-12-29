<?php
	include 'include/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$link = $_POST['link'];
		$about = htmlspecialchars($_POST['about']);

		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("UPDATE stores SET name=:name, link=:link, about=:about WHERE id=:id");
			$stmt->execute(['name'=>$name, 'link'=>$link, 'about'=>$about, 'id'=>$id]);
			$_SESSION['success'] = 'Store updated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();

	}
	else{
		$_SESSION['error'] = 'Enter link first';
	}

	header('location: stores');
?>
