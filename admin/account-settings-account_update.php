<?php
	include 'include/session.php';

	if(isset($_GET['return'])){
		$return = $_GET['return'];

	}
	else{
		$return = 'account-settings';
	}

	$logout = 'logout';

	if(isset($_POST['deactivate'])){
		$adminid = $admin['id'];
		// $email = $_POST['email'];
		$status = 2;

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:userid");
		$stmt->execute(['userid'=>$adminid]);
		$row = $stmt->fetch();

		// if(password_verify($curr_password, $admin['password'])){

			// $conn = $pdo->open();

			try{
				$stmt = $conn->prepare("UPDATE users SET status=:status WHERE id=:id");
				$stmt->execute(['status'=>$status, 'id'=>$admin['id']]);

				$_SESSION['success'] = 'Account Deactivated successfully';
				header('location:'.$logout);
				exit;
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}

			$pdo->close();

		// }
		// else{
		// 	$_SESSION['error'] = 'Incorrect password';
		// }
	}
	else{
		$_SESSION['error'] = 'Fill up required details first';
	}

header('location:'.$return);

?>
