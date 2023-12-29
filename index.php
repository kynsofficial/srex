<?php include 'includes/head.php'; ?>
	<body>
		<?php include 'includes/nav.php'; ?>
		<article class="article1">
			<div class="article">
				<section class="section1">
					<h2 class="rubikBold">Delivering Your World, Near and Far.</h2>
					<p>
						From urgent documents to global shipments, we simplify the delivery
						process, so you can focus on what matters.
					</p>
					<form>
						<div>
							<img src="./assets/images/search-icon.svg" alt="" />
							<input type="search" name="trackingNo" id="trackingNo" placeholder="Tracking number" />
						</div>
						<button type="submit" class="button">Track</button>
					</form>
				</section>
				<section class="section2">
					<img src="./assets/images/globe.svg" alt="globe" />
				</section>
			</div>
			<span>
				<img src="./assets/images/gokada.svg" alt="gokada" />
				<img src="./assets/images/ups.svg" alt="ups" />
				<img src="./assets/images/gokada.svg" alt="gokada" />
				<img src="./assets/images/dhl.svg" alt="dhl" />
			</span>
		</article>
		<article class="article2">
			<div class="article2Header">
				<h4>WHAT WE OFFER</h4>
				<h2>Our core services</h2>
			</div>
			<div class="article2Body">
				<section class="section1">
					<img src="./assets/images/import.svg" alt="" />
					<h3>Imports</h3>
					<p>
						From customs clearance to doorstep delivery, we simplify the import
						process.
					</p>
				</section>
				<section class="section2">
					<img src="./assets/images/export.svg" alt="" />
					<h3>Exports</h3>
					<p>
						We ensure your products reach their destinations efficiently and
						securely.
					</p>
				</section>
				<section class="section3">
					<img src="./assets/images/local.svg" alt="" />
					<h3>Local & Interstate deliveries</h3>
					<p>
						From deliveries within your city to interstate shipments, we provide
						dependable services.
					</p>
				</section>
			</div>
			<article class="article2Sub">
				<section class="section1">
					<h2>Get a quote</h2>
					<p>
						Fill the form to get a quick estimate of your delivery to over 25
						cities in the world. We're truly your plug for easy, stress-free
						shipping that will have your mind at rest.
					</p>
					<a href="">
						Create a SREX account now
						<img src="./assets/images/chevron-right.svg" alt="" />
					</a>
				</section>
				<section class="section2">
					<form>
						<div>
							<h5>Pickup</h5>
							<div>
								<label for="pickupCountry">
									<input type="text" id="pickupCountry" />
									<img src="./assets/images/world.svg" alt="" />
									<p>Select country</p>
									<img src="./assets/images/chevron-down.svg"	alt="" onclick="showSelect(event)"/>
								</label>
								<label for="pickupCity">
									<input type="text" id="desitinationCity" />
									<img src="./assets/images/building.svg" alt="" />
									<p>Select city</p>
									<img src="./assets/images/chevron-down.svg"	alt="" onclick="showSelect(event)"
									/>
								</label>
							</div>
						</div>
						<div>
							<h5>Destination</h5>
							<div>
								<label for="desitinationCountry">
									<input type="text" id="desitinationCountry" />
									<img src="./assets/images/world.svg" alt="" />
									<p>Select country</p>
									<img src="./assets/images/chevron-down.svg" alt="" onclick="showSelect(event)"/>
								</label>
								<label for="desitinationCity">
									<input type="text" id="desitinationCity" />
									<img src="./assets/images/building.svg" alt="" />
									<p>Select city</p>
									<img src="./assets/images/chevron-down.svg"	alt="" onclick="showSelect(event)"/>
								</label>
							</div>
						</div>
						<div>
							<h5>Item weight (in kg)</h5>
							<input type="number" placeholder="Item weight (in kg)"	onfocus="hideSelect()"/>
						</div>
						<button type="submit" class="button" onclick="hideSelect()" onsubmit="">
							Request quote
						</button>
					</form>
					<div class="overlay"></div>
				</section>
			</article>
		</article>
		<article class="article">
			<div>
				<h2>We're in over 25 cities</h2>
				<p>Your parcels are in great hands. And we've got the area covered.</p>
			</div>
			<article class="article3">
				<section class="section1">
					<div id="cities" class="cities"></div>
				</section>
				<section class="section2">
					<img src="./assets/images/map.svg" alt="" />
				</section>
			</article>
		</article>
		<article class="article4Container">
			<article class="article4">
				<section class="section1">
					<p>
						<span>“</span>
						<span> Customer Love: Real Stories, Real Satisfaction </span>
					</p>
				</section>
				<section class="section2">
					<div>
						<p>
							"Your delivery service has been a game-changer for my business. I
							can fulfill orders faster, keeping my customers happy and my
							business running smoothly."
						</p>
						<div>
							<img src="./assets/images/users.png" alt="" />
							<img src="./assets/images/users.png" alt="" />
						</div>
					</div>
				</section>
			</article>
		</article>
		<article class="article5 article">
			<section class="section1">
				<h2>Got questions?</h2>
				<p>Everything you need to know about SREX.</p>
				<button class="button" onclick="handleNavigateToFaqs()">
					View more
				</button>
			</section>
			<section class="section2"></section>
		</article>
		<article class="article6Conatiner">
			<article class="article6 article">
				<section>
					<h2>Meet the SREX mobile app</h2>
					<p>
						Our mobile app is now available for download on Google Playstore and
						iOS Appstore. Download now.
					</p>
					<div>
						<button>
							<img src="./assets/images/playstore.svg" alt="" />
							Download on Playstore
						</button>
						<button>
							<img src="./assets/images/apple.svg" alt="" />
							Download on Appstore
						</button>
					</div>
				</section>
				<section class="section2" />
			</article>
		</article>
		<?php include 'includes/footer.php'; ?>
		<script src="./index.js"></script>
		<script src="./scripts/index.js"></script>
	</body>
</html>
