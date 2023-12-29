<?php
	include 'include/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$site_name = $_POST['site_name'];
		$site_title = $_POST['site_title'];
		$site_url = $_POST['site_url'];
		$site_desc = $_POST['site_desc'];
		$site_keyword = $_POST['site_keyword'];
		$location = $_POST['location'];
		$country = $_POST['country'];
		$admin_email = $_POST['admin_email'];
		$store_link = $_POST['store_link'];
		$academy_link = $_POST['academy_link'];
// 		$mode = $_POST['mode'];
		$color = $_POST['color'];

		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT * FROM settings WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		try{
			$stmt = $conn->prepare("UPDATE settings SET site_name=:site_name, site_title=:site_title, site_url=:site_url, site_desc=:site_desc, site_keyword=:site_keyword, location=:location, country=:country, admin_email=:admin_email, store_link=:store_link, academy_link=:academy_link, theme=:color WHERE id=:id");
			$stmt->execute(['site_name'=>$site_name, 'site_title'=>$site_title, 'site_url'=>$site_url, 'site_desc'=>$site_desc, 'site_keyword'=>$site_keyword, 'location'=>$location, 'country'=>$country, 'admin_email'=>$admin_email, 'store_link'=>$store_link, 'academy_link'=>$academy_link, 'color'=>$color, 'id'=>$id]);
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

	header('location: gen-settings');

?>
