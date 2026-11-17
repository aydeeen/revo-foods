<?php
// phpcs:ignoreFile

/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

$fopr_facebook_link      = get_field( 'facebook_link', 'option' ) ?: false;
$fopr_instagram_link     = get_field( 'instagram_link', 'option' ) ?: false;
$fopr_header_button      = get_field( 'header_button', 'option' ) ?: false;
$fopr_header_button_text = get_field( 'header_button_text', 'option' ) ?: false;
$fopr_topbar_text        = get_field( 'topbar_text', 'option' ) ?: false;
$fopr_topbar_link        = get_field( 'topbar_link', 'option' ) ?: false;
$fopr_topbar_link_text   = get_field( 'topbar_link_text', 'option' ) ?: false;
$fopr_mobile_menu_id     = foundationpress_get_mobile_menu_id();
?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="google-site-verification" content="TOYOveyeIuF0QgRoU8sO5b734yfrEpMDRQpgaM-0tQQ" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<a class="screen-reader-text skip-link" href="#main-content">
		<?php esc_html_e( 'Skip to content', 'foundationpress' ); ?>
	</a>

	<?php if ( get_theme_mod( 'foundationpress_mobile_menu_layout' ) === 'offcanvas' ) : ?>
		<?php get_template_part( 'template-parts/mobile-off-canvas' ); ?>
	<?php endif; ?>

<div class="site-header-wrapper">
	<?php if ( $fopr_topbar_text || ( $fopr_topbar_link && $fopr_topbar_link_text ) ) : ?>
		<div class="topbar">
			<?php if ( $fopr_topbar_text ) : ?>
				<p><?php echo wp_kses_post( $fopr_topbar_text ); ?></p>
			<?php endif; ?>

			<?php if ( $fopr_topbar_link && $fopr_topbar_link_text ) : ?>
				<a href="<?php echo esc_url( $fopr_topbar_link ); ?>">
					<?php echo wp_kses_post( $fopr_topbar_link_text ); ?>
				</a>
			<?php endif; ?>

			<button class="topbar__close" type="button" aria-label="<?php esc_attr_e( 'Close announcement bar', 'foundationpress' ); ?>">
				<svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg">
					<path d="M4.5 4.5L13.5 13.5" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
					<path d="M13.5 4.5L4.5 13.5" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
				</svg>
			</button>
		</div>
	<?php endif; ?>

	<header class="site-header" role="banner">
		<div class="site-title-bar title-bar" <?php foundationpress_title_bar_responsive_toggle(); ?>>
			<div class="title-bar-left">
				<button aria-label="<?php esc_html_e( 'Main Menu', 'foundationpress' ); ?>" aria-controls="<?php echo esc_attr( $fopr_mobile_menu_id ); ?>" aria-expanded="false" class="menu-icon" type="button" data-toggle="<?php echo esc_attr( $fopr_mobile_menu_id ); ?>">
                    <img src="<?php fopr_assets_uri(); ?>/images/rainbow-menu.svg" alt="" width="33" height="33">
                </button>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-header__logo">
                    <img src="<?php fopr_assets_uri(); ?>/images/logo-black.svg" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
				</a>
			</div>
		</div>
		<nav class="site-navigation top-bar" aria-label="<?php esc_attr_e( 'Primary navigation', 'foundationpress' ); ?>" id="<?php echo esc_attr( $fopr_mobile_menu_id ); ?>">
			<div class="top-bar-left">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-header__logo">
                    <img src="<?php fopr_assets_uri(); ?>/images/logo-black.svg" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
				</a>
			</div>
			<div class="top-bar-right">
				<?php foundationpress_top_bar_r(); ?>
				<?php if ( ! get_theme_mod( 'foundationpress_mobile_menu_layout' ) || get_theme_mod( 'foundationpress_mobile_menu_layout' ) === 'topbar' ) : ?>
					<?php get_template_part( 'template-parts/mobile-top-bar' ); ?>
				<?php endif; ?>
            </div>
		   
			<div class="site-header__socials-wrapper">
				<?php if ( $fopr_header_button && $fopr_header_button_text ) : ?>
					<div class="button-wrapper">
						<a href="<?php echo esc_url( $fopr_header_button ); ?>" class="button" target="_blank" rel="noopener noreferrer">
							<?php echo esc_html( $fopr_header_button_text ); ?>
						</a>
					</div>
				<?php endif; ?>
                <?php if ( have_rows( 'header_socials', 'option' ) ) : ?>
                    <?php while ( have_rows( 'header_socials', 'option' ) ) :
                        the_row();
                        $link       = get_sub_field( 'link' ) ?: false;
						$icon       = get_sub_field( 'icon' ) ?: false;
						$icon_hover = get_sub_field( 'icon_hover' ) ?: false;
						$social_label = $icon ? get_post_meta( $icon, '_wp_attachment_image_alt', true ) : '';
						$social_label = $social_label ?: __( 'Social media', 'foundationpress' );
						?>
							<a href="<?php echo esc_url( $link ); ?>" target="_blank" rel="noopener noreferrer" class="social" aria-label="<?php echo esc_attr( $social_label ); ?>">
								<?php echo wp_get_attachment_image( $icon, 'full', false, [ 'alt' => '' ] ); ?>
								<?php echo wp_get_attachment_image( $icon_hover, 'full', false, [ 'alt' => '' ] ); ?>
							</a>
                    <?php endwhile; ?>
                <?php endif; ?>
			</div>
		</nav>
	</header>
</div>

<div id="main-content" tabindex="-1">
