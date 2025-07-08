<?php
/**
 * Gutenberg B2B Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_B2B extends Block {
	public static function get_name(): string {
		return 'B2B';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'B2B', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/b2b.php',
				'category'        => 'foundationpress',
				'icon'            => 'drumstick',
				'keywords'        => [ 'B2B' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_B2B::init();
