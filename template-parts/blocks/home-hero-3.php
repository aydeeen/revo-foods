<?php
// phpcs:ignoreFile

/**
 * Home Hero 3 Block Template.
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

use FoundationPress\Blocks\Block_Home_Hero_3;

$settings = $block;
$block    = new Block_Home_Hero_3( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$bg_image    = get_field( 'bg_image' ) ?: false;
$description = get_field( 'description' ) ?: false;
$button      = get_field( 'button' ) ?: false;
$button_text = get_field( 'button_text' ) ?: false;
$link_1      = get_field( 'link_1' ) ?: false;
$link_1_text = get_field( 'link_1_text' ) ?: false;
$link_2      = get_field( 'link_2' ) ?: false;
$link_2_text = get_field( 'link_2_text' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-home-hero-3 <?php echo esc_attr( $class_names ); ?>" style="background-image: url('<?php echo esc_url( $bg_image['url'] ); ?>');">
    <div class="section__inner grid-x grid-padding-x grid-padding-y b-home-hero-3__grid">
        <div class="cell">
            <div class="b-home-hero-3__content"> 
                <h1 class="b-home-hero-3__title-wrapper">
                    <img src="<?php fopr_assets_uri(); ?>/images/homepage-hero-title.png">
                <p class="b-home-hero-3__title"><?php echo wp_kses_post( $description ); ?></p>
                <?php if ( $button ): ?>
                    <div class="b-home-hero-3__button-wrapper">
                        <a href="<?php echo esc_url( $button ); ?>" class="button">
                            <?php echo esc_html( $button_text ); ?>
                        </a>
                    </div>
                <?php endif; ?>
                <?php if ( $link_1 ): ?>
                    <div class="b-home-hero-3__button-wrapper">
                        <a href="<?php echo esc_url( $link_1 ); ?>" class="button">
                            <?php echo esc_html( $link_1_text ); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <img src="<?php fopr_assets_uri(); ?>/images/pattern.jpg" alt="Waves" class="b-home-hero-3__pattern">
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
