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
?>

<article id="post-<?php the_ID(); ?>">

	<div class="topic-archive__item">

		<div class="topic-archive__item-image">
			<?php

				get_template_part( 'template-parts/archive/topic/featured-image' );

			?>
		</div>

		<div class="topic-archive__item-content">
			<?php

				get_template_part( 'template-parts/archive/topic/title' );

				get_template_part( 'template-parts/archive/topic/author' );

				get_template_part( 'template-parts/archive/topic/excerpt' );

			?>
		</div>

	</div>

</article><!-- #post-<?php the_ID(); ?> -->
