<?php
/**
 * Gutenberg Video Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Video extends Block {
	public static function get_name(): string {
		return 'video';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Video', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/video.php',
				'category'        => 'foundationpress',
				'icon'            => 'video-alt3',
				'keywords'        => [ 'video' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Video::init();
