<?php
// phpcs:ignoreFile

/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

$footer_logo            = get_field( 'footer_logo', 'option' ) ?: false;
$footer_info            = get_field( 'footer_info', 'option' ) ?: false;
$footer_rights_reserved = get_field( 'footer_rights_reserved', 'option' ) ?: false;
$footer_design_by       = get_field( 'footer_design_by', 'option' ) ?: false;
$footer_button          = get_field( 'footer_button', 'option' ) ?: false;
$footer_button_text     = get_field( 'footer_button_text', 'option' ) ?: false;
?>

<footer class="section section--full footer">
	<div class="section__inner grid-x grid-padding-x grid-padding-y">

	   <div class="cell medium-6 large-4">
	   	<div class="footer__info-wrapper">
            <?php echo wp_get_attachment_image( $footer_logo, 'full', false, [ 'class' => 'footer__logo' ] ); ?>
            <p class="footer__info"><?php echo wp_kses_post( $footer_info ); ?></p>
	   	</div>
      </div>

		<div class="cell medium-6 large-4">
			<div>
				<h3 class="footer__title footer__title--1"><?php esc_html_e( 'Sitemap', 'foundationpress' ); ?></h3>
				<nav class="legal-navigation" role="navigation">
				   <?php foundationpress_footer_legal_nav(); ?>
				</nav>
                <div class="footer__button-wrapper">
                    <a href="<?php echo esc_url( $footer_button ); ?>" class="button" target="_blank">
                        <?php echo esc_html( $footer_button_text ); ?>
                    </a>
                </div>
			</div>
		</div>

      <div class="cell medium-12 large-4">
         <div class="footer__col-3">
            <div>
               <h3 class="footer__title footer__title--2"><?php echo esc_html( 'Social Media' ); ?></h3>
               <div class="footer__socials-wrapper">
                  <?php if ( have_rows( 'footer_socials', 'option' ) ): ?>
                     <?php while ( have_rows( 'footer_socials', 'option' ) ): the_row();
                        $link       = get_sub_field( 'link' ) ?: false;
                        $icon       = get_sub_field( 'icon' ) ?: false;
                        $icon_hover = get_sub_field( 'icon_hover' ) ?: false;
                        ?>
                           <a href="<?php echo esc_url( $link ); ?>" target="_blank" class="footer__social">
                              <?php echo wp_get_attachment_image( $icon, 'full', false ); ?>
                              <?php echo wp_get_attachment_image( $icon_hover, 'full', false ); ?>
                           </a>
                     <?php endwhile; ?>
                  <?php endif; ?>
               </div>
               <div class="margin-top-3">
                  <h3 class="footer__title footer__title--3"><?php echo esc_html( 'Revo Shop' ); ?></h3>
                  <div class="button-wrapper">
                     <a href="<?php echo esc_url( 'https://shop-revo-foods.com/' ); ?>" class="button" target="_blank">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path fill-rule="evenodd" clip-rule="evenodd" d="M19.5527 11.964C19.1449 12.708 18.3532 13.2 17.4535 13.2H8.51684L7.19733 15.6H21.592V18H7.19733C5.374 18 4.22243 16.044 5.09811 14.436L6.7175 11.508L2.39911 2.4H0V0H3.92254L5.05012 2.4H22.8035C23.7152 2.4 24.291 3.384 23.8471 4.176L19.5527 11.964ZM20.7643 4.8H6.1897L9.03265 10.8H17.4535L20.7643 4.8ZM7.19733 19.2C5.87782 19.2 4.81021 20.28 4.81021 21.6C4.81021 22.92 5.87782 24 7.19733 24C8.51684 24 9.59644 22.92 9.59644 21.6C9.59644 20.28 8.51684 19.2 7.19733 19.2ZM16.8058 21.6C16.8058 20.28 17.8734 19.2 19.1929 19.2C20.5124 19.2 21.592 20.28 21.592 21.6C21.592 22.92 20.5124 24 19.1929 24C17.8734 24 16.8058 22.92 16.8058 21.6Z" fill="#9BD6D7"/>
                        </svg>
                        <?php echo esc_html( 'Order Now' ); ?>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="cell">
         <div class="footer__bottom-part">
            <p><?php echo wp_kses_post( $footer_rights_reserved ); ?></p>
	         <p><?php echo wp_kses_post( $footer_design_by ); ?></p>
         </div>
      </div>

	</div>
</footer>

<div id="back-to-top">
   <div class="icon-wrapper">
	   <img src="<?php fopr_assets_uri(); ?>/images/back-to-top.svg" alt="Back To Top">
   </div>
</div>

<?php if ( get_theme_mod( 'foundationpress_mobile_menu_layout' ) === 'offcanvas' ) : ?>
	</div><!-- Close off-canvas content -->
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
