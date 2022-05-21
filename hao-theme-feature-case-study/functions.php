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
	$theme = wp_get_theme();
	wp_enqueue_style(
		'hao-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[],
		$theme->get( 'Version' )
	);

	wp_enqueue_style(
		'child-style-dist',
		get_stylesheet_directory_uri() . '/dist/css/hao_theme.css',
		[],
		$theme->get( 'Version' ) // this only works if you have Version in the style header
	);
}

add_action( 'wp_enqueue_scripts', 'hao_enqueue_scripts' );
function hao_enqueue_scripts() {
	$theme = wp_get_theme();
	wp_register_script(
		'hao_enqueue_scripts',
		get_stylesheet_directory_uri() . '/dist/js/hao_theme.js',
		[],
		$theme->get( 'Version' ),
		true
	);
	wp_enqueue_script( 'hao_enqueue_scripts' );
}

add_action( 'init', 'archive_case_study_rules' );
function archive_case_study_rules() {
	add_rewrite_rule( 'service/([^/]*)/?$', 'index.php/case-study/?service=$1' );
	add_rewrite_rule( 'case-study/service/([^/]*)/?$', 'index.php/case-study/?service=$1' );
	add_rewrite_rule( 'case-study/service/([^/]*)/?/page/([0-9]+)', 'index.php/case-study/page/$2/?service=$1' );
}
