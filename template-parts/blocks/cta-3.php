<?php
// phpcs:ignoreFile

/**
 * CTA 3 Block Template.
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

use FoundationPress\Blocks\Block_CTA_3;

$settings = $block;
$block    = new Block_CTA_3( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$bg_image      = get_field( 'bg_image' ) ?: false;
$title         = get_field( 'title' ) ?: false;
$button_1      = get_field( 'button_1' ) ?: false;
$button_1_text = get_field( 'button_1_text' ) ?: false;
$button_2      = get_field( 'button_2' ) ?: false;
$button_2_text = get_field( 'button_2_text' ) ?: false;

$has_button_1 = ! empty( $button_1 ) && ! empty( $button_1_text );
$has_button_2 = ! empty( $button_2 ) && ! empty( $button_2_text );
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-cta-3 <?php echo esc_attr( $class_names ); ?>" style="background-image: url('<?php echo esc_url( $bg_image['url'] ); ?>');">
    <?php echo wp_get_attachment_image( $image, 'full', false )  ?>
    <div class="section__inner grid-x grid-padding-x grid-padding-y">
	    <div class="cell">
            <div>
			    <h2 class="b-cta-3__title"><?php echo wp_kses_post( $title ); ?></h2>
                <?php if ( $has_button_1 || $has_button_2 ) : ?>
                    <div class="b-cta-3__buttons-wrapper">
                        <?php if ( $has_button_1 ) : ?>
                            <div class="b-cta-3__button-wrapper b-cta-3__button-wrapper--1">
                                <a href="<?php echo esc_url( $button_1 ); ?>" class="button">
                                    <?php echo wp_kses_post( $button_1_text ); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if ( $has_button_2 ) : ?>
                            <div class="b-cta-3__button-wrapper b-cta-3__button-wrapper--2">
                                <a href="<?php echo esc_url( $button_2 ); ?>" class="button">
                                    <?php echo wp_kses_post( $button_2_text ); ?>
                                </a>
                            </div>
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
