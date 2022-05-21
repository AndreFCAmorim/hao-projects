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

	<div class="dossier-archive__item">

		<?php

			get_template_part( 'template-parts/archive/dossier/title' );

			get_template_part( 'template-parts/archive/dossier/date' );

			get_template_part( 'template-parts/archive/dossier/excerpt' );

		?>

	</div>

</article><!-- #post-<?php the_ID(); ?> -->
