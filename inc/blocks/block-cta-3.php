<?php
/**
 * Gutenberg CTA 3 Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_CTA_3 extends Block {
	public static function get_name(): string {
		return 'cta-3';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'CTA 3', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/cta-3.php',
				'category'        => 'foundationpress',
				'icon'            => 'awards',
				'keywords'        => [ 'cta', '3' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_CTA_3::init();
