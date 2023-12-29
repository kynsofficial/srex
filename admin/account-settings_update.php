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
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$contact_info = $_POST['contact_info'];

		$address = $_POST['address'];
		$state = $_POST['state'];
		$country = $_POST['country'];
		$zipcode = $_POST['zipcode'];
		$gender = $_POST['gender'];
		$dob = $_POST['dob'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM users WHERE id=:userid");
		$stmt->execute(['userid'=>$adminid]);
		$row = $stmt->fetch();

		if($gender == "Male" OR $gender == "Female"){

			// $conn = $pdo->open();

			try{
				$stmt = $conn->prepare("UPDATE users SET gender=:gender, dob=:dob, address=:address, firstname=:firstname, lastname=:lastname, contact_info=:contact_info WHERE id=:id");
				$stmt->execute(['gender'=>$gender, 'dob'=>$dob, 'address'=>$address, 'firstname'=>$firstname, 'lastname'=>$lastname, 'contact_info'=>$contact_info, 'id'=>$admin['id']]);

				$_SESSION['success'] = 'Account updated successfully';
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}

			$pdo->close();

		}
		else{
			$_SESSION['error'] = 'Incorrect Gender';
		}
	}
	else{
		$_SESSION['error'] = 'Fill up required details first';
	}

	header('location:'.$return);

?>
