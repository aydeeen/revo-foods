<?php
// phpcs:ignoreFile

/**
 * Find Store Block Template.
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

use FoundationPress\Blocks\Block_Find_Store;

$settings = $block;
$block    = new Block_Find_Store( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$title_1            = get_field( 'title_1' ) ?: false;
$description_1      = get_field( 'description_1' ) ?: false;
$icon_1             = get_field( 'icon_1' ) ?: false;
$button             = get_field( 'button' ) ?: false;
$button_text        = get_field( 'button_text' ) ?: false;
$title_2            = get_field( 'title_2' ) ?: false;
$description_2      = get_field( 'description_2' ) ?: false;
$icon_2             = get_field( 'icon_2' ) ?: false;
$banner_bg_image    = get_field( 'banner_bg_image' ) ?: false;
$banner_image_1     = get_field( 'banner_image_1' ) ?: false;
$banner_image_2     = get_field( 'banner_image_2' ) ?: false;
$banner_title       = get_field( 'banner_title' ) ?: false;
$banner_button      = get_field( 'banner_button' ) ?: false;
$banner_button_text = get_field( 'banner_button_text' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-find-store <?php echo esc_attr( $class_names ); ?>">
   <div class="section__inner grid-x grid-padding-x grid-padding-y">

	   <div class="cell medium-6">
         <?php if ( have_rows( 'items' ) ):  ?>
            <div class="b-find-store__top-part">
               <div class="b-find-store__top-part-content">
                  <h1 class="b-find-store__title"><?php echo esc_html( $title_1 ); ?></h1>
                  <div class="flex-container align-middle">
                     <?php echo wp_get_attachment_image( $icon_1, 'full', false )  ?>
                     <p class="margin-bottom-0"><?php echo esc_html( $description_1 ); ?></p>
                  </div>
               </div>
               <div class="b-find-store__button-wrapper">
                  <a href="<?php echo esc_url( $button ); ?>" class="button">
                     <?php echo esc_html( $button_text ); ?>
                  </a>
               </div>
            </div>
         <?php endif; ?>
         <div class="b-find-store__bottom-part">
            <div class="b-find-store__bottom-part-content">
               <h2 class="b-find-store__title"><?php echo esc_html( $title_2 ); ?></h2>
               <div class="flex-container align-middle">
                  <?php echo wp_get_attachment_image( $icon_2, 'full', false )  ?>
                  <p class="margin-bottom-0"><?php echo esc_html( $description_2 ); ?></p>
               </div>
            </div>
		   </div>
	   </div>

	   <div class="cell medium-6">
         <div class="banner" style="background-image: url('<?php echo esc_url( $banner_bg_image['url'] ); ?>');">
            <?php echo wp_get_attachment_image( $banner_image_1, 'full', false )  ?>
            <?php echo wp_get_attachment_image( $banner_image_2, 'full', false )  ?>
            <?php if ( $banner_title ) : ?>
               <h3 class="banner__title"><?php echo wp_kses_post( $banner_title ); ?></h3>
            <?php endif; ?>
            <div class="banner__button-wrapper">
               <a href="<?php echo esc_url( $banner_button ); ?>" class="button">
                  <?php echo esc_html( $banner_button_text ); ?>
               </a>
            </div>
		   </div>
	   </div>

	</div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;


