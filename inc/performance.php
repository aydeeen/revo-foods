<?php
/**
 * Front-end asset trimming for plugins that load on every page.
 *
 * @package FoundationPress
 */

/**
 * External-link arrow drawn with an SVG mask in the text colour, in place of
 * the Dashicons font glyph WP External Links uses.
 */
const FOPR_EXTERNAL_ICON_CSS = 'i.wpel-icon.dashicons-external::before{content:"";display:inline-block;width:1em;height:1em;vertical-align:-.15em;background-color:currentColor;-webkit-mask:url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 20 20\'%3E%3Cpath d=\'M9 3h8v8l-2-1V6.92l-5.6 5.59-1.41-1.41L14.08 5H10zm3 12v-3l2-2v7H3V6h8L9 8H5v7h7z\'/%3E%3C/svg%3E") center/contain no-repeat;mask:url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 20 20\'%3E%3Cpath d=\'M9 3h8v8l-2-1V6.92l-5.6 5.59-1.41-1.41L14.08 5H10zm3 12v-3l2-2v7H3V6h8L9 8H5v7h7z\'/%3E%3C/svg%3E") center/contain no-repeat}';

/**
 * Stop loading the Dashicons font for visitors.
 *
 * WP External Links enqueues the whole Dashicons stylesheet (an icon font of
 * ~35 KB gzipped, render-blocking) to show one arrow after external links.
 * Logged-in users keep it because the admin bar needs it.
 */
function fopr_replace_dashicons_for_visitors() {
	if ( is_user_logged_in() || ! wp_style_is( 'dashicons', 'enqueued' ) ) {
		return;
	}

	wp_dequeue_style( 'dashicons' );

	$handle = wp_style_is( 'wpel-style', 'enqueued' ) ? 'wpel-style' : 'foundationpress-styles';
	wp_add_inline_style( $handle, FOPR_EXTERNAL_ICON_CSS );
}
add_action( 'wp_enqueue_scripts', 'fopr_replace_dashicons_for_visitors', 100 );

/**
 * Whether the current page's content (including reusable blocks) mentions a string.
 *
 * @param string $needle Text to look for.
 * @return bool
 */
function fopr_current_content_contains( $needle ) {
	if ( ! is_singular() ) {
		return false;
	}

	$post = get_post( get_queried_object_id() );
	if ( ! $post ) {
		return false;
	}

	if ( false !== strpos( $post->post_content, $needle ) ) {
		return true;
	}

	if ( preg_match_all( '/<!-- wp:block \{"ref":(\d+)/', $post->post_content, $refs ) ) {
		foreach ( $refs[1] as $ref ) {
			$reusable = get_post( (int) $ref );
			if ( $reusable && false !== strpos( $reusable->post_content, $needle ) ) {
				return true;
			}
		}
	}

	return false;
}

/**
 * Load Formidable's form styles only on pages that contain a form.
 *
 * The plugin is set to load them everywhere (45 KB). Every form on this site
 * is placed through a block in the page content, so pages without
 * "formidable" in their content have none. Pages with a form keep the
 * stylesheet in the head, so the form never renders unstyled.
 */
function fopr_limit_formidable_styles() {
	if ( is_admin() || ! wp_style_is( 'formidable', 'enqueued' ) || fopr_current_content_contains( 'formidable' ) ) {
		return;
	}

	wp_dequeue_style( 'formidable' );
}
add_action( 'wp_enqueue_scripts', 'fopr_limit_formidable_styles', 100 );

/**
 * Safety net: if a form renders anyway (e.g. from a widget), load its styles.
 * Styles enqueued this late are printed in the footer.
 */
function fopr_restore_formidable_styles() {
	wp_enqueue_style( 'formidable' );
}
add_action( 'frm_enqueue_form_scripts', 'fopr_restore_formidable_styles' );

/**
 * Load Smash Balloon Instagram Feed styles only where a feed is shown.
 *
 * Turns on the plugin's own "enqueue CSS only with the shortcode" setting for
 * front-end requests; the feed then loads its stylesheet itself. The feed sits
 * low on the page, so its CSS arriving in the footer is not visible.
 *
 * @param mixed $settings Plugin settings.
 * @return mixed
 */
function fopr_instagram_css_with_feed_only( $settings ) {
	if ( is_admin() || ! is_array( $settings ) ) {
		return $settings;
	}

	$settings['enqueue_css_in_shortcode'] = true;

	return $settings;
}
add_filter( 'option_sb_instagram_settings', 'fopr_instagram_css_with_feed_only' );
