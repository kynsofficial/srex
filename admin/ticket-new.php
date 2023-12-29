<?php
	include 'include/session.php';

	if(isset($_POST['save'])){
		$subject = $_POST['subject'];
		$message = $_POST['message'];
		$category = $_POST['category'];
		$priority = $_POST['priority'];
		$userId = $_POST['userId'];
		$assignedTo = $_POST['assignedTo'];
		$ticket_id = "TCKT".time();
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM tbl_tickets WHERE message=:message");
		$stmt->execute(['message'=>$message]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Ticket already exist';
		}
		else{
			$now = date('Y-m-d');
			try{
				$stmt = $conn->prepare("INSERT INTO tbl_tickets (ticket_id, userId, assignedTo, categoryId, subject, message, priority) VALUES (:ticket_id, :userId, :assignedTo, :category, :subject, :message, :priority)");
				$stmt->execute(['ticket_id'=>$ticket_id, 'userId'=>$userId, 'assignedTo'=>$assignedTo, 'category'=>$category, 'subject'=>$subject, 'message'=>$message, 'priority'=>$priority]);
				$_SESSION['success'] = 'Ticket Created';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up account form first';
	}

	header('location: ticket');

?>
