<?php include 'include/session.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Srex Web</title>
		<link rel="stylesheet" href="<?php echo $settings['site_url']; ?>styles/fonts.css" />
		<link rel="stylesheet" href="<?php echo $settings['site_url']; ?>styles/style.css" />
		<link rel="stylesheet" href="<?php echo $settings['site_url']; ?>styles/alerts.css" />
		<?php
		$css_file_name1 = pathinfo($_SERVER["SCRIPT_NAME"]);
		$file = $_SERVER['STYLE_URL'].'/'.$css_file_name1['filename'].'.css';
		?>
		<link rel="stylesheet" href="<?php echo $file; ?>" />
		<link rel="icon" href="<?php echo $settings['site_url']; ?>assets/images/favicon.png">
	</head>

	<body>
		<?php //include 'includes/nav.php'; ?>
		<article class="trackArticle1">
			<h2>Track your shipment</h2>
			<p>Enter the tracking number for your shipment</p>
			<form>
				<div>
					<img src="<?php echo $settings['site_url']; ?>assets/images/search-icon.svg" alt="" />
					<input
						type="search"
						name="trackingNo"
						id="trackingNo"
						placeholder="Tracking number"
					/>
				</div>
				<button type="submit" class="button">Track</button>
			</form>
		</article>
		<footer>
			<div class="footer">
				<section class="section1">
					<div>
						<h1 class="rubikEBold">SREX</h1>
						<span>
							<img src="<?php echo $settings['site_url']; ?>assets/images/twitter.svg" alt="" />
							<img src="<?php echo $settings['site_url']; ?>assets/images/instagram.svg" alt="" />
							<img src="<?php echo $settings['site_url']; ?>assets/images/whatsapp.svg" alt="" />
						</span>
					</div>
					<div>
						<h4>International shipping</h4>
						<p>Ship from Nigeria to the UK, US & other cities</p>
						<p>Ship from Nigeria to US to Nigeria</p>
						<p>Ship from Nigeria to UK to Nigeria</p>
					</div>
					<div>
						<h4>Inter-state delivery</h4>
						<p>Lagos to other states</p>
						<p>Ibadan to other states</p>
					</div>
				</section>
				<section class="section2">
					<div id="footerYear">SREX, All rights reserved</div>
					<div>
						<a href="#">Terms of Services</a>
						<a href="#">Privacy Policy</a>
						<a href="#">Cookies</a>
					</div>
				</section>
			</div>
		</footer>
		<script src="<?php echo $settings['site_url']; ?>index.js"></script>
		<script src="<?php echo $settings['site_url']; ?>scripts/track.js"></script>
	</body>
</html>
