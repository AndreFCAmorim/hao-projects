<?php
/**
* Template Name: Header with Hero Image
*
* @package WordPress
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


get_template_part( 'template-parts/header-hero' );
?>

<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

<?php get_sidebar(); ?>

<?php endif ?>

<div id="primary" <?php astra_primary_class(); ?>>

<?php astra_primary_content_top(); ?>

<?php get_template_part( 'template-parts/content-hero' ); ?>

<?php get_template_part( 'template-parts/related-pages' ); ?>

<?php astra_primary_content_bottom(); ?>

</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>
