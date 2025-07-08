<?php
// phpcs:ignoreFile

/**
 * Banner Block Template.
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

use FoundationPress\Blocks\Block_Banner;

$settings = $block;
$block    = new Block_Banner( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$banner_bg_image    = get_field( 'banner_bg_image', 'option' ) ?: false;
$banner_title       = get_field( 'banner_title', 'option' ) ?: false;
$banner_subtitle    = get_field( 'banner_subtitle', 'option' ) ?: false;
$banner_button      = get_field( 'banner_button', 'option' ) ?: false;
$banner_button_text = get_field( 'banner_button_text', 'option' ) ?: false;
$banner_image       = get_field( 'banner_image', 'option' ) ?: false;
$logo               = get_field( 'footer_logo', 'option' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-banner <?php echo esc_attr( $class_names ); ?>" style="background-image: url('<?php echo esc_url( $banner_bg_image['url'] ); ?>');">
   <div class="section__inner grid-x grid-padding-x grid-padding-y align-middle">
	   <div class="cell large-6">
         <div class="text-center">
            <?php echo wp_get_attachment_image( $logo, 'full', false, [ 'class' => 'b-banner__logo' ] ); ?>
				<h2 class="b-banner__title"><?php echo wp_kses_post( $banner_title ); ?></h2>
            <p class="b-banner__subtitle"><?php echo esc_html( $banner_subtitle ); ?></p>
			   <div class="b-banner__button-wrapper">
               <a href="<?php echo esc_url( $banner_button ); ?>" class="button">
                  <?php echo esc_html( $banner_button_text ); ?>
               </a>
            </div>
			</div>
	   </div>
	   <div class="cell large-6">
         <div>
            <?php echo wp_get_attachment_image( $banner_image, 'full', false ); ?>
			</div>
	   </div>
	</div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
