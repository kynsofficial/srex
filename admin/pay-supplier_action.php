<?php

	include 'include/session.php';

	if(isset($_POST['approve'])){
		$id = $_POST['id'];
		$userid = $_POST['userid'];
		// $amount = $_POST['amount'];
		$ref_id = $_POST['ref_id'];

		// $amount_charge = 100-$settings['percentage'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM pay_supplier WHERE ref_id=:ref_id");
		$stmt->execute(['ref_id'=>$ref_id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
	  $stmt->execute(['id'=>$userid]);
	  $iow = $stmt->fetch();

		try{

			$stmt = $conn->prepare("UPDATE pay_supplier SET payment_stat = 1, status = 2 WHERE ref_id=:ref_id AND userid=:userid");
		  $stmt->execute(['ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);

		  $stmt = $conn->prepare("UPDATE transactions SET status = 1 WHERE ref_id=:ref_id");
		  $stmt->execute(['ref_id'=>$row['ref_id']]);

			include 'emails/pay-supplier_approve.php';

			$_SESSION['success'] = 'Transaction Approved successfully';
		  echo "<script>window.location.assign('pay-supplier-details?id=".$row['ref_id']."')</script>";

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}

	if(isset($_POST['disapprove'])){
		$id = $_POST['id'];
		$userid = $_POST['userid'];
		// $amount = $_POST['amount'];
		$reason = $_POST['reason'];
		$ref_id = $_POST['ref_id'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM pay_supplier WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
	  $stmt->execute(['id'=>$userid]);
	  $iow = $stmt->fetch();

		try{

			$stmt = $conn->prepare("UPDATE pay_supplier SET payment_stat = 5, reason = :reason, status = 0 WHERE ref_id=:ref_id AND userid=:userid");
		  $stmt->execute(['reason'=>$reason, 'ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);

		  $stmt = $conn->prepare("UPDATE transactions SET reason = :reason, status = 5 WHERE ref_id=:ref_id");
		  $stmt->execute(['reason'=>$reason, 'ref_id'=>$row['ref_id']]);

			include 'emails/pay-supplier_disapprove.php';

		  $_SESSION['success'] = 'Transaction Disapproved successfully';
		  echo "<script>window.location.assign('pay-supplier-details?id=".$row['ref_id']."')</script>";

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}

	if(isset($_POST['refund'])){
		$id = $_POST['id'];
		$userid = $_POST['userid'];
		// $amount = $_POST['amount'];
		$reason = $_POST['reason'];
		$ref_id = $_POST['ref_id'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM pay_supplier WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
	  $stmt->execute(['id'=>$userid]);
	  $iow = $stmt->fetch();

		try{

			$stmt = $conn->prepare("UPDATE pay_supplier SET payment_stat = 3, reason = :reason, status = 3 WHERE ref_id=:ref_id AND userid=:userid");
			$stmt->execute(['reason'=>$reason, 'ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);

			$stmt = $conn->prepare("UPDATE transactions SET reason = :reason, status = 3 WHERE ref_id=:ref_id");
			$stmt->execute(['reason'=>$reason, 'ref_id'=>$row['ref_id']]);

			include 'emails/pay-supplier_refund.php';

			$_SESSION['success'] = 'Transaction Refunded successfully';
			echo "<script>window.location.assign('pay-supplier-details?id=".$row['ref_id']."')</script>";

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

		// $amount_charge = 100-$settings['percentage'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM pay_supplier WHERE ref_id=:ref_id");
		$stmt->execute(['ref_id'=>$ref_id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
	  $stmt->execute(['id'=>$userid]);
	  $iow = $stmt->fetch();

		try{

			$stmt = $conn->prepare("UPDATE pay_supplier SET status = 1 WHERE ref_id=:ref_id AND userid=:userid");
		  $stmt->execute(['ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);

			include 'emails/pay-supplier-order_approve.php';

			$_SESSION['success'] = 'Order Approved successfully';
		  echo "<script>window.location.assign('pay-supplier-details?id=".$row['ref_id']."')</script>";

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}

	if(isset($_POST['disapprove_order'])){
		$id = $_POST['id'];
		$userid = $_POST['userid'];
		// $amount = $_POST['amount'];
		$reason = $_POST['reason'];
		$ref_id = $_POST['ref_id'];

		// $amount_charge = 100-$settings['percentage'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM pay_supplier WHERE ref_id=:ref_id");
		$stmt->execute(['ref_id'=>$ref_id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
	  $stmt->execute(['id'=>$userid]);
	  $iow = $stmt->fetch();

		try{

			$stmt = $conn->prepare("UPDATE pay_supplier SET status = 5 WHERE reason = :reason, ref_id=:ref_id AND userid=:userid");
		  $stmt->execute(['reason'=>$reason, 'ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);

			include 'emails/pay-supplier-order_disapprove.php';

			$_SESSION['success'] = 'Order Set as Unsuccessful';
		  echo "<script>window.location.assign('pay-supplier-details?id=".$row['ref_id']."')</script>";

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}

	if(isset($_POST['refund_order'])){
		$id = $_POST['id'];
		$userid = $_POST['userid'];
		// $amount = $_POST['amount'];
		$reason = $_POST['reason'];
		$ref_id = $_POST['ref_id'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM pay_supplier WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
	  $stmt->execute(['id'=>$userid]);
	  $iow = $stmt->fetch();

		try{

			$stmt = $conn->prepare("UPDATE pay_supplier SET reason = :reason, status = 3, payment_stat = 3 WHERE ref_id=:ref_id AND userid=:userid");
			$stmt->execute(['reason'=>$reason, 'ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);

			$stmt = $conn->prepare("UPDATE transactions SET reason = :reason, status = 3 WHERE ref_id=:ref_id AND userid=:userid");
			$stmt->execute(['reason'=>$reason, 'ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);

			include 'emails/pay-supplier-order_refund.php';

			$_SESSION['success'] = 'Order Refunded successfully';
			echo "<script>window.location.assign('pay-supplier-details?id=".$row['ref_id']."')</script>";

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}

	if(isset($_POST['cancel_order'])){
		$id = $_POST['id'];
		$userid = $_POST['userid'];
		// $amount = $_POST['amount'];
		$reason = $_POST['reason'];
		$ref_id = $_POST['ref_id'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM pay_supplier WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
	  $stmt->execute(['id'=>$userid]);
	  $iow = $stmt->fetch();

		try{

			$stmt = $conn->prepare("UPDATE pay_supplier SET reason = :reason, status = 4, payment_stat = 4 WHERE ref_id=:ref_id AND userid=:userid");
			$stmt->execute(['ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);

			$stmt = $conn->prepare("UPDATE transactions SET reason = :reason, status = 4 WHERE ref_id=:ref_id AND userid=:userid");
			$stmt->execute(['ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);

			include 'emails/pay-supplier-order_cancel.php';

			$_SESSION['success'] = 'Order Refunded successfully';
			echo "<script>window.location.assign('pay-supplier-details?id=".$row['ref_id']."')</script>";

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}

	echo "<script>window.location.assign('pay-supplier')</script>";

?>
