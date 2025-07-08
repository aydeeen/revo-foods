<?php
// phpcs:ignoreFile

/*Template Name: Job Post*/

get_header();

$jp_home_link           = get_field( 'jp_home_link', 'option' ) ?: false;
$jp_careers_link        = get_field( 'jp_careers_link', 'option' ) ?: false;
$jp_sidebar_bg_image    = get_field( 'jp_sidebar_bg_image', 'option' ) ?: false;
$jp_sidebar_image       = get_field( 'jp_sidebar_image', 'option' ) ?: false;
$jp_sidebar_title       = get_field( 'jp_sidebar_title', 'option' ) ?: false;
$jp_sidebar_button      = get_field( 'jp_sidebar_button', 'option' ) ?: false;
$jp_sidebar_button_text = get_field( 'jp_sidebar_button_text', 'option' ) ?: false;
?>

<section class="section section--full job-post">
   <div class="section__inner grid-x grid-padding-x grid-padding-y job-post__grid">
      <div class="cell">
         <div>
            <div class="job-post__breadcrumbs">
               <a href="<?php echo esc_url( $jp_home_link ); ?>"><?php esc_html_e( 'Home', 'foundationpress' ); ?></a> > <a href="<?php echo esc_url( $jp_careers_link ); ?>"><?php esc_html_e( 'Careers', 'foundationpress' ); ?></a> > <span><?php the_title(); ?></span>
            </div>
            <h1 class="job-post__title"><?php the_title(); ?></h1>
         </div>
      </div>
      <div class="cell large-9">
         <div class="job-post__content"><?php the_content(); ?></div>
      </div>
      <div class="cell large-3">
         <div class="job-post__sidebar" style="background-image: url('<?php echo esc_url( $jp_sidebar_bg_image['url'] ); ?>');">
            <?php echo wp_get_attachment_image( $jp_sidebar_image, 'full', false ); ?>
            <h3 class="title"><?php echo esc_html( $jp_sidebar_title ); ?></h3>
            <div class="button-wrapper">
               <a href="<?php echo esc_url( $jp_sidebar_button ); ?>" class="button">
                  <?php echo esc_html( $jp_sidebar_button_text ); ?>
               </a>
            </div>
         </div>
      </div>
   </div>
</section>

<section class="section section--full b-join-team">
   <div class="section__inner grid-x grid-padding-x grid-padding-y">
      <div class="cell">
         <p class="margin-top-0 text-center b-join-team__description b-join-team__description--2"><?php echo esc_html_e( 'If you’re asking yourself why you should join our team?', 'foundationpress' ); ?></p>
         <div class="b-join-team__images-wrapper">
            <?php if ( have_rows( 'jp_bottom_section_images', 'option' ) ): ?>
               <?php while ( have_rows( 'jp_bottom_section_images', 'option' ) ): the_row();
                  $image = get_sub_field( 'image' ) ?: false;
                  ?>
				         <?php echo wp_get_attachment_image( $image, 'full', false ); ?>
               <?php endwhile; ?>
            <?php endif; ?>
         </div>
	   </div>
   </div>
</section>

<?php get_footer(); ?>
