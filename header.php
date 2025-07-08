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

	<?php if ( get_theme_mod( 'foundationpress_mobile_menu_layout' ) === 'offcanvas' ) : ?>
		<?php get_template_part( 'template-parts/mobile-off-canvas' ); ?>
	<?php endif; ?>

<div class="site-header-wrapper">
    <div class="topbar">
        <p><?php echo wp_kses_post( $fopr_topbar_text ); ?></p>
        <img src="<?php fopr_assets_uri(); ?>/images/fn-logo-for-topbar.png" alt="Funder Nation Logo">
        <a href="<?php echo esc_url( $fopr_topbar_link ); ?>" target="_blank">
            <?php echo esc_html( $fopr_topbar_link_text ); ?>
        </a>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6 19L18 7M6 7L18 19" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
	<header class="site-header" role="banner">
		<div class="site-title-bar title-bar" <?php foundationpress_title_bar_responsive_toggle(); ?>>
			<div class="title-bar-left">
				<button aria-label="<?php esc_html_e( 'Main Menu', 'foundationpress' ); ?>" class="menu-icon" type="button" data-toggle="<?php foundationpress_mobile_menu_id(); ?>" width="33" height="33">
                    <img src="<?php fopr_assets_uri(); ?>/images/rainbow-menu.svg" alt="Menu">
                </button>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-header__logo">
                    <img src="<?php fopr_assets_uri(); ?>/images/logo-black.svg" alt="Logo">
				</a>
			</div>
		</div>
		<nav class="site-navigation top-bar" role="navigation" id="<?php foundationpress_mobile_menu_id(); ?>">
			<div class="top-bar-left">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-header__logo">
                    <img src="<?php fopr_assets_uri(); ?>/images/logo-black.svg" alt="Logo">
				</a>
			</div>
			<div class="top-bar-right">
				<?php foundationpress_top_bar_r(); ?>
				<?php if ( ! get_theme_mod( 'foundationpress_mobile_menu_layout' ) || get_theme_mod( 'foundationpress_mobile_menu_layout' ) === 'topbar' ) : ?>
					<?php get_template_part( 'template-parts/mobile-top-bar' ); ?>
				<?php endif; ?>
            </div>
		   
			<div class="site-header__socials-wrapper">
                <div class="button-wrapper">
                    <a href="<?php echo esc_url( $fopr_header_button ); ?>" class="button" target="_blank">
                        <?php echo esc_html( $fopr_header_button_text ); ?>
                    </a>
                </div>
                <?php if ( have_rows( 'header_socials', 'option' ) ) : ?>
                    <?php while ( have_rows( 'header_socials', 'option' ) ) :
                        the_row();
                        $link       = get_sub_field( 'link' ) ?: false;
                        $icon       = get_sub_field( 'icon' ) ?: false;
                        $icon_hover = get_sub_field( 'icon_hover' ) ?: false;
                        ?>
                            <a href="<?php echo esc_url( $link ); ?>" target="_blank" class="social">
                                <?php echo wp_get_attachment_image( $icon, 'full', false ); ?>
                                <?php echo wp_get_attachment_image( $icon_hover, 'full', false ); ?>
                            </a>
                    <?php endwhile; ?>
                <?php endif; ?>
			</div>
		</nav>
	</header>
</div>
