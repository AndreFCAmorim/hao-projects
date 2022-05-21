<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
?>

<div class="case-study">

	<?php
	/* Start the Loop */
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/content/content-case-study' );
	endwhile; // End of the loop.
	?>

	<footer class="entry-footer default-max-width">
		<div class="navigation">
			<?php
			if ( is_singular( 'case-study' ) ) {
				// Previous/next post navigation.
				the_post_navigation(
					[
						'next_text' => '<span class="next-post">' . esc_html__( 'Next post ', 'hao' ) . '</span> ' .
							'<span class="post-title">%title</span>',
						'prev_text' => '<span class="previous-post">' . esc_html__( 'Previous post ', 'hao' ) . '</span> ' .
							'<span class="post-title">%title</span>',
					]
				);
			}
			?>
		</div>
	</footer><!-- .entry-footer -->

</div>

<?php get_footer(); ?>
