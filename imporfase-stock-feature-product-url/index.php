<?php get_template_part( 'templates/lintel', 'title' ); ?>

<?php if ( ! have_posts() ) : ?>
	<div class="alert alert-warning">
		<?php _e( 'Não foram encontrados artigos.', 'impstock' ); ?>
	</div>
	<?php get_search_form(); ?>
<?php endif; ?>

<?php

while ( have_posts() ) :

	the_post();
	?>
<?php endwhile; ?>

<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<nav class="post-nav clearb bg_greyred">
		<ul class="pager margina w50">
			<li class="previous"><?php next_posts_link( __( '&larr; Previous', 'impstock' ) ); ?></li>
			<li class="next"><?php previous_posts_link( __( 'Next &rarr;', 'impstock' ) ); ?></li>
		</ul>
	</nav>
<?php endif; ?>
