<?php
/**
 * Gutenberg Our Products Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Our_Products extends Block {
	public static function get_name(): string {
		return 'our-products';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Our Products', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/our-products.php',
				'category'        => 'foundationpress',
				'icon'            => 'cloud',
				'keywords'        => [ 'our', 'products' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Our_Products::init();
