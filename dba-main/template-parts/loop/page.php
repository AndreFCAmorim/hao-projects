<?php
while ( have_posts() ) {
	the_post();
	the_title( '<h1 class="entry-title">', '</h1>' );
	?>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
		wp_link_pages(
			[
				'before' => '<div class="page-links">' . __( 'Pages:', 'unifield' ),
				'after'  => '</div>',
			]
		);
		?>
	</div><!-- entry-content -->
<?php
}
