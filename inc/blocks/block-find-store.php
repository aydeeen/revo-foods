<?php
/**
 * Gutenberg Find Store Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Find_Store extends Block {
	public static function get_name(): string {
		return 'find-store';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Find Store', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/find-store.php',
				'category'        => 'foundationpress',
				'icon'            => 'buddicons-community',
				'keywords'        => [ 'find', 'store' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Find_Store::init();
