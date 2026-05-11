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
 * Echoes the background-image css property with the URL from the specified ACF field.
 *
 * @param string $field name of the field.
 * @param mixed  $post_id post id to get field from.
 *
 * @see https://www.advancedcustomfields.com/resources/get_field/
 */
function fopr_acf_bg_img( $field, $post_id = false ) {
	$bg = $field;
	if ( is_string( $bg ) ) {
		if ( ! function_exists( 'get_field' ) ) {
			return;
		}

		$bg = get_field( $bg, $post_id );
	}

	if ( $bg ) {
		if ( is_array( $bg ) ) {
			if ( empty( $bg['url'] ) ) {
				return;
			}

			$bg = $bg['url'];
		}

		echo esc_attr( sprintf( "background-image: url('%s');", esc_url_raw( $bg ) ) );
	}
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
 * Get the name of the first block.
 *
 * @return bool|string If post has blocks: block name. Else: false.
 */
function fopr_get_first_block_name() {
	$post = get_post();

	if ( ! empty( $post ) && has_blocks( $post->post_content ) ) {
		$blocks = parse_blocks( $post->post_content );

		if ( empty( $blocks[0]['blockName'] ) ) {
			return false;
		}

		if ( 'core/block' === $blocks[0]['blockName'] ) {
			if ( empty( $blocks[0]['attrs']['ref'] ) ) {
				return false;
			}

			$reusable_block = get_post( $blocks[0]['attrs']['ref'] );
			if ( empty( $reusable_block ) ) {
				return false;
			}

			$block_content = parse_blocks( $reusable_block->post_content );
			return $block_content[0]['blockName'] ?? false;
		}

		return $blocks[0]['blockName'];
	}

	return false;
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
