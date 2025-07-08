<?php
/**
 * Gutenberg CTA 2 Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_CTA_2 extends Block {
	public static function get_name(): string {
		return 'cta-2';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'CTA 2', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/cta-2.php',
				'category'        => 'foundationpress',
				'icon'            => 'image-filter',
				'keywords'        => [ 'cta', '2' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_CTA_2::init();
