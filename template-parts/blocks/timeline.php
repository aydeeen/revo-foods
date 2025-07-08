<?php
// phpcs:ignoreFile

/**
 * Timeline Block Template.
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

use FoundationPress\Blocks\Block_Timeline;

$settings = $block;
$block    = new Block_Timeline( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$title = get_field( 'title' ) ?: false;
$image = get_field( 'image' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-timeline <?php echo esc_attr( $class_names ); ?>">
    <div class="section__inner grid-x grid-padding-x grid-padding-y">
        <div class="cell">
            <h2 class="b-timeline__title"><?php echo esc_html( $title ); ?></h2>
        </div>
	    <div class="cell">
            <div class="">
                <?php echo wp_get_attachment_image( $image, 'full', false ); ?>
            </div>
	    </div>
	</div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;


