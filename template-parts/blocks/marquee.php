<?php
// phpcs:ignoreFile

/**
 * Marquee Block Template.
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

use FoundationPress\Blocks\Block_Marquee;

$settings = $block;
$block    = new Block_Marquee( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$title = get_field( 'title' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-marquee <?php echo esc_attr( $class_names ); ?>">
    <h2 class="b-marquee__title"><?php echo esc_html( $title ); ?></h2>

    <div class="b-marquee__marquee-wrapper">
        <div class="b-marquee__marquee-content">
            <?php while (have_rows('items')): the_row(); 
                $image = get_sub_field('image');
                $text = get_sub_field('text');
                ?>
                    <div class="b-marquee__marquee-item">
                        <?php echo wp_get_attachment_image( $image, 'full', false ); ?>
                        <span><?php echo wp_kses_post( $text ); ?></span>
                    </div>            
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;


