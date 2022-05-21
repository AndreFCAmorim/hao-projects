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

	<section class="header-topics-archive">
		<h2 class="header-topics-archive__title"><?php echo get_queried_object()->name; ?></h2>
	</section>

	<div class="topics-archive">

		<?php astra_primary_content_top(); ?>

		<div class="topics-archive__container">

			<?php
				$topics = get_topics_by_term( get_queried_object()->name );
				get_template_part( 'template-parts/archive/content-topics', null, [ 'topics' => $topics ] );
			?>

		</div>

		<?php astra_primary_content_bottom(); ?>

	</div><!-- #primary -->


<?php get_footer(); ?>
