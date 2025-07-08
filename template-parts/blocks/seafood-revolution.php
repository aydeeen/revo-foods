<?php
// phpcs:ignoreFile

/**
 * Seafood Revolution Block Template.
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

use FoundationPress\Blocks\Block_Seafood_Revolution;

$settings = $block;
$block    = new Block_Seafood_Revolution( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$bg_image = get_field( 'bg_image' ) ?: false;
$title    = get_field( 'title' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-seafood-revolution <?php echo esc_attr( $class_names ); ?>" style="background-image: url('<?php echo esc_url( $bg_image['url'] ); ?>');">
	<div class="section__inner grid-x grid-padding-x grid-padding-y align-middle">
      <div class="cell medium-6">
         <div>
            <h2 class="b-seafood-revolution__title"><?php echo wp_kses_post( $title ); ?></h2>
         </div>
      </div>
      <div class="cell medium-6">
         <ul>
            <?php if ( have_rows( 'list' ) ): ?>
               <?php while ( have_rows( 'list' ) ): the_row();
                  $list_item = get_sub_field( 'list_item' ) ?: false;
                  ?>
                     <li><?php echo esc_html( $list_item ); ?></li>
               <?php endwhile; ?>
            <?php endif; ?>
         </ul>
      </div>
	</div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;

