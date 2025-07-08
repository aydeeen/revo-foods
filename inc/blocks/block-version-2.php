<?php
/**
 * Gutenberg Version 2 Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Version_2 extends Block {
	public static function get_name(): string {
		return 'version-2';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Version 2', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/version-2.php',
				'category'        => 'foundationpress',
				'icon'            => 'superhero-alt',
				'keywords'        => [ 'version', '2' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Version_2::init();
