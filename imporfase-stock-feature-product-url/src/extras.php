<?php
/*
 * Custom Print object
 */
if ( 'WP_ENV' === 'development' ) {
	function lcd( $object ) {
		echo "<div style='overflow: visible;'><pre style='overflow: visible; min-width: 600px; font-size: 11px;'>" ;
		var_dump( $object );
		echo '</pre></div>';
	}

	function lee( $object ) {
		error_log( print_r( $object, true ) );
	}
}


function custom_excerpt_length() {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
 * Manage output of wp_title()
 */
function roots_wp_title( $title ) {
	if ( is_feed() ) {
		return $title;
	}

	$title .= get_bloginfo( 'name' );

	return $title;
}
add_filter( 'wp_title', 'roots_wp_title', 10 );



function lc43_remove_default_image_sizes( $sizes ) {
	unset( $sizes['thumbnail'] );

	return $sizes;
}
add_filter( 'intermediate_image_sizes_advanced', 'lc43_remove_default_image_sizes' );


/*
* Admin styles
*
* */

function custom_colors() {
	echo '<style type="text/css">
		.acf_postbox { background-color: rgb(95, 158, 160); padding: 20px; }
		.acf_postbox p.label { color: rgb(236, 236, 236); text-shadow: none;  }
		.acf_postbox p.label label { color: white; font-size: 16px; }
		.acf_postbox > h3, .acf_postbox > .handlediv { display: block; }
		#poststuff .acf_postbox h3, .metabox-holder .acf_postbox h3 { padding: 8px 12px 8px 0; }
		.acf_postbox > h3 { color: rgb(255,255,255); }
		.field_type-true_false p.label { float:left; width: 79%;}
		.field_type-true_false ul.acf-checkbox-list { float:right; width: 20%;}
		#multiple-password { height: 300px }
		#acf-clientes .acf-checkbox-list li {  min-width: 35px; }

	</style>';
}

add_action( 'admin_head', 'custom_colors' );


function head_cleanup() {
	add_filter( 'use_default_gallery_style', '__return_false' );
	add_filter( 'the_generator', '__return_false' );
	add_action( 'wp_head', 'ob_start', 1, 0 );

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
}
add_action( 'init', 'head_cleanup' );


function remove_dashboard_widgets() {
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
}
add_action( 'admin_init', 'remove_dashboard_widgets' );

