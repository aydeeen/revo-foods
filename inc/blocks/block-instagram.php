<?php
/**
 * Gutenberg Instagram Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Instagram extends Block {
	public static function get_name(): string {
		return 'instagram';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Instagram', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/instagram.php',
				'category'        => 'foundationpress',
				'icon'            => 'instagram',
				'keywords'        => [ 'instagram' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Instagram::init();
