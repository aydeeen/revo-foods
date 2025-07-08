$(document).ready(() => {
	$('.topbar svg').on('click', (e) => {
		$('.topbar').addClass('remove');
		$('.site-header').css('margin-top', '-40px');
	});
});
