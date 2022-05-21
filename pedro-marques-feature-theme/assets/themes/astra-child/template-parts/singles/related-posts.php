<?php
	$parent_id     = wp_get_post_parent_id( $post->ID );
	$related_posts = get_related_posts( $post, $args['post_type'] );

	if ( $related_posts->have_posts() ) {
?>

<section class="related-posts">
	<div class="wp-block-group alignfull">
		<div class="wp-block-group__inner-container">
			<h2 class="related-posts__title"><?php _e( 'See Next', 'astra' )?></h2>
			<div class="related-slick-slider">
			<?php
				if ( $parent_id != 0 ) {
					printf(
						'<div>
							<div class="related-posts__item">
								<a href="%2$s">
									%3$s
									<h5 class="related-posts__item-title">%1$s</h5>
								</a>
							</div>
						</div>',
						get_the_title( $parent_id ),
						get_page_link( $parent_id ),
						get_the_post_thumbnail( $parent_id, 'full', [ 'class' => 'related-posts__item-image' ] ),
					);

				}

				while ( $related_posts->have_posts() ) {
					$related_posts->the_post();
					printf(
						'<div>
							<div class="related-posts__item">
								<a href="%2$s">
									%3$s
									<h5 class="related-posts__item-title">%1$s</h5>
								</a>
							</div>
						</div>',
						get_the_title( $related_posts->ID ),
						get_page_link( $related_posts->ID ),
						get_the_post_thumbnail( $related_posts->ID, 'full', ['class' => 'related-posts__item-image'] ),
					);
				}
			?>
			</div>
		</div>
	</div>
</section>

<?php } ?>
