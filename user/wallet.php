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
			<!-- Theme style -->
			<!-- <link rel="stylesheet" href="<?php echo $settings['site_url']; ?>styles/track.css" /> -->
		</head>

	<body class="main-dashboard">
		<div class="mobile-overlay" onclick="handleMobileOverLay()"></div>
		<side-bar><?php include 'includes/side-bar.php'; ?></side-bar>
		<section class="main-body">
			<header-bar><?php include 'includes/top-bar.php'; ?></header-bar>

			<div class="wallet">
			<?php
			if(isset($_SESSION['error'])){
				echo "
				<div class='alert alert-danger fade show'>
				<strong>Oops! 😕</strong> <br>".$_SESSION['error']."
				</div>
				";
				unset($_SESSION['error']);
			}
			if(isset($_SESSION['cancelled'])){
				echo "
				<div class='alert alert-warning fade show'>
				<strong>Oh-Uh! 😒</strong> <br>".$_SESSION['cancelled']."
				</div>
				";
				unset($_SESSION['cancelled']);
			}
			if(isset($_SESSION['warning'])){
				echo "
				<div class='alert alert-warning fade show'>
				<strong>Hugh 😒</strong><br>".$_SESSION['warning']."
				</div>
				";
				unset($_SESSION['warning']);
			}
			if(isset($_SESSION['success'])){
				echo "
				<div class='alert alert-success fade show'>
				<strong>Hurray 🥳</strong><br>".$_SESSION['success']."
				</div>
				";
				unset($_SESSION['success']);
			}
			?>
				<div class="card">
					<div>
						<img src="<?php echo $settings['site_url']; ?>assets/images/balance.svg" />
					</div>
					<div class="sub-grid-content">
						<span>Your balance is</span>
						<h3><?php echo $settings['currency'] ?> <?php echo number_format($user['balance'], 2, '.', ',') ?></h3>
					</div>
					<div onclick="handleWalletFunding()" class="grid-right right">Fund wallet</div>
				</div>
				<header>
					<button onclick="handleActiveTransactions('all')" class="active">
						All transactions
					</button>
					<button onclick="handleActiveTransactions('credit')">
						Deposit transactions
					</button>
					<button onclick="handleActiveTransactions('debit')">
						Refund transactions
					</button>
					<button></button>
				</header>
				<div class="recents">
					<div class="list-header">
						<span>TYPE</span>
						<span>AMOUNT</span>
						<span>TRX ID</span>
						<span>DATE</span>
						<span>STATUS</span>
					</div>
					<?php

						$conn = $pdo->open();

						try{
						$stmt = $conn->prepare("SELECT * FROM transaction_flutterwave WHERE userid=:userid ORDER BY id DESC");
						$stmt->execute(['userid'=>$user['id']]);
						$i = 0;
						foreach($stmt as $row){
							if ($row['status'] == 0) {
							$status = '<span class="status failed">Unsuccessful</span>';
							}
							if ($row['status'] == 1) {
							$status = '<span class="status success">Successful</span>';
							}
							if ($row['status'] == 2) {
							$status = '<span class="status pending">Cancelled</span>';
							}

							$amount = $settings['currency'].''.number_format($row['amount'], 2);


							?>
							<?php
							echo"
							<div class='list-content'>
								<span>Deposit</span>
								<span>".$amount."</span>
								<span>".$row['trxid']."</span>
								<span>".$row['datetime']."</span>
								<span>".$status."</span>
								<small>View</small>
							</div>
							";
							}
						}
						catch(PDOException $e){
							echo $e->getMessage();
						}

						$pdo->close();
					?>
				</div>
			</div>
		</section>
	</body>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
	const handleWalletFunding = () => {
		const body = document.querySelector('.main-body');
		body.innerHTML += String.raw` 
		<section class="overlay">
			<aside class="right-bar">
				<div class="icon-container">
					<h2>Wallet Funding</h2>
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

				<form action="flutterwave" method="post">
					<label htmlFor="id_amount">Amount</label>
					<input type="number" min="500" name="amount_bad" id="id_amount" placeholder="Enter amount to fund wallet with" required/>
					<input type="hidden" name="amount" id='printed_amount' />
					
					<span><p>Transaction charge</a> <span class="price" style="float:right" id='charge'></span></p></span>
					<hr>
					<p>Total <b><span class="price" style="color:black;float:right" id='printchatbox' ></span></b></p>
					
					<button class="button" type="submit" name="pay">Fund</button>
				</form>
				<div></div>
			</aside>
		</section>`;
		$(document).ready(function() {
			$("#id_amount").keyup(function() {
				var charge = ( Number($("#id_amount").val()) * <?php echo $settings['percentage']/100;?>);
				$("#printchatbox").text('₦' + (Number($("#id_amount").val()) + charge ));
				$("#printed_amount").val((Number($("#id_amount").val()) + charge ));
				$("#charge").text('₦' +charge)
				// console.log(charge);
			});
		});
	};
</script>
</html>
