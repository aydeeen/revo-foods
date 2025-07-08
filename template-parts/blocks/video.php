<?php
/**
 * Video Block Template.
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

use FoundationPress\Blocks\Block_Video;

$settings = $block;
$block    = new Block_Video( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$video = get_field( 'video' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-video <?php echo esc_attr( $class_names ); ?>">
   <div class="section__inner grid-x grid-padding-x grid-padding-y">
	   <div class="cell">
		   <?php if ( $video ) : ?>
			   <iframe src="<?php echo esc_url( $video ); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		   <?php endif; ?>
	   </div>
	</div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
