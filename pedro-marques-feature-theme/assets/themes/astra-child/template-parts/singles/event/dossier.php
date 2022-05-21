<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$event_id = get_the_ID();

$event_dossier_arr = get_post_meta( $event_id, 'event-dossier', true );

if ( ! empty( $event_dossier_arr ) ) {
	printf(
		'<h2 class="event-single__dossier-title">%1$s</h2>',
		esc_html__( 'Dossiers', 'astra-child' ),
	);

	foreach ( $event_dossier_arr as $dossier_id ) {
		printf(
			'<div class="event-single__dossier-item">
				<a href="%3$s">
					%1$s
					<h5 class="event-single__dossier-item-title">%2$s</h5>
				</a>
			</div>',
			get_the_post_thumbnail( $dossier_id, 'large', [ 'class' => 'event-single__dossier-item-image' ] ),
			esc_html( get_the_title( $dossier_id ) ),
			esc_url( get_permalink( $dossier_id ) ),
		);
	}
}