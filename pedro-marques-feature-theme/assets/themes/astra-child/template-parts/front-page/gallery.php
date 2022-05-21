<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$max_items = 6;
$gallery   = get_gallery( $max_items );


$items_count = 0;
$items_ids   = [];
$items_html  = '';

if ( $gallery->have_posts() ) {

	while ( $gallery->have_posts() ) {
		$gallery->the_post();

		$items_count++;
		$items_ids[] = get_the_ID();

		$items_html .= sprintf(
			'<div class="frontpage-gallery__item">
				<a href="%1$s">
					<img class="frontpage-gallery__item-image" src="%2$s" />
				</a>
			</div>',
			esc_url( get_permalink() ),
			esc_url( get_post_meta( get_the_ID(), 'gallery-image' )[0]['url'] ),
		);
	}

	wp_reset_postdata();
}

if ( $items_count < $max_items ) {

	$gallery = get_gallery_extra( $max_items - $items_count, $items_ids );

	if ( $gallery->have_posts() ) {

		while ( $gallery->have_posts() ) {
			$gallery->the_post();
			$items_count++;

			$items_html .= sprintf(
				'<div class="frontpage-gallery__item">
					<a href="%1$s">
						<img class="frontpage-gallery__item-image" src="%2$s" />
					</a>
				</div>',
				esc_url( get_permalink() ),
				esc_url( get_post_meta( get_the_ID(), 'gallery-image' )[0]['url'] ),
			);
		}

		wp_reset_postdata();
	}
}

if ( $items_count > 0 ) {

	printf(
		'<section id="gallery" class="frontpage-gallery">
			<h2 class="frontpage-gallery__entry-title">%1$s</h2>
			<div class="frontpage-gallery__items">
				%2$s
			</div>
			<div class="frontpage-gallery__see-more">
				<a href="%3$s">%4$s</a>
			</div>
		</section>',
		esc_html__( 'Gallery', 'astra-child' ),
		$items_html,
		esc_url( get_post_type_archive_link( 'gallery' ) ),
		esc_html__( 'See more', 'astra-child' ),
	);

}
