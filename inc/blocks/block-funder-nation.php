<?php
/**
 * Gutenberg Funder Nation Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Funder_Nation extends Block {
	public static function get_name(): string {
		return 'funder-nation';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Funder Nation', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/funder-nation.php',
				'category'        => 'foundationpress',
				'icon'            => 'buddicons-forums',
				'keywords'        => [ 'funder', 'nation' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Funder_Nation::init();
