<?php
/**
 * Theme assets.
 *
 * @package GoodOmens\AMGroup
 */

namespace GoodOmens\WP\Theme\JJ;

/**
 * Theme assets.
 *
 */
class Assets {

	/**
	 * Base URL for public assets.
	 *
	 * @var   string
	 */
	protected $base_uri;

	/**
	 * Base URL for public assets.
	 *
	 * @var   string
	 */
	protected $base_dir;

	/**
	 * Assets suffix.
	 *
	 * @var   string
	 */
	protected $suffix;

	/**
	 * Constructor.
	 *
	 */
	public function __construct( $base_dir, $base_uri ) {
		$this->base_dir = $base_dir;
		$this->base_uri = $base_uri;
		$this->suffix   = go_is_dev() ? '' : '.min';
	}

}
