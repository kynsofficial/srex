<?php include 'includes/head-user.php'; ?>
	<body class="main-dashboard">
		<div class="mobile-overlay" onclick="handleMobileOverLay()"></div>
		<side-bar><?php include 'includes/side-bar.php'; ?></side-bar>
		<section class="main-body">
			<header-bar><?php include 'includes/top-bar.php'; ?></header-bar>

			<div class="faqs">
				<section>
					<h3>Shipping FAQS</h3>
					<div>
						<div>
							<span>Are there any additional fees or surcharges?</span
							><img src="<?php echo $settings['site_url']; ?>assets/images/arrow-down.svg" />
						</div>
						<span></span>
					</div>
					<div>
						<div>
							<span>Is insurance included in the shipping cost?</span
							><img src="<?php echo $settings['site_url']; ?>assets/images/arrow-down.svg" />
						</div>
						<span></span>
					</div>
					<div>
						<div>
							<span>What payment methods do you accept?</span
							><img src="<?php echo $settings['site_url']; ?>assets/images/arrow-down.svg" />
						</div>
						<span></span>
					</div>

					<h3>Pricing FAQS</h3>
					<div>
						<div>
							<span>Is there a minimum order value for shipping?</span
							><img src="<?php echo $settings['site_url']; ?>assets/images/arrow-down.svg" />
						</div>
						<span></span>
					</div>
					<div>
						<div>
							<span>Do you offer refunds or returns?</span
							><img src="<?php echo $settings['site_url']; ?>assets/images/arrow-down.svg" />
						</div>
						<span></span>
					</div>

					<h3>Platform FAQS</h3>
					<div>
						<div>
							<span>What information is required to place an order?</span
							><img src="<?php echo $settings['site_url']; ?>assets/images/arrow-down.svg" />
						</div>
						<span></span>
					</div>
					<div>
						<div>
							<span>How can I contact customer support?</span
							><img src="<?php echo $settings['site_url']; ?>assets/images/arrow-down.svg" />
						</div>
						<span></span>
					</div>
				</section>
			</div>
		</section>
	</body>
</html>
