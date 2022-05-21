<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$topics = get_topics_terms();

if ( $topics->terms ) {

	printf(
		'<section class="frontpage-topics">',
		__( 'Topics', 'astra-child' ),
	);

	foreach ( $topics->terms as $tax_term ) {
		$first_post = get_topics_by_term( $tax_term->name );

		if ( isset( $first_post->posts[0]->ID ) ) {
			$topics_image = get_the_post_thumbnail( $first_post->posts[0]->ID );
		}

		if ( empty( $topics_image ) ) {
			$topics_image = '<img width="500" height="500" src="' . get_stylesheet_directory_uri() . '/dist/images/no_image.jpg' . '">';
		}

		printf(
			'<div class="frontpage-topics__item">
				<div class="frontpage-topics__item-image">
					<a href="%2$s">
						%1$s
					</a>
				</div>
				<div class="frontpage-topics__item-text">
					<a href="%2$s">
						<h3>%3$s</h3>
					</a>
				</div>
			</div>',
			wp_kses_post( $topics_image ),
			esc_url( get_term_link( $tax_term->term_id ) ),
			esc_html( $tax_term->name ),
		);
	}

	printf(
		'<div class="frontpage-topics__see-more">
			<a href="%1$s">%2$s</a>
		</div>
		</section>',
		esc_url( get_post_type_archive_link( 'topic' ) ),
		__( 'See more', 'astra-child' ),
	);
}
