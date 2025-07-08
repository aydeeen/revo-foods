<?php
// phpcs:ignoreFile

/**
 * Grid Cards Block Template.
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

use FoundationPress\Blocks\Block_Grid_Cards;

$settings = $block;
$block    = new Block_Grid_Cards( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$card_1_image        = get_field( 'card_1_image' ) ?: false;
$card_1_image_mobile = get_field( 'card_1_image' ) ?: false;
$card_1_title        = get_field( 'card_1_title' ) ?: false;
$card_1_button       = get_field( 'card_1_button' ) ?: false;

$card_2_image        = get_field( 'card_2_image' ) ?: false;
$card_2_image_mobile = get_field( 'card_2_image' ) ?: false;
$card_2_title        = get_field( 'card_2_title' ) ?: false;
$card_2_subtitle     = get_field( 'card_2_subtitle' ) ?: false;
$card_2_button       = get_field( 'card_2_button' ) ?: false;

$card_3_image        = get_field( 'card_3_image' ) ?: false;
$card_3_image_mobile = get_field( 'card_3_image_mobile' ) ?: false;
$card_3_title        = get_field( 'card_3_title' ) ?: false;
$card_3_subtitle     = get_field( 'card_3_subtitle' ) ?: false;
$card_3_button_1     = get_field( 'card_3_button_1' ) ?: false;
$card_3_button_2     = get_field( 'card_3_button_2' ) ?: false;

$card_4_image        = get_field( 'card_4_image' ) ?: false;
$card_4_image_mobile = get_field( 'card_4_image_mobile' ) ?: false;
$card_4_title        = get_field( 'card_4_title' ) ?: false;
$card_4_button       = get_field( 'card_4_button' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-grid-cards <?php echo esc_attr( $class_names ); ?>">
    <div class="section__inner grid-x grid-padding-x grid-padding-y">
	    <div class="cell">
            <div class="b-grid-cards__layout">
                <div class="b-grid-cards__card b-grid-cards__card--1"> 
                    <?php echo wp_get_attachment_image( $card_1_image, 'full', false ); ?>
                    <?php echo wp_get_attachment_image( $card_1_image_mobile, 'full', false ); ?>
                    <h3><?php echo esc_html( $card_1_title ); ?></h3>
                    <a href="<?php echo esc_url( $card_1_button['url'] ); ?>" target="<?php echo esc_attr( $card_1_button['target'] ? $card_1_button['target'] : '_self' ); ?>" class="button">
                        <?php echo esc_html( $card_1_button['title'] ); ?>
                    </a>  
                </div>
                <div class="b-grid-cards__card b-grid-cards__card--2"> 
                    <?php echo wp_get_attachment_image( $card_2_image, 'full', false ); ?>
                    <?php echo wp_get_attachment_image( $card_2_image_mobile, 'full', false ); ?>
                    <div>
                        <h3><?php echo esc_html( $card_2_title ); ?></h3>
                        <h4><?php echo esc_html( $card_2_subtitle ); ?></h4>
                    </div>
                    <a href="<?php echo esc_url( $card_2_button['url'] ); ?>" target="<?php echo esc_attr( $card_2_button['target'] ? $card_2_button['target'] : '_self' ); ?>" class="button">
                        <?php echo esc_html( $card_2_button['title'] ); ?>
                    </a> 
                </div>
                <div class="b-grid-cards__card b-grid-cards__card--3">
                    <?php echo wp_get_attachment_image( $card_3_image, 'full', false ); ?>
                    <?php echo wp_get_attachment_image( $card_3_image_mobile, 'full', false ); ?>
                    <div>
                        <h4><?php echo esc_html( $card_3_subtitle ); ?></h4>
                        <h3><?php echo wp_kses_post( $card_3_title ); ?></h3>
                    </div>
                    <div class="">
                        <a href="<?php echo esc_url( $card_3_button_1['url'] ); ?>" target="<?php echo esc_attr( $card_3_button_1['target'] ? $card_3_button_1['target'] : '_self' ); ?>" class="button">
                            <?php echo esc_html( $card_3_button_1['title'] ); ?>
                        </a>
                        <a href="<?php echo esc_url( $card_3_button_2['url'] ); ?>" target="<?php echo esc_attr( $card_3_button_2['target'] ? $card_3_button_2['target'] : '_self' ); ?>" class="button">
                            <?php echo esc_html( $card_3_button_2['title'] ); ?>
                        </a>
                    </div>    
                </div>
                <div class="b-grid-cards__card b-grid-cards__card--4"> 
                    <?php echo wp_get_attachment_image( $card_4_image, 'full', false ); ?>
                    <?php echo wp_get_attachment_image( $card_4_image_mobile, 'full', false ); ?>
                    <h3><?php echo esc_html( $card_4_title ); ?></h3>
                    <a href="<?php echo esc_url( $card_4_button['url'] ); ?>" target="<?php echo esc_attr( $card_4_button['target'] ? $card_4_button['target'] : '_self' ); ?>" class="button">
                        <?php echo esc_html( $card_4_button['title'] ); ?>
                    </a> 
                </div>
            </div>
	    </div>
	</div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
