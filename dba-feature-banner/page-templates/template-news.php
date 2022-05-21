<?php
/**
 * The Template Name: News (child)
 */
get_header();

// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
echo unifield_child_get_page_header( 'NEWS', '/news' );

get_template_part( 'template-parts/loop/news' );

get_footer();
