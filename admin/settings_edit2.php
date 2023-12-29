<?php
	include 'include/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$text_api_sender_id = $_POST['text_api_sender_id'];
		$text_api_key = $_POST['text_api_key'];
		$text_api_dnd = $_POST['text_api_dnd'];
		$public_key = $_POST['public_key'];
		$secret_key = $_POST['secret_key'];
		$client_id = $_POST['client_id'];
		$client_secret = $_POST['client_secret'];

		// echo "$api_username";
		// echo "$dataway_public";

		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT * FROM settings WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		try{
			$stmt = $conn->prepare("UPDATE settings SET text_api_dnd=:text_api_dnd, text_api_sender_id=:text_api_sender_id, text_api_key=:text_api_key, public_key=:public_key, secret_key=:secret_key, client_id=:client_id, client_secret=:client_secret WHERE id=:id");
			$stmt->execute(['text_api_dnd'=>$text_api_dnd, 'text_api_sender_id'=>$text_api_sender_id, 'text_api_key'=>$text_api_key, 'public_key'=>$public_key, 'secret_key'=>$secret_key, 'client_id'=>$client_id, 'client_secret'=>$client_secret, 'id'=>$id]);
			$_SESSION['success'] = 'Settings updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up settings form first';
	}

	header('location: api-settings');

?>
