<?php
/**
 * Gutenberg Team Block
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

class Block_Team extends Block {
	public static function get_name(): string {
		return 'team';
	}

	public static function register_block_type(): void {
		acf_register_block_type(
			[
				'name'            => self::get_name(),
				'title'           => __( 'Team', 'foundationpress' ),
				'render_template' => 'template-parts/blocks/team.php',
				'category'        => 'foundationpress',
				'icon'            => 'universal-access-alt',
				'keywords'        => [ 'team' ],
				'supports'        => [
					'align'  => false,
					'anchor' => true,
				],
			]
		);
	}
}

Block_Team::init();
