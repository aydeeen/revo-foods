<?php
/**
 * Some helper functions.
 *
 * @package FoundationPress
 */

/**
 * Returns URI to assets without trailing slash.
 *
 * @param boolean $echo whether to echo the URI.
 */
function fopr_assets_uri( $echo = true ) {
	$uri = get_template_directory_uri() . '/dist/assets';
	if ( $echo ) {
		echo esc_url( $uri );
	}
	return $uri;
}

/**
 * Get the background-image CSS property for an ACF image field.
 *
 * @param string|array $field   Name of the field or a resolved ACF image value.
 * @param mixed        $post_id Post ID to get the field from.
 * @return string
 */
function fopr_get_acf_bg_img_style( $field, $post_id = false ) {
	$bg = $field;
	if ( is_string( $bg ) ) {
		if ( ! function_exists( 'get_field' ) ) {
			return '';
		}

		$bg = get_field( $bg, $post_id );
	}

	if ( $bg ) {
		if ( is_array( $bg ) ) {
			if ( empty( $bg['url'] ) ) {
				return '';
			}

			$bg = $bg['url'];
		}

		return sprintf( "background-image: url('%s');", esc_url_raw( $bg ) );
	}

	return '';
}

/**
 * Echoes the background-image CSS property with the URL from an ACF field.
 *
 * @param string|array $field   Name of the field or a resolved ACF image value.
 * @param mixed        $post_id Post ID to get the field from.
 */
function fopr_acf_bg_img( $field, $post_id = false ) {
	echo esc_attr( fopr_get_acf_bg_img_style( $field, $post_id ) );
}

/**
 * Translate a string through Polylang when available, with gettext as fallback.
 *
 * @param string $string String to translate.
 * @return string
 */
function fopr_translate_string( $string ) {
	if ( function_exists( 'pll__' ) ) {
		return pll__( $string );
	}

	return __( $string, 'foundationpress' ); // phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
}

/**
 * Whether a block, rather than the page template, supplies the page's H1.
 *
 * True for pages that tick "Hide title". Job posts and the recipes template
 * print their own H1, so their blocks never take it.
 *
 * @param int|string $post_id Post ID.
 * @return bool
 */
function fopr_blocks_provide_page_heading( $post_id ) {
	if ( ! $post_id || 'page' !== get_post_type( $post_id ) || ! function_exists( 'get_field' ) ) {
		return false;
	}

	if ( in_array( get_page_template_slug( $post_id ), [ 'template-job-post.php', 'template-recipes.php' ], true ) ) {
		return false;
	}

	return true === get_field( 'hide_title', $post_id );
}

/**
 * Get an image's alt text, falling back to a readable version of its title.
 *
 * For images that carry meaning (for example a hero title drawn as an SVG)
 * when the alt text was never filled in the Media Library.
 *
 * @param int $attachment_id Attachment ID.
 * @return string
 */
function fopr_get_image_alt( $attachment_id ) {
	if ( ! $attachment_id ) {
		return '';
	}

	$alt = trim( (string) get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) );
	if ( '' !== $alt ) {
		return $alt;
	}

	$title = str_replace( [ '-', '_' ], ' ', (string) get_the_title( $attachment_id ) );
	$title = preg_replace( '/\s+(title|logo|image|img|icon)$/i', '', trim( $title ) );
	$title = trim( preg_replace( '/\s+/', ' ', $title ) );

	// Camera and hashed upload names ("IMG 2041", "7b6d687d59c1...") say nothing.
	if ( preg_match( '/^(?:[a-f0-9 ]{16,}|(?:img|dsc|image|screenshot|photo|frame)?\s*[\d ]+)$/i', $title ) ) {
		return '';
	}

	return $title;
}

/**
 * Mark images without an alt attribute as decorative.
 *
 * For editor-entered HTML such as a ™ graphic inside a heading, where screen
 * readers would otherwise announce the file name.
 *
 * @param string $html HTML.
 * @return string
 */
function fopr_add_missing_img_alt( $html ) {
	return preg_replace( '/<img\b(?![^>]*\balt=)/i', '<img alt=""', (string) $html );
}

/**
 * Accessible name for a logo, used when the logo is the only content of a link.
 *
 * @param int    $attachment_id Logo attachment ID.
 * @param string $url           Link target, used for the domain as a last resort.
 * @return string
 */
