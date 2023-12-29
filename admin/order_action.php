<?php

	include 'include/session.php';

	if(isset($_POST['approve_goods'])){
	    $id = $_POST['id'];
		$userid = $_POST['userid'];
		// $amount = $_POST['amount'];
		$ref_id = $_POST['ref_id'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM orders WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
    	$stmt->execute(['id'=>$userid]);
    	$iow = $stmt->fetch();

		try{

			if ($row['payment_shipping_stat'] == 2) {
				$stmt = $conn->prepare("UPDATE orders SET payment_goods_stat = 2, status = 2, payment_stat = 1 WHERE ref_id=:ref_id AND userid=:userid");
				$stmt->execute(['ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);
			}
			else {
				$stmt = $conn->prepare("UPDATE orders SET payment_goods_stat = 2 WHERE ref_id=:ref_id AND userid=:userid");
				$stmt->execute(['ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);
			}

			$stmt = $conn->prepare("UPDATE transactions SET status = 1 WHERE trx_id=:trx_id AND userid=:userid");
			$stmt->execute(['trx_id'=>$row['trx_id'], 'userid'=>$iow['id']]);

			//include 'emails/pay-supplier-order_cancel.php';

			$_SESSION['success'] = 'Goods Payment successfully';
			echo "<script>window.location.assign('order-details?id=".$row['ref_id']."')</script>";

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}

	if(isset($_POST['approve_shipping'])){
	    $id = $_POST['id'];
		$userid = $_POST['userid'];
		// $amount = $_POST['amount'];
		$ref_id = $_POST['ref_id'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM orders WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
    	$stmt->execute(['id'=>$userid]);
    	$iow = $stmt->fetch();

		try{

			if ($row['payment_goods_stat'] == 2) {
				$stmt = $conn->prepare("UPDATE orders SET payment_shipping_stat = 2, status = 2, payment_stat = 1 WHERE ref_id=:ref_id AND userid=:userid");
				$stmt->execute(['ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);
			}
			else {
				$stmt = $conn->prepare("UPDATE orders SET payment_shipping_stat = 2 WHERE ref_id=:ref_id AND userid=:userid");
				$stmt->execute(['ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);
			}

			$stmt = $conn->prepare("UPDATE transactions SET status = 1 WHERE trx_id=:trx_id AND userid=:userid");
			$stmt->execute(['trx_id'=>$row['trx_id'], 'userid'=>$iow['id']]);

			//include 'emails/pay-supplier-order_cancel.php';

			$_SESSION['success'] = 'Shipping Payment successfully';
			echo "<script>window.location.assign('order-details?id=".$row['ref_id']."')</script>";

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}

	if(isset($_POST['approve_commitment'])){
	    $id = $_POST['id'];
		$userid = $_POST['userid'];
		// $amount = $_POST['amount'];
		$ref_id = $_POST['ref_id'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM orders WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
    	$stmt->execute(['id'=>$userid]);
    	$iow = $stmt->fetch();

		try{

			$stmt = $conn->prepare("UPDATE orders SET commitment = 1 WHERE ref_id=:ref_id AND userid=:userid");
			$stmt->execute(['ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);

			$stmt = $conn->prepare("UPDATE transactions SET status = 1 WHERE trx_id=:trx_id AND userid=:userid");
			$stmt->execute(['trx_id'=>$row['trx_id'], 'userid'=>$iow['id']]);

			//include 'emails/pay-supplier-order_cancel.php';

			$_SESSION['success'] = 'Commitment Fee Payment successfully';
			echo "<script>window.location.assign('order-details?id=".$row['ref_id']."')</script>";

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}

	if(isset($_POST['disapprove_commitment'])){
	    $id = $_POST['id'];
		$userid = $_POST['userid'];
		// $amount = $_POST['amount'];
		$ref_id = $_POST['ref_id'];
		$reason = $_POST['reason'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM orders WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
    	$stmt->execute(['id'=>$userid]);
    	$iow = $stmt->fetch();

		try{

			$stmt = $conn->prepare("UPDATE orders SET commitment = 0 WHERE ref_id=:ref_id AND userid=:userid");
			$stmt->execute(['ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);

			$stmt = $conn->prepare("UPDATE transactions SET status = 0, reason=:reason WHERE trx_id=:trx_id AND userid=:userid");
			$stmt->execute(['reason'=>$reason, 'trx_id'=>$row['trx_id'], 'userid'=>$iow['id']]);

			//include 'emails/pay-supplier-order_cancel.php';

			$_SESSION['success'] = 'Commitment Fee Payment Unsuccessfully';
			echo "<script>window.location.assign('order-details?id=".$row['ref_id']."')</script>";

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}

	if(isset($_POST['approve'])){
		$id = $_POST['id'];
		$userid = $_POST['userid'];
		// $amount = $_POST['amount'];
		$ref_id = $_POST['ref_id'];

		// $amount_charge = 100-$settings['percentage'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM orders WHERE ref_id=:ref_id");
		$stmt->execute(['ref_id'=>$ref_id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
	  $stmt->execute(['id'=>$userid]);
	  $iow = $stmt->fetch();

		try
		{

			{
				$stmtat = $conn->prepare("SELECT * FROM currency WHERE slug=:slug");
				$stmtat->execute(['slug'=>$row['currency']]);
				$currency = $stmtat->fetch();

				$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM products WHERE ref_id=:ref_id");
				$stmt->execute(['ref_id'=>$row['ref_id']]);
				// $products = $stmt->fetch();

				$total_amount = 0;
				$total_weight = 0;
				$total_qty = 0;

					foreach($stmt as $products){
						$subtotal_amount = $products['product_qty'] * $products['product_price'];
						$total_amount += $subtotal_amount;

						$subtotal_weight = $products['product_qty'] * $products['product_weight'];
						$total_weight += $subtotal_weight;

						$subtotal_qty = $products['product_qty'];
						$total_qty += $subtotal_qty;
					}

				$stmt1 = $conn->prepare("SELECT * FROM shipping_plan WHERE slug=:shipping_plan");
				$stmt1->execute(['shipping_plan'=>$row['shipping_plan']]);
				$shipping_plan = $stmt1->fetch();

				$stmt1 = $conn->prepare("SELECT * FROM shipping_rate WHERE myid=:shipping_rate");
				$stmt1->execute(['shipping_rate'=>$row['destination_country']]);
				$shipping_rate = $stmt1->fetch();

				$international_transportation_cost = $shipping_plan['price'] * $total_weight;
				$domestic_transportation_cost = $rates['domestic_transportation_cost'] * $total_qty;
				$converted2 = $domestic_transportation_cost + $international_transportation_cost;

				if ($currency['slug'] == "Yuan") {
					$converted = $total_amount * $rates['yuan_naira_rate'];
					$converted1 = $total_amount * $rates['yuan_dollar_rate'];

					// Total
					$total_amount1 = $total_amount + ($converted2 * $rates['dollar_yuan_rate']);

					$service_charge_amount = $total_amount * ($rates['order_rate']/100);
					$service_charge_total = number_format($total_amount + $service_charge_amount, 2);

					$vat_charge_amount = $total_amount * ($rates['vat']/100);
					$vat_charge_total = number_format($total_amount + $vat_charge_amount, 2);

					$total_charges = $service_charge_amount + $vat_charge_amount;

					$total_yuan_o = $total_amount1 + $total_charges;
					$total_yuan = $total_amount1 + $total_charges;
					$grand_total_yuan = number_format($row['discount_yuan_amount'], 2);

					$total_usd = number_format($total_yuan_o * $rates['yuan_dollar_rate'], 2);
					$grand_total_usd = number_format($row['discount_usd_amount'], 2);
					$total_naira = number_format($total_yuan_o * $rates['yuan_naira_rate'], 2);
					$grand_total_naira = number_format($row['discount_naira_amount'], 2);
				}
				elseif ($currency['slug'] == "Dollar") {
					$converted = $total_amount * $rates['dollar_naira_rate'];

					$service_charge_amount = $total_amount * ($rates['order_rate']/100);
					$service_charge_total = number_format($total_amount + $service_charge_amount, 2);

					$vat_charge_amount = $total_amount * ($rates['vat']/100);
					$vat_charge_total = number_format($total_amount + $vat_charge_amount, 2);

					$total_charges = $service_charge_amount + $vat_charge_amount;

					$total_usd_o = $total_amount + $converted2 + $total_charges;
					$total_usd = number_format($total_amount + $converted2 + $total_charges, 2);
					$grand_total_usd = number_format($row['discount_usd_amount'], 2);
					$total_naira = number_format($total_usd_o * $rates['dollar_naira_rate'], 2);
					$grand_total_naira = number_format($row['discount_naira_amount'], 2);
				}

				$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM coupon WHERE coupon_code=:coupon_code ");
				$stmt->execute(['coupon_code'=>$row['coupon_code']]);
				$coupon_code = $stmt->fetch();

				$stmt1 = $conn->prepare("SELECT * FROM currency WHERE id = :id");
				$stmt1->execute(['id'=>$coupon_code['currency']]);
				$currency_coupon = $stmt1->fetch();

				if ($coupon_code['value_type'] == 0) {
					$value = $coupon_code['value']."%"; // "Percentage"
				}elseif ($coupon_code['value_type'] == 1) {
					$value = $currency_coupon['sign']."".$coupon_code['value']; // "Amount"
				}

				if ($currency['slug'] == "Yuan") {
					if ($row['coupon_code'] !== "") {
						$amount = "<div style='line-height: 1 !important; color: #a1acb8 !important;'><span style='color: #696cff !important; font-weight: 600 !important;'>".$currency['sign']."".$grand_total_yuan."</span></div>
						<small style='font-size: 85%; color: #a1acb8 !important;'>".$settings['currency']."".$grand_total_naira."</small>";
					}else {
						$amount = "<div style='line-height: 1 !important; color: #a1acb8 !important;'><span style='color: #696cff !important; font-weight: 600 !important;'>".$currency['sign']."".number_format($total_yuan)."</span></div>
						<small style='font-size: 85%; color: #a1acb8 !important;'>".$settings['currency']."".$total_naira."</small>";
					}
				}elseif ($currency['slug'] == "Dollar") {
					if ($row['coupon_code'] !== "") {
						$amount = "<div style='line-height: 1 !important; color: #a1acb8 !important;'><span style='color: #696cff !important; font-weight: 600 !important;'>".$currency['sign']."".$grand_total_usd."</span></div>
						<small style='font-size: 85%; color: #a1acb8 !important;'>".$settings['currency']."".$grand_total_naira."</small>";
					}else {
						$amount = "<div style='line-height: 1 !important; color: #a1acb8 !important;'><span style='color: #696cff !important; font-weight: 600 !important;'>".$currency['sign']."".$total_usd."</span></div>
						<small style='font-size: 85%; color: #a1acb8 !important;'>".$settings['currency']."".$total_naira."</small>";
					}
				}
			}

			$stmt = $conn->prepare("UPDATE orders SET payment_goods_stat = 2, payment_shipping_stat = 2, payment_stat = 1, status = 2 WHERE ref_id=:ref_id AND userid=:userid");
		  $stmt->execute(['ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);

		  $stmt = $conn->prepare("UPDATE transactions SET status = 1 WHERE ref_id=:ref_id");
		  $stmt->execute(['ref_id'=>$row['ref_id']]);

			include 'emails/order_approve.php';

			$_SESSION['success'] = 'Transaction Approved successfully';
		  echo "<script>window.location.assign('order-details?id=".$row['ref_id']."')</script>";

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

		$stmt = $conn->prepare("SELECT * FROM orders WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
	  $stmt->execute(['id'=>$userid]);
	  $iow = $stmt->fetch();

		try{

			$stmt = $conn->prepare("UPDATE orders SET payment_goods_stat = 0, payment_shiping_stat = 0, payment_stat = 5, reason = :reason, status = 0 WHERE ref_id=:ref_id AND userid=:userid");
		  $stmt->execute(['reason'=>$reason, 'ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);

		  $stmt = $conn->prepare("UPDATE transactions SET reason = :reason, status = 5 WHERE ref_id=:ref_id");
		  $stmt->execute(['reason'=>$reason, 'ref_id'=>$row['ref_id']]);

			include 'emails/order_disapprove.php';

		  $_SESSION['success'] = 'Transaction Disapproved successfully';
		  echo "<script>window.location.assign('order-details?id=".$row['ref_id']."')</script>";

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

		$stmt = $conn->prepare("SELECT * FROM orders WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
	  $stmt->execute(['id'=>$userid]);
	  $iow = $stmt->fetch();

		try{

			$stmt = $conn->prepare("UPDATE orders SET payment_stat = 3, reason = :reason, status = 3 WHERE ref_id=:ref_id AND userid=:userid");
			$stmt->execute(['reason'=>$reason, 'ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);

			$stmt = $conn->prepare("UPDATE transactions SET reason = :reason, status = 3 WHERE ref_id=:ref_id");
			$stmt->execute(['reason'=>$reason, 'ref_id'=>$row['ref_id']]);

			include 'emails/order_refund.php';

			$_SESSION['success'] = 'Transaction Refunded successfully';
			echo "<script>window.location.assign('order-details?id=".$row['ref_id']."')</script>";

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

		$stmt = $conn->prepare("SELECT * FROM orders WHERE ref_id=:ref_id");
		$stmt->execute(['ref_id'=>$ref_id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
	  $stmt->execute(['id'=>$userid]);
	  $iow = $stmt->fetch();

		try{

			{
				$stmtat = $conn->prepare("SELECT * FROM currency WHERE slug=:slug");
				$stmtat->execute(['slug'=>$row['currency']]);
				$currency = $stmtat->fetch();

				$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM products WHERE ref_id=:ref_id");
				$stmt->execute(['ref_id'=>$row['ref_id']]);
				// $products = $stmt->fetch();

				$total_amount = 0;
				$total_weight = 0;
				$total_qty = 0;

					foreach($stmt as $products){
						$subtotal_amount = $products['product_qty'] * $products['product_price'];
						$total_amount += $subtotal_amount;

						$subtotal_weight = $products['product_qty'] * $products['product_weight'];
						$total_weight += $subtotal_weight;

						$subtotal_qty = $products['product_qty'];
						$total_qty += $subtotal_qty;
					}

				$stmt1 = $conn->prepare("SELECT * FROM shipping_plan WHERE slug=:shipping_plan");
				$stmt1->execute(['shipping_plan'=>$row['shipping_plan']]);
				$shipping_plan = $stmt1->fetch();

				$stmt1 = $conn->prepare("SELECT * FROM shipping_rate WHERE myid=:shipping_rate");
				$stmt1->execute(['shipping_rate'=>$row['destination_country']]);
				$shipping_rate = $stmt1->fetch();

				$international_transportation_cost = $shipping_plan['price'] * $total_weight;
				$domestic_transportation_cost = $rates['domestic_transportation_cost'] * $total_qty;
				$converted2 = $domestic_transportation_cost + $international_transportation_cost;

				if ($currency['slug'] == "Yuan") {
					$converted = $total_amount * $rates['yuan_naira_rate'];
					$converted1 = $total_amount * $rates['yuan_dollar_rate'];

					// Total
					$total_amount1 = $total_amount + ($converted2 * $rates['dollar_yuan_rate']);

					$service_charge_amount = $total_amount * ($rates['order_rate']/100);
					$service_charge_total = number_format($total_amount + $service_charge_amount, 2);

					$vat_charge_amount = $total_amount * ($rates['vat']/100);
					$vat_charge_total = number_format($total_amount + $vat_charge_amount, 2);

					$total_charges = $service_charge_amount + $vat_charge_amount;

					$total_yuan_o = $total_amount1 + $total_charges;
					$total_yuan = $total_amount1 + $total_charges;
					$grand_total_yuan = number_format($row['discount_yuan_amount'], 2);

					$total_usd = number_format($total_yuan_o * $rates['yuan_dollar_rate'], 2);
					$grand_total_usd = number_format($row['discount_usd_amount'], 2);
					$total_naira = number_format($total_yuan_o * $rates['yuan_naira_rate'], 2);
					$grand_total_naira = number_format($row['discount_naira_amount'], 2);
				}
				elseif ($currency['slug'] == "Dollar") {
					$converted = $total_amount * $rates['dollar_naira_rate'];

					$service_charge_amount = $total_amount * ($rates['order_rate']/100);
					$service_charge_total = number_format($total_amount + $service_charge_amount, 2);

					$vat_charge_amount = $total_amount * ($rates['vat']/100);
					$vat_charge_total = number_format($total_amount + $vat_charge_amount, 2);

					$total_charges = $service_charge_amount + $vat_charge_amount;

					$total_usd_o = $total_amount + $converted2 + $total_charges;
					$total_usd = number_format($total_amount + $converted2 + $total_charges, 2);
					$grand_total_usd = number_format($row['discount_usd_amount'], 2);
					$total_naira = number_format($total_usd_o * $rates['dollar_naira_rate'], 2);
					$grand_total_naira = number_format($row['discount_naira_amount'], 2);
				}

				$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM coupon WHERE coupon_code=:coupon_code ");
				$stmt->execute(['coupon_code'=>$row['coupon_code']]);
				$coupon_code = $stmt->fetch();

				$stmt1 = $conn->prepare("SELECT * FROM currency WHERE id = :id");
				$stmt1->execute(['id'=>$coupon_code['currency']]);
				$currency_coupon = $stmt1->fetch();

				if ($coupon_code['value_type'] == 0) {
					$value = $coupon_code['value']."%"; // "Percentage"
				}elseif ($coupon_code['value_type'] == 1) {
					$value = $currency_coupon['sign']."".$coupon_code['value']; // "Amount"
				}

				if ($currency['slug'] == "Yuan") {
					if ($row['coupon_code'] !== "") {
						$amount = "<div style='line-height: 1 !important; color: #a1acb8 !important;'><span style='color: #696cff !important; font-weight: 600 !important;'>".$currency['sign']."".number_format($grand_total_yuan)."</span></div>
						<small style='font-size: 85%; color: #a1acb8 !important;'>".$settings['currency']."".number_format($grand_total_naira)."</small>";
					}else {
						$amount = "<div style='line-height: 1 !important; color: #a1acb8 !important;'><span style='color: #696cff !important; font-weight: 600 !important;'>".$currency['sign']."".number_format($total_yuan)."</span></div>
						<small style='font-size: 85%; color: #a1acb8 !important;'>".$settings['currency']."".$total_naira."</small>";
					}
				}elseif ($currency['slug'] == "Dollar") {
					if ($row['coupon_code'] !== "") {
						$amount = "<div style='line-height: 1 !important; color: #a1acb8 !important;'><span style='color: #696cff !important; font-weight: 600 !important;'>".$currency['sign']."".number_format($grand_total_usd)."</span></div>
						<small style='font-size: 85%; color: #a1acb8 !important;'>".$settings['currency']."".number_format($grand_total_naira)."</small>";
					}else {
						$amount = "<div style='line-height: 1 !important; color: #a1acb8 !important;'><span style='color: #696cff !important; font-weight: 600 !important;'>".$currency['sign']."".number_format($total_usd)."</span></div>
						<small style='font-size: 85%; color: #a1acb8 !important;'>".$settings['currency']."".$total_naira."</small>";
					}
				}
			}

			$stmt = $conn->prepare("UPDATE orders SET status = 1 WHERE ref_id=:ref_id AND userid=:userid");
		  $stmt->execute(['ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);
            // Send email
			include 'emails/ps-order_approve.php';
            // Send SMS
			include 'sms_send/ps-order_approve.php';

			$_SESSION['success'] = 'Order Approved successfully';
		    echo "<script>window.location.assign('order-details?id=".$row['ref_id']."')</script>";

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}

	if(isset($_POST['delivery_order'])){
		$id = $_POST['id'];
		$userid = $_POST['userid'];
		// $amount = $_POST['amount'];
		$ref_id = $_POST['ref_id'];

		// $amount_charge = 100-$settings['percentage'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM orders WHERE ref_id=:ref_id");
		$stmt->execute(['ref_id'=>$ref_id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
	    $stmt->execute(['id'=>$userid]);
	    $iow = $stmt->fetch();

		try{

			{
				$stmtat = $conn->prepare("SELECT * FROM currency WHERE slug=:slug");
				$stmtat->execute(['slug'=>$row['currency']]);
				$currency = $stmtat->fetch();

				$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM products WHERE ref_id=:ref_id");
				$stmt->execute(['ref_id'=>$row['ref_id']]);
				// $products = $stmt->fetch();

				$total_amount = 0;
				$total_weight = 0;
				$total_qty = 0;

					foreach($stmt as $products){
						$subtotal_amount = $products['product_qty'] * $products['product_price'];
						$total_amount += $subtotal_amount;

						$subtotal_weight = $products['product_qty'] * $products['product_weight'];
						$total_weight += $subtotal_weight;

						$subtotal_qty = $products['product_qty'];
						$total_qty += $subtotal_qty;
					}

				$stmt1 = $conn->prepare("SELECT * FROM shipping_plan WHERE slug=:shipping_plan");
				$stmt1->execute(['shipping_plan'=>$row['shipping_plan']]);
				$shipping_plan = $stmt1->fetch();

				$stmt1 = $conn->prepare("SELECT * FROM shipping_rate WHERE myid=:shipping_rate");
				$stmt1->execute(['shipping_rate'=>$row['destination_country']]);
				$shipping_rate = $stmt1->fetch();

				$international_transportation_cost = $shipping_plan['price'] * $total_weight;
				$domestic_transportation_cost = $rates['domestic_transportation_cost'] * $total_qty;
				$converted2 = $domestic_transportation_cost + $international_transportation_cost;

				if ($currency['slug'] == "Yuan") {
					$converted = $total_amount * $rates['yuan_naira_rate'];
					$converted1 = $total_amount * $rates['yuan_dollar_rate'];

					// Total
					$total_amount1 = $total_amount + ($converted2 * $rates['dollar_yuan_rate']);

					$service_charge_amount = $total_amount * ($rates['order_rate']/100);
					$service_charge_total = number_format($total_amount + $service_charge_amount, 2);

					$vat_charge_amount = $total_amount * ($rates['vat']/100);
					$vat_charge_total = number_format($total_amount + $vat_charge_amount, 2);

					$total_charges = $service_charge_amount + $vat_charge_amount;

					$total_yuan_o = $total_amount1 + $total_charges;
					$total_yuan = $total_amount1 + $total_charges;
					$grand_total_yuan = number_format($row['discount_yuan_amount'], 2);

					$total_usd = number_format($total_yuan_o * $rates['yuan_dollar_rate'], 2);
					$grand_total_usd = number_format($row['discount_usd_amount'], 2);
					$total_naira = number_format($total_yuan_o * $rates['yuan_naira_rate'], 2);
					$grand_total_naira = number_format($row['discount_naira_amount'], 2);
				}
				elseif ($currency['slug'] == "Dollar") {
					$converted = $total_amount * $rates['dollar_naira_rate'];

					$service_charge_amount = $total_amount * ($rates['order_rate']/100);
					$service_charge_total = number_format($total_amount + $service_charge_amount, 2);

					$vat_charge_amount = $total_amount * ($rates['vat']/100);
					$vat_charge_total = number_format($total_amount + $vat_charge_amount, 2);

					$total_charges = $service_charge_amount + $vat_charge_amount;

					$total_usd_o = $total_amount + $converted2 + $total_charges;
					$total_usd = number_format($total_amount + $converted2 + $total_charges, 2);
					$grand_total_usd = number_format($row['discount_usd_amount'], 2);
					$total_naira = number_format($total_usd_o * $rates['dollar_naira_rate'], 2);
					$grand_total_naira = number_format($row['discount_naira_amount'], 2);
				}

				$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM coupon WHERE coupon_code=:coupon_code ");
				$stmt->execute(['coupon_code'=>$row['coupon_code']]);
				$coupon_code = $stmt->fetch();

				$stmt1 = $conn->prepare("SELECT * FROM currency WHERE id = :id");
				$stmt1->execute(['id'=>$coupon_code['currency']]);
				$currency_coupon = $stmt1->fetch();

				if ($coupon_code['value_type'] == 0) {
					$value = $coupon_code['value']."%"; // "Percentage"
				}elseif ($coupon_code['value_type'] == 1) {
					$value = $currency_coupon['sign']."".$coupon_code['value']; // "Amount"
				}

				if ($currency['slug'] == "Yuan") {
					if ($row['coupon_code'] !== "") {
						$amount = "<div style='line-height: 1 !important; color: #a1acb8 !important;'><span style='color: #696cff !important; font-weight: 600 !important;'>".$currency['sign']."".number_format($grand_total_yuan)."</span></div>
						<small style='font-size: 85%; color: #a1acb8 !important;'>".$settings['currency']."".number_format($grand_total_naira)."</small>";
					}else {
						$amount = "<div style='line-height: 1 !important; color: #a1acb8 !important;'><span style='color: #696cff !important; font-weight: 600 !important;'>".$currency['sign']."".number_format($total_yuan)."</span></div>
						<small style='font-size: 85%; color: #a1acb8 !important;'>".$settings['currency']."".$total_naira."</small>";
					}
				}elseif ($currency['slug'] == "Dollar") {
					if ($row['coupon_code'] !== "") {
						$amount = "<div style='line-height: 1 !important; color: #a1acb8 !important;'><span style='color: #696cff !important; font-weight: 600 !important;'>".$currency['sign']."".number_format($grand_total_usd)."</span></div>
						<small style='font-size: 85%; color: #a1acb8 !important;'>".$settings['currency']."".number_format($grand_total_naira)."</small>";
					}else {
						$amount = "<div style='line-height: 1 !important; color: #a1acb8 !important;'><span style='color: #696cff !important; font-weight: 600 !important;'>".$currency['sign']."".number_format($total_usd)."</span></div>
						<small style='font-size: 85%; color: #a1acb8 !important;'>".$settings['currency']."".$total_naira."</small>";
					}
				}
			}

			$stmt = $conn->prepare("UPDATE orders SET status = 5 WHERE ref_id=:ref_id AND userid=:userid");
		  $stmt->execute(['ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);
            // Send email
			include 'emails/ps-order_delivery.php';
            // Send SMS
			include 'sms_send/ps-order_delivery.php';

			$_SESSION['success'] = 'Order Set to shipping in progress successfully';
		  //echo "<script>window.location.assign('order-details?id=".$row['ref_id']."')</script>";

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

		$stmt = $conn->prepare("SELECT * FROM orders WHERE ref_id=:ref_id");
		$stmt->execute(['ref_id'=>$ref_id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
	  $stmt->execute(['id'=>$userid]);
	  $iow = $stmt->fetch();

		try{

			{
				$stmtat = $conn->prepare("SELECT * FROM currency WHERE slug=:slug");
				$stmtat->execute(['slug'=>$row['currency']]);
				$currency = $stmtat->fetch();

				$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM products WHERE ref_id=:ref_id");
				$stmt->execute(['ref_id'=>$row['ref_id']]);
				// $products = $stmt->fetch();

				$total_amount = 0;
				$total_weight = 0;
				$total_qty = 0;

					foreach($stmt as $products){
						$subtotal_amount = $products['product_qty'] * $products['product_price'];
						$total_amount += $subtotal_amount;

						$subtotal_weight = $products['product_qty'] * $products['product_weight'];
						$total_weight += $subtotal_weight;

						$subtotal_qty = $products['product_qty'];
						$total_qty += $subtotal_qty;
					}

				$stmt1 = $conn->prepare("SELECT * FROM shipping_plan WHERE slug=:shipping_plan");
				$stmt1->execute(['shipping_plan'=>$row['shipping_plan']]);
				$shipping_plan = $stmt1->fetch();

				$stmt1 = $conn->prepare("SELECT * FROM shipping_rate WHERE myid=:shipping_rate");
				$stmt1->execute(['shipping_rate'=>$row['destination_country']]);
				$shipping_rate = $stmt1->fetch();

				$international_transportation_cost = $shipping_plan['price'] * $total_weight;
				$domestic_transportation_cost = $rates['domestic_transportation_cost'] * $total_qty;
				$converted2 = $domestic_transportation_cost + $international_transportation_cost;

				if ($currency['slug'] == "Yuan") {
					$converted = $total_amount * $rates['yuan_naira_rate'];
					$converted1 = $total_amount * $rates['yuan_dollar_rate'];

					// Total
					$total_amount1 = $total_amount + ($converted2 * $rates['dollar_yuan_rate']);

					$service_charge_amount = $total_amount * ($rates['order_rate']/100);
					$service_charge_total = number_format($total_amount + $service_charge_amount, 2);

					$vat_charge_amount = $total_amount * ($rates['vat']/100);
					$vat_charge_total = number_format($total_amount + $vat_charge_amount, 2);

					$total_charges = $service_charge_amount + $vat_charge_amount;

					$total_yuan_o = $total_amount1 + $total_charges;
					$total_yuan = $total_amount1 + $total_charges;
					$grand_total_yuan = number_format($row['discount_yuan_amount'], 2);

					$total_usd = number_format($total_yuan_o * $rates['yuan_dollar_rate'], 2);
					$grand_total_usd = number_format($row['discount_usd_amount'], 2);
					$total_naira = number_format($total_yuan_o * $rates['yuan_naira_rate'], 2);
					$grand_total_naira = number_format($row['discount_naira_amount'], 2);
				}
				elseif ($currency['slug'] == "Dollar") {
					$converted = $total_amount * $rates['dollar_naira_rate'];

					$service_charge_amount = $total_amount * ($rates['order_rate']/100);
					$service_charge_total = number_format($total_amount + $service_charge_amount, 2);

					$vat_charge_amount = $total_amount * ($rates['vat']/100);
					$vat_charge_total = number_format($total_amount + $vat_charge_amount, 2);

					$total_charges = $service_charge_amount + $vat_charge_amount;

					$total_usd_o = $total_amount + $converted2 + $total_charges;
					$total_usd = number_format($total_amount + $converted2 + $total_charges, 2);
					$grand_total_usd = number_format($row['discount_usd_amount'], 2);
					$total_naira = number_format($total_usd_o * $rates['dollar_naira_rate'], 2);
					$grand_total_naira = number_format($row['discount_naira_amount'], 2);
				}

				$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM coupon WHERE coupon_code=:coupon_code ");
				$stmt->execute(['coupon_code'=>$row['coupon_code']]);
				$coupon_code = $stmt->fetch();

				$stmt1 = $conn->prepare("SELECT * FROM currency WHERE id = :id");
				$stmt1->execute(['id'=>$coupon_code['currency']]);
				$currency_coupon = $stmt1->fetch();

				if ($coupon_code['value_type'] == 0) {
					$value = $coupon_code['value']."%"; // "Percentage"
				}elseif ($coupon_code['value_type'] == 1) {
					$value = $currency_coupon['sign']."".$coupon_code['value']; // "Amount"
				}

				if ($currency['slug'] == "Yuan") {
					if ($row['coupon_code'] !== "") {
						$amount = "<div style='line-height: 1 !important; color: #a1acb8 !important;'><span style='color: #696cff !important; font-weight: 600 !important;'>".$currency['sign']."".number_format($grand_total_yuan)."</span></div>
						<small style='font-size: 85%; color: #a1acb8 !important;'>".$settings['currency']."".number_format($grand_total_naira)."</small>";
					}else {
						$amount = "<div style='line-height: 1 !important; color: #a1acb8 !important;'><span style='color: #696cff !important; font-weight: 600 !important;'>".$currency['sign']."".number_format($total_yuan)."</span></div>
						<small style='font-size: 85%; color: #a1acb8 !important;'>".$settings['currency']."".$total_naira."</small>";
					}
				}elseif ($currency['slug'] == "Dollar") {
					if ($row['coupon_code'] !== "") {
						$amount = "<div style='line-height: 1 !important; color: #a1acb8 !important;'><span style='color: #696cff !important; font-weight: 600 !important;'>".$currency['sign']."".number_format($grand_total_usd)."</span></div>
						<small style='font-size: 85%; color: #a1acb8 !important;'>".$settings['currency']."".number_format($grand_total_naira)."</small>";
					}else {
						$amount = "<div style='line-height: 1 !important; color: #a1acb8 !important;'><span style='color: #696cff !important; font-weight: 600 !important;'>".$currency['sign']."".number_format($total_usd)."</span></div>
						<small style='font-size: 85%; color: #a1acb8 !important;'>".$settings['currency']."".$total_naira."</small>";
					}
				}
			}

			$stmt = $conn->prepare("UPDATE orders SET status = 7 WHERE reason = :reason, ref_id=:ref_id AND userid=:userid");
		  $stmt->execute(['reason'=>$reason, 'ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);

			include 'emails/ps-order_disapprove.php';

			$_SESSION['success'] = 'Order Set as Unsuccessful';
		  echo "<script>window.location.assign('order-details?id=".$row['ref_id']."')</script>";

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

		$stmt = $conn->prepare("SELECT * FROM orders WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
	  $stmt->execute(['id'=>$userid]);
	  $iow = $stmt->fetch();

		try{

			$stmt = $conn->prepare("UPDATE orders SET reason = :reason, status = 3, payment_stat = 3 WHERE ref_id=:ref_id AND userid=:userid");
			$stmt->execute(['reason'=>$reason, 'ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);

			$stmt = $conn->prepare("UPDATE transactions SET reason = :reason, status = 3 WHERE ref_id=:ref_id AND userid=:userid");
			$stmt->execute(['reason'=>$reason, 'ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);

			include 'emails/pay-supplier-order_refund.php';

			$_SESSION['success'] = 'Order Refunded successfully';
			echo "<script>window.location.assign('order-details?id=".$row['ref_id']."')</script>";

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

		$stmt = $conn->prepare("SELECT * FROM orders WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
	  $stmt->execute(['id'=>$userid]);
	  $iow = $stmt->fetch();

		try{

			$stmt = $conn->prepare("UPDATE orders SET reason = :reason, status = 4, payment_stat = 4 WHERE ref_id=:ref_id AND userid=:userid");
			$stmt->execute(['ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);

			$stmt = $conn->prepare("UPDATE transactions SET reason = :reason, status = 4 WHERE ref_id=:ref_id AND userid=:userid");
			$stmt->execute(['ref_id'=>$row['ref_id'], 'userid'=>$iow['id']]);

			include 'emails/pay-supplier-order_cancel.php';

			$_SESSION['success'] = 'Order Refunded successfully';
			echo "<script>window.location.assign('order-details?id=".$row['ref_id']."')</script>";

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}

	//echo "<script>window.location.assign('pay-supplier')</script>";

?>
