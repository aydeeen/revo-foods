<?php
/**
 * Gutenberg Join Team Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Join_Team extends Block {
	public static function get_name(): string {
		return 'join-team';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Join Team', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/join-team.php',
				'category'        => 'foundationpress',
				'icon'            => 'star-filled',
				'keywords'        => [ 'join', 'team' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Join_Team::init();
