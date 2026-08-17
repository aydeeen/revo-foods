const menuToggle = document.querySelector('.menu-icon[aria-controls]');

if (menuToggle) {
	const menu = document.getElementById(
		menuToggle.getAttribute('aria-controls'),
	);

	if (menu) {
		let frame;
		const updateExpandedState = () => {
			window.cancelAnimationFrame(frame);
			frame = window.requestAnimationFrame(() => {
				const styles = window.getComputedStyle(menu);
				const isExpanded =
					styles.display !== 'none' &&
					styles.visibility !== 'hidden' &&
					menu.getBoundingClientRect().height > 0;

				menuToggle.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
			});
		};

		menuToggle.addEventListener('click', updateExpandedState);
		window.addEventListener('resize', updateExpandedState, { passive: true });

		const observer = new MutationObserver(updateExpandedState);
		observer.observe(menu, {
			attributes: true,
			attributeFilter: ['class', 'hidden', 'style'],
		});

		updateExpandedState();
	}
}
