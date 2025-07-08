<?php
// phpcs:ignoreFile

/**
 * B2B Block Template.
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

use FoundationPress\Blocks\Block_B2B;

$settings = $block;
$block    = new Block_B2B( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$bg_image      = get_field( 'bg_image' ) ?: false;
$title         = get_field( 'title' ) ?: false;
$subtitle      = get_field( 'subtitle' ) ?: false;
$button_1      = get_field( 'button_1' ) ?: false;
$button_1_text = get_field( 'button_1_text' ) ?: false;
$button_2      = get_field( 'button_2' ) ?: false;
$button_2_text = get_field( 'button_2_text' ) ?: false;
$image         = get_field( 'image' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-b2b <?php echo esc_attr( $class_names ); ?>" style="background-image: url('<?php echo esc_url( $bg_image['url'] ); ?>');">
    <div class="section__inner grid-x grid-padding-x grid-padding-y align-middle">
		<div class="cell large-5">
            <div class="b-b2b__content-wrapper">    
                <?php if ( $subtitle ): ?>              
                    <h4 class="b-b2b__subtitle"><?php echo esc_html( $subtitle ); ?></h4>
                <?php endif; ?>
              
                <h2 class="b-b2b__title"><?php echo wp_kses_post( $title ); ?></h2>

                <div class="b-b2b__buttons-wrapper">
                    <?php if ( $button_1 ): ?>
                        <div class="b-b2b__button-wrapper--1">
                            <a href="<?php echo esc_url( $button_1 ); ?>" class="button">
                                <?php echo esc_html( $button_1_text ); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ( $button_2 ): ?>
                        <div class="b-b2b__button-wrapper--2">
                            <a href="<?php echo esc_url( $button_2 ); ?>" class="button">
                                <?php echo esc_html( $button_2_text ); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="cell large-7">
            <div class="b-b2b__image-wrapper">
                <?php echo wp_get_attachment_image( $image, 'full', false ); ?>
            </div>
        </div>
    </div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
