<?php
// phpcs:ignoreFile

/**
 * Home Shop Block Template.
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

use FoundationPress\Blocks\Block_Home_Shop;

$settings = $block;
$block    = new Block_Home_Shop( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$bg_image = get_field( 'bg_image' ) ?: false;
$title = get_field( 'title' ) ?: false;
$image = get_field( 'image' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-home-shop <?php echo esc_attr( $class_names ); ?>" style="background-image: url('<?php echo esc_url( $bg_image['url'] ); ?>');">
   <div class="section__inner grid-x grid-padding-x grid-padding-y align-middle">

      <div class="cell medium-6">
         <div>
            <h2 class="b-home-shop__title"><?php echo wp_kses_post( $title ); ?></h2>
            <div class="b-home-shop__images-wrapper">
					<img src="<?php fopr_assets_uri(); ?>/images/patterns.png" alt="Patterns" class="show-for-medium">
                    <?php echo wp_get_attachment_image( $image, 'full', false ); ?>
            </div>
         </div>
      </div>

      <div class="cell medium-6">
			<div class="b-home-shop__products">
				<?php
				   $args = array(
                  'post_type' => 'product',
                  'post__not_in' => array(1285, 1288, 1293, 1297),       
                  'orderby' => 'date',
                  'order' => 'DESC',
                  );

					$loop = new WP_Query( $args );
					if ( $loop->have_posts() ) {
						while ( $loop->have_posts() ): $loop->the_post(); ?>
							<?php global $product; ?>
							<div class="b-home-shop__product">
								<div class="image-wrapper">
									<?php echo get_the_post_thumbnail( $loop->post->ID ); ?>
								</div>
								<div>
									<h3 class="title"><?php the_title(); ?></h3>
									<p class="price"><?php echo $product->get_price_html(); ?></p>
									<a href="<?php echo get_permalink($loop->post->ID) ?>" class="link">
										<svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd" clip-rule="evenodd" d="M13.9867 8.47469C13.7012 8.99781 13.147 9.34375 12.5173 9.34375H6.26159L5.33793 11.0312H15.4142V12.7188H5.33793C4.06161 12.7188 3.25551 11.3434 3.86848 10.2128L5.00206 8.15406L1.97918 1.75H0.299805V0.0625H3.04558L3.83489 1.75H16.2623C16.9004 1.75 17.3035 2.44187 16.9928 2.99875L13.9867 8.47469ZM14.8348 3.4375H4.6326L6.62266 7.65625H12.5173L14.8348 3.4375ZM5.33793 13.5625C4.41428 13.5625 3.66695 14.3219 3.66695 15.25C3.66695 16.1781 4.41428 16.9375 5.33793 16.9375C6.26159 16.9375 7.01731 16.1781 7.01731 15.25C7.01731 14.3219 6.26159 13.5625 5.33793 13.5625ZM12.0638 15.25C12.0638 14.3219 12.8112 13.5625 13.7348 13.5625C14.6585 13.5625 15.4142 14.3219 15.4142 15.25C15.4142 16.1781 14.6585 16.9375 13.7348 16.9375C12.8112 16.9375 12.0638 16.1781 12.0638 15.25Z" fill="#9BD6D7"/>
										</svg>
										<?php echo esc_html_e( 'Shop Now' ); ?>
									</a>
								</div>
							</div>
						<?php endwhile;
					} else {
						echo esc_html_e( 'No products found' );
					}
					wp_reset_postdata(); 
				?>
			</div>    
   	</div>

	</div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;


