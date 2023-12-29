<?php
	include 'include/session.php';

	if(isset($_POST['upload'])){
		$id = $_POST['id'];
		$filename = $_FILES['logo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['logo']['tmp_name'], '../assets/img/core/'.$filename);
		}

		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("UPDATE settings SET logo=:logo WHERE id=:id");
			$stmt->execute(['logo'=>$filename, 'id'=>$id]);
			$_SESSION['success'] = 'Logo 1 image updated successfully';
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
