<?php include 'include/session.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Srex Web</title>
		<link rel="stylesheet" href="./styles/fonts.css" />
		<link rel="stylesheet" href="./styles/style.css" />
		<link rel="stylesheet" href="./styles/alerts.css" />
		<?php
		$css_file_name1 = pathinfo($_SERVER["SCRIPT_NAME"]);
		$file = $_SERVER['STYLE_URL'].'/'.$css_file_name1['filename'].'.css';
		?>
		<link rel="stylesheet" href="<?php echo $file; ?>" />
		<link rel="icon" href="./assets/images/favicon.png">
	</head>
