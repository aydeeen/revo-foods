<?php
/**
 * Gutenberg Home Hero 3 Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Home_Hero_3 extends Block {
	public static function get_name(): string {
		return 'home-hero-3';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Home Hero 3', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/home-hero-3.php',
				'category'        => 'foundationpress',
				'icon'            => 'smartphone',
				'keywords'        => [ 'home', 'hero', '3' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Home_Hero_3::init();
