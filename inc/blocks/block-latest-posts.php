<?php
/**
 * Gutenberg Latest Posts Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Latest_Posts extends Block {
	public static function get_name(): string {
		return 'latest-posts';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Latest Posts', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/latest-posts.php',
				'category'        => 'foundationpress',
				'icon'            => 'games',
				'keywords'        => [ 'latest', 'posts' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Latest_Posts::init();
