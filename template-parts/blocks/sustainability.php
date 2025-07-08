<?php
// phpcs:ignoreFile

/**
 * Sustainability Block Template.
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

use FoundationPress\Blocks\Block_Sustainability;

$settings = $block;
$block    = new Block_Sustainability( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$bg_image      = get_field( 'bg_image' ) ?: false;
$image         = get_field( 'image' ) ?: false;
$title         = get_field( 'title' ) ?: false;
$subtitle_1    = get_field( 'subtitle_1' ) ?: false;
$description_1 = get_field( 'description_1' ) ?: false;
$icon_1        = get_field( 'icon_1' ) ?: false;
$subtitle_2    = get_field( 'subtitle_2' ) ?: false;
$description_2 = get_field( 'description_2' ) ?: false;
$icon_2        = get_field( 'icon_2' ) ?: false;
$subtitle_3    = get_field( 'subtitle_3' ) ?: false;
$description_3 = get_field( 'description_3' ) ?: false;
$icon_3        = get_field( 'icon_3' ) ?: false;
$link          = get_field( 'link' ) ?: false;
$link_text     = get_field( 'link_text' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-sustainability <?php echo esc_attr( $class_names ); ?>" style="background-image: url('<?php echo esc_url( $bg_image['url'] ); ?>');">
   <div class="section__inner grid-x grid-padding-x grid-padding-y position-relative align-middle">
		<div class="cell">
         <h1 class="b-sustainability__title"><?php echo wp_kses_post( $title ); ?></h1>
      </div>
      <div class="cell medium-6">
         <div class="b-sustainability__boxes">
            <div class="b-sustainability__box">
               <div class="b-sustainability__icon-wrapper">
                  <?php echo wp_get_attachment_image( $icon_1, 'full', false ); ?>
               </div>
               <div>
                  <h3 class="b-sustainability__subtitle b-sustainability__subtitle--1"><?php echo esc_html( $subtitle_1 ); ?></h3>
                  <h5 class="b-sustainability__description"><?php echo wp_kses_post( $description_1 ); ?></h5>
               </div>
            </div>
            <div class="b-sustainability__box">
               <div class="b-sustainability__icon-wrapper">
                  <?php echo wp_get_attachment_image( $icon_2, 'full', false ); ?>
               </div>
               <div>
                  <h3 class="b-sustainability__subtitle"><?php echo esc_html( $subtitle_2 ); ?></h3>
                  <h5 class="b-sustainability__description"><?php echo wp_kses_post( $description_2 ); ?></h5>
               </div>
            </div>
            <div class="b-sustainability__box">
               <div class="b-sustainability__icon-wrapper">
                  <?php echo wp_get_attachment_image( $icon_3, 'full', false ); ?>
               </div>
               <div>
                  <h3 class="b-sustainability__subtitle"><?php echo esc_html( $subtitle_3 ); ?></h3>
                  <h5 class="b-sustainability__description"><?php echo wp_kses_post( $description_3 ); ?></h5>
               </div>
            </div>
         </div>
      </div>
      <div class="cell medium-6">
         <div class="b-sustainability__image-wrapper">
            <?php echo wp_get_attachment_image( $image, 'full', false ); ?>
         </div>
      </div>
      <div class="cell">
         <div class="b-sustainability__animation-wrapper">
            <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_7tfuypnl.json" speed="1" loop autoplay></lottie-player>
         </div>
         <div class="b-sustainability__link-wrapper">
            <a href="<?php echo esc_url( $link ); ?>">
               <?php echo esc_html( $link_text ); ?>
            </a>
         </div>
      </div>
   </div>

   <p class="b-sustainability__bottom-note"><?php echo esc_html_e( 'We are in the process of updating our sustainability metrics. Stay tuned!', 'foundationpress' ); ?></p>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
