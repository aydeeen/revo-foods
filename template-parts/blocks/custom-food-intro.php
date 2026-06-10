<?php
// phpcs:ignoreFile

/**
 * Custom Food Intro Block Template.
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

use FoundationPress\Blocks\Block_Custom_Food_Intro;

$settings = $block;
$block    = new Block_Custom_Food_Intro( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$title    = get_field( 'title' ) ?: 'More Than Catering - A Branded Food Experience';
$text     = get_field( 'text' ) ?: '<p>We create customized food concepts designed to surprise guests and make brands memorable. Whether you need recurring production of creative shapes, edible logo printing or a live interactive food activation, we help turn food into an experience people talk about.</p><p>Our products are fully plant-based, visually striking and developed for premium events, hospitality and modern brand activations across Europe.</p><p>Every project is developed with creativity, sustainability, and guest engagement at its core.</p>';
$image    = get_field( 'image' ) ?: false;
$image_id = is_array( $image ) && ! empty( $image['ID'] ) ? $image['ID'] : $image;
$video    = get_field( 'video' ) ?: false;
$video_url = is_array( $video ) && ! empty( $video['url'] ) ? $video['url'] : $video;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-custom-food-intro <?php echo esc_attr( $class_names ); ?>">
	<div class="section__inner grid-x grid-padding-x grid-padding-y">
		<div class="cell large-6">
			<?php if ( $title ): ?>
				<h2 class="b-custom-food-intro__title"><?php echo esc_html( $title ); ?></h2>
			<?php endif; ?>
		</div>

		<div class="cell large-6">
			<?php if ( $text ): ?>
				<div class="b-custom-food-intro__text"><?php echo wp_kses_post( $text ); ?></div>
			<?php endif; ?>
		</div>

		<?php if ( $video_url || $image_id ): ?>
			<div class="cell">
				<div class="b-custom-food-intro__media">
					<?php if ( $video_url ): ?>
						<video class="b-custom-food-intro__video" src="<?php echo esc_url( $video_url ); ?>" controls autoplay muted playsinline preload="auto"></video>
					<?php else: ?>
						<?php echo wp_get_attachment_image( $image_id, 'full', false, [ 'loading' => 'lazy' ] ); ?>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
