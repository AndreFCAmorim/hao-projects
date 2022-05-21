<?php
/**
 * The Template Name: Podcast (child)
 */
get_header();

// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
echo unifield_child_get_page_header( 'podcast', '/podcast' );

get_template_part( 'template-parts/loop/podcasts' );

get_footer();
