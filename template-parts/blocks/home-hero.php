<?php
// phpcs:ignoreFile

/**
 * Home Hero Block Template.
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

use FoundationPress\Blocks\Block_Home_Hero;

$settings = $block;
$block    = new Block_Home_Hero( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$bg_image      = get_field( 'bg_image' ) ?: false;
$title         = get_field( 'title' ) ?: false;
$button_1      = get_field( 'button_1' ) ?: false;
$button_1_text = get_field( 'button_1_text' ) ?: false;
$button_2      = get_field( 'button_2' ) ?: false;
$button_2_text = get_field( 'button_2_text' ) ?: false;
$button_3      = get_field( 'button_3' ) ?: false;
$button_3_text = get_field( 'button_3_text' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-home-hero <?php echo esc_attr( $class_names ); ?>" style="background-image: url('<?php echo esc_url( $bg_image['url'] ); ?>');">
    <div class="b-home-hero__content"> 
        <h1 class="b-home-hero__image-wrapper">
            <img src="<?php fopr_assets_uri(); ?>/images/homepage-hero-title.png" alt="The Filet" class="b-home-hero__image">
        </h1>
        <p class="b-home-hero__title"><?php echo wp_kses_post( $title ); ?></p>
        <div class="b-home-hero__buttons-wrapper">
            <?php if ( $button_1 ): ?>
                <div class="b-home-hero__button-wrapper b-home-hero__button-wrapper--1">
                    <a href="<?php echo esc_url( $button_1 ); ?>" class="button">
                        <?php echo wp_kses_post( $button_1_text ); ?>
                    </a>
                </div>
            <?php endif; ?>

            <?php if ( $button_2 ): ?>
                <div class="b-home-hero__button-wrapper b-home-hero__button-wrapper--2">
                    <a href="<?php echo esc_url( $button_2 ); ?>" class="button">
                        <?php echo wp_kses_post( $button_2_text ); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>

    </div>

   <img src="<?php fopr_assets_uri(); ?>/images/wavy-bottom.png" alt="Waves" class="b-home-hero__waves">
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
