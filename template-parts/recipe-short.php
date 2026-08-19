<?php
/**
 * Compact recipe card.
 *
 * @package FoundationPress
 */

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

$recipe_id     = ! empty( $args['recipe_id'] ) ? absint( $args['recipe_id'] ) : get_the_ID();
$recipe_title  = get_the_title( $recipe_id );
$recipe_url    = get_permalink( $recipe_id );
$cook_time     = get_field( 'cook_time', $recipe_id ) ?: false;
$product       = fopr_get_recipe_product( $recipe_id );
$thumbnail_id  = get_post_thumbnail_id( $recipe_id );
$thumbnail_alt = $thumbnail_id ? get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true ) : '';
$thumbnail_alt = $thumbnail_alt ?: $recipe_title;
$id_suffix     = ! empty( $args['id_suffix'] ) ? '-' . sanitize_html_class( $args['id_suffix'] ) : '';
$title_id      = 'recipe-' . $recipe_id . $id_suffix . '-title';
/* translators: %s: Recipe title. */
$recipe_link_label = sprintf( __( 'View recipe: %s', 'foundationpress' ), $recipe_title );
$product_styles    = sprintf(
	'--recipe-badge-background: %s; --recipe-badge-color: %s;',
	$product['badge_background'],
	$product['badge_color']
);
?>

<article class="recipes__recipe" aria-labelledby="<?php echo esc_attr( $title_id ); ?>">
	<div class="recipes__recipe-content-wrapper">
		<div class="recipes__recipe-content">
			<?php if ( $thumbnail_id ) : ?>
				<a
					href="<?php echo esc_url( $recipe_url ); ?>"
					class="image-link"
					aria-label="<?php echo esc_attr( $recipe_link_label ); ?>"
				>
					<?php
					echo wp_get_attachment_image(
						$thumbnail_id,
						'medium_large',
						false,
						[
							'alt'      => $thumbnail_alt,
							'decoding' => 'async',
							'loading'  => 'lazy',
						]
					); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?>
				</a>
			<?php endif; ?>

			<div class="recipes__recipe-details">
				<span class="recipes__product-badge" style="<?php echo esc_attr( $product_styles ); ?>">
					<?php echo esc_html( $product['label'] ); ?>
				</span>

				<h3 id="<?php echo esc_attr( $title_id ); ?>" class="title">
					<a href="<?php echo esc_url( $recipe_url ); ?>"><?php echo esc_html( $recipe_title ); ?></a>
				</h3>

				<?php if ( $cook_time ) : ?>
					<p class="recipes__recipe-cook-time">
						<span><?php esc_html_e( 'Cook Time', 'foundationpress' ); ?>:</span>
						<?php echo esc_html( $cook_time ); ?>
					</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</article>
