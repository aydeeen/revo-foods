<?php
// phpcs:ignoreFile

/**
 * Products Block Template.
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

use FoundationPress\Blocks\Block_Products;

$settings = $block;
$block    = new Block_Products( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$title = get_field( 'title' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-products <?php echo esc_attr( $class_names ); ?>">
   <div class="section__inner grid-x grid-padding-x grid-padding-y">
		<div class="cell">
         <h2 class="b-products__title"><?php echo wp_kses_post( $title ); ?></h2>
         <div class="b-products__products">
            <?php if ( have_rows( 'products' ) ):
               while ( have_rows( 'products' ) ): the_row();
                  $image       = get_sub_field( 'image' ) ?: false;
                  $subtitle    = get_sub_field( 'subtitle' ) ?: false;
                  $title       = get_sub_field( 'title' ) ?: false;
                  $description = get_sub_field( 'description' ) ?: false;
                  $link        = get_sub_field( 'link' ) ?: false;
                  ?>
                     <a class="b-products__product" href="<?php echo esc_url( $link ); ?>">
                        <div class="image-wrapper">
                           <?php echo wp_get_attachment_image( $image, 'full', false ); ?>
                        </div>
                        <h3 class="subtitle"><?php echo esc_html( $subtitle ); ?></h3>
                        <h3 class="title"><?php echo esc_html( $title ); ?></h3>
                        <div class="circle">
                           <svg width="11" height="16" viewBox="0 0 11 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <g id="icon_arrow_down">
                                 <path id="Path" d="M10.2734 7.99998C10.2734 7.73114 10.1534 7.46235 9.9138 7.25739L2.37063 0.807713C1.89079 0.397429 1.11282 0.397429 0.633171 0.807713C0.153526 1.21783 0.153526 1.8829 0.633171 2.29322L7.30778 7.99998L0.633404 13.7068C0.153759 14.117 0.153759 14.7821 0.633404 15.1921C1.11305 15.6026 1.89103 15.6026 2.37087 15.1921L9.91403 8.74256C10.1537 8.5375 10.2734 8.26871 10.2734 7.99998Z" fill="#F9A259"/>
                              </g>
                           </svg>
                        </div>
                     </a>
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
