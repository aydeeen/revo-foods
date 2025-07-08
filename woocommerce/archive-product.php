<?php
// phpcs:ignoreFile

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

if ( is_shop() || is_product_category() ) {
	$post_id             = get_option( 'woocommerce_shop_page_id' );
	$hero_bg_image       = get_field( 'hero_bg_image', $post_id );
	$hero_title          = get_field( 'hero_title', $post_id );
	$hero_button         = get_field( 'hero_button', $post_id );
	$hero_button_text    = get_field( 'hero_button_text', $post_id );
   $cta_1_bg_image      = get_field( 'cta_1_bg_image', $post_id );
	$cta_1_title         = get_field( 'cta_1_title', $post_id );
	$cta_1_button        = get_field( 'cta_1_button', $post_id );
	$cta_1_button_text   = get_field( 'cta_1_button_text', $post_id );
   $cta_2_bg_image      = get_field( 'cta_2_bg_image', $post_id );
	$cta_2_title         = get_field( 'cta_2_title', $post_id );
	$cta_2_button        = get_field( 'cta_2_button', $post_id );
	$cta_2_button_text   = get_field( 'cta_2_button_text', $post_id );
   $newsletter_bg_image = get_field( 'newsletter_bg_image', $post_id );
   $newsletter_title    = get_field( 'newsletter_title', $post_id );
}
?>

<div class="shop">
   <section class="section section--full shop__hero" style="background-image: url('<?php echo esc_url( $hero_bg_image['url'] ); ?>');">
      <div class="section__inner grid-x grid-padding-x grid-padding-y">
         <div class="cell">		
            <div>
               <h1 class="title"><?php echo wp_kses_post( $hero_title ); ?></h1>
               <div class="button-wrapper">
                  <a href="<?php echo esc_url( $hero_button ); ?>" class="button">
                     <?php echo esc_html( $hero_button_text ); ?>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </section>

   <section class="section section--full shop__main-products">
      <div class="section__inner grid-x grid-padding-x grid-padding-y">
         <div class="cell">
            <h2 class="main-title"><?php echo esc_html_e( 'Products', 'foundationpress' ); ?></h2>
         </div>
         <div class="cell">		
            <div class="products">
               <?php
                  $args = array(
                     'post_type' => 'product',
                     'posts_per_page' => 4,
                     'tax_query' => array(
                           array(
                              'taxonomy' => 'product_visibility',
                              'field'    => 'name',
                              'terms'    => 'featured',
                           ),
                        ),
                     );
                  $loop = new WP_Query( $args );
                  if ( $loop->have_posts() ) {
                     while ( $loop->have_posts() ) : $loop->the_post(); ?>
                        <?php global $product; ?>
                        <div class="product">
                           <a href="<?php echo get_permalink($loop->post->ID) ?>">
                              <div class="image-wrapper">
                                 <?php echo get_the_post_thumbnail( $loop->post->ID ); ?>
                              </div>
                           </a>
                           <h3 class="title">
                              <a href="<?php echo get_permalink($loop->post->ID) ?>"><?php the_title(); ?></a>
                           </h3>
                           <p class="price"><?php echo $product->get_price_html(); ?></p>
                           <a href="<?php echo get_permalink($loop->post->ID) ?>" class="button">
                              <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9867 8.47469C13.7012 8.99781 13.147 9.34375 12.5173 9.34375H6.26159L5.33793 11.0312H15.4142V12.7188H5.33793C4.06161 12.7188 3.25551 11.3434 3.86848 10.2128L5.00206 8.15406L1.97918 1.75H0.299805V0.0625H3.04558L3.83489 1.75H16.2623C16.9004 1.75 17.3035 2.44187 16.9928 2.99875L13.9867 8.47469ZM14.8348 3.4375H4.6326L6.62266 7.65625H12.5173L14.8348 3.4375ZM5.33793 13.5625C4.41428 13.5625 3.66695 14.3219 3.66695 15.25C3.66695 16.1781 4.41428 16.9375 5.33793 16.9375C6.26159 16.9375 7.01731 16.1781 7.01731 15.25C7.01731 14.3219 6.26159 13.5625 5.33793 13.5625ZM12.0638 15.25C12.0638 14.3219 12.8112 13.5625 13.7348 13.5625C14.6585 13.5625 15.4142 14.3219 15.4142 15.25C15.4142 16.1781 14.6585 16.9375 13.7348 16.9375C12.8112 16.9375 12.0638 16.1781 12.0638 15.25Z" fill="#9BD6D7"/>
                              </svg>
                              <?php echo esc_html_e( 'Show Details', 'foundationpress' ); ?>
                           </a>
                        </div>
                     <?php endwhile;
                  } else {
                     echo html_e( 'No products found', 'foundationpress' );
                  }
                  wp_reset_postdata();
               ?>
            </div>     
         </div>
      </div>
   </section>

   <section class="section section--full shop__cta" style="background-image: url('<?php echo esc_url( $cta_1_bg_image['url'] ); ?>');">
      <div class="section__inner grid-x grid-padding-x grid-padding-y">
         <div class="cell">		
            <div>
               <h2 class="title"><?php echo wp_kses_post( $cta_1_title ); ?></h2>
               <div class="button-wrapper">
                  <a href="<?php echo esc_url( $cta_1_button ); ?>" class="button">
                     <?php echo esc_html( $cta_1_button_text ); ?>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </section>

   <section class="section section--full shop__tabbed-products">
      <div class="section__inner grid-x grid-padding-x grid-padding-y">
         <div class="cell">		
            <?php echo do_shortcode( '[wtcpl-product-cat]' ); ?>
         </div>
      </div>
   </section>

   <section class="section section--full shop__cta shop__cta--2" style="background-image: url('<?php echo esc_url( $cta_2_bg_image['url'] ); ?>');">
      <div class="section__inner grid-x grid-padding-x grid-padding-y">
         <div class="cell">		
            <div>
               <h2 class="title"><?php echo wp_kses_post( $cta_2_title ); ?></h2>
               <div class="button-wrapper">
                  <a href="<?php echo esc_url( $cta_2_button ); ?>" class="button">
                     <?php echo esc_html( $cta_2_button_text ); ?>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </section>

   <!-- <section class="section section--full shop__newsletter" style="background-image: url('<?php echo esc_url( $newsletter_bg_image['url'] ); ?>');">
      <div class="section__inner grid-x grid-padding-x grid-padding-y">
         <div class="cell">		
            <div>
               <h2 class="title"><?php echo wp_kses_post( $newsletter_title ); ?></h2>
               <?php echo FrmFormsController::get_form_shortcode( array( 'id' => 4 ) ); ?>
            </div>
         </div>
      </div>
   </section> -->
</div>

<?php
get_footer( 'shop' );
