<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$max_items = 3;
$dossier   = get_dossier( $max_items );


$items_count = 0;
$items_ids   = [];
$items_html  = '';

if ( $dossier->have_posts() ) {

	while ( $dossier->have_posts() ) {
		$dossier->the_post();

		$items_count++;
		$items_ids[] = get_the_ID();

		if ( $items_count === 1 ) {
			$class_name = '--first';
		} else {
			$class_name = '';
		}

		$items_html .= sprintf(
			'<div class="frontpage-dossier__item%1$s">

				<div class="frontpage-dossier__item-content">
					<div class="frontpage-dossier__item-content-title">
						<a href="%3$s">
							<h3>%4$s</h3>
						</a>
					</div>
					<div class="frontpage-dossier__item-content-text">
						%5$s
					</div>
				</div>
			</div>',
			esc_html( $class_name ),
			'',
			esc_url( get_permalink() ),
			esc_html( get_the_title() ),
			wp_kses_post( get_the_excerpt() ),
		);
	}

	wp_reset_postdata();
}

if ( $items_count < $max_items ) {

	$dossier = get_dossier_extra( $max_items - $items_count, $items_ids );

	if ( $dossier->have_posts() ) {

		while ( $dossier->have_posts() ) {
			$dossier->the_post();
			$items_count++;

			$class_name = '';

			$items_html .= sprintf(
				'<div class="frontpage-dossier__item%1$s">
					<div class="frontpage-dossier__item-content">
						<div class="frontpage-dossier__item-content-title">
							<a href="%3$s">
								<h3>%4$s</h3>
							</a>
						</div>
						<div class="frontpage-dossier__item-content-text">
							%5$s
						</div>
					</div>
				</div>',
				esc_html( $class_name ),
				'',
				esc_url( get_permalink() ),
				esc_html( get_the_title() ),
				wp_kses_post( get_the_excerpt() ),
			);
		}

		wp_reset_postdata();
	}
}

if ( $items_count > 0 ) {
	printf(
		'<section id="parliamentary-dossier" class="frontpage-dossier">
			<h2 class="frontpage-dossier__entry-title">%1$s</h2>',
		esc_html__( 'Parliamentary Dossier', 'astra-child' ),
	);

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
