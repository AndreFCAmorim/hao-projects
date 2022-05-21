<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$gallery_id = get_the_ID();

printf(
	'<img src="%1$s" />',
	esc_url( get_post_meta( get_the_ID(), 'gallery-image' )[0]['url'] ),
);
