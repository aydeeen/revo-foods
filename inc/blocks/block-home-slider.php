<?php
/**
 * Gutenberg Home Slider Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Home_Slider extends Block {
	public static function get_name(): string {
		return 'home-slider';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Home Slider', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/home-slider.php',
				'category'        => 'foundationpress',
				'icon'            => 'heart',
				'keywords'        => [ 'home', 'slider' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Home_Slider::init();
