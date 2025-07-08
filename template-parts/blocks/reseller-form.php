<?php
// phpcs:ignoreFile

/**
 * Reseller Form Block Template.
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

use FoundationPress\Blocks\Block_Reseller_Form;

$settings = $block;
$block    = new Block_Reseller_Form( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$bg_image       = get_field( 'bg_image' ) ?: false;
$subtitle       = get_field( 'subtitle' ) ?: false;
$title          = get_field( 'title' ) ?: false;
$description    = get_field( 'description' ) ?: false;
$form_shortcode = get_field( 'form_shortcode' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-reseller-form <?php echo esc_attr( $class_names ); ?>" style="background-image: url('<?php echo esc_url( $bg_image['url'] ); ?>');">
	<div class="section__inner grid-x grid-padding-x grid-padding-y">
      <div class="cell large-4">
         <div>
            <h3 class="b-reseller-form__subtitle"><?php echo esc_html( $subtitle ); ?></h3>
            <h2 class="b-reseller-form__title"><?php echo wp_kses_post( $title ); ?></h2>
            <p class="b-reseller-form__description"><?php echo wp_kses_post( $description ); ?></p>
         </div>
      </div>
      <div class="cell large-8">
         <div>
            <?php echo do_shortcode( $form_shortcode ); ?>
         </div>
      </div>
	</div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;

