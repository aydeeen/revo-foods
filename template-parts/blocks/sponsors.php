<?php
// phpcs:ignoreFile

/**
 * Sponsors Block Template.
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

use FoundationPress\Blocks\Block_Sponsors;

$settings = $block;
$block    = new Block_Sponsors( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$title       = get_field( 'title' ) ?: false;
$button      = get_field( 'button' ) ?: false;
$button_text = get_field( 'button_text' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-sponsors <?php echo esc_attr( $class_names ); ?>">
    <div class="section__inner grid-x grid-padding-x grid-padding-y">
        <?php if ( $title ): ?>
            <div class="cell">
                <h2 class="text-center b-sponsors__title"><?php echo esc_html( $title ); ?></h2>
            </div>
        <?php endif; ?>
        
        <div class="cell">
            <div class="b-sponsors__images-wrapper">
                <?php if ( have_rows('sponsors') ): ?>
                    <?php while ( have_rows('sponsors') ): the_row(); 
                        $link  = get_sub_field( 'link' ) ?: false;
                        $image = get_sub_field( 'image' ) ?: false;
                        ?>
                            <a href="<?php echo esc_url( $link ); ?>" target="_blank">
                                <?php echo wp_get_attachment_image( $image, 'full', false ); ?>
                            </a>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>

            <?php if ( $button ): ?>
                <div class="b-sponsors__button-wrapper">
                    <a href="<?php echo esc_url( $button ); ?>" class="button">
                        <?php echo wp_kses_post( $button_text ); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
