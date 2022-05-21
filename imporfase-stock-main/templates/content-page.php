<article <?php post_class( ' col-xs-12 col-md-8' ); ?>>

	<?php
	$title_class = '';
	if ( isset( $header_thumbnail ) ) {
		$title_class = ' header_thumbnail' ;}
	?>
	<header>
		<h1 class="entry-title tac <?php esc_attr( $title_class ); ?>"><?php the_title(); ?></h1>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>

</article>
<?php
wp_link_pages(
	array(
		'before' => '<nav class="pagination">',
		'after' => '</nav>',
	)
);
