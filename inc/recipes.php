<?php
/**
 * Recipe helpers and structured data.
 *
 * @package FoundationPress
 */

/**
 * Get the product presentation used by recipe cards and recipe pages.
 *
 * @return array<string, array<string, string>>
 */
function fopr_get_recipe_products() {
	return [
		'salmon-spread'                   => [
			'label'              => __( 'Salmon Spread', 'foundationpress' ),
			'badge_background'   => '#f26b73',
			'badge_color'        => '#ffffff',
			'feature_background' => '#e8f4fc',
			'image'              => 'spread.png',
		],
		'the-filet-pink-pepper-and-lemon' => [
			'label'              => __( 'The Filet Pink Pepper & Lemon', 'foundationpress' ),
			'badge_background'   => '#d29fb7',
			'badge_color'        => '#ffffff',
			'feature_background' => '#e8f4fc',
			'image'              => 'the-filet-pink-pepper-and-lemon.png',
		],
		'the-filet-asian-fusion-style'    => [
			'label'              => __( 'The Filet Asian Fusion Style', 'foundationpress' ),
			'badge_background'   => '#b40c13',
			'badge_color'        => '#ffffff',
			'feature_background' => '#e8f4fc',
			'image'              => 'the-filet-asian-fusion-style.png',
		],
		'the-prime-cut'                   => [
			'label'              => __( 'The Prime Cut', 'foundationpress' ),
			'badge_background'   => '#c24656',
			'badge_color'        => '#ffffff',
			'feature_background' => '#f6dbc4',
			'image'              => 'the-prime-cut.png',
		],
		'el-blanco'                       => [
			'label'              => __( 'El Blanco', 'foundationpress' ),
			'badge_background'   => '#9cd6d7',
			'badge_color'        => '#1e5064',
			'feature_background' => '#def3e9',
			'image'              => 'el-blanco.png',
		],
		'el-pollo'                        => [
			'label'              => __( 'EL POLLO', 'foundationpress' ),
			'badge_background'   => '#f6dbc4',
			'badge_color'        => '#1e5064',
			'feature_background' => '#f6dbc4',
			'image'              => '',
		],
		'the-filet'                       => [
			'label'              => __( 'The Filet', 'foundationpress' ),
			'badge_background'   => '#363131',
			'badge_color'        => '#ffffff',
			'feature_background' => '#e8f4fc',
			'image'              => 'the-filet.png',
		],
		'kraken'                          => [
			'label'              => __( 'Kraken', 'foundationpress' ),
			'badge_background'   => '#1e5064',
			'badge_color'        => '#ffffff',
			'feature_background' => '#e8f4fc',
			'image'              => 'kraken.png',
		],
		'salmon'                          => [
			'label'              => __( 'Salmon', 'foundationpress' ),
			'badge_background'   => '#f0555e',
			'badge_color'        => '#ffffff',
			'feature_background' => '#e8f4fc',
			'image'              => 'salmon.png',
		],
		'tuna'                            => [
			'label'              => __( 'Tuna', 'foundationpress' ),
			'badge_background'   => '#f9a259',
			'badge_color'        => '#ffffff',
			'feature_background' => '#f6dbc4',
			'image'              => 'tuna.png',
		],
		'gravlax'                         => [
			'label'              => __( 'Gravlax', 'foundationpress' ),
			'badge_background'   => '#54b084',
			'badge_color'        => '#ffffff',
			'feature_background' => '#def3e9',
			'image'              => 'gravlax.png',
		],
	];
}

/**
 * Get the filter groups displayed on the recipe archive.
 *
 * @return array<string, array<string, mixed>>
 */
function fopr_get_recipe_filters() {
	return [
		'salmon'        => [
			'label'      => __( 'Salmon', 'foundationpress' ),
			'categories' => [ 'salmon' ],
		],
		'kraken'        => [
			'label'      => __( 'Kraken', 'foundationpress' ),
			'categories' => [ 'kraken' ],
		],
		'gravlax'       => [
			'label'      => __( 'Gravlax', 'foundationpress' ),
			'categories' => [ 'gravlax' ],
		],
		'the-filet'     => [
			'label'      => __( 'The Filet', 'foundationpress' ),
			'categories' => [
				'the-filet',
				'the-filet-asian-fusion-style',
				'the-filet-pink-pepper-and-lemon',
			],
		],
		'el-blanco'     => [
			'label'      => __( 'El Blanco', 'foundationpress' ),
			'categories' => [ 'el-blanco' ],
		],
		'el-pollo'      => [
			'label'      => __( 'EL POLLO', 'foundationpress' ),
			'categories' => [ 'el-pollo' ],
		],
		'the-prime-cut' => [
			'label'      => __( 'The Prime Cut', 'foundationpress' ),
			'categories' => [ 'the-prime-cut' ],
		],
	];
}

/**
 * Find the configured product for a recipe.
 *
 * @param int $post_id Recipe post ID.
 * @return array<string, string>
 */
function fopr_get_recipe_product( $post_id = 0 ) {
	$post_id    = $post_id ?: get_the_ID();
	$categories = wp_get_post_terms( $post_id, 'category', [ 'fields' => 'slugs' ] );

	if ( is_wp_error( $categories ) ) {
		$categories = [];
	}

	foreach ( fopr_get_recipe_products() as $slug => $product ) {
		if ( in_array( $slug, $categories, true ) ) {
			$product['slug'] = $slug;
			return $product;
		}
	}

	$term = ! empty( $categories ) ? get_category_by_slug( $categories[0] ) : false;

	return [
		'slug'               => $term ? $term->slug : '',
		'label'              => $term ? $term->name : __( 'Recipe', 'foundationpress' ),
		'badge_background'   => '#e4f4f8',
		'badge_color'        => '#1e5064',
		'feature_background' => '#def3e9',
		'image'              => '',
	];
}

