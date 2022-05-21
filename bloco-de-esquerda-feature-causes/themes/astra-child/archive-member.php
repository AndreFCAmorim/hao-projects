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

<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

	<div id="primary" <?php astra_primary_class(); ?>>

		<?php astra_primary_content_top(); ?>

		<section class="ast-archive-description">
			<h1 class="page-title ast-archive-title"><?php post_type_archive_title(); ?></h1>
		</section>


		<div class="archive__container">

			<?php
			$list_image    = [];
			$list_no_image = [];
			$members       = get_members();
			while ( $members->have_posts() ) {
				$members->the_post();
				$member_id = get_the_ID();
				//Sort members with images and no images
				if ( has_post_thumbnail( $member_id ) ) {
					$list_image[] = $member_id;
				} else {
					$list_no_image[] = $member_id;
				}
			}

			if ( empty( get_query_var( 'paged' ) ) ) {
				$current_page   = 10;
				$starts_in_post = 1;
			} else {
				$current_page   = get_query_var( 'paged' ) * 10;
				$starts_in_post = ( get_query_var( 'paged' ) * 10 ) - 9;
			}

			$count = 0;
			//Show members with image
			foreach ( $list_image as $member_image ) {
				$count++;
				if ( $count >= $starts_in_post ) {
					if ( $count <= $current_page ) {
						set_query_var( 'count', $count );
						get_template_part( 'template-parts/content/member-archive', '', [ 'ID' => $member_image ] );
					}
				}
			}

			//Show members without image
			foreach ( $list_no_image as $member_no_image ) {
				$count++;
				if ( $count >= $starts_in_post ) {
					if ( $count <= $current_page ) {
						set_query_var( 'count', $count );
						get_template_part( 'template-parts/content/member-archive', '', [ 'ID' => $member_no_image ] );
					}
				}
			}
			?>

		</div>

		<?php astra_pagination(); ?>

		<?php astra_primary_content_bottom(); ?>

	</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>
