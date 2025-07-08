<?php
/**
 * Gutenberg Sustainability Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Sustainability extends Block {
	public static function get_name(): string {
		return 'sustainability';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Sustainability', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/sustainability.php',
				'category'        => 'foundationpress',
				'icon'            => 'lightbulb',
				'keywords'        => [ 'sustainability' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Sustainability::init();
