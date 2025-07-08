<?php
/**
 * Gutenberg Image Left Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Image_Left extends Block {
	public static function get_name(): string {
		return 'image-left';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Image Left', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/image-left.php',
				'category'        => 'foundationpress',
				'icon'            => 'table-col-before',
				'keywords'        => [ 'image', 'left' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Image_Left::init();
