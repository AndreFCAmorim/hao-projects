<?php
/**
 * Theme Assets
 */
namespace HopeandOak\WP\Theme\Hao;

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
	public function render_svg_sprite() {

		$svg_sprite_file = $this->base_dir . 'sprite.svg';
		if ( ! file_exists( $svg_sprite_file ) ) {
			return;
		}
		echo file_get_contents( $svg_sprite_file );
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
				'title' => __( 'Facebook', 'hao' ),
				'svg'   => 'social-facebook',
				'style' => '',
			],
			'instagram' => [
				'title' => __( 'Instagram', 'hao' ),
				'svg'   => 'social-instagram',
				'style' => '',
			],
			'linkedin'  => [
				'title' => __( 'LinkedIn', 'hao' ),
				'svg'   => 'social-linkedin',
				'style' => '',
			],
			'pinterest' => [
				'title' => __( 'Mail', 'hao' ),
				'svg'   => 'social-mail',
				'style' => '',
			],
			'twitter'   => [
				'title' => __( 'Twitter', 'hao' ),
				'svg'   => 'social-twitter',
				'style' => '',
			],
			'youtube'   => [
				'title' => __( 'Youtube', 'hao' ),
				'svg'   => 'social-youtube',
				'style' => '',
			],
		];
	}
}
