<?php
	include 'include/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$visitors = $_POST['visitors'];

		try{
			$stmt = $conn->prepare("UPDATE about SET visitors=:visitors WHERE id=:id");
			$stmt->execute(['visitors'=>$visitors, 'id'=>$id]);
			$_SESSION['success'] = 'Visitors updated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up visitor form first';
	}

	header('location: home');

?>
