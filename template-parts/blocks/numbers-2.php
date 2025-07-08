<?php
// phpcs:ignoreFile

/**
 * Numbers 2 Block Template.
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

use FoundationPress\Blocks\Block_Numbers_2;

$settings = $block;
$block    = new Block_Numbers_2( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$title = get_field( 'title' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-numbers-2 <?php echo esc_attr( $class_names ); ?>">
    <div class="section__inner grid-x grid-padding-x grid-padding-y">
        <div class="cell">
            <h2 class="b-numbers-2__title"><?php echo esc_html( $title ); ?></h2>
        </div>
		<div class="cell">
            <div class="b-numbers-2__items">
                <?php if ( have_rows('items') ): ?>
                    <?php while ( have_rows('items') ): the_row();
                        $number  = get_sub_field( 'number' ) ?: false; 
                        $title   = get_sub_field( 'title' ) ?: false;
                        $description   = get_sub_field( 'description' ) ?: false;
                        ?>
                            <div class="b-numbers-2__item">
                                <h3 class="number"><?php echo esc_html( $number ); ?></h3>
                                <h4 class="title"><?php echo esc_html( $title ); ?></h4>
                                <?php if ( $description ): ?>
                                    <p class="description"><?php echo esc_html( $description ); ?></p>
                                <?php endif; ?>
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
