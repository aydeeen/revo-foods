<?php
// phpcs:ignoreFile

/**
 * Composition Block Template.
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

use FoundationPress\Blocks\Block_Composition;

$settings = $block;
$block    = new Block_Composition( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$title = get_field( 'title' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-composition <?php echo esc_attr( $class_names ); ?>">
    <div class="section__inner grid-x grid-padding-x grid-padding-y">
        <div class="cell">
            <h2 class="b-composition__title"><?php echo esc_html( $title ); ?></h2>
        </div>

        <div class="cell">
            <div class="b-composition__items-wrapper">
                <?php while (have_rows('items')): the_row(); 
                    $image = get_sub_field('image');
                    $text = get_sub_field('text');
                    ?>
                        <div class="b-composition__item">
                            <?php echo wp_get_attachment_image( $image, 'full', false ); ?>
                            <span><?php echo wp_kses_post( $text ); ?></span>
                        </div>            
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;


