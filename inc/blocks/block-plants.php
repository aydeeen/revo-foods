<?php
/**
 * Gutenberg Plants Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Plants extends Block {
	public static function get_name(): string {
		return 'plants';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Plants', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/plants.php',
				'category'        => 'foundationpress',
				'icon'            => 'buddicons-tracking',
				'keywords'        => [ 'plants' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Plants::init();
