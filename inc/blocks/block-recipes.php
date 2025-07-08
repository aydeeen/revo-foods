<?php
/**
 * Gutenberg Recipes Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Recipes extends Block {
	public static function get_name(): string {
		return 'recipes';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Recipes', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/recipes.php',
				'category'        => 'foundationpress',
				'icon'            => 'food',
				'keywords'        => [ 'recipes' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Recipes::init();
