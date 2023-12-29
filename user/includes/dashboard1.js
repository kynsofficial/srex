const firstNameLetter = 'T';

const handleNavigate = route => {
	switch (route) {
		case 'shipments':
			location.href = './shipments';
			break;

		default:
			break;
	}
};

const handleActiveShipment = selected => {
	const tabs = document.querySelectorAll('.shipment header button');
	tabs.forEach(
		tab => tab.classList.contains('active') && tab.classList.remove('active')
	);
	event.target.classList.add('active');
};

const handleActiveTransactions = selected => {
	const tabs = document.querySelectorAll('.wallet header button');
	tabs.forEach(
		tab => tab.classList.contains('active') && tab.classList.remove('active')
	);
	event.target.classList.add('active');
};

const handleDateFocus = () => {
	event.target.nextElementSibling.showPicker();
};

const handleBars = () => {
	const sideBar = document.querySelector('.side-bar');
	const overlay = document.querySelector('.mobile-overlay');

	if (sideBar.classList.contains('show-side-bar')) {
		sideBar.classList.remove('show-side-bar');
		overlay.classList.remove('show-mobile-overlay');
	} else {
		sideBar.classList.add('show-side-bar');
		overlay.classList.add('show-mobile-overlay');
	}
};

const handleMobileOverLay = () => {
	handleBars();
};

let modalOpen = false;

let isBookingDataComplete = false;
let errorMessage = '';
let bookingStep = 1;
// const balance = 5000;

let shipmentData = {
	type: '',
	method: '',
	destinationOption: '',
	senderDetails: {},
	receiverDetails: {},
	item: {},
	delivery: {},
	senderDetails: null,
	receiverDetails: null,
	item: null,
	delivery: null,
	paymentMethod: '',
};

const handleModal = () => {
	const body = document.querySelector('.main-body');

	body.innerHTML += String.raw`<section class="overlay">
		<div class="modal">
			<div class="modalHeader">
				<svg
					width="24"
					height="24"
					viewBox="0 0 24 24"
					fill="none"
					xmlns="http://www.w3.org/2000/svg"
					onclick="handleGoBack()"
				>
					<path
						d="M13 1L2 12L13 23"
						stroke="black"
						stroke-width="2"
						stroke-miterlimit="10"
						stroke-linecap="round"
						stroke-linejoin="round"
					/>
				</svg>
				<span class="modalTitle"></span>
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
			<div class="modalBody"></div>
		</div>
	</section>`;
};

const handleGoBack = () => {
	if (bookingStep > 1) bookingStep -= 1;
	handleShipmentBook();
};

const handleGlobalSelect = selected => {
	if (selected === 'date') {
		return document
			.querySelector('.modal section button:nth-child(2)')
			.classList.add('selected');
	}
	document
		.querySelectorAll('.modal button')
		.forEach(button =>
			button.getAttribute('onclick')?.includes(selected)
				? button.classList.add('selected')
				: button.classList.remove('selected')
		);
};

const handleShippingTypeSelect = selected => {
	handleGlobalSelect(selected);
	shipmentData.type = selected;
	if (shipmentData.type) {
		const continueButton = document.querySelector('.modal .button');
		continueButton.classList.remove('hide');
	}
};

const handleShippingMethodSelect = selected => {
	handleGlobalSelect(selected);
	const dateButton = document.querySelector('.modal .date');
	const continueButton = document.querySelector('.modal .button');
	if (selected === 'date') {
		const dateInput = document.querySelector('.date input');
		shipmentData.pickupDate = dateInput.value;
		continueButton.classList.remove('hide');
	} else if (selected === 'drop_off') {
		dateButton.classList.add('hide');
		shipmentData.method = selected;
	} else {
		continueButton.classList.add('hide');
		shipmentData.method = selected;
	}

	if (shipmentData.method === 'request_pickup') {
		dateButton.classList.remove('hide');
	} else if (shipmentData.method) {
		continueButton.classList.remove('hide');
	}
};

const handleShippingDestinationSelect = selected => {
	handleGlobalSelect(selected);
	shipmentData.destinationOption = selected;
	if (shipmentData.destinationOption) {
		const continueButton = document.querySelector('.modal .button');
		continueButton.classList.remove('hide');
	}
};

