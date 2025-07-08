<?php
/**
 * Gutenberg Grid Cards Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Grid_Cards extends Block {
	public static function get_name(): string {
		return 'grid-cards';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Grid Cards', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/grid-cards.php',
				'category'        => 'foundationpress',
				'icon'            => 'admin-customizer',
				'keywords'        => [ 'grid', 'cards' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Grid_Cards::init();
