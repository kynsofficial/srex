const trackInput = document.querySelector('.trackArticle1 input');
const searchIcon = document.querySelector('.trackArticle1 img');

const handleFocus = e => {
	searchIcon.classList.add('hide');
};
const handleBlur = () => {
	searchIcon.classList.remove('hide');
};

trackInput.addEventListener('focus', e => handleFocus(e));
trackInput.addEventListener('blur', () => handleBlur());
