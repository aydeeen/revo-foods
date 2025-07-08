<?php
// phpcs:ignoreFile

/**
 * Grid Block Template.
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

use FoundationPress\Blocks\Block_Grid;

$settings = $block;
$block    = new Block_Grid( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$image_1     = get_field( 'image_1' ) ?: false;
$image_2     = get_field( 'image_2' ) ?: false;
$image_3     = get_field( 'image_3' ) ?: false;
$image_4     = get_field( 'image_4' ) ?: false;
$bg_image    = get_field( 'bg_image' ) ?: false;
$title       = get_field( 'title' ) ?: false;
$description = get_field( 'description' ) ?: false;
$button      = get_field( 'button' ) ?: false;
$button_text = get_field( 'button_text' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-grid <?php echo esc_attr( $class_names ); ?>">
    <div class="section__inner grid-x grid-padding-x grid-padding-y">
	    <div class="cell">
            <div class="b-grid__grid">
                <?php echo wp_get_attachment_image( $image_1, 'full', false, ['class' => 'b-grid__image b-grid__image--1'] ); ?>
                <div class="b-grid__content" style="background-image: url('<?php echo esc_url( $bg_image['url'] ); ?>');">
                    <h2 class="b-grid__title"><?php echo wp_kses_post( $title ); ?></h2>
                    <p class="b-grid__description"><?php echo esc_html( $description ); ?></p>
                    <div class="b-grid__button-wrapper">
                        <a href="<?php echo esc_url( $button ); ?>" class="button">
                            <?php echo esc_html( $button_text ); ?>
                        </a>
                    </div>
                </div>
                <?php echo wp_get_attachment_image( $image_2, 'full', false, ['class' => 'b-grid__image b-grid__image--2'] ); ?>
                <?php echo wp_get_attachment_image( $image_3, 'full', false, ['class' => 'b-grid__image b-grid__image--3'] ); ?>
                <?php echo wp_get_attachment_image( $image_4, 'full', false, ['class' => 'b-grid__image b-grid__image--4'] ); ?>
            </div>
	    </div>
	</div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
