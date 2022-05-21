<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$event_id = get_the_ID();

$date = get_post_meta( $event_id, 'event-date', true );

printf(
	'<h5 class="event-archive__entry-date">
		%1$s
	</h5>',
	esc_html( $date ),
);
