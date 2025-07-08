<?php
/**
 * Gutenberg Timeline Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Timeline extends Block {
	public static function get_name(): string {
		return 'timeline';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Timeline', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/timeline.php',
				'category'        => 'foundationpress',
				'icon'            => 'testimonial',
				'keywords'        => [ 'timeline' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Timeline::init();
