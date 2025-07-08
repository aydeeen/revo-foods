<?php
// phpcs:ignoreFile

/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>
<div class="main-container">
	<div class="main-grid">
		<main class="main-content">
         <section class="section section--full">
	         <div class="section__inner grid-x grid-padding-x grid-padding-y">
		         <div class="cell">
                  <?php while ( have_posts() ) : the_post();
                     get_template_part( 'template-parts/content', 'page' );
                     comments_template();
                  endwhile; ?>
         	   </div>
            </div>
         </section>
		</main>
	</div>
</div>

<?php
get_footer();
