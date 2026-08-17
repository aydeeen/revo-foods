function findReCaptchaWrapper() {
	const iframe = document.querySelector(
		'body > div > div > iframe[src^="https://www.google.com/recaptcha/"]',
	);

	if (!iframe || !iframe.parentElement || !iframe.parentElement.parentElement) {
		return false;
	}

	iframe.parentElement.parentElement.classList.add('recaptcha-wrapper');
	return true;
}

const initializeReCaptchaObserver = () => {
	if (findReCaptchaWrapper()) {
		return;
	}

	const observer = new MutationObserver(() => {
		if (findReCaptchaWrapper()) {
			observer.disconnect();
		}
	});

	observer.observe(document.body, { childList: true, subtree: true });
};

if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', initializeReCaptchaObserver);
} else {
	initializeReCaptchaObserver();
}