const handleNextStep = step => {
	bookingStep = step + 1;
	handleShipmentBook();
};


const handleUserDetails = (type, backClicked) => {
	// Array of input IDs

	const inputIds = [
		'name',
		'email',
		'phone',
		'address',
		'postal',
		'city',
		'state',
		'country',
		'save',
		'category',
		'value',
		'desc',
		'quantity',
		'weight',
	];
	if (shipmentData[type] && backClicked) {
		return inputIds.forEach(id => {
			const element = document.getElementById(id);
			// For checkbox inputs, store their checked status'
			if (element) {
				if (element.type === 'checkbox') {
					element.checked = shipmentData[type][id];
				} else {
					element.value = shipmentData[type][id];
				}
			}
		});
	}

	// Object to store form data
	const formData = {};

	// Loop through input IDs
	let isValid = true;
	inputIds.forEach(id => {
		const element = document.getElementById(id);
		// For checkbox inputs, store their checked status'
		if (element) {
			if (element.type === 'checkbox') {
				formData[id] = element.checked;
			} else {
				formData[id] = element.value;
				if (
					formData[id] === '' &&
					element.hasAttribute('required') &&
					isValid
				) {
					isValid = false;
					errorMessage = `Please fill in ${element.previousElementSibling.textContent.toLowerCase()}`;
					return (document.getElementById('errorMessage').textContent =
						errorMessage);
				} else {
					if (isValid) document.getElementById('errorMessage').textContent = '';
				}
			}
		}
	});
	if (!isValid) return;
	shipmentData[type] = formData;
	handleNextStep(bookingStep);
};

$.ajax({
	url: 'ajax.php?action=get_delivery_options',
	method: 'GET',
	error: function() {},
	success:function(resp){
		if(typeof resp === 'object' || Array.isArray(resp) || typeof JSON.parse(resp) === 'object'){
			resp = JSON.parse(resp)
			if(Object.keys(resp).length > 0){
				Object.keys(resp).map(function(k){
					// console.log(resp[k].type);
					const deliveryOptions = [
						{'type': resp[k].type, 'amount': resp[k].amount, 'periodInDays': resp[k].periodInDays},
					];
				})
			}
		}
	},
	complete: function () {},
});

const deliveryOptions = [
	{'type': 'normal', 'amount': 5000, 'periodInDays': 5},
	{'type': 'express', 'amount': 15000, 'periodInDays': 3},
];

const handleDeliveryOption = selected => {
	shipmentData.shippingRate = deliveryOptions.find(
		option => option.type === selected
	);
	const modalBody = document.querySelector('.modalBody');
	modalBody.innerHTML = String.raw`
		<h4>Choose a shipping rate</h4>
		${deliveryOptions
			.map(
				option => String.raw`<div class="deliverOption" onclick="handleDeliveryOption('${
					option.type
				}')">
						<div>

							<h3>
								
								${option.type} Delivery
							</h3>
							<p>Delivery in ${option.periodInDays} business day${
					option.periodInDays > 1 ? 's' : ''
				} </p>
					<h2>₦ ${option.amount.toLocaleString()}</h2>
						</div>
						${
							shipmentData?.shippingRate?.type === option.type
								? String.raw`<img src="../assets/images/selected.svg" />`
								: String.raw`<img src="../assets/images/select.svg" />`
						}
				</div>`
			)
			.join('')}
		<div class="deliverButton" onclick="handleNextStep(${bookingStep})">
			<button class="button">Continue</button>
		</div>
// 	`;
};

const handlePay = () => {
	handleSubmit();
};

window.start_load = function(){
	// $('body').prepend('<div id="preloader2"></div>')
}
window.end_load = function(){
	$('#preloader2').fadeOut('fast', function() {
		$(this).remove();
	})
}
window.alert_toast= function($msg = '',$bg = 'success' ,$pos=''){
	var Toast = Swal.mixin({
	toast: true,
	position: $pos || 'top-end',
	showConfirmButton: false,
	timer: 5000
	});
	Toast.fire({
		icon: $bg,
		title: $msg
	})
}


