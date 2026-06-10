<?php
// phpcs:ignoreFile

/**
 * Custom Food Hero Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   int|string $post_id The post ID this block is saved to.
 * @package FoundationPress
 */

// we can disable some phpcs rules because we are not in the global scope.
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
// phpcs:disable WordPress.WP.GlobalVariablesOverride.Prohibited

use FoundationPress\Blocks\Block_Custom_Food_Hero;

$settings = $block;
$block    = new Block_Custom_Food_Hero( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$eyebrow          = get_field( 'eyebrow' ) ?: 'Customizable Food Experience';
$title            = get_field( 'title' ) ?: 'A Food Experience you will not forget';
$description      = get_field( 'description' ) ?: 'Turn your ideas into edible experiences through our customized creations for events, hospitality and brands: from personalized shapes and printed designs to large-scale interactive food experiences.';
$trust_text       = get_field( 'trust_text' ) ?: 'Already chosen by trusted brands, such as A1.';
$primary_button       = get_field( 'primary_button' ) ?: false;
$secondary_button     = get_field( 'secondary_button' ) ?: false;
$has_primary_button   = is_array( $primary_button ) && ! empty( $primary_button['url'] );
$has_secondary_button = is_array( $secondary_button ) && ! empty( $secondary_button['url'] );
$image            = get_field( 'image' ) ?: false;
$image_url        = $image ? wp_get_attachment_image_url( $image, 'full' ) : false;
$style            = $image_url ? ' style="background-image: url(' . esc_url( $image_url ) . ');"' : '';
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-custom-food-hero <?php echo esc_attr( $class_names ); ?><?php echo $image_url ? ' b-custom-food-hero--has-image' : ''; ?>"<?php echo $style; ?>>
	<div class="section__inner grid-x grid-padding-x grid-padding-y align-middle">
		<div class="cell large-8 xlarge-7">
			<div class="b-custom-food-hero__content">
				<?php if ( $eyebrow ): ?>
					<p class="b-custom-food-hero__eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
				<?php endif; ?>

				<?php if ( $title ): ?>
					<h1 class="b-custom-food-hero__title"><?php echo esc_html( $title ); ?></h1>
				<?php endif; ?>

				<?php if ( $description ): ?>
					<p class="b-custom-food-hero__description"><?php echo wp_kses_post( $description ); ?></p>
				<?php endif; ?>

				<?php if ( $trust_text ): ?>
					<p class="b-custom-food-hero__trust"><?php echo wp_kses_post( $trust_text ); ?></p>
				<?php endif; ?>

				<?php if ( $has_primary_button || $has_secondary_button ): ?>
					<div class="b-custom-food-hero__buttons">
						<?php if ( $has_primary_button ): ?>
							<a href="<?php echo esc_url( $primary_button['url'] ); ?>" target="<?php echo esc_attr( ( $primary_button['target'] ?? '' ) ?: '_self' ); ?>" class="button b-custom-food-hero__button">
								<?php echo esc_html( ( $primary_button['title'] ?? '' ) ?: 'Learn More' ); ?>
							</a>
						<?php endif; ?>

						<?php if ( $has_secondary_button ): ?>
							<a href="<?php echo esc_url( $secondary_button['url'] ); ?>" target="<?php echo esc_attr( ( $secondary_button['target'] ?? '' ) ?: '_self' ); ?>" class="button b-custom-food-hero__button b-custom-food-hero__button--secondary">
								<?php echo esc_html( ( $secondary_button['title'] ?? '' ) ?: 'Learn More' ); ?>
							</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
