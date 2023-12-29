<?php
include 'include/session.php';

if(isset($_GET['return'])){
	$return = $_GET['return'];

}
else{
	$return = 'pay-supplier-new';
}

$num = '123456789';
$upp = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

$set1 = substr(str_shuffle($upp), 0, 3);
$set2 = substr(str_shuffle($upp), 0, 1);
$set3 = substr(str_shuffle($num), 0, 3);
$set4 = substr(str_shuffle($upp), 0, 1);

$ref_id = 'P'.$set1.'-'.$set2.$set3.$set4.'-'.time();

if(isset($_POST['save'])){
	$userid = $_POST['userid'];
	// $email = $_POST['email'];
	$supplier_name = htmlspecialchars($_POST['supplier_name']);
	$supplier_phone = htmlspecialchars($_POST['supplier_phone']);
	$supplier_email = htmlspecialchars($_POST['supplier_email']);
	$supplier_alipay = htmlspecialchars($_POST['supplier_alipay']);
	$supplier_wechat = htmlspecialchars($_POST['supplier_wechat']);
	$supplier_bank_account = htmlspecialchars($_POST['supplier_bank_account']);
	$additional_info = htmlspecialchars($_POST['additional_info']);
	$amount = htmlspecialchars($_POST['amount']);
	$payment_method = htmlspecialchars($_POST['payment_method']);

	if ($payment_method === "Bank Deposit" || $payment_method === "Online Payment") {
		$naira_equi = $amount * $rates['yuan_naira_rate'];

		$now = date('Y-m-d');

		if($naira_equi > $rates['suppling_min']){

				$conn = $pdo->open();

				try{
					$stmt = $conn->prepare("INSERT INTO pay_supplier (payment_method, userid, discount_naira_equi, naira_equi, discount_amount, amount, ref_id, supplier_alipay, supplier_wechat, supplier_bank_account, additional_info, supplier_name, supplier_phone, supplier_email, created_on) VALUES (:payment_method, :userid, :discount_naira_equi, :naira_equi, :discount_amount, :amount, :ref_id, :supplier_alipay, :supplier_wechat, :supplier_bank_account, :additional_info, :supplier_name, :supplier_phone, :supplier_email, :created_on)");
					$stmt->execute(['payment_method'=>$payment_method, 'userid'=>$userid, 'discount_naira_equi'=>$naira_equi, 'naira_equi'=>$naira_equi, 'discount_amount'=>$amount, 'amount'=>$amount, 'ref_id'=>$ref_id, 'supplier_alipay'=>$supplier_alipay, 'supplier_wechat'=>$supplier_wechat, 'supplier_bank_account'=>$supplier_bank_account, 'additional_info'=>$additional_info, 'supplier_name'=>$supplier_name, 'supplier_phone'=>$supplier_phone, 'supplier_email'=>$supplier_email, 'created_on'=>$now]);
					$_SESSION['success'] = 'Supplier Information has been successfully uploaded, please proceed to make payments.';
					// header('location: view-pay-supplier-details?id='.$ref_id);
					echo "<script>window.location.assign('pay-supplier-details?id=$ref_id')</script>";
				}
				catch(PDOException $e){
					$_SESSION['error'] = $e->getMessage();
				}

				$pdo->close();

			// echo "Yes, everything looks fine";

		}
		else{
			$_SESSION['supplier_name'] = $supplier_name;
			$_SESSION['supplier_phone'] = $supplier_phone;
			$_SESSION['supplier_email'] = $supplier_email;
			$_SESSION['supplier_alipay'] = $supplier_alipay;
			$_SESSION['supplier_wechat'] = $supplier_wechat;
			$_SESSION['supplier_bank_account'] = $supplier_bank_account;
			$_SESSION['additional_info'] = $additional_info;
			$_SESSION['amount'] = $amount;
			$_SESSION['payment_method'] = $payment_method;
			$_SESSION['error'] = 'Amount is too low or not valid!';
			// echo 'Amount is too low or not valid!';
		}

	}
	else{
		$_SESSION['supplier_name'] = $supplier_name;
		$_SESSION['supplier_phone'] = $supplier_phone;
		$_SESSION['supplier_email'] = $supplier_email;
		$_SESSION['supplier_alipay'] = $supplier_alipay;
		$_SESSION['supplier_wechat'] = $supplier_wechat;
		$_SESSION['supplier_bank_account'] = $supplier_bank_account;
		$_SESSION['additional_info'] = $additional_info;
		$_SESSION['amount'] = $amount;
		$_SESSION['payment_method'] = $payment_method;
		$_SESSION['error'] = 'Invalid Payment Method';
		// echo 'Invalid Payment Method <br>';
	}

}
else{
	$_SESSION['supplier_name'] = $supplier_name;
	$_SESSION['supplier_phone'] = $supplier_phone;
	$_SESSION['supplier_email'] = $supplier_email;
	$_SESSION['supplier_alipay'] = $supplier_alipay;
	$_SESSION['supplier_wechat'] = $supplier_wechat;
	$_SESSION['supplier_bank_account'] = $supplier_bank_account;
	$_SESSION['additional_info'] = $additional_info;
	$_SESSION['amount'] = $amount;
	$_SESSION['payment_method'] = $payment_method;
	$_SESSION['error'] = 'Fill up required details first';
}

// header('location: '.$return);
echo "<script>window.location.assign('$return')</script>";
?>