const handleSubmit = () => {
	// JSON Data for backend server
	const backendData = JSON.stringify(shipmentData);
	// start_load()
	console.log(backendData);

	// Start ajax request for sending data here
	if(backendData == ''){
		alert_toast("An Error Occured!",'error')
		end_load()
	}else{
		$.ajax({
			url:'ajax.php?action=shipping_prepare',
			// url:'test.php',
			method:'POST',
			data:{backendata:backendData},
			error:err=>{
				console.log(err)
				alert_toast("An error occured",'error')
				end_load()
			},
			success:function(resp){

				console.log(resp);
				var responseObject = JSON.parse(resp);

				// Check the 'status' property and perform instructions accordingly
				if (responseObject.status === 'success') {
					// Execute instructions for success
					isBookingDataComplete = true;
					if (isBookingDataComplete) {
						return (overlay.innerHTML = String.raw`
							<section class="overlay">
								<div class="modal modalComplete">
									<div class="modalHeader">
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
									<img src="../assets/images/like.svg" alt="" />
									<h2>Payment successful</h2>
									<p>Your shipment has been successfully booked!</p>
									<button class="button" onclick="handleOverlay()">
										Go back to dashboard
									</button>
								</div>
							</section>
						`);
					}
					console.log('Success: ' + responseObject.message);
					alert_toast(responseObject.message, 'success');
					end_load();
					// Add more instructions as needed
				} else if (responseObject.status === 'error') {
					// Execute instructions for error
					console.error('Error: ' + responseObject.message);
					alert_toast(responseObject.message, 'error');
					end_load();
					// Add more instructions as needed
				} else {
					// Handle other statuses if necessary
					console.warn('Unexpected status: ' + responseObject.status);
					alert_toast(responseObject.message, 'error');
					end_load();
					// Add more instructions as needed
				}
			},
			complete:function(){
				end_load()
			}
		})
	}

	// Show payment success screen might need to be delayed until booking is successful on the backend
	const overlay = document.querySelector('.overlay');

	//isBookingDataComplete = true;
};


