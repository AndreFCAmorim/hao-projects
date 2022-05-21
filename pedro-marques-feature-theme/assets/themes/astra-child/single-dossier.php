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

<section class="header-dossier-single">
	<?php get_template_part( 'template-parts/singles/dossier/title' ); ?>
</section>


<div class="dossier-single">
	<?php astra_primary_content_top(); ?>
	<?php get_template_part( 'template-parts/singles/content-dossier' ); ?>
	<?php get_template_part( 'template-parts/singles/related-posts', null, [ 'post_type' => 'dossier' ] ); ?>
	<?php astra_primary_content_bottom(); ?>
</div>

<?php get_footer(); ?>
