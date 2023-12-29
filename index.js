// const head = document.querySelector('head');
// head.innerHTML += `<link rel="stylesheet" href="./styles${
// 	location.pathname === '/'
// 		? '/index.css'
// 		: location.pathname.replace('php', 'css')
// }" />`;
// console.log(location.pathname);
const navLinks = document.querySelectorAll('.nav ul a');

navLinks.forEach(link => {
	if (link.href === location.href) {
		link.classList.add('active');
		link.parentElement.innerHTML +=
			'<img src="./assets/images/active.svg" alt="active" />';
	}
});

const footerYear = document.querySelector('#footerYear');
footerYear.textContent =
	`${new Date().getFullYear()} ` + footerYear.textContent;

const barIcon = document.querySelector('.nav .fas');

const handleNav = e => {
	const nav = document.querySelector('.nav ');
	const navlinksContainer = document.querySelector('.nav .navlinks');
	const overlay = document.querySelector('.nav .overlay');
	const body = document.querySelector('body');

	if (barIcon.getAttribute('class').includes('fa-arrow-down-short-wide')) {
		nav.classList.add('navlinksShown');
		navlinksContainer.classList.add('navlinksShown');
		barIcon.setAttribute('class', 'fas fa-arrow-up-short-wide');
		overlay.style.display = 'block';
		body.style.overflow = 'hidden';
	} else {
		nav.classList.remove('navlinksShown');
		navlinksContainer.classList.remove('navlinksShown');
		barIcon.setAttribute('class', 'fas fa-arrow-down-short-wide');
		overlay.removeAttribute('style');
		body.removeAttribute('style');
	}
};

barIcon.addEventListener('click', handleNav);
