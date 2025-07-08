<?php
/**
 * Gutenberg Mission Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Mission extends Block {
	public static function get_name(): string {
		return 'mission';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Mission', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/mission.php',
				'category'        => 'foundationpress',
				'icon'            => 'palmtree',
				'keywords'        => [ 'mission' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Mission::init();
