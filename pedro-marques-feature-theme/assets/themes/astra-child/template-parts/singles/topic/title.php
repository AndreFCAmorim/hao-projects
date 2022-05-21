<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$topic_id = get_the_ID();

printf(
	'<h2 class="header-topic-single__title">%1$s</h2>',
	esc_html( get_the_title( $topic_id ) ),
);
