const Flickity = require('flickity');

const blockName = 'home-slider';

function initializeBlock($block) {
	const slider = $block.find('.b-home-slider__slider').get(0);
	if (!slider || Flickity.data(slider)) {
		return;
	}

	const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)')
		.matches;
	const sliderFlickity = new Flickity(slider, {
		wrapAround: true,
		groupCells: false,
		cellAlign: 'left',
		autoPlay: reduceMotion ? false : 5000,
		pauseAutoPlayOnHover: true,
		adaptiveHeight: false,
		prevNextButtons: false,
		draggable: true,
		pageDots: true,
	});

	$(slider).data('flickityInstance', sliderFlickity);
}

jQuery(($) => {
	$('.b-home-slider').each((index, element) => {
		initializeBlock($(element));
	});
});

if (window.acf) {
	window.acf.addAction(
		`render_block_preview/type=${blockName}`,
		initializeBlock,
	);
}
