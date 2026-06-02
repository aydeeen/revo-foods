<?php
/**
 * Gutenberg Custom Food Hero Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Custom_Food_Hero extends Block {
	public static function get_name(): string {
		return 'custom-food-hero';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Custom Food Hero', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/custom-food-hero.php',
				'category'        => 'foundationpress',
				'icon'            => 'food',
				'keywords'        => [ 'custom', 'food', 'hero' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Custom_Food_Hero::init();
