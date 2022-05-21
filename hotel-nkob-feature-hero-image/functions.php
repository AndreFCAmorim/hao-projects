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

add_post_type_support( 'page', 'excerpt' );

function wp_related_pages( $post ) {
	if ( is_page() && $post->post_parent ) {
		$parent_id = wp_get_post_parent_id( $post->ID );
		$args = [
			'post_type'      => 'page',
			'posts_per_page' => 10,
			'post_parent'    => $parent_id,
			'order'          => 'ASC',
			'orderby'        => 'menu_order',
			'post__not_in'   => [ $post->ID ],
		];
	} else {
		$args = [
			'post_type'      => 'page',
			'posts_per_page' => 10,
			'post_parent'    => $post->ID,
			'order'          => 'ASC',
			'orderby'        => 'menu_order',
			'post__not_in'   => [ $post->ID ],
		];
	}
	$query = new WP_Query( $args );
	return $query;
}

//Clean.php
add_action( 'admin_init', 'remove_dashboard_widgets' );
add_action( 'init', 'head_cleanup' );
add_filter( 'the_generator', '__return_false' );

function head_cleanup() {
	// Originally from http://wpengineer.com/1438/wordpress-header/
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'use_default_gallery_style', '__return_false' );
}

function remove_dashboard_widgets() {
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
}