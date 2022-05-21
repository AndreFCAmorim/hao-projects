<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$topic_id = get_the_ID();

$conclusion = get_post_meta( $topic_id, 'topic-conclusion', true );

printf(
	'<p class="topic-single__conclusion">
		%1$s
	</p>',
	esc_html( $conclusion ),
);
