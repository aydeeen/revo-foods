<?php
/**
 * Gutenberg Hero Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Hero extends Block {
	public static function get_name(): string {
		return 'hero';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Hero', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/hero.php',
				'category'        => 'foundationpress',
				'icon'            => 'carrot',
				'keywords'        => [ 'hero' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Hero::init();
