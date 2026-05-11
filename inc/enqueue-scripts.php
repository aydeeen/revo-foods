<?php
/**
 * Enqueue all styles and scripts
 *
 * Learn more about enqueue_script: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_script}
 * Learn more about enqueue_style: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_style }
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

/**
 * Get a cache-busting version for a built theme asset.
 *
 * @param string $relative_path Asset path relative to the theme directory.
 * @return int|string|null File timestamp, theme version, or null.
 */
function foundationpress_asset_version( $relative_path ) {
	$path = get_template_directory() . '/' . ltrim( $relative_path, '/' );

	if ( file_exists( $path ) ) {
		return filemtime( $path );
	}

	$theme = wp_get_theme();
	return $theme->exists() ? $theme->get( 'Version' ) : null;
}

if ( ! function_exists( 'foundationpress_enqueue_scripts' ) ) :
	function foundationpress_enqueue_scripts() {

		// Enqueue the stylesheet.
		wp_enqueue_style(
			'foundationpress-styles',
			get_template_directory_uri() . '/dist/assets/css/main.css',
			false,
			foundationpress_asset_version( 'dist/assets/css/main.css' )
		);

		// Enqueue the scripts.
		wp_enqueue_script(
			'foundationpress-scripts-runtime',
			get_template_directory_uri() . '/dist/assets/js/runtime.js',
			['jquery'],
			foundationpress_asset_version( 'dist/assets/js/runtime.js' ),
			true
		);

		wp_enqueue_script(
			'foundationpress-scripts',
			get_template_directory_uri() . '/dist/assets/js/app.js',
			['jquery', 'foundationpress-scripts-runtime'],
			foundationpress_asset_version( 'dist/assets/js/app.js' ),
			true
		);

		// Add the comment-reply library on pages where it is necessary
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}

	add_action( 'wp_enqueue_scripts', 'foundationpress_enqueue_scripts' );
endif;

function fopr_admin_enqueue_scripts() {
	global $pagenow;

	// fix password field is removed
	if ( 'user-new.php' !== $pagenow ) {
		// Enqueue the stylesheet.
		wp_enqueue_style(
			'foundationpress-admin-styles',
			get_template_directory_uri() . '/dist/assets/css/admin.css',
			[],
			foundationpress_asset_version( 'dist/assets/css/admin.css' )
		);

		// Enqueue the scripts.
		wp_enqueue_script(
			'foundationpress-scripts-runtime',
			get_template_directory_uri() . '/dist/assets/js/runtime.js',
			['jquery'],
			foundationpress_asset_version( 'dist/assets/js/runtime.js' ),
			true
		);

		wp_enqueue_script(
			'foundationpress-scripts',
			get_template_directory_uri() . '/dist/assets/js/app.js',
			['jquery', 'foundationpress-scripts-runtime'],
			foundationpress_asset_version( 'dist/assets/js/app.js' ),
			true
		);
	}
}
add_action( 'admin_enqueue_scripts', 'fopr_admin_enqueue_scripts' );

add_action(
	'init',
	function() {
		if ( ! function_exists( 'pll_register_string' ) ) {
			return;
		}

		pll_register_string( 'products', 'PRODUCTS' );
		pll_register_string( 'cook-time', 'Cook Time' );
		pll_register_string( 'the-recipe-features', 'the recipe features' );
		pll_register_string( 'view-product', 'View Product' );
		pll_register_string( 'ingredients', 'Ingredients' );
		pll_register_string( 'preparation', 'Preparation' );
		pll_register_string( 'latest-recipes', 'Latest Recipes' );
		pll_register_string( 'view-all', 'View All' );
	}
);
