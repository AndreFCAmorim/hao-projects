<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


$dossier_id = get_the_ID();

$date = get_post_meta( $dossier_id, 'dossier-date', true );

printf(
	'<h5 class="dossier-archive__item-date">
		%1$s
	</h5>',
	esc_html( $date ),
);
