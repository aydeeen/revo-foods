<?php
/**
 * Gutenberg Numbers 2 Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Numbers_2 extends Block {
	public static function get_name(): string {
		return 'numbers-2';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Numbers 2', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/numbers-2.php',
				'category'        => 'foundationpress',
				'icon'            => 'info',
				'keywords'        => [ 'numbers', '2' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Numbers_2::init();
