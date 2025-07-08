<?php
// phpcs:ignoreFile

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header();

$bg_image        = get_field( 'bg_image', 363 ) ?: false;
$cta_bg_image    = get_field( 'cta_bg_image', 363 ) ?: false;
$cta_subtitle    = get_field( 'cta_subtitle', 363 ) ?: false;
$cta_title       = get_field( 'cta_title', 363 ) ?: false;
$cta_button      = get_field( 'cta_button', 363 ) ?: false;
$cta_button_text = get_field( 'cta_button_text', 363 ) ?: false;
?>

<?php echo wp_get_attachment_image( $bg_image, 'full', false ); ?>

<section class="section section--full blog">
	<div class="section__inner grid-x grid-padding-x grid-padding-y">
		<div class="cell">
         <div class="blog__posts">
            <?php echo do_shortcode("[ajax_load_more post_type='post' posts_per_page='6']"); ?>
         </div>
		</div>
	</div>
</section>

<section class="section section--full b-cta" style="background-image: url('<?php echo esc_url( $cta_bg_image['url'] ); ?>');">
   <div class="section__inner grid-x grid-padding-x grid-padding-y"> 
	   <div class="cell">
         <div class="text-center">
            <h3 class="b-cta__subtitle"><?php echo esc_html( $cta_subtitle ); ?></h3>
				<h2 class="b-cta__title"><?php echo esc_html( $cta_title ); ?></h2>
			   <div class="b-cta__button-wrapper">
               <a href="<?php echo esc_url( $cta_button ); ?>" class="button">
                  <?php echo esc_html( $cta_button_text ); ?>
               </a>
            </div>
			</div>
	   </div>
	</div>
</section>

<?php
get_footer();
