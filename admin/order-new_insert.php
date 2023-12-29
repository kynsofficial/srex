<?php
include 'include/session.php';

if(isset($_GET['return'])){
	$return = $_GET['return'];

}
else{
	$return = 'order-new';
}

$num = '123456789';
$upp = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

$set1 = substr(str_shuffle($upp), 0, 3);
$set2 = substr(str_shuffle($upp), 0, 1);
$set3 = substr(str_shuffle($num), 0, 3);
$set4 = substr(str_shuffle($upp), 0, 1);

$ref_id = 'O'.$set1.'-'.$set2.$set3.$set4.'-'.time();


if(isset($_POST['save'])){
	$userid = $_POST['userid'];
	$order_name = htmlspecialchars($_POST['order_name']);
	$currency = htmlspecialchars($_POST['currency']);
	$destination_country = htmlspecialchars($_POST['destination_country']);
	$shipping_plan = htmlspecialchars($_POST['shipping_plan']);
	$shipping_address = htmlspecialchars($_POST['shipping_address']);

	// echo "<pre>";
	// var_dump($_POST);
	// echo "</pre>";

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM currency WHERE slug=:currency");
	$stmt->execute(['currency'=>$_POST['currency']]);
	$currency1 = $stmt->fetch();

	$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM shipping_rate WHERE myid=:shipping_rate");
	$stmt->execute(['shipping_rate'=>$_POST['destination_country']]);
	$shipping_rate = $stmt->fetch();

	if ($currency1['numrows'] > 0) {

		$now = date('Y-m-d');

		if($shipping_rate['numrows'] > 0){

				$conn = $pdo->open();

				try{
					$stmt = $conn->prepare("INSERT INTO orders (shipping_plan, userid, ref_id, shipping_address, orders_name, currency, destination_country, created_on) VALUES (:shipping_plan, :userid, :ref_id, :shipping_address, :order_name, :currency, :destination_country, :created_on)");
					$stmt->execute(['shipping_plan'=>$shipping_plan, 'userid'=>$userid, 'ref_id'=>$ref_id, 'shipping_address'=>$shipping_address, 'order_name'=>$order_name, 'currency'=>$currency, 'destination_country'=>$destination_country, 'created_on'=>$now]);
					$_SESSION['success'] = 'Order Created, please proceed to add products.';
					// echo $_SESSION['success'];
					// echo "<script>window.location.assign('$return')</script>";
					echo "<script>window.location.assign('order-add-products?id=$ref_id')</script>";
				}
				catch(PDOException $e){
					$_SESSION['order_name'] = $order_name;
					$_SESSION['currency'] = $currency;
					$_SESSION['destination_country'] = $destination_country;
					$_SESSION['shipping_plan'] = $shipping_plan;
					$_SESSION['shipping_address'] = $shipping_address;
					$_SESSION['error'] = $e->getMessage();
					echo $e->getMessage();
				}

				$pdo->close();

			// echo "Yes, everything looks fine";

		}
		else{
			$_SESSION['order_name'] = $order_name;
			$_SESSION['currency'] = $currency;
			$_SESSION['destination_country'] = $destination_country;
			$_SESSION['shipping_plan'] = $shipping_plan;
			$_SESSION['shipping_address'] = $shipping_address;
			$_SESSION['error'] = 'Country not valid';
			// echo 'Amount is too low or not valid!';
		}

	}
	else{
		$_SESSION['order_name'] = $order_name;
		$_SESSION['currency'] = $currency;
		$_SESSION['destination_country'] = $destination_country;
		$_SESSION['shipping_plan'] = $shipping_plan;
		$_SESSION['shipping_address'] = $shipping_address;
		$_SESSION['error'] = 'Currency not specified';
		// echo 'Invalid Payment Method <br>';
	}

}
else{
	$_SESSION['order_name'] = $order_name;
	$_SESSION['currency'] = $currency;
	$_SESSION['destination_country'] = $destination_country;
	$_SESSION['shipping_plan'] = $shipping_plan;
	$_SESSION['shipping_address'] = $shipping_address;
	$_SESSION['error'] = 'Fill up required details first';
}

// header('location: '.$return);
// echo "<script>window.location.assign('$return')</script>";
?>
