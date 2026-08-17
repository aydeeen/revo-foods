const counters = document.querySelectorAll(
	'.b-numbers__item-number, .b-sustainability__subtitle--1',
);

if (counters.length > 0 && 'IntersectionObserver' in window) {
	const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)')
		.matches;

	const animateCounter = (counter) => {
		const element = counter;
		const value = element.textContent.trim();
		const match = value.match(/^([^\d-]*)(-?\d+(?:[.,]\d+)?)(.*)$/);
		if (!match || reduceMotion) {
			return;
		}

		const [, prefix, numericValue, suffix] = match;
		const target = Number(numericValue.replace(',', '.'));
		const decimals = (numericValue.split(/[.,]/)[1] || '').length;
		const startedAt = performance.now();
		const duration = 1000;

		const update = (now) => {
			const progress = Math.min((now - startedAt) / duration, 1);
			const current = target * (1 - (1 - progress) ** 3);
			element.textContent = `${prefix}${current.toFixed(decimals)}${suffix}`;

			if (progress < 1) {
				window.requestAnimationFrame(update);
			}
		};

		window.requestAnimationFrame(update);
	};

	const observer = new IntersectionObserver(
		(entries) => {
			entries.forEach((entry) => {
				if (entry.isIntersecting) {
					animateCounter(entry.target);
					observer.unobserve(entry.target);
				}
			});
		},
		{ threshold: 0.4 },
	);

	counters.forEach((counter) => observer.observe(counter));
}
