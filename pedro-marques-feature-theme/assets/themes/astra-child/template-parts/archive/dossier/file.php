<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$dossier_id = get_the_ID();

$file = get_post_meta( $dossier_id, 'dossier-file', true );

if ( is_array( $file ) ) {
	if ( ! empty( $file['url'] ) ) {
		printf(
			'<a target="_blank" href="%1$s">%2$s</a>',
			esc_html( $file['url'] ),
			esc_html__( 'Download File', 'astra-child' )
		);

	}
}
