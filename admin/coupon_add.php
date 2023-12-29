<?php
	include 'include/session.php';

	if(isset($_POST['add'])){
		$coupon_code = $_POST['coupon_code'];
		$type = $_POST['type'];
		$value_type = $_POST['value_type'];
		$currency = $_POST['currency'];
		$value = $_POST['value'];
		$validity = $_POST['validity'];
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM coupon WHERE coupon_code=:coupon_code");
		$stmt->execute(['coupon_code'=>$coupon_code]);
		$row = $stmt->fetch();


		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Coupon Code already exist';
		}
		else{
			$now = date('Y-m-d');
			try{
				$stmt = $conn->prepare("INSERT INTO coupon (type, validity, currency, value, value_type, coupon_code) VALUES (:type, :validity, :currency, :value, :value_type, :coupon_code)");
				$stmt->execute(['type'=>$type, 'validity'=>$validity, 'currency'=>$currency, 'value'=>$value, 'value_type'=>$value_type, 'coupon_code'=>$coupon_code]);
				$_SESSION['success'] = 'Coupon added successfully';

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

	header('location: coupons');

?>
