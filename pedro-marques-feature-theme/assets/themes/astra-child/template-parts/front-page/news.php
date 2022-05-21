<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$max_items = 3;
$news      = get_news( $max_items );


$items_count = 0;
$items_ids   = [];
$items_html  = '';

if ( $news->have_posts() ) {

	while ( $news->have_posts() ) {
		$news->the_post();

		$items_count++;
		$items_ids[] = get_the_ID();

		$news_image = get_the_post_thumbnail();
		if ( empty( $news_image ) ) {
			$news_image = '<img src="' . get_stylesheet_directory_uri() . '/dist/images/no_image.jpg">';
		}

		if ( $items_count === 1 ) {
			$class_name = '--first';
		} else {
			$class_name = '';
		}

		$items_html .= sprintf(
			'<div class="frontpage-news__item%1$s">
				<div class="frontpage-news__item-image">
					<a href="%3$s">
						%2$s
					</a>
				</div>
				<div class="frontpage-news__item-content">
					<div class="frontpage-news__item-content-title">
						<a href="%3$s">
							<h3>%4$s</h3>
						</a>
					</div>
					<div class="frontpage-news__item-content-text">
						%5$s
					</div>
				</div>
			</div>',
			esc_html( $class_name ),
			wp_kses_post( $news_image ),
			esc_url( get_permalink() ),
			esc_html( get_the_title() ),
			wp_kses_post( get_the_excerpt() ),
		);
	}

	wp_reset_postdata();
}

if ( $items_count < $max_items ) {

	$news = get_news_extra( $max_items - $items_count, $items_ids );

	if ( $news->have_posts() ) {

		while ( $news->have_posts() ) {
			$news->the_post();
			$items_count++;

			$news_image = get_the_post_thumbnail();
			if ( empty( $news_image ) ) {
				$news_image = '<img src="' . get_stylesheet_directory_uri() . '/dist/images/no_image.jpg">';
			}

			$class_name = '';

			$items_html .= sprintf(
				'<div class="frontpage-news__item%1$s">
					<div class="frontpage-news__item-image">
						<a href="%3$s">
							%2$s
						</a>
					</div>
					<div class="frontpage-news__item-content">
						<div class="frontpage-news__item-content-title">
							<a href="%3$s">
								<h3>%4$s</h3>
							</a>
						</div>
						<div class="frontpage-news__item-content-text">
							%5$s
						</div>
					</div>
				</div>',
				esc_html( $class_name ),
				wp_kses_post( $news_image ),
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
		'<section id="news-and-press" class="frontpage-news">
			<h2 class="frontpage-news__entry-title">%1$s</h2>
			%2$s
			<div class="frontpage-news__see-more">
				<a href="%3$s">%4$s</a>
			</div>
		</section>',
		esc_html__( 'News and Press', 'astra-child' ),
		wp_kses_post( $items_html ),
		esc_url( get_post_type_archive_link( 'event' ) . '?filter=news' ),
		esc_html__( 'See more', 'astra-child' ),
	);
}
