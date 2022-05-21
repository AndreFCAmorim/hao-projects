<?php
/**
 * The Template Name: Front page
 */
get_header();

echo unifield_child_get_page_header( 'HOME', '/' );

get_template_part( 'template-parts/container/page' );

get_footer();
