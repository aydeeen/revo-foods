<?php
// phpcs:ignoreFile

/**
 * Numbers Block Template.
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

use FoundationPress\Blocks\Block_Numbers;

$settings = $block;
$block    = new Block_Numbers( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$bg_image = get_field( 'bg_image' ) ?: false;
$title = get_field( 'title' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-numbers <?php echo esc_attr( $class_names ); ?>" style="background-image: url('<?php echo esc_url( $bg_image['url'] ); ?>');">
   <div class="section__inner grid-x grid-padding-x grid-padding-y">
      <div class="cell">
         <h2 class="b-numbers__title"><?php echo esc_html( $title ); ?></h2>
      </div>
		<div class="cell">
         <div class="b-numbers__items-wrapper">
            <?php if ( have_rows('items') ): ?>
               <?php while ( have_rows('items') ): the_row(); 
                  $image = get_sub_field( 'image' ) ?: false;
                  $title   = get_sub_field( 'title' ) ?: false;
                  $number  = get_sub_field( 'number' ) ?: false;
                  ?>
                     <div class="b-numbers__item">
                        <div class="b-numbers__item-image-wrapper">
                           <?php echo wp_get_attachment_image( $image, 'full', false ); ?>
                        </div>
                        <h3 class="b-numbers__item-title"><?php echo esc_html( $title ); ?></h3>
                        <h4 class="b-numbers__item-number"><?php echo esc_html( $number ); ?></h4>
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
