<?php
// phpcs:ignoreFile

/**
 * Our_Products Block Template.
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

use FoundationPress\Blocks\Block_Our_Products;

$settings = $block;
$block    = new Block_Our_Products( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$bg_image    = get_field( 'bg_image' ) ?: false;
$title       = get_field( 'title' ) ?: false;
$description = get_field( 'description' ) ?: false;
$image_1     = get_field( 'image_1' ) ?: false;
$image_2     = get_field( 'image_2' ) ?: false;
$image_3     = get_field( 'image_3' ) ?: false;
$image_4     = get_field( 'image_4' ) ?: false;
$image_5     = get_field( 'image_5' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-our-products <?php echo esc_attr( $class_names ); ?>" style="background-image: url('<?php echo esc_url( $bg_image['url'] ); ?>');">
    <div class="section__inner grid-x grid-padding-x grid-padding-y">
        <div class="cell">
            <div>
                <h2 class="b-our-products__title"><?php echo wp_kses_post( $title ); ?></h2>
                <p class="b-our-products__description"><?php echo wp_kses_post( $description ); ?></p>
            </div>
        </div>
        <div class="cell large-3 show-for-large">
            <div class="b-our-products__images-wrapper--1">
                <?php echo wp_get_attachment_image( $image_1, 'full', false ); ?>
                <?php echo wp_get_attachment_image( $image_2, 'full', false ); ?>
            </div>
        </div>
        <div class="cell large-6 show-for-large">
            <div class="b-our-products__images-wrapper--2">
                <?php echo wp_get_attachment_image( $image_3, 'full', false ); ?>
            </div>
        </div>
        <div class="cell large-3 show-for-large">
            <div class="b-our-products__images-wrapper--3">
                <?php echo wp_get_attachment_image( $image_4, 'full', false ); ?>
                <?php echo wp_get_attachment_image( $image_5, 'full', false ); ?>
            </div>
        </div>
	</div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;

