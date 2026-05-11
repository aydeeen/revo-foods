$(document).ready(() => {
	const closeTopbar = () => {
		$('.topbar').addClass('remove');
		$('.site-header').css('margin-top', '-40px');
	};

	$('.topbar__close').on('click', closeTopbar);
	$('.topbar__close').on('keydown', (e) => {
		if (e.key === 'Enter' || e.key === ' ') {
			e.preventDefault();
			closeTopbar();
		}
	});
});
