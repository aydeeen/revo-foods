<?php
// phpcs:ignoreFile

/*Template Name: Recipes*/

get_header();

query_posts(
	[
		'post_type' => 'recipes',
      'posts_per_page' => -1
   ]
);

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
?>

<section class="recipes">
    <?php echo wp_get_attachment_image( $image_mobile, 'full', false, ['class' => 'recipes__hero-image'] ); ?>
    <div class="recipes__hero" style="background-image: url('<?php echo esc_url( $bg_image['url'] ); ?>');">
        <h1 class="recipes__hero-title"><?php echo wp_kses_post( $title ); ?></h1>
        <p class="recipes__hero-description"><?php echo esc_html( $description ); ?></p>
    </div>
   
    <div class="section section--full">
	    <div class="section__inner grid-x grid-padding-x grid-padding-y">
            <div class="cell">
                <div>
                    <ul class="tabs recipes__tabs" data-tabs id="recipes">
                        <li class="tabs-title is-active"><a href="#all" aria-selected="true"><?php echo esc_html_e( 'All', 'foundationpress' ); ?></a></li>
                        <li class="tabs-title"><a href="#salmon"><?php echo esc_html_e( 'Salmon', 'foundationpress' ); ?></a></li>
                        <li class="tabs-title"><a href="#salmon-spread"><?php echo esc_html_e( 'Salmon Spread', 'foundationpress' ); ?></a></li>
                        <li class="tabs-title"><a href="#tuna"><?php echo esc_html_e( 'Tuna', 'foundationpress' ); ?></a></li>
                        <li class="tabs-title"><a href="#gravlax"><?php echo esc_html_e( 'Gravlax', 'foundationpress' ); ?></a></li>
                        <li class="tabs-title"><a href="#the-filet"><?php echo esc_html_e( 'The Filet', 'foundationpress' ); ?></a></li>
                        <li class="tabs-title"><a href="#the-filet-asian-fusion-style"><?php echo esc_html_e( 'The Filet - Asian Fusion Style', 'foundationpress' ); ?></a></li>
                        <li class="tabs-title"><a href="#the-filet-pink-pepper-and-lemon"><?php echo esc_html_e( 'The Filet - Pink Pepper & Lemon', 'foundationpress' ); ?></a></li>
                        <li class="tabs-title"><a href="#el-blanco"><?php echo esc_html_e( 'El Blanco', 'foundationpress' ); ?></a></li>
                        <li class="tabs-title"><a href="#the-prime-cut"><?php echo esc_html_e( 'The Prime Cut', 'foundationpress' ); ?></a></li>
                    </ul>
                    <div class="tabs-content recipes__tabs-content" data-tabs-content="recipes">
                        <div class="tabs-panel is-active padding-0" id="all">
                            <div class="recipes__recipes-container">
                                <?php while ( have_posts() ):
                                    the_post();
                                    get_template_part( 'template-parts/recipe-short' );
                                endwhile; ?>
                            </div>
                        </div>
                        <div class="tabs-panel padding-0" id="salmon">
                            <div class="recipes__recipes-container">
                                <?php while ( have_posts() ):
                                    the_post();
                                    if ( in_category( 'salmon' ) ) {
                                        get_template_part( 'template-parts/recipe-short' );
                                    }
                                endwhile; ?>
                            </div>                  
                        </div>
                        <div class="tabs-panel padding-0" id="salmon-spread">
                            <div class="recipes__recipes-container">
                                <?php while ( have_posts() ):
                                    the_post();
                                    if ( in_category( 'salmon-spread' ) ) {
                                        get_template_part( 'template-parts/recipe-short' );
                                    }
                                endwhile; ?>  
                            </div>                  
                        </div>
                        <div class="tabs-panel padding-0" id="tuna">
                            <div class="recipes__recipes-container">
                                <?php while ( have_posts() ):
                                the_post();
                                    if ( in_category( 'Tuna' ) ) {
                                        get_template_part( 'template-parts/recipe-short' );
                                    }
                                endwhile; ?>  
                            </div>                
                        </div>
                        <div class="tabs-panel padding-0" id="gravlax">
                            <div class="recipes__recipes-container">
                                <?php while ( have_posts() ):
                                    the_post();
                                    if ( in_category( 'gravlax' ) ) {
                                        get_template_part( 'template-parts/recipe-short' );
                                    }
                                endwhile; ?>   
                            </div>               
                        </div>
                        <div class="tabs-panel padding-0" id="the-filet">
                            <div class="recipes__recipes-container">
                                <?php while ( have_posts() ):
                                    the_post();
                                    if ( in_category( 'the-filet' ) ) {
                                        get_template_part( 'template-parts/recipe-short' );
                                    }
                                endwhile; ?>   
                            </div>               
                        </div>
                        <div class="tabs-panel padding-0" id="the-filet-asian-fusion-style">
                            <div class="recipes__recipes-container">
                                <?php while ( have_posts() ):
                                    the_post();
                                    if ( in_category( 'the-filet-asian-fusion-style' ) ) {
                                        get_template_part( 'template-parts/recipe-short' );
                                    }
                                endwhile; ?>   
                            </div>               
                        </div>
                        <div class="tabs-panel padding-0" id="the-filet-pink-pepper-and-lemon">
                            <div class="recipes__recipes-container">
                                <?php while ( have_posts() ):
                                    the_post();
                                    if ( in_category( 'the-filet-pink-pepper-and-lemon' ) ) {
                                        get_template_part( 'template-parts/recipe-short' );
                                    }
                                endwhile; ?>   
                            </div>               
                        </div>
                        <div class="tabs-panel padding-0" id="el-blanco">
                            <div class="recipes__recipes-container">
                                <?php while ( have_posts() ):
                                    the_post();
                                    if ( in_category( 'el-blanco' ) ) {
                                        get_template_part( 'template-parts/recipe-short' );
                                    }
                                endwhile; ?>   
                            </div>               
                        </div>
                        <div class="tabs-panel padding-0" id="the-prime-cut">
                            <div class="recipes__recipes-container">
                                <?php while ( have_posts() ):
                                    the_post();
                                    if ( in_category( 'the-prime-cut' ) ) {
                                        get_template_part( 'template-parts/recipe-short' );
                                    }
                                endwhile; ?>   
                            </div>               
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="section section--full b-recipes-cta" style="background-image: url('<?php echo esc_url( $cta_bg_image['url'] ); ?>');">
    <div class="section__inner grid-x grid-padding-x grid-padding-y">
        <div class="cell">
            <div>
                <h2 class="b-recipes-cta__title"><?php echo wp_kses_post( $cta_title ); ?></h2>
                <div class="b-recipes-cta__button-wrapper">
                    <a href="<?php echo esc_url( $cta_button ); ?>" class="button">
                        <?php echo esc_html( $cta_button_text ); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section--full b-banner" style="background-image: url('<?php echo esc_url( $banner_bg_image['url'] ); ?>');">
   <div class="section__inner grid-x grid-padding-x grid-padding-y align-middle">
        <div class="cell large-6">
            <div class="text-center">
                <?php echo wp_get_attachment_image( $logo, 'full', false, [ 'class' => 'b-banner__logo' ] ); ?>
                <h2 class="b-banner__title"><?php echo wp_kses_post( $banner_title ); ?></h2>
                <p class="b-banner__subtitle"><?php echo esc_html( $banner_subtitle ); ?></p>
                <div class="b-banner__button-wrapper">
                    <a href="<?php echo esc_url( $banner_button ); ?>" class="button">
                        <?php echo esc_html( $banner_button_text ); ?>
                    </a>
                </div>
            </div>
        </div>
        <div class="cell large-6">
            <div>
                <?php echo wp_get_attachment_image( $banner_image, 'full', false ); ?>
            </div>
        </div>
	</div>
</section>

<?php get_footer(); ?>
