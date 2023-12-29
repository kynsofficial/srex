<?php
	include 'include/session.php';

	if(isset($_POST['add'])){
		$name = $_POST['name'];
		$link = $_POST['link'];
		$about = htmlspecialchars($_POST['about']);

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM stores WHERE name=:name");
		$stmt->execute(['name'=>$name]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM stores WHERE link=:link");
		$stmt->execute(['link'=>$link]);
		$iow = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Name already Exist';
		}elseif ($iow['numrows'] > 0) {
			$_SESSION['error'] = 'Link already Exist';
		}
		else{
			try{
				$stmt = $conn->prepare("INSERT INTO stores (name, link, about) VALUES (:name, :link, :about)");
				$stmt->execute(['name'=>$name, 'link'=>$link, 'about'=>$about]);
				$_SESSION['success'] = 'Store added successfully';

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

	header('location: stores');

?>
