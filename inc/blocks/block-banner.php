<?php
/**
 * Gutenberg Banner Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Banner extends Block {
	public static function get_name(): string {
		return 'banner';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Banner', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/banner.php',
				'category'        => 'foundationpress',
				'icon'            => 'feedback',
				'keywords'        => [ 'banner' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Banner::init();