function fopr_get_logo_label( $attachment_id, $url = '' ) {
	$label = fopr_get_image_alt( $attachment_id );

	if ( '' === $label && $url ) {
		$host  = (string) wp_parse_url( $url, PHP_URL_HOST );
		$label = preg_replace( '/^www\./', '', $host );
	}

	return $label;
}

/**
 * Get a list of pages wichh use specific template.
 *
 * @param string $template name of the template file. Must include .php ending.
 * @param array  $args additional arguments to pass to the get_pages function.
 * @return array list of pages. see https://codex.wordpress.org/Function_Reference/get_pages.
 */
function fopr_get_pages_by_template( $template = '', $args = [] ) {
	if ( empty( $template ) ) {
		return false;
	}
	if ( strpos( $template, '.php' ) !== ( strlen( $template ) - 4 ) ) {
		$template .= '.php';
	}
	$args['meta_key']   = '_wp_page_template'; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
	$args['meta_value'] = $template; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
	return get_pages( $args );
}

/**
 * Generates random string with specified length.
 *
 * @see https://stackoverflow.com/a/13212994/2180161
 *
 * @param integer $length lenght of the string.
 * @return string the generated string.
 */
function fopr_generate_random_string( $length = 10 ) {
	$x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	return substr( str_shuffle( str_repeat( $x, ceil( $length / strlen( $x ) ) ) ), 1, $length );
}

/**
 * Get the first block of a post, looking inside a leading reusable block.
 *
 * Whitespace between blocks is parsed as nameless blocks; those are skipped.
 *
 * @param int $post_id Post ID. Defaults to the current post.
 * @return array|false Parsed block, or false when the post has no blocks.
 */
function fopr_get_first_block( $post_id = 0 ) {
	static $cache = [];

	$post = get_post( $post_id ?: null );
	if ( empty( $post ) || ! has_blocks( $post->post_content ) ) {
		return false;
	}

	if ( array_key_exists( $post->ID, $cache ) ) {
		return $cache[ $post->ID ];
	}

	$first   = false;
	$content = $post->post_content;

	// Resolve nested reusable blocks, but never loop forever on a self-reference.
	for ( $depth = 0; $depth < 3; $depth++ ) {
		$next = '';

		foreach ( parse_blocks( $content ) as $block ) {
			if ( empty( $block['blockName'] ) ) {
				continue;
			}

			if ( 'core/block' === $block['blockName'] && ! empty( $block['attrs']['ref'] ) ) {
				$reusable = get_post( $block['attrs']['ref'] );
				$next     = $reusable ? $reusable->post_content : '';
			} else {
				$first = $block;
			}
			break;
		}

		if ( false !== $first || '' === $next ) {
			break;
		}

		$content = $next;
	}

	$cache[ $post->ID ] = $first;

	return $first;
}

/**
 * Get the name of the first block.
 *
 * @return bool|string If post has blocks: block name. Else: false.
 */
function fopr_get_first_block_name() {
	$block = fopr_get_first_block();

	return $block ? $block['blockName'] : false;
}

/**
 * Moves second half of the content into an accordion if <!--readmore--> tag found in the text.
 *
 * @param  string  $content the content to split.
 * @param  array   $args array with 'more_text' and 'less_text' keys. Use these to customize the more and less text.
 * @param  boolean $echo whether to echo the content or not. defaults to true.
 * @return void|string
 */
function fopr_read_more( $content, $args = [], $echo = true ) {
	if ( empty( $args ) ) {
		$args = [];
	}

	$args = array_merge(
		[
			'more_text' => __( 'Read more', 'foundationpress' ),
			'less_text' => __( 'Show less', 'foundationpress' ),
		],
		$args
	);

	$content = explode( '<!--readmore-->', $content );

	ob_start();

	echo wp_kses_post( $content[0] );

	if ( count( $content ) > 1 ) {
		?>
		<div class="accordion accordion--text" data-accordion data-allow-all-closed="true">
			<div class="accordion-item" data-accordion-item>
				<div class="accordion-content" data-tab-content>
					<?php echo wp_kses_post( $content[1] ); ?>
				</div>

				<a href="#" class="accordion-title">
					<span class="accordion-title__closed"><?php echo esc_html( $args['more_text'] ); ?></span>
					<span class="accordion-title__expanded"><?php echo esc_html( $args['less_text'] ); ?></span>
				</a>
			</div>
		</div>
		<?php
	}

	if ( $echo ) {
		echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		return ob_get_clean();
	}
}
