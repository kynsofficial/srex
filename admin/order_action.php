<?php

	include 'include/session.php';

	$conn = $pdo->open();

	// var_dump($_POST);

	if(isset($_POST['accept_order'])){
	    $id = $_POST['id'];
		$userid = $_POST['userid'];
		// $amount = $_POST['amount'];
		$ref_id = $_POST['ref_id'];

		$stmt = $conn->prepare("SELECT * FROM shippments WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
    	$stmt->execute(['id'=>$userid]);
    	$iow = $stmt->fetch();

		try{
			
			$stmt = $conn->prepare("UPDATE shippments SET status = 2 WHERE ref_id=:ref_id AND userid=:userid");
			$stmt->execute(['ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);
			//include 'emails/pay-supplier-order_cancel.php';


			$_SESSION['success'] = 'Goods Accepted successfully';
			echo "<script>window.location.assign('order-old-details?id=".$row['ref_id']."')</script>";

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}

	if(isset($_POST['assign_driver'])){
		// Update the status to 5, insert into comment, update driverid
	    $id = $_POST['id'];
		$userid = $_POST['userid'];
		$driverid = $_POST['driverid'];
		$driver_assigned = 1; // Yes, driver has been assigned
		$dateassigned = date('Y-m-d H:m:s'); // Enter format
		$ref_id = $_POST['ref_id'];
		$comment11 = "The express has been collected by ".$settings['site_name']."";

		$stmt = $conn->prepare("SELECT * FROM shippments WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
    	$stmt->execute(['id'=>$userid]);
    	$iow = $stmt->fetch();

		try{
			
			$stmt = $conn->prepare("UPDATE shippments SET status = 5, comment=:comment, driver_assigned_id=:driver_assigned_id, driver_assigned=:driver_assigned, date_assigned=:date_assigned WHERE ref_id=:ref_id AND userid=:userid");
			$stmt->execute(['ref_id'=>$row['ref_id'], 'comment'=>$comment11, 'driver_assigned_id'=>$driverid, 'driver_assigned'=>$driver_assigned, 'date_assigned'=>$dateassigned, 'userid'=>$iow['id']]);
			//include 'emails/pay-supplier-order_cancel.php';


			$_SESSION['success'] = 'Order Updated';
			echo "<script>window.location.assign('order-old-details?id=".$row['ref_id']."')</script>";

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}

	if(isset($_POST['update_track_status'])){
	    $id = $_POST['id'];
		$userid = $_POST['userid'];
		// $amount = $_POST['amount'];
		$ref_id = $_POST['ref_id'];
		$status = $_POST['status'];
		$comment = $_POST['comment'];

		$stmt = $conn->prepare("SELECT * FROM shippments WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
    	$stmt->execute(['id'=>$userid]);
    	$iow = $stmt->fetch();

		try{
			echo $status;

			
			// Make a condition if it the status is 'delivered' or 'collected'
			if ($status == 4) {
				$stmt = $conn->prepare("INSERT INTO parcel_tracks (status, comment, parcel_id) VALUES (:status, :comment, :parcel_id)");
				$stmt->execute(['status'=>$status, 'comment'=>$comment, 'parcel_id'=>$id]);

				$stmt = $conn->prepare("UPDATE shippments SET status = 4 WHERE ref_id=:ref_id AND userid=:userid");
				$stmt->execute(['ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);
				// echo 'arrived';
			}
			elseif($status == 5){
				$stmt = $conn->prepare("INSERT INTO parcel_tracks (status, comment, parcel_id) VALUES (:status, :comment, :parcel_id)");
				$stmt->execute(['status'=>$status, 'comment'=>$comment, 'parcel_id'=>$id]);

				$stmt = $conn->prepare("UPDATE shippments SET status = 1 WHERE ref_id=:ref_id AND userid=:userid");
				$stmt->execute(['ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);
				// echo 'delivered';
			}
			elseif($status == 6){
				$stmt = $conn->prepare("INSERT INTO parcel_tracks (status, comment, parcel_id) VALUES (:status, :comment, :parcel_id)");
				$stmt->execute(['status'=>$status, 'comment'=>$comment, 'parcel_id'=>$id]);

				$stmt = $conn->prepare("UPDATE shippments SET status = 3 WHERE ref_id=:ref_id AND userid=:userid");
				$stmt->execute(['ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);
				// echo 'return';
			}
			else{
				$stmt = $conn->prepare("INSERT INTO parcel_tracks (status, comment, parcel_id) VALUES (:status, :comment, :parcel_id)");
				$stmt->execute(['status'=>$status, 'comment'=>$comment, 'parcel_id'=>$id]);
				// echo 'other';
			}
			
			
			// $stmt = $conn->prepare("UPDATE shippments SET status = 2 WHERE ref_id=:ref_id AND userid=:userid");
			// $stmt->execute(['ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);
			//include 'emails/pay-supplier-order_cancel.php';


			$_SESSION['success'] = 'Status Updated';
			echo "<script>window.location.assign('order-old-details?id=".$row['ref_id']."')</script>";

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}

	if(isset($_POST['approve_order'])){
	    $id = $_POST['id'];
		$userid = $_POST['userid'];
		// $amount = $_POST['amount'];
		$ref_id = $_POST['ref_id'];
		$status = '5';
		$comment = 'The item has been successfully delivered';

		$stmt = $conn->prepare("SELECT * FROM shippments WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
    	$stmt->execute(['id'=>$userid]);
    	$iow = $stmt->fetch();

		try{
			
			$stmt = $conn->prepare("UPDATE shippments SET status = 1 WHERE ref_id=:ref_id AND userid=:userid");
			$stmt->execute(['ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);

			$stmt = $conn->prepare("INSERT INTO parcel_tracks (status, comment, parcel_id) VALUES (:status, :comment, :parcel_id)");
			$stmt->execute(['status'=>$status, 'comment'=>$comment, 'parcel_id'=>$id]);
			
			//include 'emails/pay-supplier-order_cancel.php';


			$_SESSION['success'] = 'Goods Accepted successfully';
			echo "<script>window.location.assign('order-old-details?id=".$row['ref_id']."')</script>";

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}

	if(isset($_POST['cancel_order'])){
		// Set status to cancel and refund user balance
	    $id = $_POST['id'];
		$userid = $_POST['userid'];
		$ref_id = $_POST['ref_id'];
		$reason = $_POST['reason'];

		$stmt = $conn->prepare("SELECT * FROM shippments WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
    	$stmt->execute(['id'=>$userid]);
    	$iow = $stmt->fetch();

		try{
			
			$stmt = $conn->prepare("UPDATE shippments SET status = 6, reason=:reason WHERE ref_id=:ref_id AND userid=:userid");
			$stmt->execute(['ref_id'=>$row['ref_id'], 'reason'=>$reason, 'userid'=>$iow['id']]);
			//include 'emails/pay-supplier-order_cancel.php';


			$_SESSION['success'] = 'Order Updated';
			echo "<script>window.location.assign('order-old-details?id=".$row['ref_id']."')</script>";

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}

	if(isset($_POST['refund_order'])){
		// Set status to return and refund user balance
	    $id = $_POST['id'];
		$userid = $_POST['userid'];
		$ref_id = $_POST['ref_id'];
		$reason = $_POST['reason'];

		$stmt = $conn->prepare("SELECT * FROM shippments WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
    	$stmt->execute(['id'=>$userid]);
    	$iow = $stmt->fetch();

		try{
			
			$stmt = $conn->prepare("UPDATE shippments SET status = 3, reason=:reason WHERE ref_id=:ref_id AND userid=:userid");
			$stmt->execute(['ref_id'=>$row['ref_id'], 'reason'=>$reason, 'userid'=>$iow['id']]);
			//include 'emails/pay-supplier-order_cancel.php';


			$_SESSION['success'] = 'Order Updated';
			echo "<script>window.location.assign('order-old-details?id=".$row['ref_id']."')</script>";

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}

	//echo "<script>window.location.assign('pay-supplier')</script>";

?>
