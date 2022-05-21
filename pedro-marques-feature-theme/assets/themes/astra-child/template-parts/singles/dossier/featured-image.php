<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$dossier_id = get_the_ID();

if ( ! empty( get_the_post_thumbnail() ) ) {
	echo get_the_post_thumbnail( $dossier_id, 'large', [ 'class' => 'dossier-single__featured-image' ] );
} else {
	printf(
		'<img class="dossier-single__featured-image" src="%1$s">',
		get_stylesheet_directory_uri() . '/dist/images/no_image.jpg',
	);
}
