<?php
	include 'include/session.php';
	include 'includes/slugify.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$unit = $_POST['unit'];
		$si_unit = $_POST['si_unit'];
		$price = $_POST['price'];
		$info = $_POST['info'];
		$slug = slugify($name);

		$conn = $pdo->open();
		try{
			$stmt = $conn->prepare("UPDATE shipping_plan SET info=:info, price=:price, unit=:unit, si_unit=:si_unit, name=:name, slug=:slug WHERE id=:id");
			$stmt->execute(['info'=>$info, 'price'=>$price, 'unit'=>$unit, 'si_unit'=>$si_unit, 'name'=>$name, 'slug'=>$slug, 'id'=>$id]);
			$_SESSION['success'] = 'Shipping Plan updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit review form first';
	}

	header('location: shipping-plans');

?>
