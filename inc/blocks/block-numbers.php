<?php
/**
 * Gutenberg Numbers Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Numbers extends Block {
	public static function get_name(): string {
		return 'numbers';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Numbers', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/numbers.php',
				'category'        => 'foundationpress',
				'icon'            => 'buddicons-replies',
				'keywords'        => [ 'numbers' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Numbers::init();
