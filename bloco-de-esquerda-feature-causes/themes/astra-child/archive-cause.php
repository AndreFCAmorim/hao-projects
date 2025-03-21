<?php

/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<?php if (astra_page_layout() == 'left-sidebar') : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<div id="primary" <?php astra_primary_class(); ?>>

	<?php astra_primary_content_top(); ?>

	<section class="ast-archive-description">
		<h1 class="page-title ast-archive-title"><?php post_type_archive_title(); ?></h1>
	</section>

	<div class="archive__container">

		<?php
		$count = 0;
		while (have_posts()) {
			$count++;
			the_post();
			set_query_var('count', $count);
			get_template_part('template-parts/content/cause-archive');
		}
		?>

	</div>

	<?php astra_pagination(); ?>

	<?php astra_primary_content_bottom(); ?>

</div><!-- #primary -->

<?php if (astra_page_layout() == 'right-sidebar') : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>