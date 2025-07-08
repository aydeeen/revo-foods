<?php
// phpcs:ignoreFile

/**
 * Image Left Block Template.
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

use FoundationPress\Blocks\Block_Image_Left;

$settings = $block;
$block    = new Block_Image_Left( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$title       = get_field( 'title' ) ?: false;
$subtitle    = get_field( 'subtitle' ) ?: false;
$description = get_field( 'description' ) ?: false;
$image       = get_field( 'image' ) ?: false;
$button      = get_field( 'button' ) ?: false;
$button_text = get_field( 'button_text' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-image-left <?php echo esc_attr( $class_names ); ?>">
	<div class="section__inner grid-x grid-padding-x grid-padding-y align-middle">
        <div class="cell large-6">
            <div class="b-image-left__image-wrapper">
                <?php echo wp_get_attachment_image( $image, 'full', false ); ?>
            </div>
        </div>
        <div class="cell large-6">
            <div class="b-image-left__content-wrapper">
                <?php if ( $subtitle ): ?>
                    <h4 class="b-image-left__subtitle"><?php echo wp_kses_post( $subtitle ); ?></h4>
                <?php endif; ?>
                <?php if ( $title ): ?>
                    <h2 class="b-image-left__title"><?php echo wp_kses_post( $title ); ?></h2>
                <?php endif; ?>
                <?php if ( $description ): ?>
                    <p class="b-image-left__description"><?php echo wp_kses_post( $description ); ?></p>
                <?php endif; ?>
                <?php if ( have_rows( 'list' ) ): ?>
                    <ul class="b-image-left__list">
                        <?php while ( have_rows( 'list' ) ): the_row();
                            $list_item = get_sub_field( 'list_item' ) ?: false;
                            ?>
                                <li>
                                    <img src="<?php fopr_assets_uri(); ?>/images/check.png" alt="Check">
                                    <?php echo wp_kses_post( $list_item ); ?>
                                </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
                <?php if ( $button ): ?>
                    <div class="b-image-left__button-wrapper">
                        <a href="<?php echo esc_url( $button ); ?>" class="button">
                            <?php echo wp_kses_post( $button_text ); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
	</div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;