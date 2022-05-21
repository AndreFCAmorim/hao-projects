<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

	<section class="header-topic-archive">
		<h2 class="header-topic-archive__title"><?php post_type_archive_title(); ?></h2>
	</section>

	<div class="topic-archive">

		<?php astra_primary_content_top(); ?>

		<div class="topic-archive__container">

			<?php
			$count = 0;
			while ( have_posts() ) {
				$count++;
				the_post();
				set_query_var( 'count', $count );
				get_template_part( 'template-parts/archive/content-topic' );
			}
			?>

		</div>

		<?php astra_pagination(); ?>

		<?php astra_primary_content_bottom(); ?>

	</div><!-- #primary -->


<?php get_footer(); ?>
