<?php
/**
 * Gutenberg Distributors Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Distributors extends Block {
	public static function get_name(): string {
		return 'distributors';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Distributors', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/distributors.php',
				'category'        => 'foundationpress',
				'icon'            => 'airplane',
				'keywords'        => [ 'distributors' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Distributors::init();
