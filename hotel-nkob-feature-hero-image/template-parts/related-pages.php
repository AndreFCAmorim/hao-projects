<?php
	$parent_id = wp_get_post_parent_id( $post->ID );
	$related_pages = wp_related_pages( $post );

	if ( $related_pages->have_posts() ) {
?>

<section class="related-pages">
	<div class="wp-block-group alignfull">
		<div class="wp-block-group__inner-container">
			<h2 class="related-pages__title"><?php _e( 'See Next', 'astra' )?></h2>
			<div class="related-slick-slider">
			<?php
				if ( $parent_id != 0 ) {
					printf(
						'<div>
							<div class="related-pages__item">
								<a href="%2$s">
									%3$s
									<h5 class="related-pages__item-title">%1$s</h5>
								</a>
							</div>
						</div>',
						get_the_title( $parent_id ),
						get_page_link( $parent_id ),
						get_the_post_thumbnail( $parent_id, 'full', [ 'class' => 'related-pages__item-image' ] ),
					);

				}

				while ( $related_pages->have_posts() ) {
					$related_pages->the_post();
					printf(
						'<div>
							<div class="related-pages__item">
								<a href="%2$s">
									%3$s
									<h5 class="related-pages__item-title">%1$s</h5>
								</a>
							</div>
						</div>',
						get_the_title( $related_pages->ID ),
						get_page_link( $related_pages->ID ),
						get_the_post_thumbnail( $related_pages->ID, 'full', ['class' => 'related-pages__item-image'] ),
					);
				}
			?>
			</div>
		</div>
	</div>
</section>

<?php } ?>