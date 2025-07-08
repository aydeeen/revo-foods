<?php
/**
 * Gutenberg Image Right Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Image_Right extends Block {
	public static function get_name(): string {
		return 'image-right';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Image Right', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/image-right.php',
				'category'        => 'foundationpress',
				'icon'            => 'table-col-after',
				'keywords'        => [ 'image', 'right' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Image_Right::init();
