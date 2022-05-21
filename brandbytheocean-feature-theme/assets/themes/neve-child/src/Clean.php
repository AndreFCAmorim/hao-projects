<?php
/**
 * Theme cleanup.
 */
namespace HopeandOak\WP\Theme\Hao;

/**
 * Theme cleanup.

 */
class Clean {

	/**
	 * Setup hooks.
	 */
	public function ready() {
		add_action( 'admin_init', [ $this, 'remove_dashboard_widgets' ] );
		add_action( 'init', [ $this, 'head_cleanup' ] );
		add_filter( 'the_generator', '__return_false' );
		//add_action( 'wp_enqueue_scripts', [ $this, 'wp_block_library_css'], 100 );
	}

	public function wp_block_library_css(){
	  wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
		//wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
	} 
	
	public function head_cleanup() {
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

		//comments
		wp_deregister_script( 'comment-reply' );
	}

	public function remove_dashboard_widgets() {
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
	}
}
