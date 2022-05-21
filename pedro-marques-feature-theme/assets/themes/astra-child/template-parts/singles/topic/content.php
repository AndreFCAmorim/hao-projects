<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$topic_id = get_the_ID();

echo wp_kses_post( apply_filters( 'the_content', get_the_content( $topic_id ) ) );
