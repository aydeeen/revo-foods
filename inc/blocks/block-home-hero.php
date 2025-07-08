<?php
/**
 * Gutenberg Home Hero Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Home_Hero extends Block {
	public static function get_name(): string {
		return 'home-hero';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Home Hero', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/home-hero.php',
				'category'        => 'foundationpress',
				'icon'            => 'drumstick',
				'keywords'        => [ 'home', 'hero' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Home_Hero::init();
