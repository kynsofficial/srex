const workingCities = [
	// 'nigeria',
	'ghana',
	'kenya',
	'south africa',
	'rwanda',
	'mauritius',
	'tunisia',
	'morocco',
	'egypt',
	'uganda',
];

const questions = [
	{
		question: 'Are there any additional fees or surcharges?',
		answer: 'answer',
	},
	{
		question: 'Is insurance included in the shipping cost?',
		answer: 'answer',
	},
	{
		question: 'What payment methods do you accept?',
		answer: 'answer',
	},
	{
		question: 'Is there a minimum order value for shipping?',
		answer: 'answer',
	},
	{
		question: 'Do you offer refunds or returns?',
		answer: 'answer',
	},
	{
		question: 'What information is required to place an order?',
		answer: 'answer',
	},
	{
		question: 'How can I contact customer support?',
		answer: 'answer',
	},
];

const citysContainer = document.querySelector('#cities');

workingCities.forEach(city => {
	const cityContainer = document.createElement('div');
	const cityImage = document.createElement('img');
	const cityName = document.createElement('span');
	citysContainer?.appendChild(cityContainer);
	cityContainer.appendChild(cityImage);
	cityContainer.setAttribute('class', 'city');
	cityContainer.appendChild(cityName);
	cityImage.setAttribute('src', `./assets/images/${city}.svg`);
	cityImage.setAttribute('class', 'flag');
	cityName.textContent = city;
});

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

const questionsAnswerContainer = document.querySelector('.article5 .section2');
const body = document.querySelector('body');
questions?.forEach(question => {
	const questionAnswerContainer = document.createElement('div');
	const questionContainer = document.createElement('div');
	const questionElement = document.createElement('span');
	const answerElement = document.createElement('span');
	const chevron = document.createElement('img');
	chevron.setAttribute('src', `./assets/images/arrow-down.svg`);
	questionElement.textContent = question.question;
	questionContainer.appendChild(questionElement);
	questionContainer.appendChild(chevron);
	questionAnswerContainer.appendChild(questionContainer);
	questionAnswerContainer.appendChild(answerElement);
	questionsAnswerContainer.appendChild(questionAnswerContainer);
	questionContainer.addEventListener('click', () =>
		openQuestion(question, answerElement, chevron)
	);
});

const handleNavigateToFaqs = () => {
	location.replace('/faqs');
};

const showSelect = e => {
	const selectedElement = e.target.nextElementSibling;
	// document.querySelector('.article2Sub .overlay').classList.add('transparentOverlay');
	if (selectedElement) {
		return hideSelect();
	} else {
		hideSelect();
	}
	const selectElement = e.target.parentElement.appendChild(
		document.createElement('aside')
	);
	workingCities.forEach(city => {
		selectElement.innerHTML += String.raw`<span onclick={handleSelect(event)}><img src='./assets/images/${city}.svg' />${city}</span>`;
	});
	selectElement.style.display = 'flex';
	e.target.parentElement.appendChild(selectElement);
};

const hideSelect = () => {
	const selectElement = document.querySelector(
		'.article2Sub .section2 label aside'
	);
	if (selectElement) selectElement.remove();
};
const handleSelect = e => {
	e.target.parentElement.parentElement.firstElementChild.value =
		e.target.textContent;
	e.target.parentElement.parentElement.children[2].innerText =
		e.target.textContent;
	hideSelect();
};
