<?php
// phpcs:ignoreFile

/**
 * Contact Block Template.
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

use FoundationPress\Blocks\Block_Contact;

$settings = $block;
$block    = new Block_Contact( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$bg_image       = get_field( 'bg_image' ) ?: false;
$title          = get_field( 'title' ) ?: false;
$description    = get_field( 'description' ) ?: false;
$form_shortcode = get_field( 'form_shortcode' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-contact <?php echo esc_attr( $class_names ); ?>" style="background-image: url('<?php echo esc_url( $bg_image['url'] ); ?>');">
	<div class="section__inner grid-x grid-padding-x grid-padding-y align-middle">

      <div class="cell medium-6">
         <div class="margin-bottom-1 medium-margin-bottom-0">
            <h1 class="b-contact__title"><?php echo wp_kses_post( $title ); ?></h1>
            <p class="b-contact__description"><?php echo esc_html( $description ); ?></p>
            <div class="b-contact__items-wrapper b-contact__items-wrapper-mobile">
               <?php if ( have_rows( 'items' ) ) : ?>
                  <?php
                  while ( have_rows( 'items' ) ) :
                     the_row();
                     $icon = get_sub_field( 'icon' ) ?: false;
                     $text = get_sub_field( 'text' ) ?: false;
                     ?>
                        <div class="b-contact__item">
                           <?php echo wp_get_attachment_image( $icon, 'full', false, ['class' => 'icon'] ); ?>
                           <h3 class="title"><?php echo esc_html( $text ); ?></h3>
                        </div>
                  <?php endwhile; ?>
               <?php endif; ?>
			   </div> 
            <?php echo do_shortcode( $form_shortcode ); ?>
         </div>
      </div>
	  
		<div class="cell medium-6">
			<div class="b-contact__items-wrapper">
            <?php if ( have_rows( 'items' ) ) : ?>
               <?php
               while ( have_rows( 'items' ) ) :
                  the_row();
                  $icon = get_sub_field( 'icon' ) ?: false;
                  $text = get_sub_field( 'text' ) ?: false;
                  ?>
                     <div class="b-contact__item">
                        <?php echo wp_get_attachment_image( $icon, 'full', false, ['class' => 'icon'] ); ?>
                        <h3 class="title"><?php echo esc_html( $text ); ?></h3>
                     </div>
               <?php endwhile; ?>
            <?php endif; ?>
			</div> 
		</div>

	</div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;

