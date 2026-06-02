<?php
// phpcs:ignoreFile

/**
 * Custom Food Services Block Template.
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

use FoundationPress\Blocks\Block_Custom_Food_Services;

$settings = $block;
$block    = new Block_Custom_Food_Services( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$eyebrow     = get_field( 'eyebrow' ) ?: 'Custom food printing';
$title       = get_field( 'title' ) ?: 'What We Offer';
$description = get_field( 'description' ) ?: '';
$button      = get_field( 'button' ) ?: [
	'url'    => '#shape-library',
	'title'  => 'Explore Our Shape Library',
	'target' => '',
];
$note        = get_field( 'note' ) ?: 'Contact us to suggest your own shape!';

$default_services = [
	[
		'title'       => 'Custom Shapes & Objects',
		'description' => 'We can create edible versions of almost any concept - from geometric forms and branded symbols to playful objects, letters, numbers and fully custom creations developed specifically for your event or campaign.',
		'list_title'  => 'Examples include:',
		'items'       => [ 'custom shapes', 'letters & typography', 'numbers', 'abstract forms', 'edible objects', 'themed creations', 'sculptural concepts' ],
	],
	[
		'title'       => 'Personalized Printing & Design',
		'description' => 'Beyond logos, we can personalize products with graphics, visuals, illustrations, patterns and custom artwork tailored to your event, audience or brand identity.',
		'list_title'  => 'Perfect for:',
		'items'       => [ 'product launches', 'fashion events', 'PR campaigns', 'corporate gifting', 'luxury hospitality', 'influencer activations' ],
	],
	[
		'title'       => 'Experimental & Creative Projects',
		'description' => 'Some projects go beyond standard production. From edible objects and political satire pieces to highly creative one-off concepts, we collaborate on unique edible experiences designed to generate surprise and conversation.',
		'list_title'  => '',
		'items'       => [ 'If you can imagine it, we would love to explore it.' ],
	],
	[
		'title'       => 'Live Edible Experiences',
		'description' => 'We bring the customization process directly to events with interactive live edible printing and personalization experiences that engage guests in real time.',
		'list_title'  => 'Ideal for:',
		'items'       => [ 'trade fairs', 'brand activations', 'conferences', 'launch events', 'experiential marketing' ],
	],
];
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-custom-food-services <?php echo esc_attr( $class_names ); ?>">
	<div class="section__inner grid-x grid-padding-x grid-padding-y">
		<div class="cell large-8 large-offset-2">
			<div class="b-custom-food-services__header">
				<?php if ( $eyebrow ): ?>
					<p class="b-custom-food-services__eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
				<?php endif; ?>

				<?php if ( $title ): ?>
					<h2 class="b-custom-food-services__title"><?php echo esc_html( $title ); ?></h2>
				<?php endif; ?>

				<?php if ( $description ): ?>
					<p class="b-custom-food-services__description"><?php echo wp_kses_post( $description ); ?></p>
				<?php endif; ?>
			</div>
		</div>

		<div class="cell">
			<div class="b-custom-food-services__grid">
				<?php if ( have_rows( 'services' ) ): ?>
					<?php while ( have_rows( 'services' ) ): the_row();
						$service_title       = get_sub_field( 'title' ) ?: false;
						$service_description = get_sub_field( 'description' ) ?: false;
						$list_title          = get_sub_field( 'list_title' ) ?: false;
						$image               = get_sub_field( 'image' ) ?: false;
						?>
							<article class="b-custom-food-services__card">
								<div class="b-custom-food-services__media">
									<?php if ( $image ): ?>
										<?php echo wp_get_attachment_image( $image, 'large', false ); ?>
									<?php endif; ?>
								</div>

								<div class="b-custom-food-services__card-content">
									<?php if ( $service_title ): ?>
										<h3><?php echo esc_html( $service_title ); ?></h3>
									<?php endif; ?>

									<?php if ( $service_description ): ?>
										<p><?php echo wp_kses_post( $service_description ); ?></p>
									<?php endif; ?>

									<?php if ( have_rows( 'items' ) ): ?>
										<?php if ( $list_title ): ?>
											<h4><?php echo esc_html( $list_title ); ?></h4>
										<?php endif; ?>
										<ul>
											<?php while ( have_rows( 'items' ) ): the_row();
												$item = get_sub_field( 'item' ) ?: false;
												?>
													<?php if ( $item ): ?>
														<li><?php echo esc_html( $item ); ?></li>
													<?php endif; ?>
											<?php endwhile; ?>
										</ul>
									<?php endif; ?>
								</div>
							</article>
					<?php endwhile; ?>
				<?php else: ?>
					<?php foreach ( $default_services as $service ): ?>
						<article class="b-custom-food-services__card">
							<div class="b-custom-food-services__media"></div>
							<div class="b-custom-food-services__card-content">
								<h3><?php echo esc_html( $service['title'] ); ?></h3>
								<p><?php echo esc_html( $service['description'] ); ?></p>
								<?php if ( $service['list_title'] ): ?>
									<h4><?php echo esc_html( $service['list_title'] ); ?></h4>
								<?php endif; ?>
								<ul>
									<?php foreach ( $service['items'] as $item ): ?>
										<li><?php echo esc_html( $item ); ?></li>
									<?php endforeach; ?>
								</ul>
							</div>
						</article>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>

		<?php if ( $button || $note ): ?>
			<div class="cell">
				<div class="b-custom-food-services__cta">
					<?php if ( $button ): ?>
						<a href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo esc_attr( $button['target'] ? $button['target'] : '_self' ); ?>" class="button">
							<?php echo esc_html( $button['title'] ); ?>
						</a>
					<?php endif; ?>

					<?php if ( $note ): ?>
						<p><?php echo wp_kses_post( $note ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
