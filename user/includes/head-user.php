<?php
include 'include/session.php';

$css_file_name1 = pathinfo($_SERVER["SCRIPT_NAME"]);
$filename = $css_file_name1['filename'];
$userfirstletter = substr($user['firstname'], 0, 1)
?>
<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="UTF-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0" />
			<title><?php echo ucfirst($filename); ?> | <?php echo $settings['site_title']; ?></title>
			<link rel="stylesheet" href="<?php echo $settings['site_url']; ?>styles/fonts.css" />
			<link rel="stylesheet" href="<?php echo $settings['site_url']; ?>styles/style.css" />
			<link rel="stylesheet" href="<?php echo $settings['site_url']; ?>styles/login.css" />
			<link rel="stylesheet" href="<?php echo $settings['site_url']; ?>styles/dashboard.css" />
			<link rel="stylesheet" href="<?php echo $settings['site_url']; ?>styles/alerts.css" />
			<link rel="icon" href="<?php echo $settings['site_url']; ?>assets/images/favicon.png">
			<!-- <script src="<?php echo $settings['site_url']; ?>scripts/dashboard.js" type="text/javascript" defer></script> -->
			<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
			<!-- SweetAlert2 -->
			<script src="<?php echo $settings['site_url']; ?>assets/plugins/jquery/jquery-3.4.1.min.js"></script>
			<script src="<?php echo $settings['site_url']; ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
			<!-- Toastr -->
			<script src="<?php echo $settings['site_url']; ?>assets/plugins/toastr/toastr.min.js"></script>
			<script src="<?php echo $settings['site_url']; ?>user/includes/dashboard1.js" type="text/javascript" defer></script>
			<script type="text/javascript">
			const handleProfile = () => {
				const body = document.querySelector('.main-body');
				body.innerHTML += String.raw` <section class="overlay">
					<aside class="right-bar">
						<div class="icon-container">
							<h2>Profile</h2>
							<svg
								width="24"
								height="24"
								viewBox="0 0 24 24"
								fill="none"
								xmlns="http://www.w3.org/2000/svg"
								onclick="handleOverlay()"
							>
								<g clip-path="url(#clip0_457_474)">
									<path
										d="M0 0L24 24M0 24L24 0"
										stroke="black"
										stroke-width="1.5"
										stroke-linecap="round"
										stroke-linejoin="round"
									/>
								</g>
								<defs>
									<clipPath id="clip0_457_474">
										<rect width="24" height="24" fill="white" />
									</clipPath>
								</defs>
							</svg>
						</div>

						<div class="icon-container">
							<span class="icon"> <?php echo $userfirstletter; ?> </span>
							<h4><?php echo $user['firstname'].' '.$user['lastname']; ?></h4>
						</div>
						<form action="">
							<label htmlFor="email">Email address</label>
							<input
								type="email"
								name="email"
								id="email"
								value="<?php echo $user['email']; ?>"
								placeholder="srexuser@gmail.com"
							/>
							<label htmlFor="phone">Phone number</label>
							<input
								type="tel"
								name="phone"
								id="phone"
								value="<?php echo $user['contact_info']; ?>"
								placeholder="+2349087392038"
							/>
							<label>Account type</label>
							<div>
								<span>
									<label htmlFor="personal">
										<input type="radio" name="accountType" id="personal" />
										Personal
									</label>
								</span>
								<span>
									<label htmlFor="business">
										<input type="radio" name="accountType" id="business" />
										Business
									</label>
								</span>
							</div>
							<label htmlFor="email">Password</label>
							<input type="password" name="password" id="password" value="<?php echo $user['password']; ?>" placeholder="****************" />
							<span>Change Password</span>

							<button class="button">Save</button>
						</form>
						<div></div>
					</aside>
				</section>`;
			};
			</script>
			<!-- SweetAlert2 -->
			<link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
			<!-- Toastr -->
			<link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/plugins/toastr/toastr.min.css">
		</head>
