<?php
// phpcs:ignoreFile

/**
 * Home Slider Block Template.
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

use FoundationPress\Blocks\Block_Home_Slider;

$settings = $block;
$block    = new Block_Home_Slider( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$bg_image = get_field( 'bg_image' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-home-slider <?php echo esc_attr( $class_names ); ?>" style="background-image: url('<?php echo esc_url( $bg_image['url'] ); ?>');">
	<div class="section__inner grid-x grid-padding-x grid-padding-y">
		<div class="cell">
			<div class="b-home-slider__slider">
			   <?php if ( have_rows( 'items' ) ):
					while ( have_rows( 'items' ) ): the_row();
						$title       = get_sub_field( 'title' ) ?: false;
                  $subtitle    = get_sub_field( 'subtitle' ) ?: false;
                  $button      = get_sub_field( 'button' ) ?: false;
                  $button_text = get_sub_field( 'button_text' ) ?: false;
                  $image       = get_sub_field( 'image' ) ?: false;
						?>
							<div class="carousel-cell b-home-slider__carousel-cell">
								<div class="grid-x grid-padding-x grid-padding-y align-middle">
									<div class="cell medium-6">
										<div class="b-home-slider__content">
											<h4 class="b-home-slider__subtitle"><?php echo esc_html( $subtitle ); ?></h4>
											<h2 class="b-home-slider__title"><?php echo wp_kses_post( $title ); ?></h2>
                                 <a href="<?php echo esc_url( $button ); ?>" class="b-home-slider__link">
                                    <?php echo esc_html( $button_text ); ?>
                                 </a>
										</div>
									</div>
									<div class="cell medium-6">
										<div class="b-home-slider__images-wrapper">
                                 <img src="<?php fopr_assets_uri(); ?>/images/patterns-box.jpg" alt="Patterns">
											<?php echo wp_get_attachment_image( $image, 'full', false ); ?>
										</div>
									</div>
								</div>
							</div>
						<?php
					 endwhile;
				endif;
				?>
			</div>
		</div>
	</div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
