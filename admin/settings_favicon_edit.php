<?php
	include 'include/session.php';

	if(isset($_POST['upload'])){
		$id = $_POST['id'];
		$filename = $_FILES['favicon']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['favicon']['tmp_name'], '../assets/img/core/'.$filename);
		}

		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("UPDATE settings SET favicon=:favicon WHERE id=:id");
			$stmt->execute(['favicon'=>$filename, 'id'=>$id]);
			$_SESSION['success'] = 'Favicon image updated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();

	}
	else{
		$_SESSION['error'] = 'Select image to update image first';
	}

	header('location: gen-settings');
?>
