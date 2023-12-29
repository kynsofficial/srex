<?php include 'includes/head-user.php'; ?>
	<body class="main-dashboard">
		<div class="mobile-overlay" onclick="handleMobileOverLay()"></div>
		<side-bar><?php include 'includes/side-bar.php'; ?></side-bar>
		<section class="main-body">
			<header-bar><?php include 'includes/top-bar.php'; ?></header-bar>

			<div class="address">
				<h4>Your saved addresses</h4>
				<section>
					<div class="addresses">
					<?php

						$conn = $pdo->open();

						try{
						$stmt = $conn->prepare("SELECT * FROM users_address WHERE userid=:userid ORDER BY id DESC");
						$stmt->execute(['userid'=>$user['id']]);
						$i = 0;
						foreach($stmt as $row){
							$i++;
								echo"
								<button onclick='setAddress()'>
									<div>
										<h4 id='user_fullname'>".$row['firstname']." ".$row['lastname']."</h4>
										<span>
											<svg width='24' height='17' viewBox='0 0 24 17' fill='none' xmlns='http://www.w3.org/2000/svg'>
												<g clip-path='url(#clip0_432_699)'>
													<path fill-rule='evenodd' clip-rule='evenodd' d='M0 0H24V17H0V0Z' fill='white'/>
													<path fill-rule='evenodd' clip-rule='evenodd' d='M15.9975 0H24V17H15.9975V0ZM0 0H7.99875V17H0V0Z' fill='#008753'/>
												</g>
												<defs>
													<clipPath id='clip0_432_699'>
														<rect width='24' height='17' fill='white' />
													</clipPath>
												</defs>
											</svg>
											<span id='user_location' style='display: none'>".$row['location']."</span>
											<span id='user_email' style='display: none'>".$row['email']."</span>
											<span id='user_phonenumber' style='display: none'>".$row['phonenumber']."</span>
											<span id='user_address_full'> ".$row['lga'].", ".$row['state'].", ".$row['country']." </span>
										</span>
									</div>

									<svg width='24' height='25' viewBox='0 0 24 25' fill='none' xmlns='http://www.w3.org/2000/svg' onclick=''>
										<path d='M19.5 10.25C20.0967 10.25 20.669 10.4871 21.091 10.909C21.5129 11.331 21.75 11.9033 21.75 12.5C21.75 13.0967 21.5129 13.669 21.091 14.091C20.669 14.5129 20.0967 14.75 19.5 14.75C18.9033 14.75 18.331 14.5129 17.909 14.091C17.4871 13.669 17.25 13.0967 17.25 12.5C17.25 11.9033 17.4871 11.331 17.909 10.909C18.331 10.4871 18.9033 10.25 19.5 10.25ZM12 10.25C12.5967 10.25 13.169 10.4871 13.591 10.909C14.0129 11.331 14.25 11.9033 14.25 12.5C14.25 13.0967 14.0129 13.669 13.591 14.091C13.169 14.5129 12.5967 14.75 12 14.75C11.4033 14.75 10.831 14.5129 10.409 14.091C9.98705 13.669 9.75 13.0967 9.75 12.5C9.75 11.9033 9.98705 11.331 10.409 10.909C10.831 10.4871 11.4033 10.25 12 10.25ZM4.5 10.25C5.09674 10.25 5.66903 10.4871 6.09099 10.909C6.51295 11.331 6.75 11.9033 6.75 12.5C6.75 13.0967 6.51295 13.669 6.09099 14.091C5.66903 14.5129 5.09674 14.75 4.5 14.75C3.90326 14.75 3.33097 14.5129 2.90901 14.091C2.48705 13.669 2.25 13.0967 2.25 12.5C2.25 11.9033 2.48705 11.331 2.90901 10.909C3.33097 10.4871 3.90326 10.25 4.5 10.25Z' fill='black'/>
									</svg>
									<span>Edit</span>
								</button>
								";
							
							}
						}
						catch(PDOException $e){
							echo $e->getMessage();
						}

						$pdo->close();
					?>
					</div>
					<aside style="display: none;" id="address_side">
						<h4 id="fullname_side">FirstName LastName</h4>
						<h4>Contact Details</h4>
						<div>
							<p id="email_side">srexuser@gmail.com</p>
							<p id="phonenumber_side">+2349045189278</p>
						</div>
						<h4>Addresses</h4>
						<div>
							<p id="location_side">srexuser@gmail.com</p>
							<p id="address_full_side">+2349045189278</p>
						</div>
					</aside>
				</section>
			</div>
		</section>
	</body>
	<script>
		function setAddress(){
			var address_side = document.getElementById('address_side');

			var user_fullname = document.getElementById('user_fullname');
			var fullname_side = document.getElementById('fullname_side');

			var user_location = document.getElementById('user_location');
			var location_side = document.getElementById('location_side');

			var user_email = document.getElementById('user_email');
			var email_side = document.getElementById('email_side');

			var user_phonenumber = document.getElementById('user_phonenumber');
			var phonenumber_side = document.getElementById('phonenumber_side');

			var user_address_full = document.getElementById('user_address_full');
			var address_full_side = document.getElementById('address_full_side');


			address_side.style.display = 'block';
			// alert(user_fullname.innerHTML);
			fullname_side.innerHTML = user_fullname.innerHTML;
			location_side.innerHTML = user_location.innerHTML;
			email_side.innerHTML = user_email.innerHTML;
			phonenumber_side.innerHTML = user_phonenumber.innerHTML;
			address_full_side.innerHTML = user_address_full.innerHTML;
		}
	</script>
</html>
