<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$dossier_id = get_the_ID();

if ( ! empty( get_the_post_thumbnail() ) ) {
	printf(
		'<a href="%1$s">%2$s</a>',
		esc_url( get_permalink() ),
		get_the_post_thumbnail( $dossier_id, 'large', [ 'class' => 'dossier-archive__featured-image' ] ),
	);
} else {
	printf(
		'<a href="%1$s">
			<img class="dossier-archive__featured-image" src="%2$s">
		</a>',
		esc_url( get_permalink() ),
		get_stylesheet_directory_uri() . '/dist/images/no_image.jpg',
	);
}

