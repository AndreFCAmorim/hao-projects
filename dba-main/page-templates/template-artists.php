<?php
/**
 * The Template Name: Artists (child)
 */
get_header();

// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
echo unifield_child_get_page_header( 'artists', '/artists' );

get_template_part( 'template-parts/loop/artists' );

get_footer();
