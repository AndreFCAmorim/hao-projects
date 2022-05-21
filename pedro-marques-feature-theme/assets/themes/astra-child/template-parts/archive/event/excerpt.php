<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

printf(
	'<p class="event-archive__item-content-excerpt">
		%1$s
	</p>',
	wp_kses_post( get_the_excerpt() ),
);
