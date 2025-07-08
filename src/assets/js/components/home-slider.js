const Flickity = require('flickity');

$(() => {
	const slider = $('.b-home-slider__slider');
	if (slider.length > 0) {
		const sliderFlickity = new Flickity(slider.get(0), {
			wrapAround: true,
			groupCells: false,
			cellAlign: 'left',
			autoPlay: 5000,
			pauseAutoPlayOnHover: false,
			adaptiveHeight: false,
			prevNextButtons: false,
			draggable: true,
		});
	}
});
