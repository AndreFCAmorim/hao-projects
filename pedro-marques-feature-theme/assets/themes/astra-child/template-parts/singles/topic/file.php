<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$topic_id = get_the_ID();

$file = get_post_meta( $topic_id, 'topic-file', true );

if ( is_array( $file ) ) {

	if ( ! empty( $file['url'] ) ) {
		printf(
			'<div class="topic-single__file">
				<a target="_blank" href="%1$s">%2$s</a>
			</div>',
			esc_html( $file['url'] ),
			esc_html__( 'Download File', 'astra-child' )
		);
	}

}