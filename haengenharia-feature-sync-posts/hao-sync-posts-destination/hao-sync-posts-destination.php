<?php
/**
 * Plugin Name:       HaO Sync Posts [ Destination ]
 * Plugin URI:        https://hopeandoak.agency
 * Description:       This plugin should be installed in the site that will receive data from remote.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.3
 * Author:            Hope and Oak Agency
 * Author URI:        https://hopeandoak.agency
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       hao-sync-posts-endpoints
 * Domain Path:       /languages
 */

require 'include/basic-auth.php'; //This add basic-auth plugin. This plugin isn't available on WP Plugin Library.

add_action(
	'rest_api_init',
	function() {
		register_rest_route(
			'hao/v1',
			'/futuro/(?P<id>[^/]+)',
			[
				'methods'             => 'GET',
				'callback'            => 'hao_check_futuro_post_exists',
				'permission_callback' => '__return_true',
			]
		);

		register_rest_route(
			'hao/v1',
			'/futuro/image',
			[
				'methods'             => 'POST',
				'callback'            => 'hao_set_futuro_post_featured_image',
				'permission_callback' => '__return_true',
			]
		);

		register_rest_route(
			'hao/v1',
			'/futuro/terms',
			[
				'methods'             => 'POST',
				'callback'            => 'hao_check_term_exists',
				'permission_callback' => '__return_true',
			]
		);
		register_rest_route(
			'hao/v1',
			'/futuro/clear',
			[
				'methods'             => 'POST',
				'callback'            => 'hao_clear_terms',
				'permission_callback' => '__return_true',
			]
		);
	}
);

function hao_clear_terms( $data ) {
	$post_id = [];
	if ( empty( $data['id'] ) ) {
		return new WP_Error( '400', __( 'Missing Parameters', 'hao-sync-posts-endpoints' ) );
	}

	$post_id = (int) sanitize_text_field( $data['id'] );

	$taxonomies = [
		'formato',
		'local',
		'destaque',
		'futuro-areas-eng',
		'categorias-vai-acontecer',
	];

	wp_delete_object_term_relationships( $post_id, $taxonomies );
	return;
}
/**
 * Check if futuro post exists and returns the post id
 *
 * @param  mixed $data Data submit
 * @return int Post ID
 */
function hao_check_futuro_post_exists( $data ) {
	if ( empty( $data['id'] ) ) {
		return new WP_Error( '400', __( 'Missing Parameters', 'hao-sync-posts-endpoints' ) );
	}
	$data_id = (int) $data['id'];

	//Before checking do a taxonomy clean up
	hao_clean_taxonomies_empty_terms();

	global $wpdb;
	return $wpdb->get_row( $wpdb->prepare( "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key='remote_post_id' AND meta_value='%d'", $data_id) );
}

/**
 * Set featured image
 *
 * @param  mixed $data Data submit
 */
