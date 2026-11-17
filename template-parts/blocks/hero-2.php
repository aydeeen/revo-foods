<?php
// phpcs:ignoreFile

/**
 * Hero 2 Block Template.
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

use FoundationPress\Blocks\Block_Hero_2;

$settings = $block;
$block    = new Block_Hero_2( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();
$title_tag   = $block->get_title_tag( $post_id );

$bg_image    = get_field( 'bg_image' ) ?: false;
$title       = get_field( 'title' ) ?: false;
$button      = get_field( 'button' ) ?: false;
$button_text = get_field( 'button_text' ) ?: false;
$link        = get_field( 'link' ) ?: false;
$image       = get_field( 'image' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-hero-2 <?php echo esc_attr( $class_names ); ?>" style="<?php fopr_acf_bg_img( $bg_image ); ?>">
    <div class="section__inner grid-x grid-padding-x grid-padding-y align-middle">
        <div class="cell large-6">
            <div>
                <<?php echo tag_escape( $title_tag ); ?> class="b-hero-2__title"><?php echo wp_kses_post( $title ); ?></<?php echo tag_escape( $title_tag ); ?>>
                <div class="b-hero-2__button-wrapper">
                    <a href="<?php echo esc_url( $button ); ?>" class="button">
                        <?php echo wp_kses_post( $button_text ); ?>
                    </a>
                </div>
            </div>
        </div>
        <div class="cell large-6">
            <a href="<?php echo esc_url( $link ); ?>" class="b-hero-2__link" aria-label="<?php echo esc_attr( fopr_get_logo_label( $image, $link ) ); ?>">
                <?php echo wp_get_attachment_image( $image, 'full', false, [ 'alt' => '' ] ); ?>
            </a>
        </div>
    </div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
