<?php
// phpcs:ignoreFile

/**
 * Version 2 Block Template.
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

use FoundationPress\Blocks\Block_Version_2;

$settings = $block;
$block    = new Block_Version_2( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$image       = get_field( 'image' ) ?: false;
$subtitle    = get_field( 'subtitle' ) ?: false;
$title       = get_field( 'title' ) ?: false;
$description = get_field( 'description' ) ?: false;
$button      = get_field( 'button' ) ?: false;
$button_text = get_field( 'button_text' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-version-2 <?php echo esc_attr( $class_names ); ?>">
    <div class="b-version-2__layout">
        <div class="b-version-2__right-part">
            <div class="b-version-2__right-part-content">
                <h3 class="b-version-2__subtitle"><?php echo esc_html( $subtitle ); ?></h3>
                <h2 class="b-version-2__title"><?php echo esc_html( $title ); ?></h2>
                <p class="b-version-2__description"><?php echo wp_kses_post( $description ); ?></p>
                <div class="b-version-2__button-wrapper">
                    <a href="<?php echo esc_url( $button ); ?>" class="button">
                        <?php echo wp_kses_post( $button_text ); ?>
                    </a>
                </div>
            </div>
        </div>
        <div class="b-version-2__left-part">
            <?php echo wp_get_attachment_image( $image, 'full', false ) ?>
        </div>
    </div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;


