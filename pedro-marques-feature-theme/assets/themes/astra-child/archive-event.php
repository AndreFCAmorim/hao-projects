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

$filter = get_query_var( 'filter' );

switch ( $filter ) {
	case 'news':
		$page_title = __( 'News and Press', 'astra-child' );
		break;
	case 'activity':
		$page_title = __( 'Activities', 'astra-child' );
		break;
	default:
		$page_title = __( 'Events', 'astra-child' );
}

?>

	<section class="header-event-archive">
		<h2 class="header-event-archive__title"><?php echo esc_html( $page_title ); ?></h2>
	</section>

	<div class="event-archive">

		<?php astra_primary_content_top(); ?>

		<div class="event-archive__container">

		<?php
		switch ( $filter ) {
			case 'news':
				$news = get_news_extra( 0, [], false, 'ASC' );

				$count = 0;
				while ( $news->have_posts() ) {
					$count++;
					$news->the_post();
					set_query_var( 'count', $count );
					get_template_part( 'template-parts/archive/content-event' );
				}
				break;
			case 'activity':
				$recent_activity = get_recent_activity_extra( 0, [], false, 'ASC' );

				$count = 0;
				while ( $recent_activity->have_posts() ) {
					$count++;
					$recent_activity->the_post();
					set_query_var( 'count', $count );
					get_template_part( 'template-parts/archive/content-event' );
				}
				break;
			default:
				$count = 0;
				while ( have_posts() ) {
					$count++;
					the_post();
					set_query_var( 'count', $count );
					get_template_part( 'template-parts/archive/content-event' );
				}
		}
		?>

		</div>

		<?php astra_pagination(); ?>

		<?php astra_primary_content_bottom(); ?>

	</div><!-- #primary -->


<?php get_footer(); ?>
