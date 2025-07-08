<?php
// phpcs:ignoreFile

/**
 * Products 2 Block Template.
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

use FoundationPress\Blocks\Block_Products_2;

$settings = $block;
$block    = new Block_Products_2( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$title        = get_field( 'title' ) ?: false;
$description  = get_field( 'description' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-products-2 <?php echo esc_attr( $class_names ); ?>">
   <div class="section__inner grid-x grid-padding-x grid-padding-y">

		<div class="cell">
         <h1 class="b-products-2__title"><?php echo wp_kses_post( $title ); ?></h1>
         <p class="text-center"><?php echo esc_html( $description ); ?></p>
      </div>

      <div class="cell">
         <div class="b-products-2__products">
            <?php if ( have_rows( 'products' ) ):
               while ( have_rows( 'products' ) ): the_row();
                  $link        = get_sub_field( 'link' ) ?: false;
                  $image       = get_sub_field( 'image' ) ?: false;
                  $title       = get_sub_field( 'title' ) ?: false;
                  $description = get_sub_field( 'description' ) ?: false;
                  ?>
                     <div class="b-products-2__product">
                        <a href="<?php echo esc_url( $link ); ?>">
                           <div class="image-wrapper">
                              <?php echo wp_get_attachment_image( $image, 'full', false ); ?>
                           </div>
                           <div class="bottom">
                              <h3><?php echo esc_html( $title ); ?></h3>
                              <div class="icon-wrapper">
                                 <svg width="11" height="16" viewBox="0 0 11 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.25 7.99998C10.25 7.73114 10.13 7.46235 9.89036 7.25739L2.34719 0.807713C1.86736 0.397429 1.08938 0.397429 0.609734 0.807713C0.130089 1.21783 0.130089 1.8829 0.609734 2.29322L7.28435 7.99998L0.609967 13.7068C0.130322 14.117 0.130322 14.7821 0.609967 15.1921C1.08961 15.6026 1.86759 15.6026 2.34743 15.1921L9.8906 8.74256C10.1302 8.5375 10.25 8.26871 10.25 7.99998Z" fill="#F9A259"></path></svg>
                              </div>
                           </div>
                        </a>
                     </div>
                  <?php
               endwhile;
            endif;
            ?>
         </div>
      </div>

   </div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
