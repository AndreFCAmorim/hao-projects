<?php
/**
 * The Template Name: Releases (child)
 */
get_header();

// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
echo unifield_child_get_page_header( 'releases', '/releases' );

get_template_part( 'template-parts/loop/releases' );

get_footer();
