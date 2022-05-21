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

<section class="header-topic-single">
	<?php get_template_part( 'template-parts/singles/topic/title' ); ?>
</section>


<div class="topic-single">
	<?php astra_primary_content_top(); ?>
	<?php get_template_part( 'template-parts/singles/content-topic' ); ?>
	<?php get_template_part( 'template-parts/singles/related-posts', null, [ 'post_type' => 'topic' ] ); ?>
	<?php astra_primary_content_bottom(); ?>
</div>

<?php get_footer(); ?>
