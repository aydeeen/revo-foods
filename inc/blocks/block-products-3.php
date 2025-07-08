<?php
/**
 * Gutenberg Products 3 Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Products_3 extends Block {
	public static function get_name(): string {
		return 'products-3';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Products 3', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/products-3.php',
				'category'        => 'foundationpress',
				'icon'            => 'align-full-width',
				'keywords'        => [ 'products', '3' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Products_3::init();
