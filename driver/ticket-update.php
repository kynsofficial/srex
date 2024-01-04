<?php
	include 'include/session.php';

	// if(isset($_POST['send'])){
		$ticketId = $_POST['ticketId'];
		$message = $_POST['message'];
		$repliedById = $_POST['repliedById'];
		$conn = $pdo->open();

    // $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM tbl_ticket_replies WHERE message=:message");
    // $stmt->execute(['message'=>$message]);
    // $row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM tbl_tickets WHERE id=:ticketId");
		$stmt->execute(['ticketId'=>$ticketId]);
		$iow = $stmt->fetch();

		$link = "ticket-view?ticket_id=".$iow['ticket_id'];


		// if($row['numrows'] > 0){
		// 	$_SESSION['error'] = 'Message already exist';
		// }
		// else{
			try{
				// Send emai too - You have a new message from bla bla
				$stmt = $conn->prepare("INSERT INTO tbl_ticket_replies (repliedById, ticketId, message) VALUES (:repliedById, :ticketId, :message)");
				$stmt->execute(['repliedById'=>$repliedById, 'ticketId'=>$ticketId, 'message'=>$message]);
				// $_SESSION['success'] = 'Message Sent';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		// }

		$pdo->close();
	// }
	// else{
	// 	$_SESSION['error'] = 'Fill up account form first';
	// }

	header('location: '.$link);

?>
