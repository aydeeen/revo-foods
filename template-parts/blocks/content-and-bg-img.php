<?php
// phpcs:ignoreFile

/**
 * Content And Bg Img Block Template.
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

use FoundationPress\Blocks\Block_Content_And_Bg_Img;

$settings = $block;
$block    = new Block_Content_And_Bg_Img( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$bg_image    = get_field( 'bg_image' ) ?: false;
$title       = get_field( 'title' ) ?: false;
$image       = get_field( 'image' ) ?: false;
$subtitle    = get_field( 'subtitle' ) ?: false;
$description = get_field( 'description' ) ?: false;
$button      = get_field( 'button' ) ?: false;
$button_text = get_field( 'button_text' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-content-and-bg-img <?php echo esc_attr( $class_names ); ?>" style="background-image: url('<?php echo esc_url( $bg_image['url'] ); ?>');">
   <div class="section__inner grid-x grid-padding-x grid-padding-y">
		<div class="cell">
         <div>
            <?php if ( $subtitle ): ?>
               <h4 class="b-content-and-bg-img__subtitle"><?php echo esc_html( $subtitle ); ?></h4>
            <?php endif; ?>
            <?php if ( $title ): ?>
               <h2 class="b-content-and-bg-img__title"><?php echo esc_html( $title ); ?></h2>
            <?php endif; ?>
            <?php if ( $image ): ?>
               <div class="b-content-and-bg-img__image-wrapper">
                  <?php echo wp_get_attachment_image( $image, 'full', false ); ?>
               </div>
            <?php endif; ?>
            <?php if ( $description ): ?>
                  <p class="b-content-and-bg-img__description"><?php echo esc_html( $description ); ?></p>
            <?php endif; ?>
            <?php if ( $button ): ?>
               <div class="b-content-and-bg-img__button-wrapper">
                  <a href="<?php echo esc_url( $button ); ?>" class="button">
                     <?php echo wp_kses_post( $button_text ); ?>
                  </a>
               </div>
            <?php endif; ?>
         </div>
      </div>
   </div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
