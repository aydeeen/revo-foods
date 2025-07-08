<?php
/**
 * Gutenberg Content And Bg Img Block Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Content_And_Bg_Img extends Block {
	public static function get_name(): string {
		return 'content-and-bg-img';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Content And Bg Img', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/content-and-bg-img.php',
				'category'        => 'foundationpress',
				'icon'            => 'color-picker',
				'keywords'        => [ 'content', 'image' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Content_And_Bg_Img::init();
