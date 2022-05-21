<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<section class="header-event-single">
	<?php get_template_part( 'template-parts/singles/event/title' ); ?>
</section>


<div class="event-single">
	<?php astra_primary_content_top(); ?>
	<?php get_template_part( 'template-parts/singles/content-event' ); ?>
	<?php get_template_part( 'template-parts/singles/related-posts', null, [ 'post_type' => 'event' ] ); ?>
	<?php astra_primary_content_bottom(); ?>
</div>

<?php get_footer(); ?>
