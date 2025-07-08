<?php
/**
 * Gutenberg Map Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Map extends Block {
	public static function get_name(): string {
		return 'map';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Map', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/map.php',
				'category'        => 'foundationpress',
				'icon'            => 'admin-site',
				'keywords'        => [ 'map' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Map::init();
