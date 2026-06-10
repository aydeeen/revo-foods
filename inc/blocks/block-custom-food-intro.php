<?php
/**
 * Gutenberg Custom Food Intro Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Custom_Food_Intro extends Block {
	public static function get_name(): string {
		return 'custom-food-intro';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Custom Food Intro', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/custom-food-intro.php',
				'category'        => 'foundationpress',
				'icon'            => 'text-page',
				'keywords'        => [ 'custom', 'food', 'intro' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Custom_Food_Intro::init();
