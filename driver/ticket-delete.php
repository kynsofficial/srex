<?php
	include 'include/session.php';

	// if(isset($_POST['delete'])){
		$id = $_POST['id'];

		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("DELETE FROM tbl_ticket_replies WHERE replyId=:id");
			$stmt->execute(['id'=>$id]);

			// $_SESSION['success'] = 'Message deleted successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	// }
	// else{
	// 	$_SESSION['error'] = 'Select video to delete first';
	// }

	// header('location: video-settings');

?>
