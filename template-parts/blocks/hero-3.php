<?php
// phpcs:ignoreFile

/**
 * Hero 2 Block Template.
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

use FoundationPress\Blocks\Block_Hero_3;

$settings = $block;
$block    = new Block_Hero_3( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$bg_image = get_field( 'bg_image' ) ?: false;
$image    = get_field( 'image' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-hero-3 <?php echo esc_attr( $class_names ); ?>" style="background-image: url('<?php echo esc_url( $bg_image['url'] ); ?>');">
    <div class="section__inner grid-x grid-padding-x grid-padding-y">
        <div class="cell">
            <div class="b-hero-3__image-wrapper">
                <?php echo wp_get_attachment_image( $image, 'full', false ); ?>
            </div>
        </div>
    </div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
