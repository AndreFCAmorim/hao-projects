<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */
use HopeandOak\WP\Theme\Hao\Templates\Partials\Filters;

get_header();

$description = get_the_archive_description();

$service_term = get_query_var( 'service' );
if ( ! empty( $service_term ) ) {
	$args  = [
		'post_type' => 'case-study',
		'tax_query' => [
			[
				'field'    => 'slug',
				'taxonomy' => 'service',
				'terms'    => $service_term,
			],
		],
	];
	$query = new WP_Query( $args );
}
?>

<div class="archive">
<?php if ( have_posts() ) : ?>

	<header class="archive__page-header">
		<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
		<?php if ( $description ) : ?>
			<div class="archive-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
		<?php endif; ?>


		<div class="filter-bar">
			<div class="filter-bar__inner">
					<?php
					$filter     = new Filters( 'case-study', 'service' );
					$term_slugs = $filter->get_term_slug();
					if ( ! empty( $term_slugs ) ) {
						$filter->render_filters( $term_slugs );
					} else {
						$filter->render_filters( '' );
					}
					?>
			</div>
		</div>


	</header><!-- .page-header -->

	<div class="archive__container">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<?php get_template_part( 'template-parts/content/case-study-archive' ); ?>
	<?php endwhile; ?>
	</div>

	<footer class ="archive__page-footer">
		<div class="navigation">
			<div class="alignleft"><?php previous_posts_link( '&laquo; Previous Entries' ); ?></div>
			<div class="alignright"><?php next_posts_link( 'Next Entries &raquo;', '' ); ?></div>
		</div>
	</footer>

<?php else : ?>
	<?php get_template_part( 'template-parts/content/content-none' ); ?>
<?php endif; ?>

</div>

<?php get_footer(); ?>
