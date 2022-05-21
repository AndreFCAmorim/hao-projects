<?php

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
	$parenthandle = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
	$theme        = wp_get_theme();
	wp_enqueue_style(
		$parenthandle,
		get_template_directory_uri() . '/style.css',
		[],  // if the parent theme code has a dependency, copy it to here
		$theme->parent()->get( 'Version' )
	);
	wp_enqueue_style(
		'child-style',
		get_stylesheet_uri(),
		[ $parenthandle ],
		$theme->get( 'Version' ) // this only works if you have Version in the style header
	);
}

// HAO - BEGIN
add_action(
	'rest_api_init',
	function() {
		register_rest_route(
			'hao/v1',
			'/futuro/(?P<id>[^/]+)',
			[
				'methods'             => 'GET',
				'callback'            => 'check_futuro_post_exists',
				'permission_callback' => function() {
					return true;
				},
			]
		);

		register_rest_route(
			'hao/v1',
			'/futuro',
			[
				'methods'             => 'POST',
				'callback'            => 'set_futuro_post_featured_image',
				'permission_callback' => function() {
					return true;
				},
			]
		);
	}
);


function check_futuro_post_exists( $data ) {
	global $wpdb;
	return $wpdb->get_row( $wpdb->prepare( "SELECT post_id FROM wp_postmeta WHERE meta_key='remote_post_id' AND meta_value='%d'", $data['id'] ) );
}

function set_futuro_post_featured_image( $data ) {
	global $wpdb;
	$futuro_id     = $wpdb->get_row( $wpdb->prepare( "SELECT post_id FROM wp_postmeta WHERE meta_key='remote_post_id' AND meta_value='%d'", $data['id'] ) );
	$futuro_url    = $wpdb->get_row( $wpdb->prepare( "SELECT meta_value FROM wp_postmeta WHERE meta_key='remote_post_featured_image_url' AND post_id='%d'", $futuro_id->post_id ) );
	$current_image = get_the_post_thumbnail_url( $futuro_id->post_id );

	//If there's changes in the url
	if ( $current_image !== $futuro_url ) {

		// Add Featured Image to Post
		$image_url        = $futuro_url->meta_value; // Define the image URL here
		$image_name       = basename( $futuro_url->meta_value );
		$upload_dir       = wp_upload_dir(); // Set upload folder
		$image_data       = file_get_contents( $image_url ); // Get image data
		$unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
		$filename         = basename( $unique_file_name ); // Create image file name

		// Check folder permission and define file location
		if ( wp_mkdir_p( $upload_dir['path'] ) ) {
			$file = $upload_dir['path'] . '/' . $filename;
		} else {
			$file = $upload_dir['basedir'] . '/' . $filename;
		}

		// Create the image  file on the server
		file_put_contents( $file, $image_data );

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
		$res = new WP_REST_Response( $response );
		$res->set_status( 200 );

		return [
			'req'     => $res,
			'data_id' => $data['id'],
			'id'      => $futuro_id->post_id,
			'meta'    => $futuro_url->meta_value,
			'current' => $current_image,
		];

	}
}
