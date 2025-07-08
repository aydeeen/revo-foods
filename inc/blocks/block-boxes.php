<?php
/**
 * Gutenberg Boxes Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Boxes extends Block {
	public static function get_name(): string {
		return 'boxes';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Boxes', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/boxes.php',
				'category'        => 'foundationpress',
				'icon'            => 'editor-kitchensink',
				'keywords'        => [ 'boxes' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Boxes::init();
