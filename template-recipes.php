<?php
/**
 * Template Name: Recipes
 *
 * @package FoundationPress
 */

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
// phpcs:disable WordPress.WP.GlobalVariablesOverride.Prohibited

get_header();

$bg_image           = get_field( 'bg_image' ) ?: false;
$image_mobile       = get_field( 'image_mobile' ) ?: false;
$title              = get_field( 'title' ) ?: false;
$description        = get_field( 'description' ) ?: false;
$cta_bg_image       = get_field( 'cta_bg_image' ) ?: false;
$cta_title          = get_field( 'cta_title' ) ?: false;
$cta_button         = get_field( 'cta_button' ) ?: false;
$cta_button_text    = get_field( 'cta_button_text' ) ?: false;
$banner_bg_image    = get_field( 'banner_bg_image', 'option' ) ?: false;
$banner_title       = get_field( 'banner_title', 'option' ) ?: false;
$banner_subtitle    = get_field( 'banner_subtitle', 'option' ) ?: false;
$banner_button      = get_field( 'banner_button', 'option' ) ?: false;
$banner_button_text = get_field( 'banner_button_text', 'option' ) ?: false;
$banner_image       = get_field( 'banner_image', 'option' ) ?: false;
$logo               = get_field( 'footer_logo', 'option' ) ?: false;
$image_mobile_id    = is_array( $image_mobile ) ? ( $image_mobile['ID'] ?? 0 ) : $image_mobile;
$banner_image_id    = is_array( $banner_image ) ? ( $banner_image['ID'] ?? 0 ) : $banner_image;
$logo_id            = is_array( $logo ) ? ( $logo['ID'] ?? 0 ) : $logo;

$recipe_filters = fopr_get_recipe_filters();
$recipe_panels  = [ 'all' => [] ];
foreach ( $recipe_filters as $filter_slug => $filter ) {
	$recipe_panels[ $filter_slug ] = [];
}

$recipe_query = new WP_Query(
	[
		'post_type'           => 'recipes',
		'post_status'         => 'publish',
		'posts_per_page'      => -1,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	]
);

foreach ( $recipe_query->posts as $recipe_post ) {
	$category_slugs = wp_get_post_terms( $recipe_post->ID, 'category', [ 'fields' => 'slugs' ] );
	$category_slugs = is_wp_error( $category_slugs ) ? [] : $category_slugs;

	if ( ! array_intersect( [ 'salmon-spread', 'tuna' ], $category_slugs ) ) {
		$recipe_panels['all'][] = $recipe_post;
	}

	foreach ( $recipe_filters as $filter_slug => $filter ) {
		if ( array_intersect( $filter['categories'], $category_slugs ) ) {
			$recipe_panels[ $filter_slug ][] = $recipe_post;
		}
	}
}

$visible_filters = array_filter(
	$recipe_filters,
	static function( $filter, $filter_slug ) use ( $recipe_panels ) {
		return ! empty( $recipe_panels[ $filter_slug ] );
	},
	ARRAY_FILTER_USE_BOTH
);
$tabs_id         = 'recipes-' . get_the_ID();
?>

