<?php
	include 'include/session.php';
	include 'includes/slugify.php';

	if(isset($_POST['add'])){
		$title = $_POST['title'];
		$icon = $_POST['icon'];
		$subtitle = $_POST['subtitle'];
		$slug = slugify($title);

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM faq_category WHERE title=:title");
		$stmt->execute(['title'=>$title]);
		$row = $stmt->fetch();

		$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM faq_category WHERE icon=:icon");
		$stmt->execute(['icon'=>$icon]);
		$iow = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Title already Exist';
		}elseif ($iow['numrows'] > 0) {
			$_SESSION['error'] = 'Icon already Exist';
		}
		else{
			try{
				$stmt = $conn->prepare("INSERT INTO faq_category (title, subtitle, icon, slug, link) VALUES (:title, :subtitle, :icon, :slug, :link)");
				$stmt->execute(['title'=>$title, 'subtitle'=>$subtitle, 'icon'=>$icon, 'slug'=>$slug, 'link'=>$slug]);
				$_SESSION['success'] = 'FAQ Category added successfully';

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

	header('location: faq');

?>
