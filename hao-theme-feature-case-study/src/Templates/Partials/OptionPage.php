<?php
/**
 * Theme Partials.
 *
 * @package GoodOmens/AMGroup\Templates\Partials
 */

namespace GoodOmens\WP\Theme\JJ\Templates\Partials;

use GoodOmens\WP\Plugin\JJSiteOptions\Option\Pages;

/**
 * OptionPage
 *
 */
class OptionPage {

	private $slug;

	public function __construct( string $slug ) {
		$this->slug = $slug;
	}

	public function setup() {
		if ( ! class_exists( 'GoodOmens\WP\Plugin\JJSiteOptions\Option\Pages' ) ) {
			return;
		}
		$this->page_id = Pages::get_option( 'assoc', $this->slug );
	}

	public function get_link() {
		return get_the_permalink( $this->page_id );
	}
	public function show_title() {
		$page = get_post( $this->page_id );
		if ( is_a( $page, 'WP_Post' ) ) {
			return;
		}
		echo $page->post_title;
	}

	public function show_content() {

		$page = get_post( $this->page_id );
		if ( is_a( $page, 'WP_Post' ) ) {
			return;
		}
		$post_content = apply_filters( 'the_content', $page->post_content );
		echo $post_content;

	}
}
