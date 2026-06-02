<?php
// phpcs:ignoreFile

/**
 * Custom Food Process Block Template.
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

use FoundationPress\Blocks\Block_Custom_Food_Process;

$settings = $block;
$block    = new Block_Custom_Food_Process( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$title          = get_field( 'title' ) ?: 'From Idea to Edible Experience';
$description    = get_field( 'description' ) ?: '';
$benefits_title = get_field( 'benefits_title' ) ?: 'Why Brands Work With Us';
$benefits_video = get_field( 'benefits_video' ) ?: false;
$video_url      = is_array( $benefits_video ) && ! empty( $benefits_video['url'] ) ? $benefits_video['url'] : $benefits_video;
$closing_title  = get_field( 'closing_title' ) ?: 'Almost Anything Can Become Edible';
$closing_text   = get_field( 'closing_text' ) ?: 'Our process allows us to develop highly customized edible concepts that go far beyond traditional catering. From typography and symbolic objects to playful cultural references and artistic installations, we work with brands and agencies to create food experiences that people instantly photograph, share and remember.<br><br>Whether you need 500 recurring customized pieces or a one-of-a-kind edible statement piece, we combine creativity, food technology and visual storytelling to bring ideas to life.';

$default_steps = [
	[
		'label' => 'Step 1',
		'title' => 'Concept & Brief',
		'text'  => 'Tell us about your event, brand or idea.',
	],
	[
		'label' => 'Step 2',
		'title' => 'Design & Prototyping',
		'text'  => 'We develop visuals, shapes and edible branding concepts together.',
	],
	[
		'label' => 'Step 3',
		'title' => 'Production',
		'text'  => 'Products are produced in bulk or prepared for live activation.',
	],
	[
		'label' => 'Step 4',
		'title' => 'Delivery or Live Event',
		'text'  => 'We ship across Europe or bring the live experience directly to your event.',
	],
];

$default_benefits = [
	[
		'title' => 'Visually Unique',
		'text'  => 'Products designed to stand out instantly.',
	],
	[
		'title' => 'Flexible Production',
		'text'  => 'From small creative projects to larger recurring orders.',
	],
	[
		'title' => 'Social Media Impact',
		'text'  => 'Designed for engagement, photos and shareability.',
	],
	[
		'title' => 'European Reach',
		'text'  => 'Production and support for projects across Europe.',
	],
];
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-custom-food-process <?php echo esc_attr( $class_names ); ?>">
	<div class="section__inner grid-x grid-padding-x grid-padding-y">
		<div class="cell large-8 large-offset-2">
			<div class="b-custom-food-process__header">
				<?php if ( $title ): ?>
					<h2 class="b-custom-food-process__title"><?php echo esc_html( $title ); ?></h2>
				<?php endif; ?>

				<?php if ( $description ): ?>
					<p class="b-custom-food-process__description"><?php echo wp_kses_post( $description ); ?></p>
				<?php endif; ?>
			</div>
		</div>

		<div class="cell">
			<ol class="b-custom-food-process__steps">
				<?php if ( have_rows( 'steps' ) ): ?>
					<?php while ( have_rows( 'steps' ) ): the_row();
						$label      = get_sub_field( 'label' ) ?: false;
						$step_title = get_sub_field( 'title' ) ?: false;
						$text       = get_sub_field( 'text' ) ?: false;
						?>
							<li>
								<?php if ( $label ): ?>
									<span><?php echo esc_html( $label ); ?></span>
								<?php endif; ?>
								<?php if ( $step_title ): ?>
									<h3><?php echo esc_html( $step_title ); ?></h3>
								<?php endif; ?>
								<?php if ( $text ): ?>
									<p><?php echo wp_kses_post( $text ); ?></p>
								<?php endif; ?>
							</li>
					<?php endwhile; ?>
				<?php else: ?>
					<?php foreach ( $default_steps as $step ): ?>
						<li>
							<span><?php echo esc_html( $step['label'] ); ?></span>
							<h3><?php echo esc_html( $step['title'] ); ?></h3>
							<p><?php echo esc_html( $step['text'] ); ?></p>
						</li>
					<?php endforeach; ?>
				<?php endif; ?>
			</ol>
		</div>

		<div class="cell">
			<div class="b-custom-food-process__benefits">
				<?php if ( $benefits_title ): ?>
					<h2><?php echo esc_html( $benefits_title ); ?></h2>
				<?php endif; ?>

				<?php if ( $video_url ): ?>
					<div class="b-custom-food-process__video-wrapper">
						<video src="<?php echo esc_url( $video_url ); ?>" controls playsinline preload="metadata"></video>
					</div>
				<?php endif; ?>

				<div class="b-custom-food-process__benefit-grid">
					<?php if ( have_rows( 'benefits' ) ): ?>
						<?php while ( have_rows( 'benefits' ) ): the_row();
							$icon          = get_sub_field( 'icon' ) ?: false;
							$benefit_title = get_sub_field( 'title' ) ?: false;
							$text          = get_sub_field( 'text' ) ?: false;
							?>
								<article>
									<div class="b-custom-food-process__benefit-icon">
										<?php if ( $icon ): ?>
											<?php echo wp_get_attachment_image( $icon, 'thumbnail', false ); ?>
										<?php endif; ?>
									</div>

									<?php if ( $benefit_title ): ?>
										<h3><?php echo esc_html( $benefit_title ); ?></h3>
									<?php endif; ?>

									<?php if ( $text ): ?>
										<p><?php echo wp_kses_post( $text ); ?></p>
									<?php endif; ?>
								</article>
						<?php endwhile; ?>
					<?php else: ?>
						<?php foreach ( $default_benefits as $benefit ): ?>
							<article>
								<div class="b-custom-food-process__benefit-icon"></div>
								<h3><?php echo esc_html( $benefit['title'] ); ?></h3>
								<p><?php echo esc_html( $benefit['text'] ); ?></p>
							</article>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<?php if ( $closing_title || $closing_text ): ?>
			<div class="cell large-10 large-offset-1">
				<div class="b-custom-food-process__closing">
					<?php if ( $closing_title ): ?>
						<h2><?php echo esc_html( $closing_title ); ?></h2>
					<?php endif; ?>

					<?php if ( $closing_text ): ?>
						<p><?php echo wp_kses_post( $closing_text ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
