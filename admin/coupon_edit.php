<?php
	include 'include/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$coupon_code = $_POST['coupon_code'];
		$type = $_POST['type'];
		$value_type = $_POST['value_type'];
		$currency = $_POST['currency'];
		$value = $_POST['value'];
		$validity = $_POST['validity'];

		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT * FROM coupon WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		try{
			$stmt = $conn->prepare("UPDATE coupon SET type=:type, value_type=:value_type, currency=:currency, coupon_code=:coupon_code, value=:value, validity=:validity WHERE id=:id");
			$stmt->execute(['type'=>$type, 'value_type'=>$value_type, 'currency'=>$currency, 'coupon_code'=>$coupon_code, 'value'=>$value, 'validity'=>$validity, 'id'=>$id]);
			$_SESSION['success'] = 'Coupon updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit admin form first';
	}

	header('location: coupons');

?>
