<?php
/**
 * Search and social metadata fallbacks for Yoast SEO.
 *
 * Most pages are built from ACF blocks, whose text and images live in block
 * attributes rather than in the post HTML Yoast reads. Pages without a
 * hand-written description or social image therefore had none at all. These
 * filters only fill gaps; anything set in Yoast still wins.
 *
 * @package FoundationPress
 */

/**
 * Collect readable text from parsed blocks, in page order.
 *
 * @param array $blocks Parsed blocks.
 * @return string[]
 */
function fopr_collect_block_text( $blocks ) {
	$chunks = [];

	foreach ( $blocks as $block ) {
		if ( ! empty( $block['attrs']['data'] ) && is_array( $block['attrs']['data'] ) ) {
			foreach ( $block['attrs']['data'] as $key => $value ) {
				if ( '_' !== substr( (string) $key, 0, 1 ) && is_string( $value ) && ! is_numeric( $value ) && 0 !== strpos( $value, 'field_' ) && ! wp_http_validate_url( $value ) ) {
					$chunks[] = $value;
				}
			}
		} elseif ( ! empty( $block['innerHTML'] ) ) {
			$chunks[] = $block['innerHTML'];
		}

		if ( ! empty( $block['innerBlocks'] ) ) {
			$chunks = array_merge( $chunks, fopr_collect_block_text( $block['innerBlocks'] ) );
		}
	}

	return array_map(
		static function( $chunk ) {
			return trim( preg_replace( '/\s+/u', ' ', html_entity_decode( wp_strip_all_tags( strip_shortcodes( $chunk ) ), ENT_QUOTES, 'UTF-8' ) ) );
		},
		$chunks
	);
}

/**
 * Shorten text to a search-result friendly length on a word boundary.
 *
 * @param string $text Plain text.
 * @param int    $max  Maximum characters.
 * @return string
 */
function fopr_trim_description( $text, $max = 155 ) {
	$text = trim( preg_replace( '/\s+/u', ' ', $text ) );

	if ( mb_strlen( $text ) <= $max ) {
		return $text;
	}

	$cut = mb_substr( $text, 0, $max - 1 );
	$cut = preg_replace( '/\s+\S*$/u', '', $cut );

	return rtrim( $cut, ' ,;:-–' ) . '…';
}

/**
 * Build a description for a post from its excerpt or first real paragraph.
 *
 * @param int $post_id Post ID.
 * @return string
 */
function fopr_get_fallback_description( $post_id ) {
	static $cache = [];

	if ( isset( $cache[ $post_id ] ) ) {
		return $cache[ $post_id ];
	}

	$post = get_post( $post_id );
	$text = '';

	if ( $post && ! post_password_required( $post ) ) {
		if ( has_excerpt( $post ) ) {
			$text = $post->post_excerpt;
		} else {
			$chunks = fopr_get_post_text_chunks( $post );

			// The first passage long enough to describe the page, skipping
			// headings, button labels and similar short strings.
			foreach ( $chunks as $chunk ) {
				if ( mb_strlen( $chunk ) >= 70 ) {
					$text = $chunk;
					break;
				}
			}

			// Pages made only of short strings (e.g. contact): join them.
			if ( '' === $text ) {
				$parts = [];
				foreach ( $chunks as $chunk ) {
					if ( mb_strlen( $chunk ) >= 20 ) {
						$parts[] = rtrim( $chunk, '.!? ' );
					}
				}
				$text = implode( '. ', $parts );
			}
		}
	}

	$cache[ $post_id ] = fopr_trim_description( wp_strip_all_tags( $text ) );

	return $cache[ $post_id ];
}

/**
 * Get a post's readable text: its blocks, or for template-driven pages
 * (e.g. the recipes overview) its classic content and ACF fields.
 *
 * @param WP_Post $post Post.
 * @return string[]
 */
function fopr_get_post_text_chunks( $post ) {
	if ( has_blocks( $post->post_content ) ) {
		return array_values( array_filter( fopr_collect_block_text( parse_blocks( $post->post_content ) ) ) );
	}

	$chunks = [ $post->post_content ];

	if ( function_exists( 'get_fields' ) ) {
		foreach ( (array) get_fields( $post->ID ) as $value ) {
			if ( is_string( $value ) && ! is_numeric( $value ) && ! wp_http_validate_url( $value ) ) {
				$chunks[] = $value;
			}
		}
	}

	$blocks = array_map(
		static function( $chunk ) {
			return [ 'innerHTML' => $chunk ];
		},
		$chunks
	);

	return array_values( array_filter( fopr_collect_block_text( $blocks ) ) );
}

/**
 * Get the post ID a Yoast presentation describes, if it is a single post.
 *
 * @param object $presentation Yoast indexable presentation.
 * @return int
 */
