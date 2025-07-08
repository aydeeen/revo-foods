<?php
/**
 * Gutenberg Press Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Press extends Block {
	public static function get_name(): string {
		return 'press';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Press', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/press.php',
				'category'        => 'foundationpress',
				'icon'            => 'buddicons-groups',
				'keywords'        => [ 'press' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Press::init();
