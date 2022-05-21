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

use HopeandOak\WP\Theme\Hao\Templates\Partials\Archive;

use HopeandOak\WP\Theme\Hao\Media;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php
$archive = new Archive( get_the_ID(), Media::get_svg( 'arrow-right', '<style>svg.svg-sprite{width:16px; height:16px;}</style>' ) );
$archive->render();
?>

<footer class="entry-footer default-max-width">
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
