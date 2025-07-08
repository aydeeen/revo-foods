<?php
/**
 * Gutenberg Team 2Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Team_2 extends Block {
	public static function get_name(): string {
		return 'team-2';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Team 2', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/team-2.php',
				'category'        => 'foundationpress',
				'icon'            => 'admin-users',
				'keywords'        => [ 'team', '2' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Team_2::init();
