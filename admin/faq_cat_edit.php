<?php
	include 'include/session.php';
	include 'includes/slugify.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$title = $_POST['title'];
		$subtitle = $_POST['subtitle'];
		$icon = $_POST['icon'];
		$slug = slugify($title);

		$conn = $pdo->open();
		try{
			$stmt = $conn->prepare("UPDATE faq_category SET subtitle=:subtitle, icon=:icon, title=:title, slug=:slug, link=:link WHERE id=:id");
			$stmt->execute(['subtitle'=>$subtitle, 'icon'=>$icon, 'title'=>$title, 'slug'=>$slug, 'link'=>$slug, 'id'=>$id]);
			$_SESSION['success'] = 'FAQ Category updated successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}


		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit review form first';
	}

	header('location: faq');

?>