const handleShipmentBook = () => {

	// Use AJAX to get balance and delivery option
	function getCookie(cname) {
		let name = cname + "=";
		let decodedCookie = decodeURIComponent(document.cookie);
		let ca = decodedCookie.split(';');
		for(let i = 0; i < ca.length; i++) {
			let c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}
	let user_username = getCookie("username");
	// console.log(user_username)
	let globalBalance; // Declare a global variable to store the balance

	function getUserBalance(user_username) {
	return new Promise((resolve, reject) => {
		$.ajax({
		url: 'ajax.php?action=get_user_balance',
		method: 'POST',
		data: { username: user_username },
		error: reject,
		success: resolve,
		complete: function () {},
		});
	});
	}

	getUserBalance(user_username).then(function (user_bal) {
		globalBalance = user_bal; // Store the balance in the global variable
		// console.log(globalBalance);
		useBalanceInOtherFunction();
	})
	.catch(function (err) {
		console.log(err);
	});

	function useBalanceInOtherFunction() {
	!modalOpen && handleModal();
	modalOpen = true;
	if (isBookingDataComplete) return;
	const modalTitle = document.querySelector('.modalTitle');
	const modalBody = document.querySelector('.modalBody');
	switch (bookingStep) {
		case 1:
			modalTitle.textContent = 'Book a shipment';
			modalBody.innerHTML = String.raw`
				<section>
					<button onclick="handleShippingTypeSelect('delivery')">
						<h4>Book a delivery</h4>
						<p>Send out a parcel locally or internationally</p>
					</button>
					<button onclick="handleShippingTypeSelect('import')">
						<h4>Book an import</h4>
						<p>Receive your packages from anywhere in the world</p>
					</button>
					<button onclick="handleShippingTypeSelect('shop&ship')">
						<h4>Shop and ship</h4>
						<p>Shop and ship from our US and UK addresses</p>
					</button>
				</section>
				<button class="button hide" onclick="handleNextStep(${bookingStep})">
					Continue
				</button>
			`;
			// break;
			shipmentData.type && handleShippingTypeSelect(shipmentData.type);
			break;
		case 2:
			// let selectDate;
			modalTitle.textContent = 'Choose a shipment method';
			modalBody.innerHTML = String.raw`
				<section>
					<button onclick="handleShippingMethodSelect('drop_off')">
						<h4>Drop off</h4>
						<p>Drop off your items to our processing center</p>
					</button>
					<button onclick="handleShippingMethodSelect('request_pickup')">
						<h4>Request pickup</h4>
						<p>A dispatch rider will pick up your parcel at your location</p>
					</button>
					<button class="date hide">
						<h4><label for="date"> Select pickup date </label></h4>
						<input
							type="date"
							name="pickup_date"
							id="date"
							onchange="handleShippingMethodSelect('date')"
						/>
					</button>
				</section>
				<button class="button hide" onclick="handleNextStep(${bookingStep})">
					Continue
				</button>
			`;
			shipmentData.method && handleShippingMethodSelect(shipmentData.method);
			break;
		case 3:
			modalTitle.textContent = 'Choose your destination option';
			modalBody.innerHTML = String.raw`
				<section>
					<button onclick="handleShippingDestinationSelect('single')">
						<h4>Single destination delivery</h4>
						<p>Deliver your parcels to one destination only</p>
					</button>
					<button onclick="handleShippingDestinationSelect('multiple')">
						<h4>Multiple destinations</h4>
						<p>Deliver your parcels to up to 4 destinations per booking</p>
					</button>
				</section>
				<button class="button hide" onclick="handleNextStep(${bookingStep})">
					Continue
				</button>
			`;
			shipmentData.destinationOption &&
				handleShippingDestinationSelect(shipmentData.destinationOption);
			break;
		case 4:
			modalTitle.textContent = 'Input sender details';

			$.ajax({
				url: 'ajax.php?action=get_states',
				method: 'GET',
				error: function() {},
				success:function(resp){
					if(typeof resp === 'object' || Array.isArray(resp) || typeof JSON.parse(resp) === 'object'){
						resp = JSON.parse(resp)
						if(Object.keys(resp).length > 0){
							const selectSendElement = document.getElementById('state');
							Object.keys(resp).map(function(k){
								// console.log(resp[k].name);
								const option = document.createElement('option');
								option.value = resp[k].name;
								option.text = resp[k].name;
								selectSendElement.appendChild(option);
							})
						}
					}
				},
				complete: function () {},
			});

			modalBody.innerHTML = String.raw`
				<form>
					<div>
						<label for="name">Full name</label>
						<input type="text" name="name" id="name" required />
					</div>
					<div>
						<label for="email">Email address</label>
						<input type="email" name="email" id="email" required />
					</div>
					<div>
						<label for="phone">Phone number</label>
						<input type="tel" name="phone" id="phone" required />
					</div>
					<div>
						<label for="address">Address</label>
						<input type="text" name="address" id="address" required />
					</div>
					<div>
						<label for="postal">Postal Code</label>
						<input type="text" name="postal" id="postal" required />
					</div>
					<div>
						<label for="city">City</label>
						<input type="text" name="city" id="city" required />
					</div>
					<div>
						<label for="state">State</label>
						<select name="state" id="state" required>
							<option value="" selected disabled hidden>--Select--</option>
						</select>
					</div>
					<div>
						<label for="country">Country</label>
						<select name="country" id="country" required>
							<option value="" selected disabled>--Select--</option>
							<option value="Nigeria">Nigeria</option>
						</select>
					</div>
					<span>
						<input type="checkbox" name="save" id="save" />
						<label for="save">Save address</label>
					</span>
					<small id="errorMessage"></small>
					<button
						class="button"
						type="button"
						onclick="handleUserDetails('senderDetails')"
					>
						Continue
					</button>
				</form>
			`;
			shipmentData.senderDetails &&
				handleUserDetails('senderDetails', 'backClicked');
			break;
		case 5:
			modalTitle.textContent = 'Input receiver details';

			$.ajax({
				url: 'ajax.php?action=get_states',
				method: 'GET',
				error: function() {},
				success:function(resp){
					if(typeof resp === 'object' || Array.isArray(resp) || typeof JSON.parse(resp) === 'object'){
						resp = JSON.parse(resp)
						if(Object.keys(resp).length > 0){
							const selectReceElement = document.getElementById('state');
							Object.keys(resp).map(function(k){
								// console.log(resp[k].name);
								const option = document.createElement('option');
								option.value = resp[k].name;
								option.text = resp[k].name;
								selectReceElement.appendChild(option);
							})
						}
					}
				},
				complete: function () {},
			});

			modalBody.innerHTML = String.raw`
				<form>
					<div>
						<label for="name">Full name</label>
						<input type="text" name="name" id="name" required />
					</div>
					<div>
						<label for="email">Email address</label>
						<input type="email" name="email" id="email" required />
					</div>
					<div>
						<label for="phone">Phone number</label>
						<input type="tel" name="phone" id="phone" required />
					</div>
					<div>
						<label for="address">Address</label>
						<input type="text" name="address" id="address" required />
					</div>
					<div>
						<label for="postal">Postal Code</label>
						<input type="text" name="postal" id="postal" required />
					</div>
					<div>
						<label for="city">City</label>
						<input type="text" name="city" id="city" required />
					</div>
					<div>
						<label for="state">State</label>
						<select name="state" id="state" required>
							<option value="" selected disabled hidden>--Select--</option>
						</select>
					</div>
					<div>
						<label for="country">Country</label>
						<select name="country" id="country" required>
							<option value="" selected disabled>--Select--</option>
							<option value="Nigeria">Nigeria</option>
						</select>
					</div>
					<span>
						<input type="checkbox" name="save" id="save" />
						<label for="save">Save address</label>
					</span>
					<small id="errorMessage"></small>
					<button
						class="button"
						type="button"
						onclick="handleUserDetails('receiverDetails')"
					>
						Continue
					</button>
				</form>
			`;
			shipmentData.receiverDetails &&
				handleUserDetails('receiverDetails', 'backClicked');
			break;
		case 6:
			modalTitle.textContent = 'Input item description';

			$.ajax({
				url: 'ajax.php?action=get_product_category',
				method: 'GET',
				error: function() {},
				success:function(resp){
					if(typeof resp === 'object' || Array.isArray(resp) || typeof JSON.parse(resp) === 'object'){
						resp = JSON.parse(resp)
						if(Object.keys(resp).length > 0){
							const selectSendElement = document.getElementById('category');
							Object.keys(resp).map(function(k){
								// console.log(resp[k].name);
								const option = document.createElement('option');
								option.value = resp[k].name;
								option.text = resp[k].name;
								selectSendElement.appendChild(option);
							})
						}
					}
				},
				complete: function () {},
			});

			modalBody.innerHTML = String.raw`
				<form class="desc">
					<div>
						<label for="category">Select item category</label>
						<select name="category" id="category" required>
							<option value="" selected disabled hidden>--Select--</option>
						</select>
					</div>
					<div>
						<label for="value">Item value (₦)</label>
						<input type="number" name="value" id="value" required />
					</div>
					<div>
						<label for="desc">Detailed item description</label>
						<textarea
							name="desc"
							id="desc"
							cols="30"
							rows="10"
							required
							placeholder="Kindly provide a detailed description of the item being shipped"
						></textarea>
					</div>
					<div>
						<label for="quantity">Quantity</label>
						<input type="number" name="quantity" id="quantity" required />
					</div>
					<div>
						<label for="weight">Weight (KG)</label>
						<select name="weight" id="weight" required>
							<option value="" selected disabled hidden>--Select--</option>
							<option value="equal">0.2KG to 2KG</option>
							<option value="great">Above 2KG</option>
						</select>
					</div>
					<small id="errorMessage"></small>
					<button
						class="button"
						type="button"
						onclick="handleUserDetails('item')"
					>
						Continue
					</button>
				</form>
			`;
			shipmentData.item && handleUserDetails('item', 'backClicked');
			break;
		case 7:
			modalTitle.textContent = 'Delivery option';

			modalBody.innerHTML = String.raw` <h4>Choose a shipping rate</h4> 
			${deliveryOptions
				.map(
					option => String.raw`<div class="deliverOption" onclick="handleDeliveryOption('${
						option.type
					}')">
						<div>

							<h3>
								
								${option.type} Delivery
							</h3>
							<p>Delivery in ${option.periodInDays} business day${
						option.periodInDays > 1 ? 's' : ''
					} </p>
					<h2>₦ ${option.amount.toLocaleString()}</h2>
						</div>
						${
							shipmentData?.shippingRate?.type === option.type
								? String.raw`<img src="../assets/images/selected.svg" />`
								: String.raw`<img src="../assets/images/select.svg" />`
						}
				</div>`
				)
				.join('')}
				${
					shipmentData?.shippingRate
						? `
						<div class="deliverButton" onclick="handleNextStep(${bookingStep})">
							<button class="button ">Continue</button>
						</div>`
						: `
					''
					`
				}
			`;
			break;
		case 8:
			modalTitle.textContent = 'Order summary';

			modalBody.innerHTML = String.raw`
				<div class="summary">
					<h3>Kindly review your shipping information</h3>
					<div>
						<div>
							<span class="red"></span>
							<img src="../assets/images/line.svg" />
							<span class="green"></span>
						</div>
						<div>
							<div>
								<div>
									<h4>Pickup from:</h4>
									<p>
										${shipmentData.senderDetails.address || ''},<br />
										${shipmentData.senderDetails.city || ''},
										${shipmentData.senderDetails.state || ''},<br />
										${shipmentData.senderDetails.country || ''}
									</p>
								</div>
								<span onclick="handleNextStep(3)">Edit</span>
							</div>
							<div>
								<div>
									<h4>Delivery to:</h4>
									<p>
										${shipmentData.receiverDetails.address || ''},<br />
										${shipmentData.receiverDetails.city || ''},
										${shipmentData.receiverDetails.state || ''},<br />
										${shipmentData.receiverDetails.country || ''}
									</p>
								</div>
								<span onclick="handleNextStep(4)">Edit</span>
							</div>
						</div>
					</div>
					<div class="deliverButton" onclick="handleNextStep(${bookingStep})">
							<button class="button ">Continue</button>
						</div>
				</div>
			`;
			break;
		case 9:
			modalTitle.textContent = 'Payment';
			 

			modalBody.innerHTML = String.raw`

			<div class="deliverOption" id="wallet">
						<div>

							<h3>Pay from wallet</h3>
							<p>Your balance is ₦${
								globalBalance.toLocaleString()
							}</p>
							<button class="button" onclick="handleWalletFunding()">Fund Wallet</button>
						</div>
						<img src="../assets/images/select.svg" />
				</div>
			<!-- <div class="deliverOption" id="card">
						<div>
							<h3>Pay with card</h3>
							<button class="button">Add new card</button>
						</div>
						<img src="../assets/images/select.svg" />
				</div> -->
				<div class="deliverButton hide" onclick="handlePay()">
							<button class="button">Make Payment</button>
						</div>
				`;

			const rerenderElement = paymentType => {
				const deliverOption = document.querySelector(`#${paymentType}`);
				const imgElement = deliverOption.querySelector('img');
				shipmentData.paymentMethod = paymentType;
				document
					.querySelectorAll('.deliverOption img')
					.forEach(option => (option.src = '../assets/images/select.svg'));
					if (shipmentData?.paymentMethod === paymentType) {
					imgElement.src = '../assets/images/selected.svg';
				} else {
					imgElement.src = '../assets/images/select.svg';
				}

				document.querySelector('.deliverButton').classList.remove('hide');
			};

			// Attach the rerenderElement function to the onclick event
			const deliverOptionElements = document.querySelectorAll('.deliverOption');
			deliverOptionElements.forEach(element => {
				element.addEventListener('click', function (event) {
					const paymentType = event.currentTarget.id; // Get the id of the clicked element
					rerenderElement(paymentType); // Pass the extracted paymentType to rerenderElement
				});
			});
			shipmentData.paymentMethod && rerenderElement(shipmentData.paymentMethod);
			break;
		default:
			modalTitle.textContent = 'Book a shipment';
			modalBody.innerHTML = '';
			break;
	}
	}
};

// handleShipmentBook();
const handleOverlay = () => {
	const overlay = document.querySelector('.overlay');
	modalOpen = false;
	overlay.remove();
	bookingStep = 1;
	shipmentData = {};
	isBookingDataComplete = false;
};

// handleShipmentBook();