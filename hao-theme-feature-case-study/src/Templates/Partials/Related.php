<?php
/**
 * Theme Partials.
 *
 * @package HopeandOak\WP\Theme\Hao
 */

namespace HopeandOak\WP\Theme\Hao\Templates\Partials;

/**
 * Related blocks
 *
 */
class Related {

	/**
	 * Stores the post type slug
	 *
	 * @var string
	 */
	protected $post_type;

	/**
	 * Stores the current post ID
	 *
	 * @var string
	 */
	protected $current_id;

	private $max_number;
	private $mode;
	private $order;
	private $results;
	private $counter;
	private $results_id;

	/**
	 * Setup class properties
	 *
	 * @param string $post_type   (Optional) A slug for Post Type
	 * @param int    $post_id     (Optional) Exclude this ID
	 */
	public function __construct( $post_type, $current_id = 0 ) {
		$this->post_type  = $post_type;
		$this->current_id = (int) $current_id;
	}

	/**
	 * Get the terms associated with the current id
	 *
	 * @return array   List of taxonomy queries related to the current id
	 */
	private function get_related_terms() {

		if ( $this->current_id !== 0 ) {
			return [];

		}
		$transient_name = 'amgroup_theme_post_tax_query_' . $this->current_id;
		$tax_query      = get_transient( $transient_name );

		// if there's a stored tax_query, return it.
		if ( $tax_query !== false ) {
			return $tax_query;
		}

		$expire_date = apply_filters( 'amgroup_theme_post_tax_query_expire', 4 * HOUR_IN_SECONDS );

		// setup an empty transient as soon as possible so the function can return early.
		set_transient( $transient_name, [], $expire_date );

		// get 'names', which are the slugs
		$taxonomies = get_object_taxonomies( $this->post_type );

		if ( empty( $taxonomies ) ) {
			return [];
		}

		foreach ( $taxonomies as $taxonomy_slug ) {

			$terms = wp_get_post_terms( $this->current_id, $taxonomy_slug );

			if ( ! $terms || is_wp_error( $terms ) ) {
				continue;
			}

			foreach ( $terms as $term ) {

				$tax_query[] = [
					'taxonomy' => $taxonomy_slug,
					'field'    => 'slug',
					'terms'    => $term->slug,
				];
			}
		}

		if ( empty( $tax_query ) ) {
			return $tax_query;
		}

		if ( count( $tax_query ) > 1 ) {
			$tax_query['relation'] = 'OR';
		}

		// if there's any related term, overwrite the empty transient
		set_transient( $transient_name, $tax_query, $expire_date );

		return $tax_query;
	}

	/**
	 *
	 * Get the query arguments for related items
	 *
	 * @return array   Query args to fetch related items.
	 */
	private function get_related_query() {

		$args = [
			'ignore_sticky_posts' => 1,
			'orderby'             => 'date',
			'post_status'         => 'publish',
		];

		if ( ! empty( $this->current_id ) ) {
			$args['post__not_in'] = [ $this->current_id ];
		}
		if ( ! empty( $this->post_type ) ) {
			$args['post_type'] = $this->post_type;
		}

		if ( $this->mode === 'restricted' && $this->current_id !== 0 ) {
			$tax_query         = $this->get_related_terms();
			$args['tax_query'] = $tax_query;
		}

		return $args;
	}


	/**
	 * Get the related items.
	 *
	 * @param  int  $posts_per_page  (Optional) Max items per page
	 * @param  string  $mode            (Optional) Query mode for either `restrict` to common terms.
	 * @param  string  $order           (Optional) Order the results ASC or DESC.
	 * @return WP_Query                 Contains the related items
	 */
	private function get_related_items() {

		$args = $this->get_related_query( $this->mode );

		if ( $this->max_number > 0 ) {
			$args['posts_per_page'] = $this->max_number;
		}

		$args['order'] = $this->order;

		return new \WP_Query( $args );

	}

	/**
	 * Get the related items.
	 *
	 * @param  string  $posts_per_page  (Optional) Max items per page
	 * @param  array   $exclude         (Optional) List of IDs to exclude
	 * @param  string  $order           (Optional) Order the results ASC or DESC.
	 * @return WP_Query                 Contains the related items
	 */
	private function get_extra( $posts_per_page = 0, $exclude = [], $order = '' ) {

		$args = $this->get_related_query();

		if ( $posts_per_page > 0 ) {
			$args['posts_per_page'] = $posts_per_page;
		}

		$args['order'] = $order;

		if ( is_array( $exclude ) ) {
			$args['post__not_in'] = $exclude;
		}

		return new \WP_Query( $args );

	}

	public function setup_results( $posts_per_page = 0, $mode = '', $order = 'DESC' ) {
		$this->max_number = $posts_per_page;
		$this->mode       = $mode;
		$this->order      = $order;
		$this->results    = $this->get_related_items();
		$this->counter    = 0;

		if ( $this->results->have_posts() ) {
			while ( $this->results->have_posts() ) {

				$this->results->the_post();

				$this_id  = get_the_ID();
				$image_id = get_post_thumbnail_id( $this_id );
				if ( ! $image_id || empty( $image_id ) ) {
					continue;
				}
				$added_ids[] = $this_id;
				$this->counter++;
			}
		}
		wp_reset_postdata();

		if ( $this->counter < $posts_per_page ) {

			// add current post id to exclude it too, again:
			$added_ids[]         = $this->current_id;
			$extra_count         = $posts_per_page - $this->counter + 1;
			$this->extra_results = $this->get_extra( $extra_count, $added_ids, $order );
			if ( $this->extra_results->have_posts() ) {
				while ( $this->extra_results->have_posts() ) {

					$this->extra_results->the_post();

					$this_id  = get_the_ID();
					$image_id = get_post_thumbnail_id( $this_id );
					if ( ! $image_id || empty( $image_id ) ) {
						continue;
					}
					$this->counter++;
				}
			}
		}
		$this->results_id = $added_ids;
		wp_reset_postdata();
	}

	public function get_results() {
		return $this->results;
	}

	public function get_count() {
		return $this->counter;
	}

	public function render() {
		if ( $this->results_id === 0 ) {
			return;
		}

		$html = '';
		foreach ( $this->results_id as $related_id ) {
			$related_post = get_post( $related_id );
			$html        .= sprintf(
				'<div class="related-item">
					<a class="related-item__title" href="%1$s">%2$s</a>
					<a class="related-item__logo" href="%3$s">%4$s</a>
				</div>',
				get_permalink( $related_post->ID ),
				$related_post->post_title,
				get_permalink( $related_post->ID ),
				get_the_post_thumbnail( $related_post->ID, [ '200', '200' ], [ 'class' => 'related-image' ] )
			);
		}

		echo wp_kses_post( $html );
	}

}
