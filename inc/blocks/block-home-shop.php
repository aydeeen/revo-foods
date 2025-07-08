<?php
/**
 * Gutenberg Home Shop Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Home_Shop extends Block {
	public static function get_name(): string {
		return 'home-shop';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Home Shop', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/home-shop.php',
				'category'        => 'foundationpress',
				'icon'            => 'calculator',
				'keywords'        => [ 'home', 'shop' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Home_Shop::init();
