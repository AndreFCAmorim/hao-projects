<?php
/**
 * Single for a post
 */
get_header();

// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
echo unifield_child_get_post_header();

get_template_part( 'template-parts/container/post' );

get_footer();