function hao_set_futuro_post_featured_image( $data ) {
	if ( empty( $data['id'] ) ) {
		return new WP_Error( '400', __( 'Missing Parameters', 'hao-sync-posts-endpoints' ) );
	}
	$data_id = (int) $data['id'];

	global $wpdb;

	$futuro_id     = $wpdb->get_row( $wpdb->prepare( "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key='remote_post_id' AND meta_value='%d'", $data_id ) );
	$futuro_url    = $wpdb->get_row( $wpdb->prepare( "SELECT meta_value FROM {$wpdb->postmeta} WHERE meta_key='remote_post_featured_image_url' AND post_id='%d'", $futuro_id->post_id ) );
	$current_image = get_the_post_thumbnail_url( $futuro_id->post_id );

	if ( $futuro_url->meta_value === '0' ) {
		$futuro_url->meta_value = false;
	}

	//If there's no changes in the url
	if ( basename( $current_image ) === basename( $futuro_url->meta_value ) ) {
		return;
	}

	// Add Featured Image to Post
	$image_url  = $futuro_url->meta_value;
	$upload_dir = wp_upload_dir(); // Set upload folder
	$image_data = wp_remote_get( $image_url, [ 'sslverify' => false ] ); // Get image data
	$filename   = basename( $futuro_url->meta_value ); // Create image file name

	//Check if this new image already exists in media library
	$current_image_id = $wpdb->get_row( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE post_title='%s'", $filename ) );

	if ( ! is_null( $current_image_id ) ) {
		//Set image from media library
		set_post_thumbnail( $futuro_id->post_id, $current_image_id->ID );
		return;
	}

	//Insert image
	// Check folder permission and define file location
	if ( wp_mkdir_p( $upload_dir['path'] ) ) {
		$file = $upload_dir['path'] . '/' . $filename;
	} else {
		$file = $upload_dir['basedir'] . '/' . $filename;
	}

	// Create the image  file on the server
	file_put_contents( $file, $image_data['body'] );

	// Check image file type
	$wp_filetype = wp_check_filetype( $filename, null );

	// Set attachment data
	$attachment = [
		'post_mime_type' => $wp_filetype['type'],
		'post_title'     => sanitize_file_name( $filename ),
		'post_content'   => '',
		'post_status'    => 'inherit',
	];

	// Create the attachment
	$attach_id = wp_insert_attachment( $attachment, $file );

	// Include image.php
	require_once ABSPATH . 'wp-admin/includes/image.php';

	// Define attachment metadata
	$attach_data = wp_generate_attachment_metadata( $attach_id, $file );

	// Assign metadata to attachment
	wp_update_attachment_metadata( $attach_id, $attach_data );

	// And finally assign featured image to post
	set_post_thumbnail( $futuro_id->post_id, $attach_id );

	//Define status
	$res = new WP_REST_Response();
	$res->set_status( 200 );

	return [
		'req'     => $res,
		'data_id' => $data_id,
		'id'      => $futuro_id->post_id,
		'meta'    => $futuro_url->meta_value,
		'current' => $current_image,
	];
}

/**
 * Callback - Check if terms exist and return array with ids
 *
 * @param  mixed $data     Data submit
 * @return array $term_ids Collection of term ids
 */
function hao_check_term_exists( $data ) {
	$term_ids = [];
	if ( empty( $data['terms'] ) ) {
		return new WP_Error( '400', __( 'Missing Parameters', 'hao-sync-posts-endpoints' ) );
	}

	$tax_name = sanitize_text_field( $data['taxonomy'] );

	foreach ( $data['terms'] as $term ) {
		$existing_term = term_exists( $term, $tax_name ); //Get the id of the term by name and tax

		//Check if term exists
		if ( ! is_null( $existing_term ) && ! empty( $existing_term['term_id'] ) ) {
			//Collect the id
			$term_ids[] = intval( $existing_term['term_id'] );
			continue;
		}

		//Create term and collect the id
		$api_response = wp_insert_term( $term, $tax_name );
		if ( is_wp_error( $api_response ) ) {
			$message = $api_response->get_error_message();
			$code    = $api_response->get_error_code();
			throw new \Exception( $message, $code );
		}
		$term_ids[] = $api_response['term_id'];
	}

	return $term_ids;
}

/**
 * Clean up empty terms from taxonomies used in sync
 */
function hao_clean_taxonomies_empty_terms() {
	$taxonomies = [
		'formato',
		'local',
		'destaque',
		'futuro-areas-eng',
		'categorias-vai-acontecer',
	];

	foreach ( $taxonomies as $taxonomy ) {
		$terms = get_terms(
			[
				'taxonomy'   => $taxonomy,
				'hide_empty' => false,
			]
		);

		if ( is_wp_error( $terms ) ) {
			$message = $terms->get_error_message();
			$code    = $terms->get_error_code();
			throw new \Exception( $message, $code );
		}

		foreach ( $terms as $term ) {
			$term_count = $term->count;

			if ( $term_count < 1 ) {
				$term_response = wp_delete_term( $term->term_id, $taxonomy );
				if ( is_wp_error( $term_response ) ) {
					$message = $term_response->get_error_message();
					$code    = $term_response->get_error_code();
					throw new \Exception( $message, $code );
				}
			}
		}
	}

}
