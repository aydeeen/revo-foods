const backToTop = document.getElementById('back-to-top');

if (backToTop) {
	let ticking = false;

	const updateVisibility = () => {
		const isVisible = window.scrollY > 300;
		backToTop.classList.toggle('show', isVisible);
		backToTop.setAttribute('aria-hidden', isVisible ? 'false' : 'true');
		backToTop.tabIndex = isVisible ? 0 : -1;
		ticking = false;
	};

	window.addEventListener(
		'scroll',
		() => {
			if (!ticking) {
				window.requestAnimationFrame(updateVisibility);
				ticking = true;
			}
		},
		{ passive: true },
	);

	backToTop.addEventListener('click', () => {
		const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)')
			.matches;
		window.scrollTo({ top: 0, behavior: reduceMotion ? 'auto' : 'smooth' });
	});

	updateVisibility();
}
