<?php
/**
 * Gutenberg Seafood Revolution Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Seafood_Revolution extends Block {
	public static function get_name(): string {
		return 'seafood-revolution';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Seafood Revolution', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/seafood-revolution.php',
				'category'        => 'foundationpress',
				'icon'            => 'money',
				'keywords'        => [ 'seafood', 'revolution' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Seafood_Revolution::init();
