<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$topic_id = get_the_ID();

$lead = get_post_meta( $topic_id, 'topic-lead', true );

printf(
	'<p class="topic-single__lead">
		%1$s
	</p>',
	esc_html( $lead ),
);
