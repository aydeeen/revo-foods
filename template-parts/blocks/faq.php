<?php
/**
 * FAQ Block Template.
 *
 * @param array      $block      Block settings and attributes.
 * @param string     $content    Block inner HTML.
 * @param bool       $is_preview Whether this is an editor preview.
 * @param int|string $post_id    Post ID where the block is saved.
 * @package FoundationPress
 */

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
// phpcs:disable WordPress.WP.GlobalVariablesOverride.Prohibited

use FoundationPress\Blocks\Block_FAQ;

$settings = $block;
$block    = new Block_FAQ( $settings );

$id          = $block->get_anchor();
$class_names = $block->get_class_names();
$title       = get_field( 'title' ) ?: false;
$description = get_field( 'description' ) ?: false;
$sections    = get_field( 'sections' ) ?: [];
$faq_items   = [];

foreach ( $sections as $section ) {
	if ( empty( $section['items'] ) ) {
		continue;
	}

	foreach ( $section['items'] as $item ) {
		if ( empty( $item['title'] ) || empty( $item['content'] ) ) {
			continue;
		}

		$faq_items[] = [
			'@type'          => 'Question',
			'name'           => wp_specialchars_decode( wp_strip_all_tags( $item['title'] ), ENT_QUOTES ),
			'acceptedAnswer' => [
				'@type' => 'Answer',
				'text'  => wp_specialchars_decode( wp_strip_all_tags( $item['content'] ), ENT_QUOTES ),
			],
		];
	}
}
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section section--full b-faq <?php echo esc_attr( $class_names ); ?>">
	<div class="section__inner grid-x grid-padding-x grid-padding-y">
		<div class="cell">
			<?php if ( $title ) : ?>
				<h2 class="b-faq__title"><?php echo esc_html( $title ); ?></h2>
			<?php endif; ?>

			<?php if ( $description ) : ?>
				<div class="b-faq__description"><?php echo wp_kses_post( $description ); ?></div>
			<?php endif; ?>
		</div>

		<div class="cell">
			<?php foreach ( $sections as $section_index => $section ) : ?>
				<?php
				$section_title = $section['title'] ?? false;
				$items         = $section['items'] ?? [];
				if ( ! $section_title && ! $items ) {
					continue;
				}
				?>
				<div class="b-faq__section">
					<?php if ( $section_title ) : ?>
						<h3 class="b-faq__section-title"><?php echo esc_html( $section_title ); ?></h3>
					<?php endif; ?>

					<?php if ( $items ) : ?>
						<ul
							class="accordion b-faq__accordion"
							data-accordion
							data-allow-all-closed="true"
							id="<?php echo esc_attr( $id . '-section-' . $section_index ); ?>"
						>
							<?php foreach ( $items as $item ) : ?>
								<?php if ( ! empty( $item['title'] ) ) : ?>
									<li class="accordion-item" data-accordion-item>
										<a href="#" class="accordion-title">
											<svg width="8" height="8" viewBox="0 0 8 8" fill="none" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg">
												<circle cx="4" cy="4" r="4" fill="#F9A259"/>
											</svg>
											<?php echo esc_html( $item['title'] ); ?>
										</a>
										<div class="accordion-content" data-tab-content>
											<?php echo wp_kses_post( $item['content'] ?? '' ); ?>
										</div>
									</li>
								<?php endif; ?>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php if ( $faq_items && ! is_admin() ) : ?>
	<script type="application/ld+json">
		<?php
		echo wp_json_encode(
			[
				'@context'   => 'https://schema.org',
				'@type'      => 'FAQPage',
				'mainEntity' => $faq_items,
			],
			JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP
		); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		?>
	</script>
<?php endif; ?>

<?php
// Important: reset $block variable to initial value.
$block = $settings;
