<?php
/**
 * Gutenberg Reseller Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Reseller extends Block {
	public static function get_name(): string {
		return 'reseller';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Reseller', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/reseller.php',
				'category'        => 'foundationpress',
				'icon'            => 'nametag',
				'keywords'        => [ 'reseller' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Reseller::init();
