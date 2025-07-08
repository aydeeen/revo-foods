<?php
// phpcs:ignoreFile

/**
 * Team 2 Block Template.
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

use FoundationPress\Blocks\Block_Team_2;

$settings = $block;
$block    = new Block_Team_2( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$title       = get_field( 'title' ) ?: false;
$subtitle    = get_field( 'subtitle' ) ?: false;
$description = get_field( 'description' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-team-2 <?php echo esc_attr( $class_names ); ?>">
	<div class="section__inner grid-x grid-padding-x grid-padding-y">
		<div class="cell">
			<div>
				<h3 class="b-team-2__subtitle"><?php echo esc_html( $subtitle ); ?></h3>
				<h2 class="b-team-2__title"><?php echo esc_html( $title ); ?></h2>
				<p class="b-team-2__description"><?php echo esc_html( $description ); ?></p>
			</div>
		</div>

		<div class="cell">
			<div class="b-team-2__team-wrapper">
				<?php
				if ( have_rows( 'people' ) ) :
					while ( have_rows( 'people' ) ) : the_row();
						$image    = get_sub_field( 'image' ) ?: false;
						$name     = get_sub_field( 'name' ) ?: false;
						$position = get_sub_field( 'position' ) ?: false;
						?>
							<div class="b-team-2__person">
								<div class="images-wrapper">
									<img src="<?php fopr_assets_uri(); ?>/images/person-pattern-1.jpg" alt="Pattern">
									<img src="<?php fopr_assets_uri(); ?>/images/person-pattern-2.jpg" alt="Pattern">
									<?php echo wp_get_attachment_image( $image, 'full', false ); ?>
								</div>
								<h3 class="name"><?php echo esc_html( $name ); ?></h3>
								<h4 class="position"><?php echo esc_html( $position ); ?></h4>
							</div>
						<?php
					endwhile;
				endif;
				?>
			</div>
      	</div>

		<div class="cell">
			<div class="b-team-2__accordions-wrapper">
				<ul class="accordion" data-accordion data-allow-all-closed="true"> 
				  	<?php if ( have_rows('accordions') ): ?>
                    	<?php while ( have_rows('accordions') ): the_row(); 
							$accordion_title = get_sub_field( 'accordion_title' ) ?: false;
							?>
								<li class="accordion-item" data-accordion-item>
									<a href="#" class="accordion-title">
										<svg width="11" height="12" viewBox="0 0 11 12" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd" clip-rule="evenodd" d="M5.10896 11.7291C4.12035 11.7458 3.31456 11.6328 2.6916 11.3899C2.06864 11.147 1.54725 10.7576 1.12742 10.2216C0.639889 9.59348 0.33518 8.94861 0.213296 8.28699C0.0914127 7.62538 0.0236996 6.96794 0.010157 6.3147C-0.00338566 6.23932 -0.00338566 6.06136 0.010157 5.7808C0.0236996 5.50024 0.0541705 5.18199 0.10157 4.82605C0.148969 4.47012 0.209911 4.1079 0.284395 3.73941C0.35888 3.37091 0.457064 3.06523 0.578947 2.82235C0.890428 2.14398 1.49985 1.61636 2.4072 1.23949C3.31456 0.862618 4.44537 0.695119 5.79963 0.736994C6.20591 0.720244 6.61557 0.753744 7.02862 0.837493C7.44167 0.921243 7.83441 1.04896 8.20683 1.22065C8.57926 1.39233 8.91444 1.60171 9.21237 1.84877C9.51031 2.09583 9.75408 2.37011 9.94368 2.6716C10.3229 3.28297 10.5937 3.90062 10.7562 4.52456C10.9187 5.14849 11 5.77033 11 6.39007C11 7.00982 10.9255 7.62119 10.7765 8.22418C10.6276 8.82718 10.4244 9.40505 10.1671 9.95779C10.0452 10.2677 9.78794 10.5336 9.3952 10.7555C9.00246 10.9774 8.55556 11.1596 8.05448 11.302C7.5534 11.4443 7.0354 11.549 6.50046 11.616C5.96553 11.683 5.50169 11.7207 5.10896 11.7291ZM7.19756 2.64147C7.77527 2.94859 8.2567 3.39047 8.64184 3.96711C8.58103 3.31526 8.28711 2.81697 7.76007 2.47224C7.23303 2.12751 6.46275 1.89247 5.44922 1.76711C6.03707 2.04289 6.61985 2.33435 7.19756 2.64147ZM3.68884 10.7492C3.25547 10.6655 2.87628 10.4812 2.55126 10.1965C2.22623 9.91173 1.98247 9.57255 1.81995 9.17893C1.65744 8.7853 1.57957 8.36028 1.58634 7.90384C1.59312 7.44741 1.71161 7.00982 1.94184 6.59107C2.07726 6.95957 2.14836 7.33016 2.15513 7.70284C2.16191 8.07553 2.19238 8.43984 2.24655 8.79577C2.30072 9.15171 2.42599 9.49508 2.62235 9.82589C2.81872 10.1567 3.17422 10.4645 3.68884 10.7492ZM5.17138 5.73541C5.06776 6.07715 5.05049 6.4545 5.11957 6.86744C5.41891 6.62537 5.64917 6.4189 5.81035 6.24803C5.97153 6.07715 6.06939 5.9134 6.10393 5.75676C6.13847 5.60013 6.1212 5.43994 6.05212 5.27618C5.98304 5.11243 5.86791 4.90952 5.70673 4.66744C5.45345 5.03767 5.275 5.39366 5.17138 5.73541ZM4.05263 9.22917C3.78178 9.02818 3.62604 8.83346 3.58541 8.64502C3.54478 8.45659 3.55833 8.24093 3.62604 7.99806C3.81564 8.19906 3.95445 8.39378 4.04247 8.58221C4.1305 8.77065 4.13389 8.9863 4.05263 9.22917ZM7.12457 8.95701C6.59494 9.17144 6.18753 9.46734 5.90234 9.84473C6.59494 9.84473 7.12457 9.80185 7.49123 9.71608C7.8579 9.63031 8.12271 9.51452 8.28568 9.36871C8.44864 9.2229 8.56068 9.05994 8.62179 8.87982C8.6829 8.6997 8.7542 8.53245 8.83568 8.37807C8.22457 8.5496 7.6542 8.74259 7.12457 8.95701Z" fill="#F9A259"/>
										</svg>
										<?php echo esc_html( $accordion_title ); ?>
									</a>

									<div class="accordion-content" data-tab-content>
										<div class="b-team-2__team-wrapper">
											<?php if ( have_rows( 'people' ) ) :
												while ( have_rows( 'people' ) ) : the_row();
													$image    = get_sub_field( 'image' ) ?: false;
													$name     = get_sub_field( 'name' ) ?: false;
													$position = get_sub_field( 'position' ) ?: false;
													?>
														<div class="b-team-2__person">
															<div class="images-wrapper">
																<img src="<?php fopr_assets_uri(); ?>/images/person-pattern-1.jpg" alt="Pattern">
																<img src="<?php fopr_assets_uri(); ?>/images/person-pattern-2.jpg" alt="Pattern">
																<?php echo wp_get_attachment_image( $image, 'full', false ); ?>
															</div>
															<h3 class="name"><?php echo esc_html( $name ); ?></h3>
															<h4 class="position"><?php echo esc_html( $position ); ?></h4>
														</div>
													<?php
												endwhile;
											endif;
											?>
										</div>
									</div>
								</li>
							<?php
						endwhile;
					endif;
					?>
				</ul>
			</div>
		</div>
	</div>	
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
