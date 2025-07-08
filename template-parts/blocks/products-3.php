<?php
// phpcs:ignoreFile

/**
 * Products 3 Block Template.
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

use FoundationPress\Blocks\Block_Products_3;

$settings = $block;
$block    = new Block_Products_3( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$title = get_field( 'title' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-products-3 <?php echo esc_attr( $class_names ); ?>">
   <div class="section__inner grid-x grid-padding-x grid-padding-y">

		<div class="cell">
         <h1 class="b-products-3__title"><?php echo esc_html( $title ); ?></h1>
      </div>

      <?php if ( have_rows( 'products' ) ):
         while ( have_rows( 'products' ) ): the_row();
            $image = get_sub_field( 'image' ) ?: false;
            $title = get_sub_field( 'title' ) ?: false;
            $link  = get_sub_field( 'link' ) ?: false;
            ?>
            <div class="cell medium-6 large-4">
               <div class="b-products-3__product">
                  <?php echo wp_get_attachment_image( $image, 'full', false ); ?>
                  <h3><?php echo wp_kses_post( $title ); ?></h3>
                  <a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ? $link['target'] : '_self' ); ?>">
                     <?php echo esc_html( $link['title'] ); ?>
                  </a>  
               </div>
            </div>
            <?php
         endwhile;
      endif;
      ?>

   </div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
