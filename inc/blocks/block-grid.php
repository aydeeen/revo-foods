<?php
/**
 * Gutenberg Grid Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Grid extends Block {
	public static function get_name(): string {
		return 'grid';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Grid', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/grid.php',
				'category'        => 'foundationpress',
				'icon'            => 'airplane',
				'keywords'        => [ 'grid' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Grid::init();
