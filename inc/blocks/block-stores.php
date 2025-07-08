<?php
/**
 * Gutenberg Stores Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Stores extends Block {
	public static function get_name(): string {
		return 'stores';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Stores', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/stores.php',
				'category'        => 'foundationpress',
				'icon'            => 'tickets',
				'keywords'        => [ 'stores' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Stores::init();
