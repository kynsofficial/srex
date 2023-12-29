<?php
	include 'include/session.php';
	include 'includes/slugify.php';

	if(isset($_POST['add'])){
		$state = $_POST['name'];
		$equal_amount = $_POST['equal_amount'];
		$great_amount = $_POST['great_amount'];
		$yourba_state = $_POST['yourba_state'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM states WHERE name=:state");
		$stmt->execute(['state'=>$state]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'State already Exist';
		}
		else{
			try{
				$stmt = $conn->prepare("INSERT INTO states (name, yourba_state, equal_amount, great_amount) VALUES (:state, :yourba_state, :equal_amount, :great_amount)");
				$stmt->execute(['state'=>$state, 'yourba_state'=>$yourba_state, 'equal_amount'=>$equal_amount, 'great_amount'=>$great_amount]);
				$_SESSION['success'] = 'Shipping rate added successfully';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up form';
	}

	header('location: shipping-settings');

?>
