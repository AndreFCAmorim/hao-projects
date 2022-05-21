<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Unifield
 */

get_header(); ?>

<div class="container">
	<div id="page_content">
		<section class="fullwidth">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<?php get_template_part( 'content', 'single' ); ?>

				<?php endwhile; // end of the loop. ?>
		</section>

		<div class="clear"></div>
	</div><!-- page_content -->
</div><!-- container -->

<?php
get_footer();