function fopr_get_presentation_post_id( $presentation ) {
	if ( empty( $presentation->model ) ) {
		return 0;
	}

	if ( 'post' === $presentation->model->object_type ) {
		return (int) $presentation->model->object_id;
	}

	// The blog index is described by the page set as "Posts page".
	if ( 'home-page' === $presentation->model->object_type && is_home() && 'page' === get_option( 'show_on_front' ) ) {
		return (int) get_queried_object_id();
	}

	return 0;
}

/**
 * Fill empty meta, Open Graph and Twitter descriptions.
 *
 * @param string $description  Description from Yoast.
 * @param object $presentation Yoast indexable presentation.
 * @return string
 */
function fopr_fallback_meta_description( $description, $presentation = null ) {
	if ( '' !== trim( (string) $description ) || ! $presentation ) {
		return $description;
	}

	$post_id = fopr_get_presentation_post_id( $presentation );

	return $post_id ? fopr_get_fallback_description( $post_id ) : $description;
}
add_filter( 'wpseo_metadesc', 'fopr_fallback_meta_description', 10, 2 );
add_filter( 'wpseo_opengraph_desc', 'fopr_fallback_meta_description', 10, 2 );
add_filter( 'wpseo_twitter_description', 'fopr_fallback_meta_description', 10, 2 );

/**
 * Find the first image used by a post's blocks.
 *
 * @param array $blocks Parsed blocks.
 * @return int Attachment ID, or 0.
 */
function fopr_find_block_image_id( $blocks ) {
	foreach ( $blocks as $block ) {
		$candidates = [];

		if ( ! empty( $block['attrs']['data'] ) && is_array( $block['attrs']['data'] ) ) {
			foreach ( $block['attrs']['data'] as $key => $value ) {
				if ( '_' !== substr( (string) $key, 0, 1 ) && preg_match( '/(image|img|bg|photo|picture)/i', (string) $key ) && is_numeric( $value ) ) {
					$candidates[] = (int) $value;
				}
			}
		} elseif ( ! empty( $block['attrs']['id'] ) && in_array( $block['blockName'], [ 'core/image', 'core/cover', 'core/media-text' ], true ) ) {
			$candidates[] = (int) $block['attrs']['id'];
		}

		foreach ( $candidates as $attachment_id ) {
			// Social networks don't render SVG previews.
			if ( $attachment_id && wp_attachment_is_image( $attachment_id ) && 'image/svg+xml' !== get_post_mime_type( $attachment_id ) ) {
				return $attachment_id;
			}
		}

		if ( ! empty( $block['innerBlocks'] ) ) {
			$found = fopr_find_block_image_id( $block['innerBlocks'] );
			if ( $found ) {
				return $found;
			}
		}
	}

	return 0;
}

/**
 * Use the first block image as the social sharing image when Yoast found none.
 *
 * @param object $image_container Yoast Open Graph image container.
 */
function fopr_fallback_open_graph_image( $image_container ) {
	if ( ! is_object( $image_container ) || ! method_exists( $image_container, 'has_images' ) || $image_container->has_images() || ! is_singular() ) {
		return;
	}

	$post = get_post( get_queried_object_id() );
	if ( ! $post ) {
		return;
	}

	if ( has_blocks( $post->post_content ) ) {
		$image_id = fopr_find_block_image_id( parse_blocks( $post->post_content ) );
	} else {
		// Template-driven pages keep their hero image in ACF fields.
		$data = function_exists( 'get_fields' ) ? array_map(
			static function( $value ) {
				return is_array( $value ) && isset( $value['ID'] ) ? $value['ID'] : $value;
			},
			(array) get_fields( $post->ID, false )
		) : [];

		$image_id = fopr_find_block_image_id( [ [ 'attrs' => [ 'data' => $data ] ] ] );
	}

	if ( $image_id ) {
		$image_container->add_image_by_id( $image_id );
	}
}
add_action( 'wpseo_add_opengraph_additional_images', 'fopr_fallback_open_graph_image' );

/**
 * Keep taxonomies whose archives are switched off out of the XML sitemap.
 *
 * Smart Archive Page Remove turns category and tag archives into 404s, but
 * Yoast kept listing them, so the sitemap advertised dead URLs.
 *
 * @param bool   $excluded Whether Yoast already excludes the taxonomy.
 * @param string $taxonomy Taxonomy name.
 * @return bool
 */
function fopr_exclude_removed_archives_from_sitemap( $excluded, $taxonomy ) {
	$settings = get_option( 'smart_archive_page_remove_settings' );
	$map      = [
		'category' => 'category',
		'post_tag' => 'tag',
	];

	if ( isset( $map[ $taxonomy ] ) && function_exists( 'pp_smart_archive_page_remove' ) && is_array( $settings ) && ! empty( $settings[ $map[ $taxonomy ] ] ) ) {
		return true;
	}

	return $excluded;
}
add_filter( 'wpseo_sitemap_exclude_taxonomy', 'fopr_exclude_removed_archives_from_sitemap', 10, 2 );
