<?php
/**
 * Gutenberg Products Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Products extends Block {
	public static function get_name(): string {
		return 'products';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Products', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/products.php',
				'category'        => 'foundationpress',
				'icon'            => 'store',
				'keywords'        => [ 'products' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Products::init();
