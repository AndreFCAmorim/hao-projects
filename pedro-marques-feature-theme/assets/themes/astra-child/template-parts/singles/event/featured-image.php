<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$event_id = get_the_ID();

if ( ! empty( get_the_post_thumbnail() ) ) {
	echo get_the_post_thumbnail( $event_id, 'large', [ 'class' => 'event-single__featured-image' ] );
} else {
	printf(
		'<img class="event-single__featured-image" src="%1$s">',
		get_stylesheet_directory_uri() . '/dist/images/no_image.jpg',
	);
}
