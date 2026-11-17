<?php
/**
 * Rewrite rule safeguards for Polylang and custom post types.
 *
 * @package FoundationPress
 */

/**
 * Drop the rewrite rules WordPress generates for Polylang's internal
 * "language" taxonomy. Left in place, they turn every single-segment URL
 * (for example /recipes/ or /faq/) into a language archive that 404s.
 *
 * Polylang removes them itself with `__return_empty_array`, and it also uses
 * `has_filter( 'language_rewrite_rules', '__return_empty_array' )` as its
 * "rules already prepared" flag. Hooking that same callback from the theme
 * makes Polylang skip every /de/ rule, so this uses a callback of its own.
 *
 * @return array
 */
function fopr_suppress_language_taxonomy_rewrite_rules() {
	return [];
}
add_filter( 'language_rewrite_rules', 'fopr_suppress_language_taxonomy_rewrite_rules', 1 );

/**
 * Get the URL prefix Polylang adds to rewrite rules for non-default languages.
 *
 * @return string Prefix such as "(de)/", or an empty string when Polylang
 *                does not put the language in the URL path.
 */
function fopr_get_polylang_rewrite_prefix() {
	if ( ! function_exists( 'PLL' ) || ! function_exists( 'pll_languages_list' ) ) {
		return '';
	}

	$options = PLL()->options;

	// Only the "language set from the directory name" mode adds path rules.
	if ( empty( $options['force_lang'] ) || 1 !== (int) $options['force_lang'] ) {
		return '';
	}

	$languages = pll_languages_list( [ 'fields' => 'slug' ] );
	if ( ! empty( $options['hide_default'] ) && ! empty( $options['default_lang'] ) ) {
		$languages = array_diff( $languages, [ $options['default_lang'] ] );
	}

	if ( empty( $languages ) ) {
		return '';
	}

	global $wp_rewrite;

	return $wp_rewrite->root . ( empty( $options['rewrite'] ) ? 'language/' : '' ) . '(' . implode( '|', $languages ) . ')/';
}

/**
 * Whether the stored rewrite rules were built without Polylang's language rules.
 *
 * @param mixed $rules Stored rewrite rules.
 * @return bool
 */
function fopr_rewrite_rules_need_rebuild( $rules ) {
	// WordPress rebuilds missing rules on its own.
	if ( empty( $rules ) || ! is_array( $rules ) ) {
		return false;
	}

	// The language taxonomy rules leaked in: /faq/ would be read as ?lang=faq.
	if ( isset( $rules['([^/]+)/?$'] ) && 'index.php?lang=$matches[1]' === $rules['([^/]+)/?$'] ) {
		return true;
	}

	$prefix = fopr_get_polylang_rewrite_prefix();

	// Polylang adds a home rule for each prefixed language, e.g. "(de)/?$".
	if ( '' !== $prefix && ! isset( $rules[ $prefix . '?$' ] ) ) {
		return true;
	}

	// Rules flushed before Custom Post Type UI registered the post types on
	// `init` have no /recipes/<slug>/ rule at all.
	$targets    = implode( "\n", array_filter( $rules, 'is_string' ) );
	$post_types = get_post_types(
		[
			'public'   => true,
			'_builtin' => false,
		],
		'objects'
	);

	foreach ( $post_types as $post_type ) {
		if ( $post_type->rewrite && $post_type->query_var && false === strpos( $targets, $post_type->query_var . '=$matches[' ) ) {
			return true;
		}
	}

	return false;
}

/**
 * Attach Polylang 3.2-3.4's rewrite filters before any flush in this request.
 *
 * Those versions attach their /de/ rule filters from the
 * `pre_option_rewrite_rules` hook, i.e. the first time the rules are read
 * after `wp_loaded`. Since WordPress 6.4, `flush_rewrite_rules()` rebuilds the
 * rules without reading the option first, so a flush (saving permalinks, a
 * plugin update) only included the German rules when something had happened
 * to read them earlier in the same request. Reading the option here, ahead of
 * WordPress's deferred flush at priority 10, closes that gap. It is
 * autoloaded, so this costs no query. Polylang 3.5+ attaches its filters on
 * `wp_loaded` at priority 9 and ignores this.
 */
function fopr_prime_polylang_rewrite_filters() {
	get_option( 'rewrite_rules' );
}
add_action( 'wp_loaded', 'fopr_prime_polylang_rewrite_filters', 1 );

/**
 * Repair the stored rules once if an earlier flush built them without
 * Polylang's language rules or without the custom post types.
 *
 * Runs after priority 9, where Polylang 3.5+ attaches its rewrite filters, so
 * the rebuilt rules include the /de/ URLs on every Polylang version. The
 * transient keeps a persistent mismatch from flushing on every request; its
 * key carries a version so a deploy that changes this logic re-arms it.
 */
function fopr_maybe_rebuild_polylang_rewrite_rules() {
	$lock = 'fopr_rewrite_rules_rebuilt_v2';

	if ( ! get_option( 'permalink_structure' ) || get_transient( $lock ) ) {
		return;
	}

	if ( ! fopr_rewrite_rules_need_rebuild( get_option( 'rewrite_rules' ) ) ) {
		return;
	}

	set_transient( $lock, time(), HOUR_IN_SECONDS );
	flush_rewrite_rules( false );
}
add_action( 'wp_loaded', 'fopr_maybe_rebuild_polylang_rewrite_rules', 20 );
