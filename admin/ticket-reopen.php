<?php
	include 'include/session.php';

	// if(isset($_POST['edit'])){
    $ticket_id = $_GET['ticket_id'];
		$resolved = 0;

    $stmt = $conn->prepare("SELECT * FROM tbl_tickets WHERE ticket_id=:ticketId");
		$stmt->execute(['ticketId'=>$ticket_id]);
		$iow = $stmt->fetch();

    $link = "ticket-view?ticket_id=".$iow['ticket_id'];

		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("UPDATE tbl_tickets SET resolved=:resolved WHERE ticket_id=:ticket_id");
			$stmt->execute(['resolved'=>$resolved, 'ticket_id'=>$ticket_id]);

      $res = array(
        'success'=>true
      );

      echo json_encode($res);
      // echo "$resolved";

			// $_SESSION['success'] = 'Ticket opened successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	// }
	// else{
	// 	$_SESSION['error'] = 'Fill up edit form first';
	// }

	// header('location: '.$link);

?>
