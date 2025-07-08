<?php
/**
 * Gutenberg News Tabs Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_News_Tabs extends Block {
	public static function get_name(): string {
		return 'news-tabs';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'News Tabs', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/news-tabs.php',
				'category'        => 'foundationpress',
				'icon'            => 'sos',
				'keywords'        => [ 'news', 'tabs' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_News_Tabs::init();
