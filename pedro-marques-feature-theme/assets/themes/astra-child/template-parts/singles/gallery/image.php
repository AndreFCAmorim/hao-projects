<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$gallery_id = get_the_ID();

printf(
	'<img class="gallery-single__content-image" src="%1$s" />',
	esc_url( get_post_meta( get_the_ID(), 'gallery-image' )[0]['url'] ),
);
