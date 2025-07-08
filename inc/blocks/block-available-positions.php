<?php
/**
 * Gutenberg Available_Positions Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Available_Positions extends Block {
	public static function get_name(): string {
		return 'available-positions';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Available Positions', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/available-positions.php',
				'category'        => 'foundationpress',
				'icon'            => 'buddicons-buddypress-logo',
				'keywords'        => [ 'available', 'positions' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Available_Positions::init();
