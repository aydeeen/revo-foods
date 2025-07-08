<?php
/**
 * Home Hero 4 Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Home_Hero_4 extends Block {
	public static function get_name(): string {
		return 'home-hero-4';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Home Hero 4', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/home-hero-4.php',
				'category'        => 'foundationpress',
				'icon'            => 'hammer',
				'keywords'        => [ 'home', 'hero', '4' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Home_Hero_4::init();