<main class="recipes">
	<?php if ( $image_mobile_id ) : ?>
		<?php
		echo wp_get_attachment_image(
			$image_mobile_id,
			'full',
			false,
			[
				'class'         => 'recipes__hero-image',
				'fetchpriority' => 'high',
				'loading'       => 'eager',
			]
		); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		?>
	<?php endif; ?>

	<section class="recipes__hero"<?php echo $bg_image ? ' style="' . esc_attr( fopr_get_acf_bg_img_style( $bg_image ) ) . '"' : ''; ?>>
		<?php if ( $title ) : ?>
			<h1 class="recipes__hero-title"><?php echo wp_kses_post( $title ); ?></h1>
		<?php endif; ?>
		<?php if ( $description ) : ?>
			<p class="recipes__hero-description"><?php echo esc_html( $description ); ?></p>
		<?php endif; ?>
	</section>

	<section class="section section--full" aria-labelledby="<?php echo esc_attr( $tabs_id ); ?>-heading">
		<div class="section__inner grid-x grid-padding-x grid-padding-y">
			<div class="cell">
				<h2 id="<?php echo esc_attr( $tabs_id ); ?>-heading" class="screen-reader-text">
					<?php esc_html_e( 'Browse recipes by product', 'foundationpress' ); ?>
				</h2>

				<ul class="tabs recipes__tabs" data-tabs id="<?php echo esc_attr( $tabs_id ); ?>">
					<li class="tabs-title is-active">
						<a href="#<?php echo esc_attr( $tabs_id ); ?>-all" aria-selected="true">
							<?php esc_html_e( 'All', 'foundationpress' ); ?>
						</a>
					</li>
					<?php foreach ( $visible_filters as $filter_slug => $filter ) : ?>
						<li class="tabs-title">
							<a href="#<?php echo esc_attr( $tabs_id . '-' . $filter_slug ); ?>">
								<?php echo esc_html( $filter['label'] ); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>

				<div class="tabs-content recipes__tabs-content" data-tabs-content="<?php echo esc_attr( $tabs_id ); ?>">
					<?php
					$panels_to_render = array_merge( [ 'all' => [ 'label' => __( 'All', 'foundationpress' ) ] ], $visible_filters );
					foreach ( $panels_to_render as $panel_slug => $panel ) :
						$is_active = 'all' === $panel_slug;
						?>
						<div
							class="tabs-panel padding-0<?php echo $is_active ? ' is-active' : ''; ?>"
							id="<?php echo esc_attr( $tabs_id . '-' . $panel_slug ); ?>"
						>
							<?php if ( ! empty( $recipe_panels[ $panel_slug ] ) ) : ?>
								<div class="recipes__recipes-container">
									<?php foreach ( $recipe_panels[ $panel_slug ] as $recipe_post ) : ?>
										<?php
										get_template_part(
											'template-parts/recipe-short',
											null,
											[
												'recipe_id' => $recipe_post->ID,
												'id_suffix' => $tabs_id . '-' . $panel_slug,
											]
										);
										?>
									<?php endforeach; ?>
								</div>
							<?php else : ?>
								<p class="recipes__empty-state">
									<?php esc_html_e( 'New recipes are coming soon.', 'foundationpress' ); ?>
								</p>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
</main>

<?php if ( $cta_title || ( $cta_button && $cta_button_text ) ) : ?>
	<section class="section section--full b-recipes-cta"<?php echo $cta_bg_image ? ' style="' . esc_attr( fopr_get_acf_bg_img_style( $cta_bg_image ) ) . '"' : ''; ?>>
		<div class="section__inner grid-x grid-padding-x grid-padding-y">
			<div class="cell">
				<?php if ( $cta_title ) : ?>
					<h2 class="b-recipes-cta__title"><?php echo wp_kses_post( $cta_title ); ?></h2>
				<?php endif; ?>
				<?php if ( $cta_button && $cta_button_text ) : ?>
					<div class="b-recipes-cta__button-wrapper">
						<a href="<?php echo esc_url( $cta_button ); ?>" class="button">
							<?php echo esc_html( $cta_button_text ); ?>
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if ( $banner_title || $banner_subtitle || $banner_image_id ) : ?>
	<section class="section section--full b-banner"<?php echo $banner_bg_image ? ' style="' . esc_attr( fopr_get_acf_bg_img_style( $banner_bg_image ) ) . '"' : ''; ?>>
		<div class="section__inner grid-x grid-padding-x grid-padding-y align-middle">
			<div class="cell large-6">
				<div class="text-center">
					<?php if ( $logo_id ) : ?>
						<?php echo wp_get_attachment_image( $logo_id, 'full', false, [ 'class' => 'b-banner__logo' ] ); ?>
					<?php endif; ?>
					<?php if ( $banner_title ) : ?>
						<h2 class="b-banner__title"><?php echo wp_kses_post( $banner_title ); ?></h2>
					<?php endif; ?>
					<?php if ( $banner_subtitle ) : ?>
						<p class="b-banner__subtitle"><?php echo esc_html( $banner_subtitle ); ?></p>
					<?php endif; ?>
					<?php if ( $banner_button && $banner_button_text ) : ?>
						<div class="b-banner__button-wrapper">
							<a href="<?php echo esc_url( $banner_button ); ?>" class="button">
								<?php echo esc_html( $banner_button_text ); ?>
							</a>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<?php if ( $banner_image_id ) : ?>
				<div class="cell large-6">
					<?php echo wp_get_attachment_image( $banner_image_id, 'full', false, [ 'loading' => 'lazy' ] ); ?>
				</div>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>

<?php get_footer(); ?>
