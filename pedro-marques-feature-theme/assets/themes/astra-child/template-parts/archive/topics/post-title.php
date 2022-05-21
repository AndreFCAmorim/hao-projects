<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

printf(
	'<h3 class="topic-archive__item-content-title">
		<a href="%1$s">%2$s</a>
	</h3>',
	esc_url( get_permalink() ),
	esc_html( get_the_title() ),
);
