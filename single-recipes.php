<?php
/**
 * The template for displaying a single recipe.
 *
 * @package FoundationPress
 */

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
// phpcs:disable WordPress.WP.GlobalVariablesOverride.Prohibited

get_header();

$single_recipe_breadcrumbs_link = get_field( 'single_recipe_breadcrumbs_link', 'option' ) ?: false;
$single_recipe_breadcrumbs_text = get_field( 'single_recipe_breadcrumbs_text', 'option' ) ?: false;
$cook_time                      = get_field( 'cook_time' ) ?: false;
$product_link                   = get_field( 'product_link' ) ?: false;
$ingredients                    = get_field( 'ingredients' ) ?: [];
$preparation                    = get_field( 'preparation' ) ?: [];
$product                        = fopr_get_recipe_product();
$product_image_url              = fopr_get_recipe_product_image_url( $product );
$related_recipes                = fopr_get_related_recipes( get_the_ID() );
$featured_image_id              = get_post_thumbnail_id();
$featured_image_alt             = $featured_image_id ? get_post_meta( $featured_image_id, '_wp_attachment_image_alt', true ) : '';
$featured_image_alt             = $featured_image_alt ?: get_the_title();
?>

<main class="single-recipe">
	<div class="single-recipe__boxes-wrapper">
		<section class="single-recipe__box-1">
			<div class="single-recipe__box-1-top-part">
				<?php if ( $single_recipe_breadcrumbs_link && $single_recipe_breadcrumbs_text ) : ?>
					<a href="<?php echo esc_url( $single_recipe_breadcrumbs_link ); ?>" class="link">
						<svg width="32" height="9" viewBox="0 0 32 9" fill="none" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg">
							<path d="M0.646447 4.14645C0.451184 4.34171 0.451184 4.65829 0.646447 4.85355L3.82843 8.03553C4.02369 8.2308 4.34027 8.2308 4.53553 8.03553C4.7308 7.84027 4.7308 7.52369 4.53553 7.32843L1.70711 4.5L4.53553 1.67157C4.7308 1.47631 4.7308 1.15973 4.53553 0.964466C4.34027 0.769204 4.02369 0.769204 3.82843 0.964466L0.646447 4.14645ZM31 5C31.2761 5 31.5 4.77614 31.5 4.5C31.5 4.22386 31.2761 4 31 4V5ZM1 5H31V4H1V5Z" fill="#1E5064"/>
						</svg>
						<?php echo esc_html( $single_recipe_breadcrumbs_text ); ?>
					</a>
				<?php endif; ?>
				<time class="date" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
					<?php echo esc_html( get_the_date() ); ?>
				</time>
			</div>

			<h1 class="single-recipe__box-1-title"><?php the_title(); ?></h1>
			<div class="single-recipe__box-1-middle-part">
				<span><?php echo esc_html( fopr_translate_string( 'PRODUCTS' ) ); ?></span>
				<span><?php echo esc_html( $product['label'] ); ?></span>
			</div>
			<div class="single-recipe__box-1-excerpt"><?php the_excerpt(); ?></div>

			<?php if ( $cook_time ) : ?>
				<p class="single-recipe__box-1-cook-time"><?php echo esc_html( fopr_translate_string( 'Cook Time' ) ); ?></p>
				<p class="single-recipe__box-1-time"><?php echo esc_html( $cook_time ); ?></p>
			<?php endif; ?>
		</section>

		<section class="single-recipe__box-2" aria-label="<?php esc_attr_e( 'Featured recipe product', 'foundationpress' ); ?>">
			<?php if ( $featured_image_id ) : ?>
				<div class="single-recipe__box-2-featured-image-wrapper">
					<?php
					echo wp_get_attachment_image(
						$featured_image_id,
						'full',
						false,
						[
							'alt'           => $featured_image_alt,
							'decoding'      => 'async',
							'fetchpriority' => 'high',
							'loading'       => 'eager',
						]
					); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?>
				</div>
			<?php endif; ?>

			<div class="single-recipe__box-2-bottom-part" style="background: <?php echo esc_attr( $product['feature_background'] ); ?>;">
				<?php if ( $product_image_url ) : ?>
					<img src="<?php echo esc_url( $product_image_url ); ?>" alt="<?php echo esc_attr( $product['label'] ); ?>" loading="lazy" decoding="async">
				<?php endif; ?>
				<div class="content">
					<span><?php echo esc_html( fopr_translate_string( 'the recipe features' ) ); ?></span>
					<span><?php echo esc_html( $product['label'] ); ?></span>
				</div>
				<?php if ( $product_link ) : ?>
					<a href="<?php echo esc_url( $product_link ); ?>" class="link">
						<span><?php echo esc_html( fopr_translate_string( 'View Product' ) ); ?></span>
						<svg width="7" height="10" viewBox="0 0 7 10" fill="none" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg">
							<path d="M6.36235 4.99998C6.36235 5.16902 6.28687 5.33805 6.13621 5.46693L1.39296 9.52257C1.09123 9.78056 0.602031 9.78056 0.300424 9.52257C-0.00118307 9.26468 -0.00118307 8.84648 0.300424 8.58846L4.49751 4.99998L0.300571 1.41147C-0.00103659 1.15348 -0.00103659 0.735315 0.300571 0.477448C0.602178 0.219332 1.09138 0.219332 1.39311 0.477448L6.13636 4.53303C6.28704 4.66197 6.36235 4.831 6.36235 4.99998Z" fill="#1E5064"/>
						</svg>
					</a>
				<?php endif; ?>
			</div>
		</section>

		<?php if ( $ingredients ) : ?>
			<section class="single-recipe__box-3">
				<h2 class="single-recipe__box-3-title"><?php echo esc_html( fopr_translate_string( 'Ingredients' ) ); ?></h2>
				<ul class="single-recipe__box-3-list">
					<?php foreach ( $ingredients as $ingredient_row ) : ?>
						<?php if ( ! empty( $ingredient_row['ingredient'] ) ) : ?>
							<li>
								<svg width="16" height="14" viewBox="0 0 16 14" fill="none" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M13.3019 1.02928C13.774 0.598156 14.5793 -0.129365 15.3013 0.247868C16.9342 1.09917 15.3159 2.94677 14.3885 4.00547C14.2593 4.15307 14.1434 4.28534 14.0517 4.39743C13.2555 5.38555 12.4347 6.34973 11.6138 7.31391C11.2036 7.79581 10.7933 8.27771 10.3861 8.7626C10.0136 9.19854 9.65829 9.65128 9.30154 10.1059C8.75424 10.8033 8.20347 11.5052 7.58143 12.1577C7.54962 12.1915 7.51658 12.2268 7.48236 12.2634C6.8893 12.8974 5.94557 13.9062 5.02666 13.8553C4.22135 13.8283 3.52712 13.2625 2.99951 12.7236C1.74989 11.4572 0.0559656 9.46322 0.000427067 7.60396C-0.0273422 6.17586 1.30558 6.60699 2.11089 7.19978C2.85075 7.75612 3.47972 8.39617 4.1127 9.04029C4.43004 9.36321 4.74838 9.68715 5.0822 10.0021C5.52651 9.19373 6.24851 8.49315 6.91497 7.84647C7.63863 7.12754 8.31952 6.39825 9.00409 5.66503C9.42283 5.21654 9.84294 4.76657 10.2751 4.3166C10.6861 3.88538 11.0795 3.43691 11.4728 2.98844C12.0625 2.31598 12.6522 1.64354 13.3019 1.02928Z" fill="#9BD6D7"/>
								</svg>
								<?php echo esc_html( $ingredient_row['ingredient'] ); ?>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</section>
		<?php endif; ?>

		<?php if ( $preparation ) : ?>
			<section class="single-recipe__box-4">
				<h2 class="single-recipe__box-4-title"><?php echo esc_html( fopr_translate_string( 'Preparation' ) ); ?></h2>
				<ol class="single-recipe__box-4-list">
					<?php foreach ( $preparation as $index => $preparation_row ) : ?>
						<?php if ( ! empty( $preparation_row['preparation_step'] ) ) : ?>
							<li>
								<span aria-hidden="true"><?php echo esc_html( $index + 1 ); ?></span>
								<span><?php echo esc_html( $preparation_row['preparation_step'] ); ?></span>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ol>
			</section>
		<?php endif; ?>
	</div>

	<?php if ( $related_recipes ) : ?>
		<section class="section section--full single-recipe__latest-recipes">
			<div class="section__inner grid-x grid-padding-x grid-padding-y">
				<div class="cell">
					<div class="single-recipe__latest-recipes-top-part">
						<h2 class="title"><?php echo esc_html( fopr_translate_string( 'Related Recipes' ) ); ?></h2>
						<?php if ( $single_recipe_breadcrumbs_link ) : ?>
							<a href="<?php echo esc_url( $single_recipe_breadcrumbs_link ); ?>" class="link">
								<?php echo esc_html( fopr_translate_string( 'View All' ) ); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
				<div class="cell">
					<div class="single-recipe__latest-recipes-main-part">
						<?php foreach ( $related_recipes as $related_recipe ) : ?>
							<?php get_template_part( 'template-parts/recipe-short', null, [ 'recipe_id' => $related_recipe->ID ] ); ?>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>
</main>

<?php get_footer(); ?>
