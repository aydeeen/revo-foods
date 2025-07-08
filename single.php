<?php
// phpcs:ignoreFile

/**
 * The template for displaying all single articles
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); 

$home_link = get_field( 'home_link', 'option' ) ?: false;
$blog_link = get_field( 'blog_link', 'option' ) ?: false;
?>

<section class="section section--full">
	<div class="section__inner grid-x grid-padding-x grid-padding-y single-post">

      <div class="cell">
         <div class="single-post__breadcrumbs">
            <a href="<?php echo esc_url( $home_link ); ?>"><?php esc_html_e( 'Home', 'foundationpress' ); ?></a> > <a href="<?php echo esc_url( $blog_link ); ?>"><?php esc_html_e( 'Blog', 'foundationpress' ); ?></a> > <span><?php the_title(); ?></span>
         </div>
         <h1 class="single-post__title"><?php the_title(); ?></h1>
         <p class="single-post__meta"><?php echo get_the_date( 'F d, Y' ); ?></p>      
      </div>

		<div class="cell large-9">
			<div>
				<?php echo esc_url( the_post_thumbnail( 'full', ['class' => 'single-post__featured-image'] ) ); ?>
				<div class="single-post__content"><?php the_content(); ?></div>
			</div>
		</div>
      
		<div class="cell large-3">
			<div class="margin-top-1 large-margin-top-0">
            <h2 class="single-post__sidebar-title"><?php esc_html_e( 'Latest Articles', 'foundationpress' ); ?></h2>
            <div class="single-post__sidebar-posts">
               <?php
               $args = [
                  'posts_per_page' => 6,
                  'post_type'      => 'post',
               ];
               $posts = new WP_Query( $args );
               while ( $posts->have_posts() ): $posts->the_post(); ?>
                  <div class="single-post__sidebar-post">
                     <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail(); ?>
                     </a>
                     <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                     </a>
                  </div>
               <?php endwhile; ?>
               <?php wp_reset_postdata(); ?>
            </div>	
			</div>			
		</div>

	</div>
</section>

<?php
get_footer();
