<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$topic_id = get_the_ID();

$author = get_post_meta( $topic_id, 'topic-author', true );

printf(
	'<h5 class="topic-single__header-content-author">
		%1$s
	</h5>',
	esc_html( $author ),
);
