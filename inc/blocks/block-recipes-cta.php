<?php
/**
 * Gutenberg Recipes CTA Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Recipes_CTA extends Block {
	public static function get_name(): string {
		return 'recipes-cta';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Recipes CTA', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/recipes-cta.php',
				'category'        => 'foundationpress',
				'icon'            => 'carrot',
				'keywords'        => [ 'recipes', 'cta' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Recipes_CTA::init();
