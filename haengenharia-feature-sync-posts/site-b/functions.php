<?php
/**
* Theme functions and definitions
*
* @package HelloOERN
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_OERN_VERSION', '1.0.4' );

if ( ! function_exists( 'hello_elementor_scripts_styles' ) ) {
	/**
	* Theme Scripts & Styles.
	*
	* @return void
	*/
	function hello_elementor_scripts_styles() {
		wp_enqueue_style(
			'menu_styles',
			get_stylesheet_directory_uri() . '/assets/css/styles.css',
			[],
			HELLO_OERN_VERSION
		);

		wp_enqueue_style( 'hello-elementor-style', get_template_directory_uri() . '/style.css', [], HELLO_OERN_VERSION );
		wp_enqueue_script( 'oern_scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.js', [ 'jquery' ], HELLO_OERN_VERSION, true );
		wp_enqueue_style( 'oern_styles', get_stylesheet_directory_uri() . '/assets/css/oern.css', [], HELLO_OERN_VERSION );
		wp_enqueue_style( 'cuprum-font', 'https://fonts.googleapis.com/css2?family=Cuprum:wght@400;700&display=swap', [], HELLO_OERN_VERSION );
	}
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_scripts_styles' );

/**Edicao Login page*/

function my_custom_login() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo( 'stylesheet_directory' ) . '/login/custom-login-styles.css" />';
}
add_action( 'login_head', 'my_custom_login' );


function my_login_logo_url() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );


function my_login_logo_url_title() {
	return 'Your Site Name and Info';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


//retirar elementor widget dashboard
function disable_elementor_dashboard_overview_widget() {
	remove_meta_box( 'e-dashboard-overview', 'dashboard', 'normal' );
}
add_action( 'wp_dashboard_setup', 'disable_elementor_dashboard_overview_widget', 40 );

//retirar elementor template folder
function wpdocs_remove_menus() {
	// don't do anything if the user can publish posts
	if ( current_user_can( 'manage_options' ) ) {
		return;
	}
	// remove these items from the admin menu
	remove_menu_page( 'edit.php?post_type=elementor_library' );
}

add_action( 'admin_menu', 'wpdocs_remove_menus' );

//Admin sorting datainicio
function datainicio_orderby( $query ) {

	if ( ! is_admin() ) {
		return;
	}

	$orderby = $query->get( 'orderby' );

	switch ( $orderby ) {
		case 'datainicio':
			$query->set( 'meta_key', 'datainicio' );
			$query->set( 'orderby', 'meta_value' );
			break;
		default:
			break;
	}

}

add_action( 'pre_get_posts', 'datainicio_orderby' );

//Admin sorting datafim
function datafim_orderby( $query ) {

	if ( ! is_admin() ) {
		return;
	}

	$orderby = $query->get( 'orderby' );

	switch ( $orderby ) {
		case 'datafim':
			$query->set( 'meta_key', 'datafim' );
			$query->set( 'orderby', 'meta_value' );
			break;
		default:
			break;
	}

}

add_action( 'pre_get_posts', 'datafim_orderby' );


// Sorting Post Grid CPT - datainicio
add_action( 'elementor/query/jet-smart-filters', function( $query ) {
	$query->set( 'post_type', [ 'cursos' ] );
	$query->set( 'meta_query', [
		'relation'                => 'AND',
		'curso_com_data_prevista' => [
			'key'     => 'cursocomdata',
			'compare' => 'EXISTS',
		],
		'datainicio_curso'        => [
			'key'     => 'datainicio',
			'compare' => 'EXISTS',
		],
	] );
	$query->set( 'orderby', [
		'curso_com_data_prevista' => 'DESC',
		'datainicio_curso'        => 'ASC',
	] );
} );

// HAO - BEGIN
add_action( 'transition_post_status', 'on_all_status_transitions', 10, 3 );
function on_all_status_transitions( $new_status, $old_status, $post ) {
	//Credentials to remote
	$url  = 'http://formacao-oern-site-a.test/';
	$user = 'andre';
	$pass = 'pw';

	if ( $post->post_type === 'cursos' ) {

		if ( ( $old_status === 'draft' || $old_status === 'auto-draft' ) && $new_status === 'publish' ) {
			//Publish first so we can grab the meta fields
			//wp_update_post( $post );
			remote_insert_or_update_post( $post, $url, $user, $pass, $new_status );
		}

		if ( $old_status === 'publish' && ( $new_status === 'publish' || $new_status === 'draft' ) ) {
			remote_insert_or_update_post( $post, $url, $user, $pass, $new_status );
		}

		if ( ( $old_status === 'publish' || $old_status === 'draft' ) && $new_status === 'trash' ) {
			remote_delete_post( $post, $url, $user, $pass );
		}

		if ( $old_status === 'trash' && ( $new_status === 'draft' || $new_status === 'publish' ) ) {
			remote_insert_or_update_post( $post, $url, $user, $pass, $new_status );
		}
	}
}

include 'inc/remote_sync.php';
