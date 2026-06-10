<?php
/**
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

// composer autoload.
$foundationpress_autoload        = __DIR__ . '/vendor/autoload.php';
$foundationpress_autoload_real   = __DIR__ . '/vendor/composer/autoload_real.php';
$foundationpress_autoload_static = __DIR__ . '/vendor/composer/autoload_static.php';
$foundationpress_class_loader    = __DIR__ . '/vendor/composer/ClassLoader.php';
if (
	file_exists( $foundationpress_autoload )
	&& file_exists( $foundationpress_autoload_real )
	&& file_exists( $foundationpress_autoload_static )
	&& file_exists( $foundationpress_class_loader )
) {
	require_once $foundationpress_autoload;
}

/**
 * Requires all files recursively within given directory
 *
 * @param string $path path to directory which should be required recursively.
 */
function foundationpress_recursive_require_dir( $path ) {
	if ( ! is_dir( $path ) ) {
		return;
	}

	$dir      = new RecursiveDirectoryIterator( $path, RecursiveDirectoryIterator::SKIP_DOTS );
	$iterator = new RecursiveIteratorIterator( $dir );
	foreach ( $iterator as $file ) {
		$fname = $file->getFilename();
		if ( $file->isFile() && preg_match( '%\.php$%', $fname ) ) {
			require_once $file->getPathname();
		}
	}
}

foundationpress_recursive_require_dir( get_template_directory() . '/inc' );

// Log unexpected flushes.
add_action(
	'init',
	function() {
		if ( did_action( 'init' ) === 1 && function_exists( 'flush_rewrite_rules' ) ) {
			if ( isset( $GLOBALS['wp_rewrite'] ) && null === $GLOBALS['wp_rewrite']->rules ) {
				error_log( 'Rewrites flushed on ' . current_time( 'mysql' ) ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
			}
		}
	}
);

// Force Polylang rewrite rules every load (safe version).
add_action(
	'init',
	function() {
		if ( function_exists( 'PLL' ) ) {
			$pll = PLL();
			if ( isset( $pll->model ) && isset( $pll->model->rewrite ) ) {
				$pll->model->rewrite->init();
			}
		}
	}
);
