<?php
/**
 * Gutenberg Products 2 Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Products_2 extends Block {
	public static function get_name(): string {
		return 'products-2';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Products 2', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/products-2.php',
				'category'        => 'foundationpress',
				'icon'            => 'buddicons-topics',
				'keywords'        => [ 'products' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Products_2::init();
