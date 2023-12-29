const shippingFAQsArray = [
	{
		question: 'How long does it take to deliver locally?',
		answer:
			'Our local delivery times vary depending on the destination and the type of service chosen. Generally, we strive to deliver within 2-3 working days, and for express delivery, we aim for same-day or next-day delivery.',
	},
	{
		question: 'How long does it take for my package to be delivered?',
		answer: 'Answer',
	},
	{
		question: 'What should I do if my package is damaged or lost?',
		answer: 'Answer',
	},
	{
		question: 'What are the shipping options available?',
		answer: 'Answer',
	},
	{
		question: "What happens if I'm not available to receive the package?",
		answer: 'Answer',
	},
	{
		question: 'Can I change the delivery address after placing an order?',
		answer: 'Answer',
	},
];
const pricingFAQsArray = [
	{
		question: 'Are there any additional fees or surcharges?',
		answer: 'Answer',
	},
	{
		question: 'Is insurance included in the shipping cost?',
		answer: 'Answer',
	},
	{
		question: 'What payment methods do you accept?',
		answer: 'Answer',
	},
	{
		question: 'Is there a minimum order value for shipping?',
		answer: 'Answer',
	},
	{
		question: 'Do you offer refunds or returns?',
		answer: 'Answer',
	},
];
const platformFAQsArray = [
	{
		question: 'What information is required to place an order?',
		answer: 'Answer',
	},
	{
		question: 'How can I contact customer support?',
		answer: 'Answer',
	},
	{
		question: 'Can I save multiple delivery addresses in my account?',
		answer: 'Answer',
	},
	{
		question: 'Do you offer notifications for delivery updates?',
		answer: 'Answer',
	},
	{
		question: 'Can I leave delivery instructions for the carrier?',
		answer: 'Answer',
	},
];

const openQuestion = (question, answerElement, chevron) => {
	// console.log(isOpened);
	if (!answerElement.textContent) {
		answerElement.textContent = question.answer;
		chevron.style.transform = 'rotateX(-180deg)';
		answerElement.style.marginBottom = '20px';
	} else {
		answerElement.textContent = '';
		chevron.removeAttribute('style');
		answerElement.removeAttribute('style');
	}
};

const shippingFAQsContainer = document.querySelector('#shipping');
const pricingFAQsContainer = document.querySelector('#pricing');
const platformFAQsContainer = document.querySelector('#platform');

shippingFAQsArray.forEach(question => {
	const shippingFAQs = document.createElement('div');
	const questionContainer = document.createElement('div');
	const questionElement = document.createElement('h4');
	const answerElement = document.createElement('span');
	const chevron = document.createElement('img');
	chevron.setAttribute('src', `./assets/images/arrow-down.svg`);
	questionElement.textContent = question.question;
	questionContainer.appendChild(questionElement);
	questionContainer.appendChild(chevron);
	shippingFAQs.appendChild(questionContainer);
	shippingFAQs.appendChild(answerElement);
	shippingFAQsContainer.appendChild(shippingFAQs);
	questionContainer.addEventListener('click', () =>
		openQuestion(question, answerElement, chevron)
	);
});
pricingFAQsArray.forEach(question => {
	const shippingFAQs = document.createElement('div');
	const questionContainer = document.createElement('div');
	const questionElement = document.createElement('h4');
	const answerElement = document.createElement('span');
	const chevron = document.createElement('img');
	chevron.setAttribute('src', `./assets/images/arrow-down.svg`);
	questionElement.textContent = question.question;
	questionContainer.appendChild(questionElement);
	questionContainer.appendChild(chevron);
	shippingFAQs.appendChild(questionContainer);
	shippingFAQs.appendChild(answerElement);
	pricingFAQsContainer.appendChild(shippingFAQs);
	questionContainer.addEventListener('click', () =>
		openQuestion(question, answerElement, chevron)
	);
});
platformFAQsArray.forEach(question => {
	const shippingFAQs = document.createElement('div');
	const questionContainer = document.createElement('div');
	const questionElement = document.createElement('h4');
	const answerElement = document.createElement('span');
	const chevron = document.createElement('img');
	chevron.setAttribute('src', `./assets/images/arrow-down.svg`);
	questionElement.textContent = question.question;
	questionContainer.appendChild(questionElement);
	questionContainer.appendChild(chevron);
	shippingFAQs.appendChild(questionContainer);
	shippingFAQs.appendChild(answerElement);
	platformFAQsContainer.appendChild(shippingFAQs);
	questionContainer.addEventListener('click', () =>
		openQuestion(question, answerElement, chevron)
	);
});
