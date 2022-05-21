<?php
/**
 * Scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/assets/css/main.css
 *
 * Enqueue scripts in the following order:
 * 1. jquery-1.11.1.min.js via Google CDN
 * 2. /theme/assets/js/vendor/modernizr.min.js
 * 3. /theme/assets/js/scripts.js (in footer)
 *
 * Google Analytics is loaded after enqueued scripts if:
 * - An ID has been defined in config.php
 * - You're not logged in as an administrator
 */
function roots_scripts() {
	/**
	 * The build task in Grunt renames production assets with a hash
	 * Read the asset names from assets-manifest.json
	 */

	$base_uri = get_stylesheet_directory_uri();
	$base_dir = get_stylesheet_directory();
	$suffix   = WP_ENV ? '' : '.min';

	$base_uri_js = $base_uri . '/dist/js/';

	wp_enqueue_script(
		'impstock',
		$base_uri_js . THEME_NAME . "{$suffix}.js",
		[ 'jquery-core' ],
		THEME_VERSION,
		true
	);
	wp_enqueue_script(
		'html5',
		$base_uri_js . 'html5.js',
		[],
		THEME_VERSION,
		true
	);
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_localize_script(
		'impstock',
		'impstock_data',
		[
			'ajaxurl'         => admin_url( 'admin-ajax.php' ),
			'gettermsNonce'   => wp_create_nonce( 'getterm-nonce' ),
			'root'            => esc_url_raw( rest_url() ),
			'successMessage'  => esc_html__( 'Email Sent with success.', 'impstock' ),
			'failureMessage'  => esc_html__( 'An error has occurred.', 'impstock' ),
			'missingMessage'  => esc_html__( 'Some fields need your attention.', 'impstock' ),
			'addToOrder'      => esc_html__( 'Add to Order', 'impstock' ),
			'addedToOrder'    => esc_html__( 'Added!', 'impstock' ),
			'retailPrice'     => esc_html__( 'Retail Price', 'impstock' ),
			'rP'              => esc_html__( 'RP', 'impstock' ),
			'getDeliveryDate' => esc_html__( 'Get Delivery Date', 'impstock' ),
			'askPrice'        => esc_html__( 'Ask for Price', 'impstock' ),
		]
	);
	$base_uri_css = $base_uri . '/dist/css/';
	$base_dir_css = $base_dir . '/dist/css/';
	$style_path   = $base_dir_css . THEME_NAME . "{$suffix}.css";
	if ( file_exists( $style_path ) ) {
		wp_enqueue_style(
			THEME_NAME,
			$base_uri_css . THEME_NAME . "{$suffix}.css",
			[],
			filemtime( $style_path )
		);
	}

	$style_path = $base_dir_css . 'stock' . "{$suffix}.css";
	if ( file_exists( $style_path ) ) {
		wp_enqueue_style(
			THEME_NAME . '-stock',
			$base_uri_css . 'stock' . "{$suffix}.css",
			[],
			filemtime( $style_path )
		);
	}
}

add_action( 'wp_enqueue_scripts', 'roots_scripts', 100 );

function roots_jquery_local_fallback( $src, $handle = null ) {
	static $add_jquery_fallback = false;

	if ( $add_jquery_fallback ) {
		echo '<script>window.jQuery || document.write(\'<script src="' . get_template_directory_uri() . '/assets/vendor/jquery/dist/jquery.min.js?1.11.1"><\/script>\')</script>' . "\n";
		$add_jquery_fallback = false;
	}

	if ( $handle === 'jquery' ) {
		$add_jquery_fallback = true;
	}

	return $src;
}
add_action( 'wp_head', 'roots_jquery_local_fallback' );
