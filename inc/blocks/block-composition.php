<?php
/**
 * Gutenberg Composition Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Composition extends Block {
	public static function get_name(): string {
		return 'composition';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Composition', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/composition.php',
				'category'        => 'foundationpress',
				'icon'            => 'pets',
				'keywords'        => [ 'composition' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Composition::init();
