<?php
// phpcs:ignoreFile

/**
 * Plants Block Template.
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

use FoundationPress\Blocks\Block_Plants;

$settings = $block;
$block    = new Block_Plants( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-plants <?php echo esc_attr( $class_names ); ?>">
   <div class="section__inner grid-x grid-padding-x grid-padding-y">
        <?php if ( have_rows( 'items' ) ): ?>
            <?php while ( have_rows( 'items' ) ): the_row();
                $image       = get_sub_field( 'image' ) ?: false;
                $title       = get_sub_field( 'title' ) ?: false;
                $description = get_sub_field( 'description' ) ?: false;
                ?>
				    <div class="cell medium-6 large-3">
                        <div class="text-center">
                            <?php echo wp_get_attachment_image( $image, 'full', false, [ 'class' => 'b-plants__image' ] ); ?>
                            <h2 class="b-plants__title"><?php echo esc_html( $title ); ?></h2>
                            <p class="b-plants__description"><?php echo esc_html( $description ); ?></p>
                        </div>
	                </div>
            <?php endwhile; ?>
        <?php endif; ?>
	</div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;


