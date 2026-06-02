<?php
/**
 * Gutenberg Custom Food Process Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Custom_Food_Process extends Block {
	public static function get_name(): string {
		return 'custom-food-process';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Custom Food Process', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/custom-food-process.php',
				'category'        => 'foundationpress',
				'icon'            => 'editor-ol',
				'keywords'        => [ 'custom', 'food', 'process', 'timeline' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Custom_Food_Process::init();
