<?php
// phpcs:ignoreFile

/**
 * Reseller Block Template.
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

use FoundationPress\Blocks\Block_Reseller;

$settings = $block;
$block    = new Block_Reseller( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();

$bg_image    = get_field( 'bg_image' ) ?: false;
$title       = get_field( 'title' ) ?: false;
$link_1      = get_field( 'link_1' ) ?: false;
$link_1_text = get_field( 'link_1_text' ) ?: false;
$link_2      = get_field( 'link_2' ) ?: false;
$link_2_text = get_field( 'link_2_text' ) ?: false;
$button      = get_field( 'button' ) ?: false;
$button_text = get_field( 'button_text' ) ?: false;
$image       = get_field( 'image' ) ?: false;
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-reseller <?php echo esc_attr( $class_names ); ?>" style="background-image: url('<?php echo esc_url( $bg_image['url'] ); ?>');">
	<div class="section__inner grid-x grid-padding-x grid-padding-y align-middle">

		<div class="cell large-4">
			<div>
                <h2 class="b-reseller__title"><?php echo wp_kses_post( $title ); ?></h2>

                <?php if ( $link_1 ) : ?>
                    <div class="b-reseller__link-wrapper">
                        <a href="<?php echo esc_url( $link_1 ); ?>">
                            <svg width="20" height="23" viewBox="0 0 20 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="position-relative">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M19.3332 8H13.9998V0H5.99984V8H0.666504L9.99984 17.3333L19.3332 8ZM8.6665 10.6667V2.66667H11.3332V10.6667H12.8932L9.99984 13.56L7.1065 10.6667H8.6665ZM19.3332 22.6667V20H0.666504V22.6667H19.3332Z"
                                    fill="#F9A259" />
                            </svg>
                            <span><?php echo esc_html( $link_1_text ); ?></span>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if ( $link_2 ) : ?>
                    <div class="b-reseller__link-wrapper">
                        <a href="<?php echo esc_url( $link_2 ); ?>">
                            <svg width="20" height="23" viewBox="0 0 20 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="position-relative">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M19.3332 8H13.9998V0H5.99984V8H0.666504L9.99984 17.3333L19.3332 8ZM8.6665 10.6667V2.66667H11.3332V10.6667H12.8932L9.99984 13.56L7.1065 10.6667H8.6665ZM19.3332 22.6667V20H0.666504V22.6667H19.3332Z"
                                    fill="#F9A259" />
                            </svg>
                            <span><?php echo esc_html( $link_2_text ); ?></span>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if ( $button ) : ?>
                    <div class="b-reseller__button-wrapper">
                        <a href="<?php echo esc_url( $button ); ?>" class="button">
                            <svg width="25" height="18" viewBox="0 0 25 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="email">
                                    <path id="Combined Shape" fill-rule="evenodd" clip-rule="evenodd" d="M23.4375 0H1.5625C0.782812 0 0.164062 0.608727 0.046875 1.39255L12.5 9.98509L24.9531 1.39255C24.8359 0.608727 24.2172 0 23.4375 0ZM0 14.7142V3.31855L8.42813 9.13418L0 14.7142ZM25 14.7142L16.5719 9.13418L25 3.31855V14.7142ZM12.9297 11.6476L15.1406 10.1225L24.95 16.6189C24.8297 17.3962 24.2141 18 23.4375 18H1.5625C0.785938 18 0.170312 17.3962 0.05 16.6189L9.85938 10.1209L12.0703 11.6476C12.2016 11.7376 12.35 11.7818 12.5 11.7818C12.65 11.7818 12.7984 11.7376 12.9297 11.6476Z" fill="#F9A259"/>
                                </g>
                            </svg>
                            <span><?php echo esc_html( $button_text ); ?></span>
                        </a>
                    </div>
                <?php endif; ?>

			</div>
		</div>

		<div class="cell large-8">
			<div class="b-reseller__image-wrapper">
				<?php echo wp_get_attachment_image( $image, 'full', false ); ?>
			</div>
		</div>

	</div>
</section>

<?php
// important: reset $block variable to initial value.
$block = $settings;
