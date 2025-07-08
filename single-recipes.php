<?php
// phpcs:ignoreFile

/**
 * The template for displaying single recipe post.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package _s
 */

get_header();

$single_recipe_breadcrumbs_link = get_field( 'single_recipe_breadcrumbs_link', 'option' ) ?: false;
$single_recipe_breadcrumbs_text = get_field( 'single_recipe_breadcrumbs_text', 'option' ) ?: false;
$cook_time                      = get_field( 'cook_time' ) ?: false;
$cook_time                      = get_field( 'cook_time' ) ?: false;
?>

<div class="single-recipe">
   <div class="single-recipe__boxes-wrapper">
      <div class="single-recipe__box-1">
         <div class="single-recipe__box-1-top-part">
            <a href="<?php echo esc_url( $single_recipe_breadcrumbs_link ); ?>" class="link">
               <svg width="32" height="9" viewBox="0 0 32 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0.646447 4.14645C0.451184 4.34171 0.451184 4.65829 0.646447 4.85355L3.82843 8.03553C4.02369 8.2308 4.34027 8.2308 4.53553 8.03553C4.7308 7.84027 4.7308 7.52369 4.53553 7.32843L1.70711 4.5L4.53553 1.67157C4.7308 1.47631 4.7308 1.15973 4.53553 0.964466C4.34027 0.769204 4.02369 0.769204 3.82843 0.964466L0.646447 4.14645ZM31 5C31.2761 5 31.5 4.77614 31.5 4.5C31.5 4.22386 31.2761 4 31 4V5ZM1 5H31V4H1V5Z" fill="#1E5064"/>
               </svg>
               <?php echo esc_html( $single_recipe_breadcrumbs_text ); ?>
            </a>
            <p class="date"><?php echo get_the_date( 'M d, Y' ); ?></p>
         </div>
         <h1 class="single-recipe__box-1-title"><?php the_title(); ?></h1>
         <div class="single-recipe__box-1-middle-part">
            <span><?php pll_e( 'PRODUCTS' ); ?></span>
            <?php $cat = get_the_category(); ?>
            <span><?php echo $cat[0]->cat_name; ?></span>
         </div>
         <div class="single-recipe__box-1-excerpt"><?php the_excerpt(); ?></div>
         <p class="single-recipe__box-1-cook-time"><?php pll_e( 'Cook Time' ); ?></p>
         <p class="single-recipe__box-1-time"><?php echo esc_html( $cook_time ); ?></p>
      </div>
      <div class="single-recipe__box-2">
         <div class="single-recipe__box-2-featured-image-wrapper">
            <?php echo esc_url( the_post_thumbnail( 'full' ) ); ?>
         </div>
         <?php if ( in_category( 'salmon' ) ) { ?>
            <div class="single-recipe__box-2-bottom-part" style="background: #E8F4FC;">
               <img src="<?php fopr_assets_uri(); ?>/images/salmon.png" alt="Salmon">
         <?php } else if ( in_category( 'salmon-spread' ) ) { ?>
            <div class="single-recipe__box-2-bottom-part" style="background: #E8F4FC;"> 
               <img src="<?php fopr_assets_uri(); ?>/images/spread.png" alt="Salmon Spread">
         <?php } else if ( in_category( 'tuna' ) ) { ?>
            <div class="single-recipe__box-2-bottom-part" style="background: #F6DBC4;"> 
               <img src="<?php fopr_assets_uri(); ?>/images/tuna.png" alt="Tuna">
         <?php } else if ( in_category( 'el-blanco' ) ) { ?>
            <div class="single-recipe__box-2-bottom-part" style="background: #DEF3E9;"> 
               <img src="<?php fopr_assets_uri(); ?>/images/el-blanco.png" alt="El Blanco" style="max-height: 118px; margin-right: 20px;">
         <?php } else if ( in_category( 'the-filet' ) ) { ?>
            <div class="single-recipe__box-2-bottom-part" style="background: #E8F4FC;"> 
               <img src="<?php fopr_assets_uri(); ?>/images/the-filet.png" alt="The Filet" style="max-height: 118px; margin-right: 20px;">
         <?php } else if ( in_category( 'the-filet-asian-fusion-style' ) ) { ?>
            <div class="single-recipe__box-2-bottom-part" style="background: #E8F4FC;"> 
               <img src="<?php fopr_assets_uri(); ?>/images/the-filet-asian-fusion-style.png" alt="The Filet Asian Fusion Style" style="max-height: 118px; margin-right: 20px;">
         <?php } else if ( in_category( 'the-filet-pink-pepper-and-lemon' ) ) { ?>
            <div class="single-recipe__box-2-bottom-part" style="background: #E8F4FC;"> 
               <img src="<?php fopr_assets_uri(); ?>/images/the-filet-pink-pepper-and-lemon.png" alt="The Filet Pink Pepper and Lemon" style="max-height: 118px; margin-right: 20px;">
         <?php } else if ( in_category( 'the-prime-cut' ) ) { ?>
            <div class="single-recipe__box-2-bottom-part" style="background: #F6DBC4;"> 
               <img src="<?php fopr_assets_uri(); ?>/images/the-prime-cut.png" alt="The Prime Cut" style="max-height: 118px; margin-right: 20px;">
         <?php } else { ?> 
            <div class="single-recipe__box-2-bottom-part" style="background: #DEF3E9"> 
               <img src="<?php fopr_assets_uri(); ?>/images/gravlax.png" alt="Gravlax">
         <?php } ?>   
            <div class="content">
               <span><?php pll_e( 'the recipe features' ); ?></span>
               <span><?php echo $cat[0]->cat_name; ?></span>
            </div>
            <a href="<?php the_field( 'product_link' ); ?>" class="link">
               <span><?php pll_e( 'View Product' ); ?></span>
               <svg width="7" height="10" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M6.36235 4.99998C6.36235 5.16902 6.28687 5.33805 6.13621 5.46693L1.39296 9.52257C1.09123 9.78056 0.602031 9.78056 0.300424 9.52257C-0.00118307 9.26468 -0.00118307 8.84648 0.300424 8.58846L4.49751 4.99998L0.300571 1.41147C-0.00103659 1.15348 -0.00103659 0.735315 0.300571 0.477448C0.602178 0.219332 1.09138 0.219332 1.39311 0.477448L6.13636 4.53303C6.28704 4.66197 6.36235 4.831 6.36235 4.99998Z" fill="#1E5064"/>
               </svg>
            </a>
         </div>
      </div>   
	  <div class="single-recipe__box-3">
		 <h2 class="single-recipe__box-3-title"><?php pll_e( 'Ingredients' ); ?></h2>
		 <ul class="single-recipe__box-3-list">
			<?php if ( have_rows( 'ingredients' ) ): ?>
				<?php while ( have_rows( 'ingredients' ) ): the_row();
               $ingredient = get_sub_field( 'ingredient' ) ?: false;
					?>
                  <li>
                     <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.3019 1.02928C13.774 0.598156 14.5793 -0.129365 15.3013 0.247868C16.9342 1.09917 15.3159 2.94677 14.3885 4.00547C14.2593 4.15307 14.1434 4.28534 14.0517 4.39743C13.2555 5.38555 12.4347 6.34973 11.6138 7.31391C11.2036 7.79581 10.7933 8.27771 10.3861 8.7626C10.0136 9.19854 9.65829 9.65128 9.30154 10.1059C8.75424 10.8033 8.20347 11.5052 7.58143 12.1577C7.54962 12.1915 7.51658 12.2268 7.48236 12.2634C6.8893 12.8974 5.94557 13.9062 5.02666 13.8553C4.22135 13.8283 3.52712 13.2625 2.99951 12.7236C1.74989 11.4572 0.0559656 9.46322 0.000427067 7.60396C-0.0273422 6.17586 1.30558 6.60699 2.11089 7.19978C2.85075 7.75612 3.47972 8.39617 4.1127 9.04029C4.43004 9.36321 4.74838 9.68715 5.0822 10.0021C5.52651 9.19373 6.24851 8.49315 6.91497 7.84647C7.63863 7.12754 8.31952 6.39825 9.00409 5.66503C9.42283 5.21654 9.84294 4.76657 10.2751 4.3166C10.6861 3.88538 11.0795 3.43691 11.4728 2.98844C12.0625 2.31598 12.6522 1.64354 13.3019 1.02928ZM1.32063 7.82377C1.42222 7.80381 1.47302 7.80381 1.52381 7.80381C1.16825 7.72377 0.914286 7.70377 0.761905 7.74377C0.965079 7.78377 1.11746 7.80381 1.32063 7.82377Z" fill="#9BD6D7"/>
                     </svg>
                     <?php echo esc_html( $ingredient ); ?>
                  </li>       
			   <?php endwhile; ?>
			<?php endif; ?>
		 </ul>
	  </div> 
      <div class="single-recipe__box-4">
         <h2 class="single-recipe__box-4-title"><?php pll_e( 'Preparation' ); ?></h2>
         <ul class="single-recipe__box-4-list">
            <?php $number = 1; ?>
            <?php if ( have_rows( 'preparation' ) ): ?>
               <?php while ( have_rows( 'preparation' ) ): the_row();
                  $preparation_step = get_sub_field( 'preparation_step' ) ?: false; 
                  ?>
                     <li>
                        <span><?php echo esc_html( $number ); ?></span>
                        <span><?php echo esc_html( $preparation_step ); ?></span>
                     </li>    
                  <?php $number++; ?>   
               <?php endwhile; ?>
            <?php endif; ?>
         </ul>
      </div>
   </div>
   <div class="section section--full single-recipe__latest-recipes">
      <div class="section__inner grid-x grid-padding-x grid-padding-y">
         <div class="cell">
            <div class="single-recipe__latest-recipes-top-part">
               <h2 class="title"><?php pll_e( 'Latest Recipes' ); ?></h2>
               <a href="<?php echo esc_url( $single_recipe_breadcrumbs_link ); ?>" class="link"><?php pll_e( 'View All' ); ?></a>
            </div>
         </div>
         <div class="cell">
            <div class="single-recipe__latest-recipes-main-part">
               <?php
                  $args  = [
                     'post_type'      => 'recipes',
                     'posts_per_page' => '3',
                     'post__not_in'   => [ get_the_ID() ],
                  ];
                  $query = new WP_Query( $args );
                  if ( $query->have_posts() ) {
                     while ( $query->have_posts() ) :
                        $query->the_post();
                        get_template_part( 'template-parts/recipe-short' );
                     endwhile;
                  }
                  wp_reset_postdata(); ?>
            </div>
         </div>
      </div>
   </div>
</div>

<?php
get_footer();
