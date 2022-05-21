<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$topic_id = get_the_ID();

if ( ! empty( get_the_post_thumbnail() ) ) {
	echo get_the_post_thumbnail( $topic_id, 'large', [ 'class' => 'topic-single__featured-image' ] );
} else {
	printf(
		'<img class="topic-single__featured-image" src="%1$s">',
		get_stylesheet_directory_uri() . '/dist/images/no_image.jpg',
	);
}
