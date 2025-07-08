<?php
// phpcs:ignoreFile

/**
 * Latest Posts Block Template.
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

use FoundationPress\Blocks\Block_Latest_Posts;

$settings = $block;
$block    = new Block_Latest_Posts( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$title         = get_field( 'title' ) ?: false;
$button        = get_field( 'button' ) ?: false;
$button_text = get_field( 'button_text' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-latest-posts <?php echo esc_attr( $class_names ); ?>">
	<div class="section__inner grid-x grid-padding-x grid-padding-y">
      <div class="cell">
         <h2 class="b-latest-posts__title"><?php echo esc_html( $title ); ?></h2>
      </div>
      <div class="cell">
         <div class="b-latest-posts__posts">
            <?php
				$args  = [
					'orderby'        => 'post_date',
					'post_type'      => 'post',
					'post_status'    => 'publish',
               'posts_per_page' => 3,
				];
				$query = new WP_Query( $args );
				if ( $query->have_posts() ) :
					while ( $query->have_posts() ) :
						$query->the_post();
						?>
							<div class="b-latest-posts__post">
								<a href="<?php the_permalink(); ?>" class="b-latest-posts__post-image-link">
									<?php the_post_thumbnail(); ?>
								</a>
                        <h3 class="b-latest-posts__post-title">
                           <a href="<?php the_permalink(); ?>">
                              <?php the_title(); ?>
                           </a>
                        </h3>
							</div>
						<?php
					endwhile;
				endif;
				wp_reset_postdata();
				?>
         </div>
      </div>
      <div class="cell">
         <div class="b-latest-posts__button-wrapper">
            <a href="<?php echo esc_url( $button ); ?>" class="button">
               <?php echo esc_html( $button_text ); ?>
            </a>
		   </div>
      </div>
	</div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;

