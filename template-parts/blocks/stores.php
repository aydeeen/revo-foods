<?php
// phpcs:ignoreFile

/**
 * Stores Block Template.
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

use FoundationPress\Blocks\Block_Stores;

$settings = $block;
$block    = new Block_Stores( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-stores <?php echo esc_attr( $class_names ); ?>">
   <div class="section__inner grid-x grid-padding-x grid-padding-y">
		<div class="cell">
         <div>
            <?php if( have_rows( 'items' ) ): ?>
               <?php while( have_rows( 'items' ) ): the_row(); 
                  $flag    = get_sub_field( 'flag' ) ?: false; 
                  $country = get_sub_field( 'country' ) ?: false; 
                  ?>
                     <div class="b-stores__country-container">
                        <div class="b-stores__country-title">
                           <?php echo wp_get_attachment_image( $flag, 'full', false ); ?>
                           <h3><?php echo esc_html( $country ); ?></h3>
                        </div>
                        <div class="b-stores__stores">
                           <?php if ( have_rows( 'stores' ) ): ?>
                              <?php while( have_rows( 'stores' ) ): the_row(); 
                                 $link = get_sub_field( 'link' ) ?: false; 
                                 $logo = get_sub_field( 'logo' ) ?: false; 
                                 ?>
                                    <div class="b-stores__store">
                                       <a href="<?php echo esc_url( $link ); ?>" target="_blank">
                                          <?php echo wp_get_attachment_image( $logo, 'full', false ); ?>
                                       </a>
                                    </div>
                              <?php endwhile; ?>
                           <?php endif; ?>
                        </div>
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
