<?php
include 'include/session.php';

if(isset($_GET['return'])){
	$return = $_GET['return'];

}
else{
	$return = 'order';
}


if(isset($_POST['save'])){
	$userid = $_POST['userid'];
	$ref_id = htmlspecialchars($_POST['ref_id']);
	$product_name = htmlspecialchars($_POST['product_name']);
	$product_link = htmlspecialchars($_POST['link']);
	$product_category = htmlspecialchars($_POST['product_category']);
	$product_price = htmlspecialchars($_POST['product_price']);
	$product_qty = htmlspecialchars($_POST['product_qty']);
	$product_weight = htmlspecialchars($_POST['product_weight']);
	$product_info = htmlspecialchars($_POST['product_info']);

	// echo "<pre>";
	// var_dump($_POST);
	// echo "</pre>";

	$now = date('Y-m-d');

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM product_category WHERE slug=:product_category");
	$stmt->execute(['product_category'=>$_POST['product_category']]);
	$product_category1 = $stmt->fetch();

	$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM orders WHERE userid=:userid AND ref_id=:ref_id");
	$stmt->execute(['userid'=>$userid, 'ref_id'=>$_POST['ref_id']]);
	$order_details = $stmt->fetch();

	$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM products WHERE product_link=:product_link");
	$stmt->execute(['product_link'=>$_POST['link']]);
	$products = $stmt->fetch();

	$p_id = $_POST['id'];

	if ($order_details['numrows'] > 0) {

		if ($order_details['status'] < 1 OR $order_details['coupon_code'] !== "") {

			if($product_category1['numrows'] > 0){

					$conn = $pdo->open();

					try{

						$stmt = $conn->prepare("UPDATE products SET product_info=:product_info, product_weight=:product_weight, product_link=:product_link, userid=:userid, ref_id=:ref_id, product_qty=:product_qty, product_name=:product_name, product_category=:product_category, product_price=:product_price WHERE id=:id");
						$stmt->execute(['product_info'=>$product_info, 'product_weight'=>$product_weight, 'product_link'=>$product_link, 'userid'=>$userid, 'ref_id'=>$ref_id, 'product_qty'=>$product_qty, 'product_name'=>$product_name, 'product_category'=>$product_category, 'product_price'=>$product_price, 'id'=>$p_id]);
						$_SESSION['success'] = 'Product Updated.';
						// echo $_SESSION['success'];
						// echo "<script>window.location.assign('$return')</script>";
						// echo "<script>window.location.assign('order-edit-products?id=$ref_id&i=$p_id')</script>";
						// echo "<script>window.location.assign('orders')</script>";
						echo "<script>window.location.assign('order-details?id=$ref_id')</script>";
					}
					catch(PDOException $e){
						// $_SESSION['product_name'] = $product_name;
						// $_SESSION['product_link'] = $product_link;
						// $_SESSION['product_category'] = $product_category;
						// $_SESSION['product_price'] = $product_price;
						// $_SESSION['product_qty'] = $product_qty;
						// $_SESSION['product_weight'] = $product_weight;
						// $_SESSION['product_info'] = $product_info;
						$_SESSION['error'] = $e->getMessage();
						echo "<script>window.location.assign('order-edit-products?id=$ref_id&i=$p_id')</script>";
						// echo $e->getMessage();
					}

					$pdo->close();

				// echo "Yes, everything looks fine";

			}
			else{
				$_SESSION['product_name'] = $product_name;
				$_SESSION['product_link'] = $product_link;
				$_SESSION['product_category'] = $product_category;
				$_SESSION['product_price'] = $product_price;
				$_SESSION['product_qty'] = $product_qty;
				$_SESSION['product_weight'] = $product_weight;
				$_SESSION['product_info'] = $product_info;
				$_SESSION['error'] = 'Product Category does not exist';
				echo "<script>window.location.assign('order-edit-products?id=$ref_id&i=$p_id')</script>";
				// echo 'Amount is too low or not valid!';
			}

		}
		else{
			$_SESSION['error'] = 'Order is already been processed. You cannot alter products.';
			echo "<script>window.location.assign('order-details?id=$ref_id')</script>";
			// echo 'Amount is too low or not valid!';
		}

	}
	else{
		$_SESSION['error'] = 'Wrong Order';
		echo "<script>window.location.assign('order-edit-products?id=$ref_id&i=$p_id')</script>";
	}

}
else{
	$_SESSION['error'] = 'Fill up required details first';
	echo "<script>window.location.assign('order-edit-products?id=$ref_id&i=$p_id')</script>";
}

// header('location: '.$return);
// echo $_SESSION['error'];
// echo "<script>window.location.assign('$return')</script>";
?>
