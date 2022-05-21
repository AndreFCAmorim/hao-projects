<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$event_id = get_the_ID();

$local = get_post_meta( $event_id, 'event-local', true );

printf(
	'<h5 class="event-single__header-content-local">
		%1$s
	</h5>',
	wp_kses_post( make_clickable( $local ) ),
);
