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

	<div class="event-archive__item">

		<div class="event-archive__item-image">
			<?php

				get_template_part( 'template-parts/archive/event/featured-image' );

			?>
		</div>

		<div class="event-archive__item-content">
			<?php

				get_template_part( 'template-parts/archive/event/title' );

				get_template_part( 'template-parts/archive/event/date' );

				get_template_part( 'template-parts/archive/event/excerpt' );

			?>
		</div>

	</div>

</article><!-- #post-<?php the_ID(); ?> -->
