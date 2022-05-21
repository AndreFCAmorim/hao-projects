<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="grid entry-content">
		<div class="grid-row grid-row--first">
			<div class="col-60">
				<?php get_template_part( 'template-parts/content/case-study-featured-image' ); ?>
				<?php get_template_part( 'template-parts/content/case-study-images' ); ?>
			</div>

			<div class="col-40">
				<?php
				the_title( '<h1 class="case-study__entry-title">', '</h1>' );
				echo '<div class="case-study__content">' . wp_kses_post( apply_filters( 'the_content', get_the_content() ) ) . '</div>';
				?>
			</div>
		</div>

		<div class="grid-row grid-row--second">
				<?php
				get_template_part( 'template-parts/content/case-study-content' );
				?>
		</div>

		<div class="grid-row grid-row--mobile-gallery">
			<div class="col-100">
			<?php get_template_part( 'template-parts/content/case-study-images-mobile' ); ?>
			</div>
		</div>

		<div class="grid-row grid-row--third">
			<div class="col-100">
				<?php
				get_template_part( 'template-parts/content/case-study-share' );
				?>
			</div>
		</div>

		<div class="grid-row grid-row--fourth">
			<div class="col-100">
				<?php
				get_template_part( 'template-parts/content/case-study-related' );
				?>
			</div>
		</div>

	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
