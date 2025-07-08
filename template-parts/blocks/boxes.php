<?php
// phpcs:ignoreFile

/**
 * Boxes Block Template.
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

use FoundationPress\Blocks\Block_Boxes;

$settings = $block;
$block    = new Block_Boxes( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-boxes <?php echo esc_attr( $class_names ); ?>">   
    <div class="section__inner grid-x grid-padding-x grid-padding-y">
		<div class="cell">
            <div class="b-boxes__boxes">
                <?php if ( have_rows('items') ): ?>
                    <?php while ( have_rows('items') ): the_row(); 
                        $bg_image = get_sub_field( 'bg_image' ) ?: false;
                        $title    = get_sub_field( 'title' ) ?: false;
                        $content  = get_sub_field( 'content' ) ?: false;
                        ?>
                            <div class="b-boxes__box" style="background-image: url('<?php echo esc_url( $bg_image['url'] ); ?>');">
                                <h3 class="title"><?php echo esc_html( $title ); ?></h3>
                                <p class="content"><?php echo esc_html( $content ); ?></p>
                            </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
