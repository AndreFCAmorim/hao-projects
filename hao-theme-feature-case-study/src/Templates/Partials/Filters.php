<?php
/**
 * Theme Partials.
 *
 * @package HopeandOak\WP\Theme\Hao
 */

namespace HopeandOak\WP\Theme\Hao\Templates\Partials;

/**
 * Taxonomy filter blocks
 *
 */
class Filters {


	/**
	 * Stores the post type slug
	 *
	 * @var string
	 */
	protected $post_type;

	/**
	 * Stores the taxonomy slug
	 *
	 * @var string
	 */
	protected $taxonomy;
	/**
	 * Setup class properties
	 *
	 * @param string $post_type  A slug for Post Type
	 * @param string $taxonomy   A slug for Post Type Taxonomy
	 */
	public function __construct( $post_type, $taxonomy ) {
		$this->post_type = $post_type;
		$this->taxonomy  = $taxonomy;
	}

	/**
	 * Render Filters section
	 *
	 * @param string $current_term (Optional) A term name
	 * @return void
	 */
	public function render_filters( $current_term = '' ) {

		if ( ! $this->taxonomy || ! $this->post_type ) {
			return;
		}

		$args      = [
			'taxonomy'   => $this->taxonomy,
			'hide_empty' => true,
		];
		$term_list = get_terms( $args );

		$active_class = ' is-active';
		if ( empty( $term_list ) || is_wp_error( $term_list ) || ! is_array( $term_list ) ) {
			return '';
		}

		$filters_html  = '';
		$sub_link      = get_site_url() . '/' . $this->post_type;
		$filters_html .= sprintf(
			'<div class="filters__item">
				<a href="%1$s" class="filter%2$s">
					%3$s
				</a>
			</div>',
			esc_url( $sub_link ),
			esc_attr( ! $current_term ? $active_class : '' ),
			esc_html_x( 'All', 'All filters', 'hao' )
		);

		foreach ( $term_list as $term ) {

			$term_link = get_site_url() . '/' . $this->post_type . '/' . $this->taxonomy . '/' . $term->slug;

			// no link, no go
			if ( ! $term_link || is_wp_error( $term_link ) ) {
				continue;
			}
			$filters_html .= sprintf(
				'<div class="filters__item">
					<a href="%1$s" class="filter%2$s">
						%3$s
					</a>
				</div>',
				esc_url( $term_link ),
				esc_attr( $current_term === $term->slug ? $active_class : '' ),
				esc_html( $term->name )
			);
		}

		printf(
			'<div class="filters">
				%1$s
			</div>',
			$filters_html
		);

	}

	/**
	 * Get term slug from query
	 *
	 * @return void
	 */
	public function get_term_slug() {
		$term_slug = '';
		if ( ! is_category() && ! is_tag() && ! is_tax() ) {
			return '';
		}
		$term = get_queried_object();
		if ( $term ) {
			return $term->slug;
		}
		return '';
	}
}
