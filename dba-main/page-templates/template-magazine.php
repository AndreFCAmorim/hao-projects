<?php
/**
 * The Template Name: Magazine (child)
 */
get_header();

// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
echo unifield_child_get_page_header( 'magazine', '/magazine' );

get_template_part( 'template-parts/loop/magazine' );

get_footer();
