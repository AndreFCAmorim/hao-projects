<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

printf(
	'<p class="dossier-archive__item-excerpt">
		%1$s
	</p>',
	wp_kses_post( get_the_excerpt() ),
);
