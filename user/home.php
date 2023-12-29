<?php include 'includes/head-user.php'; ?>
	<body class="main-dashboard">
		<div class="mobile-overlay" onclick="handleMobileOverLay()"></div>
		<side-bar><?php include 'includes/side-bar.php'; ?></side-bar>
		<section class="main-body">
			<header-bar><?php include 'includes/top-bar.php'; ?></header-bar>
			<?php
			$stmt = $conn->prepare("SELECT COUNT(*) as numrows FROM shipments WHERE userid=:userid");
			$stmt->execute(['userid'=>$user['id']]);
			$total_shipment = $stmt->fetch();
			?>

			<div class="dashboard">
				<div class="grid">
					<div class="sub-grid wide">
						<div>
							<img src="<?php echo $settings['site_url']; ?>assets/images/scooter.png" />
						</div>
						<div class="sub-grid-content">
							<span> You have made </span>
							<?php if($total_shipment['numrows'] == 1): ?>
							<h3><?php echo $total_shipment['numrows'] ?> Shipment</h3>
							<?php else: ?>
							<h3><?php echo $total_shipment['numrows'] ?> Shipments</h3>
							<?php endif; ?>
						</div>
						<div class="grid-right right1">
							<?php echo date('M');?> 2023
							<i class="fas fa-chevron-down"></i>
						</div>
					</div>
					<div class="sub-grid" onclick="handleShipmentBook()">
						<div class="sub-grid-content">
							<h4>Book Shipments</h4>
							<p>Send or receive items</p>
						</div>
						<i class="fas fa-chevron-right grid-right"></i>
					</div>
					<div class="sub-grid" onclick="window.location.href='shipments'">
						<div class="sub-grid-content">
							<h4>Shop & Ship</h4>
							<p>Mail packages to our hub</p>
						</div>
						<i class="fas fa-chevron-right grid-right"></i>
					</div>
					<div class="sub-grid wide">
						<div>
							<img src="<?php echo $settings['site_url']; ?>assets/images/balance.svg" />
						</div>
						<div class="sub-grid-content">
							<span>Your balance is</span>
							<h3><?php echo $settings['currency']; ?> <?php echo number_format($user['balance'], 2, '.', ',') ?></h3>
						</div>
						<div onclick="window.location.href='wallet'" class="grid-right right2">Fund wallet</div>
					</div>
					<div class="sub-grid" onclick="window.location.href='shipments'">
						<div class="sub-grid-content">
							<h4>Get pricing</h4>
							<p>Request quote</p>
						</div>
						<i class="fas fa-chevron-right grid-right"></i>
					</div>
					<div class="sub-grid" onclick="window.location.href='track'">
						<div class="sub-grid-content">
							<h4>Track Shipments</h4>
							<p>Track your shipments</p>
						</div>
						<i class="fas fa-chevron-right grid-right"></i>
					</div>
				</div>
				<section class="gradient">
					<p>
						Meet the SREX mobile app now available on the Appstore and Playstore
					</p>
					<div>
						<button>
							<img src="<?php echo $settings['site_url']; ?>assets/images/playstore.svg" alt="" />
							Download on Playstore
						</button>
						<button>
							<img src="<?php echo $settings['site_url']; ?>assets/images/apple.svg" alt="" />
							Download on Appstore
						</button>
					</div>
				</section>
				<section>
					<div class="header">
						<h3>Recent shipments</h3>
						<span onclick="handleNavigate('shipments')"
							>See all <i class="fas fa-chevron-right"></i
						></span>
					</div>
					<div class="recents">
						<div class="list-header">
							<span>SENDER</span>
							<span>RECEIVER</span>
							<span>Tracking ID</span>
							<span>AMOUNT</span>
							<span>EST. DELIVERY DATE</span>
							<span></span>
						</div>
						<?php

						$conn = $pdo->open();

						try{
						$stmt = $conn->prepare("SELECT * FROM shipments WHERE userid=:userid ORDER BY id DESC LIMIT 3");
						$stmt->execute(['userid'=>$user['id']]);
						$i = 0;
						foreach($stmt as $row){
							if ($row['status'] == 0) {
							$status = '<span class="status failed">Failed</span>';
							}
							if ($row['status'] == 1) {
							$status = '<span class="status success">Delivered</span>';
							}
							if ($row['status'] == 2) {
							$status = '<span class="status pending">In Transit</span>';
							}

							$amount = $settings['currency'].''.number_format($row['amount'], 2);


							?>
							<?php
							echo"
							<div class='list-content'>
								<span>".$row['sender_name']." <span>".$row['sender_state']." ".$row['sender_country']."</span></span>
								<span>".$row['receiver_name']." <span>".$row['receiver_state']." ".$row['receiver_country']."</span></span>
								<span>".$row['tracking_id']."</span>
								<span>".$amount."</span>
								<span>".$row['date_delivered']."</span>
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
				</section>
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
