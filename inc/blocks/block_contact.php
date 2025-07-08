<?php
/**
 * Gutenberg Contact Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Contact extends Block {
	public static function get_name(): string {
		return 'contact';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Contact', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/contact.php',
				'category'        => 'foundationpress',
				'icon'            => 'format-status',
				'keywords'        => [ 'contact' ],
				'supports'        => [
					'align'      => true,
					'anchor'     => true,
					'classNames' => false,
				],
			]
		);
	}
}

Block_Contact::init();
