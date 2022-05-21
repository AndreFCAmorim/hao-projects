<?php
/**
 * Roots includes
 *
 * The $roots_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/roots/pull/1042
 */
$roots_includes = array(
	'src/utils.php',           // Utility functions
	'src/init.php',            // Initial theme setup and constants
	'src/wrapper.php',         // Theme wrapper class
	'src/config.php',          // Configuration
	'src/titles.php',          // Page titles
	'src/scripts.php',         // Scripts and stylesheets
	'src/extras.php',          // Custom functions
	'src/custom-fields.php',   // Custom functions
	'src/stock.php',           // Stock functions
);
define( 'THEME_NAME', 'impstock' );
define( 'THEME_VERSION', '2.0.2' );
define( 'MCS_MAX_NUMBERPOSTS', '500' );

foreach ( $roots_includes as $file ) {
	if ( ! $filepath = locate_template( $file ) ) {
		trigger_error( sprintf( esc_html__( 'Error locating %s for inclusion', 'impstock' ), $file ), E_USER_ERROR );
	}

	require_once $filepath;
}
unset( $file, $filepath );
