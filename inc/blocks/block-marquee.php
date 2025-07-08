<?php
/**
 * Gutenberg Marquee Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Marquee extends Block {
	public static function get_name(): string {
		return 'marquee';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Marquee', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/marquee.php',
				'category'        => 'foundationpress',
				'icon'            => 'vault',
				'keywords'        => [ 'marquee' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Marquee::init();
