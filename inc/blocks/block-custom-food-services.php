<?php
/**
 * Gutenberg Custom Food Services Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Custom_Food_Services extends Block {
	public static function get_name(): string {
		return 'custom-food-services';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Custom Food Services', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/custom-food-services.php',
				'category'        => 'foundationpress',
				'icon'            => 'grid-view',
				'keywords'        => [ 'custom', 'food', 'services', 'grid' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Custom_Food_Services::init();
