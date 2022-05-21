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


$image_id = get_the_ID();
?>

<article id="post-<?php the_ID(); ?>">

	<div class="gallery-archive__item">

		<div class="gallery-archive__item-title">
			<?php

			if ( $image_id !== 0 ) {
				get_template_part( 'template-parts/archive/gallery/title' );
			}

			?>
		</div>

		<div class="gallery-archive__item-image">
			<?php

			if ( $image_id !== 0 ) {
				get_template_part( 'template-parts/archive/gallery/image' );
			}

			?>
		</div>

	</div>

</article><!-- #post-<?php the_ID(); ?> -->
