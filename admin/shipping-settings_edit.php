<?php
	include 'include/session.php';
	include 'includes/slugify.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$equal_amount = $_POST['equal_amount'];
		$great_amount = $_POST['great_amount'];
		$yourba_state = $_POST['yourba_state'];

		$conn = $pdo->open();
		try{
			$stmt = $conn->prepare("UPDATE states SET great_amount=:great_amount, equal_amount=:equal_amount, yourba_state=:yourba_state, name=:name WHERE id=:id");
			$stmt->execute(['great_amount'=>$great_amount, 'equal_amount'=>$equal_amount, 'yourba_state'=>$yourba_state, 'name'=>$name, 'id'=>$id]);
			$_SESSION['success'] = 'Shipping rate updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit review form first';
	}

	header('location: shipping-settings');

?>
