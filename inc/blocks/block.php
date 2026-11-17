<?php
/**
 * Gutenberg Block with ACF
 *
 * @package FoundationPress
 */

namespace FoundationPress\Blocks;

abstract class Block {
	/**
	 * The block settings and attributes.
	 *
	 * @var array
	 */
	protected $settings;

	/**
	 * A unique name that identifies the block (without namespace).
	 * Note: A block name can only contain lowercase alphanumeric characters
	 * and dashes, and must begin with a letter.
	 */
	abstract public static function get_name(): string;

	/**
	 * Calls acf_register_block_type function to register the block.
	 *
	 * @see https://www.advancedcustomfields.com/resources/acf_register_block_type/
	 */
	abstract public static function register_block_type(): void;

	public function __construct( array $settings ) {
		$this->settings = $settings;
	}

	/**
	 * Register all needed WordPress actions.
	 */
	public static function init(): void {
		// only run on child classes.
		if ( get_called_class() !== __CLASS__ ) {
			add_action( 'acf/init', [ get_called_class(), 'register_block_type' ] );
		}
	}

	/**
	 * Get the anchor to use for the id attribute..
	 */
	public function get_anchor(): string {
		$id = $this->get_name() . '-' . $this->settings['id'];
		if ( ! empty( $this->settings['anchor'] ) ) {
			$id = $this->settings['anchor'];
		}
		return $id;
	}

	/**
	 * Get block class names.
	 *
	 * @param string $names class names.
	 */
	public function get_class_names( string $names = '' ): string {
		if ( ! empty( $this->settings['className'] ) ) {
			$names .= ' ' . $this->settings['className'];
		}

		if ( ! empty( $this->settings['align'] ) ) {
			$names .= ' align' . $this->settings['align'];
		}

		return $names;
	}

	/**
	 * Heading tag for the block's main title.
	 *
	 * The first block on a page that hides its template title supplies the
	 * page's H1. Every other block title is an H2, so a page never ends up
	 * with two H1s when blocks are reordered or reused.
	 *
	 * @param int|string $post_id ID of the current post.
	 */
	public function get_title_tag( $post_id ): string {
		return \fopr_blocks_provide_page_heading( $post_id ) && $this->is_first_block( $post_id ) ? 'h1' : 'h2';
	}

	/**
	 * Whether the current block is the first block in the page.
	 *
	 * Blocks saved by ACF 6 no longer store an `id` attribute, so the block is
	 * matched by its name and field data when no saved id is available.
	 *
	 * @param int|string $post_id ID of the current post.
	 */
	public function is_first_block( $post_id ): bool {
		$first = \fopr_get_first_block( (int) $post_id );

		if ( ! $first || empty( $this->settings['name'] ) || $first['blockName'] !== $this->settings['name'] ) {
			return false;
		}

		if ( ! empty( $first['attrs']['id'] ) ) {
			return isset( $this->settings['id'] ) && $first['attrs']['id'] === $this->settings['id'];
		}

		// Loose comparison on purpose: ACF may cast numeric field values.
		return ( $first['attrs']['data'] ?? [] ) == ( $this->settings['data'] ?? [] ); // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
	}
}

Block::init();
