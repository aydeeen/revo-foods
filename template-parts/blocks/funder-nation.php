<?php
// phpcs:ignoreFile

/**
 * Funder Nation Block Template.
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

use FoundationPress\Blocks\Block_Funder_Nation;

$settings = $block;
$block    = new Block_Funder_Nation( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$image         = get_field( 'image' ) ?: false;
$subtitle      = get_field( 'subtitle' ) ?: false;
$title         = get_field( 'title' ) ?: false;
$bg_image      = get_field( 'bg_image' ) ?: false;
$description   = get_field( 'description' ) ?: false;
$button_1      = get_field( 'button_1' ) ?: false;
$button_1_text = get_field( 'button_1_text' ) ?: false;
$button_2      = get_field( 'button_2' ) ?: false;
$button_2_text = get_field( 'button_2_text' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-funder-nation <?php echo esc_attr( $class_names ); ?>">
    <div class="b-funder-nation__layout">
        <div class="b-funder-nation__left-part">
            <?php echo wp_get_attachment_image( $image, 'full', false ) ?>
        </div>
        <div class="b-funder-nation__right-part" style="background-image: url('<?php echo esc_url( $bg_image['url'] ); ?>');">
            <h3 class="b-funder-nation__subtitle"><?php echo esc_html( $subtitle ); ?></h3>
            <h2 class="b-funder-nation__title"><?php echo esc_html( $title ); ?></h2>
            <p class="b-funder-nation__description"><?php echo wp_kses_post( $description ); ?></p>
            <div class="b-funder-nation__buttons-wrapper">
                <div class="b-funder-nation__button-wrapper">
                    <a href="<?php echo esc_url( $button_1 ); ?>" class="button">
                        <?php echo wp_kses_post( $button_1_text ); ?>
                    </a>
                </div>
                <div class="b-funder-nation__button-wrapper">
                    <a href="<?php echo esc_url( $button_2 ); ?>" class="button">
                        <?php echo wp_kses_post( $button_2_text ); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;


