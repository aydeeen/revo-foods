<?php
/**
 * Gutenberg Hero 2 Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Hero_2 extends Block {
	public static function get_name(): string {
		return 'hero-2';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Hero 2', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/hero-2.php',
				'category'        => 'foundationpress',
				'icon'            => 'universal-access',
				'keywords'        => [ 'hero', '2' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Hero_2::init();
