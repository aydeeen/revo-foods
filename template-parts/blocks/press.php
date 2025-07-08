<?php
// phpcs:ignoreFile

/**
 * Press Block Template.
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

use FoundationPress\Blocks\Block_Press;

$settings = $block;
$block    = new Block_Press( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$title_1        = get_field( 'title_1' ) ?: false;
$title_2        = get_field( 'title_2' ) ?: false;
$button         = get_field( 'button' ) ?: false;
$button_text    = get_field( 'button_text' ) ?: false;
$description    = get_field( 'description' ) ?: false;
$form_shortcode = get_field( 'form_shortcode' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-press <?php echo esc_attr( $class_names ); ?>">
	<div class="section__inner grid-x grid-padding-x grid-padding-y">
      <div class="cell">
         <div class="text-center b-press__col-1">
            <h2 class="b-press__title"><?php echo esc_html( $title_1 ); ?></h2>
            <div class="b-press__button-wrapper">
               <a href="<?php echo esc_url( $button ); ?>" class="button">
                  <?php echo esc_html( $button_text ); ?>
                  <img src="<?php fopr_assets_uri(); ?>/images/download.png" alt="Download">
               </a>
            </div>
         </div>
      </div>
      <div class="cell">
         <div class="text-center">
            <h2 class="b-press__title"><?php echo esc_html( $title_2 ); ?></h2>
            <p><?php echo esc_html( $description ); ?></p>
            <?php echo do_shortcode( $form_shortcode ); ?>
         </div>
      </div>
	</div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;

