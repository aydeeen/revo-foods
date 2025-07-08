<?php
// phpcs:ignoreFile

/**
 * Home Hero 4 Block Template.
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

use FoundationPress\Blocks\Block_Home_Hero_4;

$settings = $block;
$block    = new Block_Home_Hero_4( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$description = get_field( 'description' ) ?: false;
$button_1    = get_field( 'button_1' ) ?: false;
$button_2    = get_field( 'button_2' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-home-hero-4 <?php echo esc_attr( $class_names ); ?>">
    <div class="section__inner grid-x grid-padding-x grid-padding-y b-home-hero-4__grid">
        <div class="cell">
            <div class="b-home-hero-4__content"> 
                <h1 class="b-home-hero-4__title-wrapper">
                    <img src="<?php fopr_assets_uri(); ?>/images/prime-cut-title.png">
                </h1>
                <p class="b-home-hero-4__description"><?php echo wp_kses_post( $description ); ?></p>
                <div class="b-home-hero-4__buttons-wrapper">
                    <div class="b-home-hero-4__button-wrapper">
                        <a href="<?php echo esc_url( $button_1['url'] ); ?>" target="<?php echo esc_attr( $button_1['target'] ? $button_1['target'] : '_self' ); ?>" class="button">
                            <?php echo esc_html( $button_1['title'] ); ?>
                        </a>
                    </div>
                    <div class="b-home-hero-4__button-wrapper">
                        <a href="<?php echo esc_url( $button_2['url'] ); ?>" target="<?php echo esc_attr( $button_2['target'] ? $button_2['target'] : '_self' ); ?>" class="button">
                            <?php echo esc_html( $button_2['title'] ); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
