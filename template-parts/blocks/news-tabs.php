<?php
// phpcs:ignoreFile

/**
 * News Tabs Block Template.
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

use FoundationPress\Blocks\Block_News_Tabs;

$settings = $block;
$block    = new Block_News_Tabs( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$title = get_field( 'title' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-news-tabs <?php echo esc_attr( $class_names ); ?>">
   <div class="section__inner grid-x grid-padding-x grid-padding-y">
	   <div class="cell">
         <div class="text-center">
            <h2 class="b-news-tabs__title"><?php echo esc_html( $title ); ?></h2>
            <ul class="tabs b-news-tabs__tabs" data-tabs id="news">
               <?php if (is_page( '907' )) { ?>
                  <li class="tabs-title is-active"><a href="#english" aria-selected="true"><?php echo esc_html_e( 'English', 'foundationpress' ); ?></a></li>
                  <li class="tabs-title"><a href="#german"><?php echo esc_html_e( 'German', 'foundationpress' ); ?></a></li>
                  <li class="tabs-title"><a href="#international"><?php echo esc_html_e( 'International', 'foundationpress' ); ?></a></li>
               <?php } 
               else { ?>
                  <li class="tabs-title is-active"><a href="#german" aria-selected="true"><?php echo esc_html_e( 'German', 'foundationpress' ); ?></a></li>
                  <li class="tabs-title"><a href="#english"><?php echo esc_html_e( 'English', 'foundationpress' ); ?></a></li>
                  <li class="tabs-title"><a href="#international"><?php echo esc_html_e( 'International', 'foundationpress' ); ?></a></li>
               <?php } ?>
            </ul>
            <div class="tabs-content b-news-tabs__tabs-content" data-tabs-content="news">
               <?php if (is_page( '907' )) { ?>
                  <div class="tabs-panel is-active" id="english">
                     <div class="b-news-tabs__tab-items">
                        <?php if ( have_rows( 'english' ) ): ?>
                           <?php while ( have_rows( 'english' ) ): the_row();
                              $logo  = get_sub_field( 'logo' ) ?: false;
                              $title = get_sub_field( 'title' ) ?: false;
                              $link  = get_sub_field( 'link' ) ?: false;
                              ?>
                                 <div class="b-news-tabs__tab-item">
                                    <div class="b-news-tabs__tab-item-image-wrapper">                           
                                       <?php echo wp_get_attachment_image( $logo, 'full', false ); ?>
                                    </div>
                                    <div class="b-news-tabs__tab-item-content">  
                                       <h5><?php echo esc_html( $title ); ?></h5>
                                       <a href="<?php echo esc_url( $link ); ?>" target="_blank">
                                          <?php echo esc_html_e( 'Read more', 'foundationpress' ); ?>
                                       </a>
                                    </div>
                                 </div>
                           <?php endwhile; ?>
                        <?php endif; ?>
                     </div>
                  </div>
                  <div class="tabs-panel is-active" id="german">
                     <div class="b-news-tabs__tab-items">
                        <?php if ( have_rows( 'german' ) ): ?>
                           <?php while ( have_rows( 'german' ) ): the_row();
                              $logo  = get_sub_field( 'logo' ) ?: false;
                              $title = get_sub_field( 'title' ) ?: false;
                              $link  = get_sub_field( 'link' ) ?: false;
                              ?>
                                 <div class="b-news-tabs__tab-item">
                                    <div class="b-news-tabs__tab-item-image-wrapper">                           
                                       <?php echo wp_get_attachment_image( $logo, 'full', false ); ?>
                                    </div>
                                    <div class="b-news-tabs__tab-item-content">  
                                       <h5><?php echo esc_html( $title ); ?></h5>
                                       <a href="<?php echo esc_url( $link ); ?>" target="_blank">
                                          <?php echo esc_html_e( 'Read more', 'foundationpress' ); ?>
                                       </a>
                                    </div>
                                 </div>
                           <?php endwhile; ?>
                        <?php endif; ?>
                     </div>
                  </div>
                  <div class="tabs-panel" id="international">
                     <div class="b-news-tabs__tab-items">
                        <?php if ( have_rows( 'other' ) ): ?>
                           <?php while ( have_rows( 'other' ) ): the_row();
                              $logo  = get_sub_field( 'logo' ) ?: false;
                              $title = get_sub_field( 'title' ) ?: false;
                              $link  = get_sub_field( 'link' ) ?: false;
                              ?>
                                 <div class="b-news-tabs__tab-item">
                                    <div class="b-news-tabs__tab-item-image-wrapper">                           
                                       <?php echo wp_get_attachment_image( $logo, 'full', false ); ?>
                                    </div>
                                    <div class="b-news-tabs__tab-item-content">  
                                       <h5><?php echo esc_html( $title ); ?></h5>
                                       <a href="<?php echo esc_url( $link ); ?>" target="_blank">
                                          <?php echo esc_html_e( 'Read more', 'foundationpress' ); ?>
                                       </a>
                                    </div>
                                 </div>
                           <?php endwhile; ?>
                        <?php endif; ?>
                     </div>
                  </div>
               <?php } 
               else { ?>
                  <div class="tabs-panel is-active" id="german">
                     <div class="b-news-tabs__tab-items">
                        <?php if ( have_rows( 'german' ) ): ?>
                           <?php while ( have_rows( 'german' ) ): the_row();
                              $logo  = get_sub_field( 'logo' ) ?: false;
                              $title = get_sub_field( 'title' ) ?: false;
                              $link  = get_sub_field( 'link' ) ?: false;
                              ?>
                                 <div class="b-news-tabs__tab-item">
                                    <div class="b-news-tabs__tab-item-image-wrapper">                           
                                       <?php echo wp_get_attachment_image( $logo, 'full', false ); ?>
                                    </div>
                                    <div class="b-news-tabs__tab-item-content">  
                                       <h5><?php echo esc_html( $title ); ?></h5>
                                       <a href="<?php echo esc_url( $link ); ?>" target="_blank">
                                          <?php echo esc_html_e( 'Read more', 'foundationpress' ); ?>
                                       </a>
                                    </div>
                                 </div>
                           <?php endwhile; ?>
                        <?php endif; ?>
                     </div>
                  </div>
                  <div class="tabs-panel" id="english">
                     <div class="b-news-tabs__tab-items">
                        <?php if ( have_rows( 'english' ) ): ?>
                           <?php while ( have_rows( 'english' ) ): the_row();
                              $logo  = get_sub_field( 'logo' ) ?: false;
                              $title = get_sub_field( 'title' ) ?: false;
                              $link  = get_sub_field( 'link' ) ?: false;
                              ?>
                                 <div class="b-news-tabs__tab-item">
                                    <div class="b-news-tabs__tab-item-image-wrapper">                           
                                       <?php echo wp_get_attachment_image( $logo, 'full', false ); ?>
                                    </div>
                                    <div class="b-news-tabs__tab-item-content">  
                                       <h5><?php echo esc_html( $title ); ?></h5>
                                       <a href="<?php echo esc_url( $link ); ?>" target="_blank">
                                          <?php echo esc_html_e( 'Read more', 'foundationpress' ); ?>
                                       </a>
                                    </div>
                                 </div>
                           <?php endwhile; ?>
                        <?php endif; ?>
                     </div>
                  </div>
                  <div class="tabs-panel" id="international">
                     <div class="b-news-tabs__tab-items">
                        <?php if ( have_rows( 'other' ) ): ?>
                           <?php while ( have_rows( 'other' ) ): the_row();
                              $logo  = get_sub_field( 'logo' ) ?: false;
                              $title = get_sub_field( 'title' ) ?: false;
                              $link  = get_sub_field( 'link' ) ?: false;
                              ?>
                                 <div class="b-news-tabs__tab-item">
                                    <div class="b-news-tabs__tab-item-image-wrapper">                           
                                       <?php echo wp_get_attachment_image( $logo, 'full', false ); ?>
                                    </div>
                                    <div class="b-news-tabs__tab-item-content">  
                                       <h5><?php echo esc_html( $title ); ?></h5>
                                       <a href="<?php echo esc_url( $link ); ?>" target="_blank">
                                          <?php echo esc_html_e( 'Read more', 'foundationpress' ); ?>
                                       </a>
                                    </div>
                                 </div>
                           <?php endwhile; ?>
                        <?php endif; ?>
                     </div>
                  </div>
               <?php } ?>
            </div>
         </div>
      </div>
   </div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
