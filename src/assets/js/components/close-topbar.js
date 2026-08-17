const closeTopbar = document.querySelector('.topbar__close');

if (closeTopbar) {
	closeTopbar.addEventListener('click', () => {
		const topbar = closeTopbar.closest('.topbar');
		if (topbar) {
			topbar.hidden = true;
		}
	});
}
