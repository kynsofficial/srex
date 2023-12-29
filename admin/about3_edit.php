<?php
	include 'include/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$whatsapp = $_POST['whatsapp'];
		$facebook = $_POST['facebook'];
		$twitter = $_POST['twitter'];
		$instagram = $_POST['instagram'];
		$email = $_POST['email'];
		$tawk_link = $_POST['tawk_link'];

		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT * FROM about WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		try{
			$stmt = $conn->prepare("UPDATE about SET whatsapp=:whatsapp, twitter=:twitter, facebook=:facebook, instagram=:instagram, email=:email, tawk_link=:tawk_link WHERE id=:id");
			$stmt->execute(['whatsapp'=>$whatsapp, 'twitter'=>$twitter, 'facebook'=>$facebook, 'instagram'=>$instagram, 'email'=>$email, 'tawk_link'=>$tawk_link, 'id'=>$id]);
			$_SESSION['success'] = 'Social Media Account updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}

	if(isset($_POST['edit_notification'])){
		$id = $_POST['id'];
		$gen_notification = $_POST['gen_notification'];
		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT * FROM settings WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		try{
			$stmt = $conn->prepare("UPDATE settings SET gen_notification=:gen_notification WHERE id=:id");
			$stmt->execute(['gen_notification'=>$gen_notification, 'id'=>$id]);
			$_SESSION['success'] = 'Notification updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}

	else{
		// $_SESSION['error'] = 'Fill up edit About form first';
	}

	header('location: gen-settings');

?>
