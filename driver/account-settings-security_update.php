<?php
include 'include/session.php';

if(isset($_GET['return'])){
	$return = $_GET['return'];

}
else{
	$return = 'account-settings-security';
}

if(isset($_POST['save'])){
	$adminid = $admin['id'];
	$currentPassword = $_POST['currentPassword'];
	$newPassword = $_POST['newPassword'];
	$confirmPassword = $_POST['confirmPassword'];

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM drivers WHERE id=:userid");
	$stmt->execute(['userid'=>$adminid]);
	$row = $stmt->fetch();

	if ($newPassword == $confirmPassword) {
		if(password_verify($currentPassword, $admin['password'])){

			if($newPassword == $admin['password']){
				$newPassword = $admin['password'];
			}
			else{
				$newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
			}

			// $conn = $pdo->open();

			try{
				$stmt = $conn->prepare("UPDATE drivers SET password=:password WHERE id=:id");
				$stmt->execute(['password'=>$newPassword, 'id'=>$admin['id']]);

				$_SESSION['success'] = 'Password updated successfully';
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}

			$pdo->close();

		}
		else{
			$_SESSION['error'] = 'Incorrect password';
		}
	}
	else{
		$_SESSION['error'] = 'Password does not match';
	}

}
else{
	$_SESSION['error'] = 'Fill up required details first';
}

header('location:'.$return);

?>
