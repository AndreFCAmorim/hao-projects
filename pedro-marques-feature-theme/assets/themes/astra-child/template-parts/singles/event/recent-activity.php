<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$event_id = get_the_ID();

$max_items       = 3;
$recent_activity = get_recent_activity( $max_items, false, [ $event_id ] );


$items_count = 0;
$items_ids   = [ $event_id ];
$items_html  = '';

if ( $recent_activity->have_posts() ) {

	while ( $recent_activity->have_posts() ) {
		$recent_activity->the_post();

		$items_count++;
		$items_ids[] = get_the_ID();

		$recent_activity_image = get_the_post_thumbnail();
		if ( empty( $recent_activity_image ) ) {
			$recent_activity_image = '<img src="' . get_stylesheet_directory_uri() . '/dist/images/no_image.jpg">';
		}

		if ( $items_count === 1 ) {
			$class_name = '--first';
		} else {
			$class_name = '';
		}

		$items_html .= sprintf(
			'<div class="frontpage-recent-activity__item%1$s">
				<div class="frontpage-recent-activity__item-image">
					<a href="%3$s">
						%2$s
					</a>
				</div>
				<div class="frontpage-recent-activity__item-content">
					<div class="frontpage-recent-activity__item-content-title">
						<a href="%3$s">
							<h3>%4$s</h3>
						</a>
					</div>
					<div class="frontpage-recent-activity__item-content-text">
						%5$s
					</div>
				</div>
			</div>',
			esc_html( $class_name ),
			wp_kses_post( $recent_activity_image ),
			esc_url( get_permalink() ),
			esc_html( get_the_title() ),
			wp_kses_post( get_the_excerpt() ),
		);
	}

	wp_reset_postdata();
}

if ( $items_count < $max_items ) {

	$recent_activity = get_recent_activity_extra( $max_items - $items_count, $items_ids, false );

	if ( $recent_activity->have_posts() ) {

		while ( $recent_activity->have_posts() ) {
			$recent_activity->the_post();
			$items_count++;

			$recent_activity_image = get_the_post_thumbnail();
			if ( empty( $recent_activity_image ) ) {
				$recent_activity_image = '<img src="' . get_stylesheet_directory_uri() . '/dist/images/no_image.jpg">';
			}

			$class_name = '';

			$items_html .= sprintf(
				'<div class="frontpage-recent-activity__item%1$s">
					<div class="frontpage-recent-activity__item-image">
						<a href="%3$s">
							%2$s
						</a>
					</div>
					<div class="frontpage-recent-activity__item-content">
						<div class="frontpage-recent-activity__item-content-title">
							<a href="%3$s">
								<h3>%4$s</h3>
							</a>
						</div>
						<div class="frontpage-recent-activity__item-content-text">
							%5$s
						</div>
					</div>
				</div>',
				esc_html( $class_name ),
				wp_kses_post( $recent_activity_image ),
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
		'<section id="activities" class="frontpage-recent-activity">
			<h2 class="frontpage-recent-activity__entry-title">%1$s</h2>
			%2$s
			<div class="frontpage-recent-activity__see-more">
				<a href="%3$s">%4$s</a>
			</div>
		</section>',
		esc_html__( 'Activities', 'astra-child' ),
		wp_kses_post( $items_html ),
		esc_url( get_post_type_archive_link( 'event' ) . '?filter=recent-activity' ),
		esc_html__( 'See more', 'astra-child' ),
	);
}
