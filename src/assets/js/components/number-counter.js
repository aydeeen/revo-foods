/* eslint-disable */

jQuery(document).ready(($) => {
	if (
		window.location.pathname === '/about/' ||
		window.location.pathname === '/sustainability/'
	) {
		let viewed = false;

		function isScrolledIntoView(elem) {
			const docViewTop = $(window).scrollTop();
			const docViewBottom = docViewTop + $(window).height();

			const elemTop = $(elem).offset().top;
			const elemBottom = elemTop + $(elem).height();

			return elemBottom <= docViewBottom && elemTop >= docViewTop;
		}

		function numberCounter() {
			if (isScrolledIntoView($('.b-numbers, .b-sustainability')) && !viewed) {
				viewed = true;
				$('.b-numbers__item-number, .b-sustainability__subtitle--1').each(
					function () {
						$(this)
							.prop('Counter', 0)
							.animate(
								{
									Counter: $(this).text(),
								},
								{
									duration: 1000,
									easing: 'swing',
									step(now) {
										$(this).text(Math.ceil(now));
									},
								},
							);
					},
				);
			}
		}

		$(window).scroll(numberCounter);
	}
});
