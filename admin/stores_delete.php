<?php
	include 'include/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];

		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("DELETE FROM stores WHERE id=:id");
			$stmt->execute(['id'=>$id]);

			$_SESSION['success'] = 'Store deleted successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Select video to delete first';
	}

	header('location: stores');

?>
