<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


$dossier_id = get_the_ID();

$credit = get_post_meta( $dossier_id, 'dossier-credit', true );

printf(
	'<h5 class="dossier-archive__item-credit">
		%1$s
	</h5>',
	esc_html( $credit ),
);
