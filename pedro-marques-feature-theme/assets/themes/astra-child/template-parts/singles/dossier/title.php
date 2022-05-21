<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$dossier_id = get_the_ID();

printf(
	'<h1 class="header-dossier-single__title">
		%1$s
	</h1>',
	esc_html( get_the_title( $dossier_id ) ),
);
