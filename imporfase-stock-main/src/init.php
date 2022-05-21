<?php
/**
 * Roots initial setup and constants
 */
function roots_setup() {
	// Make theme available for translation
	// Community translations can be found at https://github.com/roots/roots-translations
	load_theme_textdomain( 'stock', get_template_directory() . '/lang/frontend/' );
	load_theme_textdomain( 'impstock', get_template_directory() . '/languages/' );
	load_theme_textdomain( 'stock-admin', get_template_directory() . '/lang/backend/' );

	add_theme_support( 'post-thumbnails' );

	// Add HTML5 markup for captions
	add_theme_support( 'html5', array( 'caption' ) );

	// Tell the TinyMCE editor to use a custom stylesheet
	add_editor_style( '/assets/css/editor-style.css' );
}
add_action( 'after_setup_theme', 'roots_setup' );
