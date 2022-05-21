<?php
/**
 * Theme Assets
 */
namespace GoodOmens\WP\Theme\JJ;

/**
 * Theme assets.
 *
 */
class Media extends Assets {

	/**
	 * Constructor.
	 */
	public function __construct( $base_dir, $base_uri ) {
		parent::__construct( $base_dir, $base_uri );

		$this->base_uri = $this->base_uri . '/dist/images/';
		$this->base_dir = $this->base_dir . '/dist/images/';
	}


	/**
	 * Get SVG sprite.
	 */
	public function get_svg_sprite() {

		$svg_sprite_file = $this->base_dir . 'sprite.svg';
		if ( ! file_exists( $svg_sprite_file ) ) {
			return;
		}
		echo file_get_contents( $svg_sprite_file );
	}

	/**
	 * Get supported SVG shapes by "group".
	 *
	 * @param  string $group   The shape "group" name.
	 * @param  string $context The shape "group" context. E.g. Social, footer.
	 * @return array           The SVG shapes.
	 */
	public static function get_meta_shapes() {

		return [
			'meta-duration'      => [
				'title' => __( 'Duration', 'jjtheme' ),
				'svg'   => 'meta-duration',
			],
			'meta-servings'      => [
				'title' => __( 'Servings', 'jjtheme' ),
				'svg'   => 'meta-servings',
			],
			'meta-equipment'     => [
				'title' => __( 'Workout Equipment', 'jjtheme' ),
				'svg'   => 'meta-equipment',
			],
			'meta-material'     => [
				'title' => __( 'Spiritual Equipment', 'jjtheme' ),
				'svg'   => 'meta-material',
			],
			'tags-tribe'         => [
				'title' => __( 'Tribe Tag', 'jjtheme' ),
				'svg'   => 'tags-tribe',
			],
			'category-nutrition' => [
				'title' => __( 'Tribe Recipe', 'jjtheme' ),
				'svg'   => 'category-nutrition',
			],
			'category-spirituality' => [
				'title' => __( 'Tribe Spirituality', 'jjtheme' ),
				'svg'   => 'category-spirituality',
			],
			'category-workout' => [
				'title' => __( 'Tribe workout', 'jjtheme' ),
				'svg'   => 'category-workout',
			],
		];
	}

	public static function get_svg( $shape, $style ) {

		return sprintf(
			'<svg class="svg-sprite" role="img">
				%2$s
				<use xlink:href="#shape-%1$s"></use>
			</svg>',
			esc_attr( $shape ),
			$style
		);
	}
	/**
	 * Get supported SVG shapes by "group".
	 *
	 * @param  string $group   The shape "group" name.
	 * @param  string $context The shape "group" context. E.g. Social, footer.
	 * @return array           The SVG shapes.
	 */
	public static function get_social_shapes() {

		return [
			'facebook'  => [
				'title' => __( 'Facebook', 'jjtheme' ),
				'svg'   => 'facebook-square',
			],
			'instagram' => [
				'title' => __( 'Instagram', 'jjtheme' ),
				'svg'   => 'instagram-square',
				'style' => '<radialGradient id="ibg" r="150%" cx="30%" cy="107%"> <stop stop-color="#fdf497" offset="0"/> <stop stop-color="#fdf497" offset="0.05"/> <stop stop-color="#fd5949" offset="0.45"/> <stop stop-color="#d6249f" offset="0.6"/> <stop stop-color="#285AEB" offset="0.9"/> </radialGradient>',
			],
			'linkedin'  => [
				'title' => __( 'LinkedIn', 'jjtheme' ),
				'svg'   => 'linkedin-square',
			],
			'pinterest' => [
				'title' => __( 'Pinterest', 'jjtheme' ),
				'svg'   => 'pinterest',
			],
			'twitter'   => [
				'title' => __( 'Twitter', 'jjtheme' ),
				'svg'   => 'twitter-square',
			],
			'vimeo'     => [
				'title' => __( 'Vimeo', 'jjtheme' ),
				'svg'   => 'vimeo',
			],
			'youtube'   => [
				'title' => __( 'Youtube', 'jjtheme' ),
				'svg'   => 'youtube-square',
			],
		];
	}
}
