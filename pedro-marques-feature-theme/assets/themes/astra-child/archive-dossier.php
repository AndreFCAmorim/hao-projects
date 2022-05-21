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

	<section class="header-dossier-archive">
		<h2 class="header-dossier-archive__title"><?php post_type_archive_title(); ?></h2>
	</section>

	<div class="dossier-archive">

		<?php astra_primary_content_top(); ?>

		<div class="dossier-archive__container">

			<?php
			$dossiers = get_dossier_extra( 0, [], false, 'ASC' );
			while ( $dossiers->have_posts() ) {
				$dossiers->the_post();
				get_template_part( 'template-parts/archive/content-dossier' );
			}
			?>

		</div>

		<?php astra_primary_content_bottom(); ?>

	</div><!-- #primary -->


<?php get_footer(); ?>
