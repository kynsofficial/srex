<?php
	include 'include/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$role = $_POST['role'];
		$title = $_POST['title'];
		$message = $_POST['message'];

		$conn = $pdo->open();
		try{
			$stmt = $conn->prepare("UPDATE front_testimonials SET email=:email, role=:role, name=:name, message=:message WHERE id=:id");
			$stmt->execute(['email'=>$email, 'role'=>$role, 'name'=>$name, 'message'=>$message, 'id'=>$id]);
			$_SESSION['success'] = 'Testimonial updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit review form first';
	}

	header('location: testimonials');

?>
