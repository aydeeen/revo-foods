/* eslint-disable import/first */
/* eslint-disable no-underscore-dangle, global-require */
/* uncomment if babel polyfills are needed.
if (
	(typeof window !== 'undefined' && !window._babelPolyfill) ||
	(typeof global !== 'undefined' && !global._babelPolyfill)
) {
	require('@babel/polyfill');
}
*/
/* eslint-enable no-underscore-dangle, global-require */

import './lib/foundation';

// components
import './components/number-counter';
import './components/back-to-top';
import './components/home-header-bg-color';
import './components/close-topbar';
import './components/mobile-menu-a11y';

// FontAwesome (lib/FontAwesome.js), the iconlist component and the exit-intent
// Reveal helper are no longer bundled: no page uses them. Re-import to use.
import './lib/reCaptcha';

// because jQuery is included with webpack.ProvidePlugin we can
// just use jQuery and $ variables without importing it again.
