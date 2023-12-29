<?php
	include 'include/session.php';

	if(isset($_GET['return'])){
		$return = $_GET['return'];

	}
	else{
		$return = 'account-settings';
	}

	if(isset($_POST['save'])){
		$adminid = $admin['id'];
		// $email = $_POST['email'];
		$short_code = $_POST['short_code'];
		$main_bank_name = $_POST['main_bank_name'];
		$main_account_number = $_POST['main_account_number'];
		$name_on_account = $_POST['name_on_account'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:userid");
		$stmt->execute(['userid'=>$adminid]);
		$row = $stmt->fetch();

		// if(password_verify($curr_password, $admin['password'])){

			// $conn = $pdo->open();

			try{
				$stmt = $conn->prepare("UPDATE users SET main_bank_name=:main_bank_name, main_account_number=:main_account_number, name_on_account=:name_on_account, short_code=:short_code WHERE id=:id");
				$stmt->execute(['main_bank_name'=>$main_bank_name, 'main_account_number'=>$main_account_number, 'name_on_account'=>$name_on_account, 'short_code'=>$short_code, 'id'=>$admin['id']]);

				$_SESSION['success'] = 'Bank Account Detail updated successfully';
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
