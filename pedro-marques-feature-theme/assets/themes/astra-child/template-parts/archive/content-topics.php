<?php
/**
 * Template part for displaying archive posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$topic_id = 0;
if ( $args['topics']->have_posts() ) {
	$args['topics']->the_post();
	$topic_id = get_the_ID();
}
?>

<article id="post-<?php echo esc_html( $topic_id ); ?>">

	<div class="topics-archive__item">

		<div class="topics-archive__item-title">
			<?php

			if ( $topic_id !== 0 ) {
				get_template_part( 'template-parts/archive/topics/post-title' );
			}

			?>
		</div>

		<div class="topics-archive__item-image">
			<?php

			if ( $topic_id !== 0 ) {
				get_template_part( 'template-parts/archive/topics/post-featured-image' );
			}

			?>
		</div>

		<div class="topics-archive__item-content">
			<?php

			if ( $topic_id !== 0 ) {
				get_template_part( 'template-parts/archive/topics/post-content' );
			}

			?>
		</div>

		<div class="topics-archive__recent-activities">
			<?php

				get_template_part( 'template-parts/archive/topics/recent-activity' );


			?>
		</div>

		<div class="topics-archive__news">
			<?php

				get_template_part( 'template-parts/archive/topics/news' );

			?>
		</div>

	</div>

</article><!-- #post-<?php the_ID(); ?> -->
