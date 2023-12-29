<?php
include 'include/session.php';
$slug = $_GET['id'];
$i = $_GET['i'];
$userid = $_GET['userid'];

if(isset($_GET['return'])){
	$return = $_GET['return'];

}
else{
	$return = 'order-details?id='.$slug;
}


$conn = $pdo->open();

$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM products WHERE ref_id = :slug AND id = :id");
$stmt->execute(['slug' => $slug, 'id'=>$i]);
$products = $stmt->fetch();

$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM orders WHERE userid=:userid AND ref_id=:ref_id");
$stmt->execute(['userid'=>$userid, 'ref_id'=>$slug]);
$order_details = $stmt->fetch();

if ($order_details['status'] < 1 OR $order_details['coupon_code'] !== "") {

	if ($products['numrows'] > 0) {
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("DELETE FROM products WHERE userid=:userid AND ref_id = :slug AND id = :id");
			$stmt->execute(['userid'=>$userid, 'slug' => $slug, 'id'=>$i]);

			$_SESSION['success'] = 'Product deleted successfully';
			// echo $_SESSION['success'];
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


	}
	else{
		$_SESSION['error'] = 'Select product to delete first';
		// echo $_SESSION['error'];
	}

}
else{
	$_SESSION['error'] = 'Order is already been processed. You cannot alter products.';
	echo "<script>window.location.assign('order-details?id=$slug')</script>";
	// echo 'Amount is too low or not valid!';
}

$pdo->close();
// header('location: '.$return);
// echo $_SESSION['error'];
echo "<script>window.location.assign('$return')</script>";
?>
