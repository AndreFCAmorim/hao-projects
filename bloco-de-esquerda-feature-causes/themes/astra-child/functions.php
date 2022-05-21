<?php

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
	$parenthandle = 'parent-style';
	$theme        = wp_get_theme();

	wp_enqueue_style(
		$parenthandle,
		get_template_directory_uri() . '/style.css',
		[],
		$theme->parent()->get( 'Version' )
	);

	wp_enqueue_style(
		'child-style',
		get_stylesheet_uri(),
		[ $parenthandle ],
		$theme->get( 'Version' )
	);

	wp_enqueue_style(
		'main-style',
		get_stylesheet_directory_uri() . '/dist/css/astra_theme.css',
		[],
		$theme->get( 'Version' )
	);

	wp_enqueue_script(
		'main-script',
		get_stylesheet_directory_uri() . '/dist/js/astra_theme.js',
		[ 'jquery' ],
		$theme->get( 'Version' ),
		true
	);

}

/**
* Add button HTML to the footer section.
*/
add_action( 'wp_footer', 'theme_add_backtotop_button' );
function theme_add_backtotop_button() {
	echo '<a href="#" class="topbutton"></a>';
}


function get_members() {
	$args = [
		'post_type'      => 'member',
		'posts_per_page' => -1,
		'orderby'        => [
			'menu_order' => 'ASC',
		],

	];

	$query = new WP_Query( $args );

	return $query;
}
