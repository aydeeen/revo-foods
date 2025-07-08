<?php
/**
 * Gutenberg Sponsors Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Sponsors extends Block {
	public static function get_name(): string {
		return 'sponsors';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Sponsors', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/sponsors.php',
				'category'        => 'foundationpress',
				'icon'            => 'art',
				'keywords'        => [ 'sponsors' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Sponsors::init();
