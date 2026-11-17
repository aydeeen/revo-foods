<?php
// phpcs:ignoreFile

/**
 * Hero Block Template.
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

use FoundationPress\Blocks\Block_Hero;

$settings = $block;
$block    = new Block_Hero( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();
$title_tag   = $block->get_title_tag( $post_id );

$bg_image    = get_field( 'bg_image' ) ?: false;
$title       = get_field( 'title' ) ?: false;
$subtitle    = get_field( 'subtitle' ) ?: false;
$description = get_field( 'description' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-hero <?php echo esc_attr( $class_names ); ?>" style="<?php fopr_acf_bg_img( $bg_image ); ?>">
   <?php if ( $subtitle ) : ?>
		<h2 class="b-hero__subtitle"><?php echo esc_html( $subtitle ); ?></h2>
	<?php endif; ?>
   <?php if ( $title ) : ?>
		<<?php echo tag_escape( $title_tag ); ?> class="b-hero__title"><?php echo wp_kses_post( $title ); ?></<?php echo tag_escape( $title_tag ); ?>>
	<?php endif; ?>
	<?php if ( $description ) : ?>
		<p class="b-hero__description"><?php echo esc_html( $description ); ?></p>
	<?php endif; ?>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
