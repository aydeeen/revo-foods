<?php
/**
 * Gutenberg CTA Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_CTA extends Block {
	public static function get_name(): string {
		return 'cta';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'CTA', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/cta.php',
				'category'        => 'foundationpress',
				'icon'            => 'buddicons-activity',
				'keywords'        => [ 'cta' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_CTA::init();
