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

get_header();
?>

	<section class="header-gallery-archive">
		<h2 class="header-gallery-archive__title"><?php post_type_archive_title(); ?></h2>
	</section>

	<div class="gallery-archive">

		<?php astra_primary_content_top(); ?>

		<div class="gallery-archive__container">

			<?php

			$max_items = 6;
			$gallery   = get_gallery( $max_items );


			$items_count = 0;
			$items_ids   = [];
			$items_html  = '';

			if ( $gallery->have_posts() ) {

				while ( $gallery->have_posts() ) {
					$gallery->the_post();
					get_template_part( 'template-parts/archive/content-gallery' );
				}

				wp_reset_postdata();
			}

			if ( $items_count < $max_items ) {

				$gallery = get_gallery_extra( $max_items - $items_count, $items_ids );

				if ( $gallery->have_posts() ) {

					while ( $gallery->have_posts() ) {
						$gallery->the_post();
						get_template_part( 'template-parts/archive/content-gallery' );
					}

					wp_reset_postdata();
				}
			}
			?>

		</div>

		<?php astra_pagination(); ?>

		<?php astra_primary_content_bottom(); ?>

	</div><!-- #primary -->


<?php get_footer(); ?>