/**
 * Resolve the product image used on a single recipe page.
 *
 * @param array<string, string> $product Product configuration.
 * @return string
 */
function fopr_get_recipe_product_image_url( $product ) {
	if ( ! empty( $product['image'] ) ) {
		return get_template_directory_uri() . '/dist/assets/images/' . $product['image'];
	}

	if ( empty( $product['slug'] ) ) {
		return '';
	}

	$term = get_category_by_slug( $product['slug'] );
	if ( ! $term || empty( $term->description ) ) {
		return '';
	}

	if ( preg_match( '/<img[^>]+src=["\']([^"\']+)["\']/', $term->description, $matches ) ) {
		return esc_url_raw( $matches[1] );
	}

	return '';
}

/**
 * Get related recipes, filling remaining slots with the latest recipes.
 *
 * @param int $post_id Recipe post ID.
 * @param int $limit   Maximum number of recipes.
 * @return WP_Post[]
 */
function fopr_get_related_recipes( $post_id, $limit = 3 ) {
	$category_ids = wp_get_post_categories( $post_id );
	$query_args   = [
		'post_type'           => 'recipes',
		'post_status'         => 'publish',
		'posts_per_page'      => $limit,
		'post__not_in'        => [ $post_id ],
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	];

	if ( ! empty( $category_ids ) ) {
		$query_args['category__in'] = $category_ids;
	}

	$related = ( new WP_Query( $query_args ) )->posts;

	if ( count( $related ) >= $limit ) {
		return $related;
	}

	$excluded_ids = array_merge( [ $post_id ], wp_list_pluck( $related, 'ID' ) );
	$fallback     = new WP_Query(
		[
			'post_type'           => 'recipes',
			'post_status'         => 'publish',
			'posts_per_page'      => $limit - count( $related ),
			'post__not_in'        => $excluded_ids,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		]
	);

	return array_merge( $related, $fallback->posts );
}

/**
 * Convert a human-readable duration into the ISO 8601 format used by schema.org.
 *
 * @param string $duration Duration such as "1 hour 30 minutes".
 * @return string
 */
function fopr_recipe_duration_to_iso( $duration ) {
	$hours   = 0;
	$minutes = 0;

	if ( preg_match( '/(\d+)\s*(?:hours?|hrs?|h)\b/i', $duration, $matches ) ) {
		$hours = (int) $matches[1];
	}

	if ( preg_match( '/(\d+)\s*(?:minutes?|mins?|m)\b/i', $duration, $matches ) ) {
		$minutes = (int) $matches[1];
	}

	if ( ! $hours && ! $minutes && preg_match( '/^\s*(\d+)\s*$/', $duration, $matches ) ) {
		$minutes = (int) $matches[1];
	}

	if ( ! $hours && ! $minutes ) {
		return '';
	}

	return 'PT' . ( $hours ? $hours . 'H' : '' ) . ( $minutes ? $minutes . 'M' : '' );
}

/**
 * Output Recipe structured data on single recipe pages.
 */
function fopr_output_recipe_structured_data() {
	if ( ! is_singular( 'recipes' ) || ! function_exists( 'get_field' ) ) {
		return;
	}

	$post_id     = get_queried_object_id();
	$ingredients = get_field( 'ingredients', $post_id );
	$preparation = get_field( 'preparation', $post_id );

	if ( empty( $ingredients ) || empty( $preparation ) ) {
		return;
	}

	$ingredient_list = array_values(
		array_filter(
			array_map(
				static function( $row ) {
					return isset( $row['ingredient'] ) ? wp_strip_all_tags( $row['ingredient'] ) : '';
				},
				$ingredients
			)
		)
	);

	$instruction_list = array_values(
		array_filter(
			array_map(
				static function( $row ) {
					if ( empty( $row['preparation_step'] ) ) {
						return false;
					}

					return [
						'@type' => 'HowToStep',
						'text'  => wp_strip_all_tags( $row['preparation_step'] ),
					];
				},
				$preparation
			)
		)
	);

	if ( empty( $ingredient_list ) || empty( $instruction_list ) ) {
		return;
	}

	$image  = get_the_post_thumbnail_url( $post_id, 'full' );
	$terms  = wp_get_post_terms( $post_id, 'category', [ 'fields' => 'names' ] );
	$schema = [
		'@context'           => 'https://schema.org',
		'@type'              => 'Recipe',
		'mainEntityOfPage'   => get_permalink( $post_id ),
		'name'               => get_the_title( $post_id ),
		'description'        => wp_strip_all_tags( get_the_excerpt( $post_id ) ),
		'datePublished'      => get_the_date( DATE_W3C, $post_id ),
		'dateModified'       => get_the_modified_date( DATE_W3C, $post_id ),
		'author'             => [
			'@type' => 'Organization',
			'name'  => get_bloginfo( 'name' ),
			'url'   => home_url( '/' ),
		],
		'recipeIngredient'   => $ingredient_list,
		'recipeInstructions' => $instruction_list,
	];

	if ( $image ) {
		$schema['image'] = [ $image ];
	}

	if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
		$schema['keywords'] = implode( ', ', $terms );
	}

	$cook_time = (string) get_field( 'cook_time', $post_id );
	$iso_time  = fopr_recipe_duration_to_iso( $cook_time );
	if ( $iso_time ) {
		$schema['cookTime'] = $iso_time;
	}

	printf(
		'<script type="application/ld+json">%s</script>' . "\n",
		wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP )
	); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
add_action( 'wp_head', 'fopr_output_recipe_structured_data', 30 );
