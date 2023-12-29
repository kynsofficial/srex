<?php
	include 'include/session.php';
	include 'includes/slugify.php';

	if(isset($_POST['add'])){
		$name = $_POST['name'];
		$unit = $_POST['unit'];
		$si_unit = $_POST['si_unit'];
		$price = $_POST['price'];
		$info = $_POST['info'];
		$slug = slugify($name);

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM shipping_plan WHERE name=:name");
		$stmt->execute(['name'=>$name]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Shipping Plan already Exist';
		}
		else{
			try{
				$stmt = $conn->prepare("INSERT INTO shipping_plan (name, si_unit, unit, price, info, slug) VALUES (:name, :si_unit, :unit, :price, :info, :slug)");
				$stmt->execute(['name'=>$name, 'si_unit'=>$si_unit, 'unit'=>$unit, 'price'=>$price, 'info'=>$info, 'slug'=>$slug]);
				$_SESSION['success'] = 'Shipping Rate added successfully';

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

	header('location: shipping-plans');

?>
