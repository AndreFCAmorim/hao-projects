<?php
/**
 * The Template Name: Shop (child)
 */
get_header();

echo unifield_child_get_page_header( 'shop', '/shop' );

?>

<div class="containershop">
	<div class="page_content">
		<section class="site-main fullwidth">
			<?php
			get_template_part( 'template-parts/loop/page' );
			?>
		</section><!-- section-->
	</div><!-- .page_content -->
</div><!-- .container -->

<?php get_footer(); ?>
