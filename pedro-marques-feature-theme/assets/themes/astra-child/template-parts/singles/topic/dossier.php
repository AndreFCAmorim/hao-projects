<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$topic_id = get_the_ID();

$topic_dossier_arr = get_post_meta( $topic_id, 'topic-dossiers', true );

if ( is_array( $topic_dossier_arr ) ) {
	printf(
		'<section id="parliamentary-dossier" class="frontpage-dossier">
			<h2 class="frontpage-dossier__entry-title">%1$s</h2>',
		esc_html__( 'Parliamentary Dossier', 'astra-child' ),
	);

	$items_html = '';

	foreach ( $topic_dossier_arr as $dossier_id ) {
		$items_html .= sprintf(
			'<div class="frontpage-dossier__item">
				<div class="frontpage-dossier__item-content">
					<div class="frontpage-dossier__item-content-title">
						<a href="%1$s">
							<h3>%2$s</h3>
						</a>
					</div>
					<div class="frontpage-dossier__item-content-text">
						%3$s
					</div>
				</div>
			</div>',
			esc_url( get_permalink( $dossier_id ) ),
			esc_html( get_the_title( $dossier_id ) ),
			wp_kses_post( get_the_excerpt( $dossier_id ) ),
		);
	}

	printf(
		'<div class="frontpage-dossier__columns_2" style="display: flex;">
			<div class="frontpage-dossier__columns_2_image">
				<img class="frontpage-dossier__image" src="%1$s">
			</div>
			<div class="frontpage-dossier__columns_2_content">
				%2$s
				<div class="frontpage-dossier__see-more">
					<a href="%3$s">%4$s</a>
				</div>
			</div>
		</div>
	</section>',
		esc_url( wp_get_attachment_url( get_option( 'parliamentary_dossier_attachment_id' ) ) ),
		$items_html,
		esc_url( get_post_type_archive_link( 'dossier' ) ),
		esc_html__( 'See more', 'astra-child' ),
	);

}