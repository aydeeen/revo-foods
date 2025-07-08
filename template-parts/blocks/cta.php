<?php
// phpcs:ignoreFile

/**
 * CTA Block Template.
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

use FoundationPress\Blocks\Block_CTA;

$settings = $block;
$block    = new Block_CTA( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$bg_image    = get_field( 'bg_image' ) ?: false;
$subtitle    = get_field( 'subtitle' ) ?: false;
$title       = get_field( 'title' ) ?: false;
$description = get_field( 'description' ) ?: false;
$button      = get_field( 'button' ) ?: false;
$button_text = get_field( 'button_text' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-cta <?php echo esc_attr( $class_names ); ?>" style="background-image: url('<?php echo esc_url( $bg_image['url'] ); ?>');">
    <div class="section__inner grid-x grid-padding-x grid-padding-y">
	   <div class="cell">
         <div class="b-cta__content">
            <?php if ( $subtitle ): ?>
               <h3 class="b-cta__subtitle"><?php echo esc_html( $subtitle ); ?></h3>
            <?php endif; ?>

				<h2 class="b-cta__title"><?php echo wp_kses_post( $title ); ?></h2>

            <?php if ( $description ): ?>
               <p class="b-cta__description"><?php echo wp_kses_post( $description ); ?></p>
            <?php endif; ?>

			   <div class="b-cta__button-wrapper">
               <a href="<?php echo esc_url( $button ); ?>" class="button">
                  <?php echo esc_html( $button_text ); ?>
               </a>
            </div>
			</div>
	   </div>
	</div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;

