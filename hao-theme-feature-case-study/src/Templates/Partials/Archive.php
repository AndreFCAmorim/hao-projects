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
class Archive {

	/**
	 * Stores the current post ID
	 *
	 * @var string
	 */
	protected $current_id;

	/**
	 * Setup class properties
	 *
	 * @param int    $post_id     (Optional) Exclude this ID
	 */
	public function __construct( $current_id = 0, $svg_read_more ) {
		$this->current_id     = (int) $current_id;
		$this->icon_read_more = $svg_read_more;
		add_filter( 'excerpt_more', [ $this, 'icon_readmore' ] );
	}

	public function render() {

		$image_id = get_post_thumbnail_id( $this->current_id );

		if ( ! $image_id || empty( $image_id ) ) {
			return;
		}

		$post_thumbnail = get_the_post_thumbnail( $this->current_id, 'large', [ 'class' => 'entry-header__image' ] );
		$post_title     = get_the_title( $this->current_id );
		$post_link      = get_permalink( $this->current_id );
		$post_excerpt   = get_the_excerpt( $this->current_id );

		$html = sprintf(
			'<header class="entry-header">
				<h2 class="entry-header__title default-max-width">%1$s</h2>
				<a href="%2$s">%3$s</a>
			</header>
			<div class="entry-content">
				<div class="entry-content__excerpt">
					%4$s
				</div>
			</div><!-- .entry-content -->',
			$post_title,
			$post_link,
			$post_thumbnail,
			$post_excerpt,
		);

		echo $html;

	}

	public function icon_readmore() {
		global $post;
		return ' <a href="' . get_permalink( $post->ID ) . '">' . $this->icon_read_more . '</a>';
	}

}
