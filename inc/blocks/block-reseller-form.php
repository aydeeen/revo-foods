<?php
/**
 * Gutenberg Reseller Info Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Reseller_Form extends Block {
	public static function get_name(): string {
		return 'reseller-form';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Reseller Form', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/reseller-form.php',
				'category'        => 'foundationpress',
				'icon'            => 'visibility',
				'keywords'        => [ 'reseller', 'form' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Reseller_Form::init();
