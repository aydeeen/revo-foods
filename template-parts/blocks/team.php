<?php
// phpcs:ignoreFile

/**
 * Team Block Template.
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

use FoundationPress\Blocks\Block_Team;

$settings = $block;
$block    = new Block_Team( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$title       = get_field( 'title' ) ?: false;
$description = get_field( 'description' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-team <?php echo esc_attr( $class_names ); ?>">
	<div class="section__inner grid-x grid-padding-x grid-padding-y">

		<div class="cell">
			<h2 class="text-center b-team__title"><?php echo esc_html( $title ); ?></h2>
         <?php if ( $description ) : ?>
            <p class="b-team__description"><?php echo esc_html( $description ); ?></p>
         <?php endif; ?>  
		</div>

      <div class="cell">
         <div class="b-team__team-wrapper">
           <?php
           if ( have_rows( 'team' ) ) :
               while ( have_rows( 'team' ) ) : the_row();
                  $image    = get_sub_field( 'image' ) ?: false;
                  $name     = get_sub_field( 'name' ) ?: false;
                  $position = get_sub_field( 'position' ) ?: false;
                  ?>
                     <div class="b-team__person">
                        <div class="images-wrapper">
                           <img src="<?php fopr_assets_uri(); ?>/images/person-pattern-1.jpg" alt="Pattern">
                           <img src="<?php fopr_assets_uri(); ?>/images/person-pattern-2.jpg" alt="Pattern">
                           <?php echo wp_get_attachment_image( $image, 'full', false ); ?>
                        </div>
                        <h5 class="name"><?php echo esc_html( $name ); ?></h5>
                        <h6 class="position"><?php echo wp_kses_post( $position ); ?></h6>
                     </div>
                  <?php
               endwhile;
           endif;
           ?>
         </div>
      </div>

   </div>
</div>

<?php
// important: reset $block variable to initial value.
$block = $settings;
