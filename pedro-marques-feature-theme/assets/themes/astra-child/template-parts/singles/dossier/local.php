<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$dossier_id = get_the_ID();

$local = get_post_meta( $dossier_id, 'dossier-local', true );

printf(
	'<h5 class="dossier-single__header-content-local">
		%1$s
	</h5>',
	esc_html( $local ),
);
