<?php
	include 'include/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$naira_dollar_rate = $_POST['naira_dollar_rate'];
		$naira_yuan_rate = $_POST['naira_yuan_rate'];
		$dollar_naira_rate = $_POST['dollar_naira_rate'];
		$dollar_yuan_rate = $_POST['dollar_yuan_rate'];
		$yuan_naira_rate = $_POST['yuan_naira_rate'];
		$yuan_dollar_rate = $_POST['yuan_dollar_rate'];
		$suppling_rate = $_POST['suppling_rate'];
		$suppling_min = $_POST['suppling_min'];
		$order_rate = $_POST['order_rate'];
		$order_min = $_POST['order_min'];
		$commitment_fee = $_POST['commitment_fee'];
		$domestic_transportation_cost = $_POST['domestic_transportation_cost'];
		$international_transportation_cost = $_POST['international_transportation_cost'];
		$vat = $_POST['vat'];

		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("UPDATE rates SET vat=:vat, naira_dollar_rate=:naira_dollar_rate, naira_yuan_rate=:naira_yuan_rate, dollar_naira_rate=:dollar_naira_rate, dollar_yuan_rate=:dollar_yuan_rate, yuan_naira_rate=:yuan_naira_rate, yuan_dollar_rate=:yuan_dollar_rate, suppling_rate=:suppling_rate, suppling_min=:suppling_min, order_rate=:order_rate, order_min=:order_min, commitment_fee=:commitment_fee, domestic_transportation_cost=:domestic_transportation_cost, international_transportation_cost=:international_transportation_cost WHERE id=:id");
			$stmt->execute(['vat'=>$vat, 'naira_dollar_rate'=>$naira_dollar_rate, 'naira_yuan_rate'=>$naira_yuan_rate, 'dollar_naira_rate'=>$dollar_naira_rate, 'dollar_yuan_rate'=>$dollar_yuan_rate, 'yuan_naira_rate'=>$yuan_naira_rate, 'yuan_dollar_rate'=>$yuan_dollar_rate, 'suppling_rate'=>$suppling_rate, 'suppling_min'=>$suppling_min, 'order_rate'=>$order_rate, 'order_min'=>$order_min, 'commitment_fee'=>$commitment_fee, 'domestic_transportation_cost'=>$domestic_transportation_cost, 'international_transportation_cost'=>$international_transportation_cost, 'id'=>$id]);
			$_SESSION['success'] = 'Settings updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up settings form first';
	}

	header('location: rates-settings');

?>
