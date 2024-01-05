// * Template messages
const messages = [
	{
		message: 'Hi, welcome to srex customer service, how can I help you',
		isAdmin: true,
	},
	{
		message:
			"Hello, I'm having an issue with payment, i can't use my card to pay",
	},
	{
		message: "I've been experiencing this since yesterday",
	},
	{
		message:
			'Please can you provide more context on the error you are experiencing?',
		isAdmin: true,
	},
	{message: "It's just stock nothing is showing up"},
	{
		message:
			'Sorry about the inconveniences, please hold on for the next five minutes while I check this out for you',
		isAdmin: true,
	},
	{message: 'Alright'},
];

const messagesContainer = document.querySelector('.support .messages');
messages.forEach((message, index) => {
	if (message.isAdmin) {
		messagesContainer.innerHTML += `<div class="admin-message">${message.message}</div>`;
	} else {
		if (messages[index - 1].isAdmin) {
			messagesContainer.innerHTML += `<div class="user-message-container">
				<div class="user-message">${message.message}</div>
				<div class="user-icon">T</div>
			</div> `;
		} else {
			messagesContainer.innerHTML += `<div class="user-message-container">
				<div class="user-message">${message.message}</div>
				<div class="user-icon-space"></div>
			</div>`;
		}
	}
});

const handleSend = () => {
	const input = document.querySelector('.support .input input');
	if (input.value) {
		// Send input.value to backend and save in db instead of pushing to the messages Array
		messages.push({message: input.value});

		//Do this after doing all the backend stuff and has received response
		if (messages[messages.length - 1].isAdmin) {
			messagesContainer.innerHTML += `<div class="user-message-container">
				<div class="user-message">${input.value}</div>
				<div class="user-icon">T</div>
			</div> `;
		} else {
			messagesContainer.innerHTML += `<div class="user-message-container-continue">
				<div class="user-message">${input.value}</div>
				<div class="user-icon-space"></div>
			</div>`;
		}
		input.value = '';
	}
};

const sendButton = document.querySelector('.support .input button');
sendButton.addEventListener('click', handleSend);
