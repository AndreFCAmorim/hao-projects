<?php

use HopeandOak\WP\Theme\Hao\Theme;


if ( file_exists( get_stylesheet_directory() . '/vendor/autoload.php' ) ) {
	require_once get_stylesheet_directory() . '/vendor/autoload.php';
}

$theme = Theme::instance();
$theme->init();

function go_is_dev() {
	return apply_filters( 'go_is_dev', defined( 'WP_ENV' ) && 'production' !== WP_ENV );
}

add_action( 'wp_enqueue_scripts', 'hao_enqueue_styles' );
function hao_enqueue_styles() {

	wp_enqueue_style(
		'hao-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[],
		wp_get_theme()->get( 'Version' )
	);
}
