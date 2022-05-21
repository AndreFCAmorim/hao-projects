<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$gallery_id = get_the_ID();

printf(
	'<h2>%1$s</h2>',
	esc_html( get_the_title( $gallery_id ) ),
);