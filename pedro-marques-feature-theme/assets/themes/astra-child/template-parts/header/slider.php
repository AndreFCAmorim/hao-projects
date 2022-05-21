
<div id="home-hero-slider" class="site-content">
	<?php astra_content_top(); ?>
	<?php
	$slide = get_slider_images();
	if ( $slide->post_count > 1 && $slide->have_posts() ) {
		echo '<section class="header-slick-slider">';
		$post_count = 0;
		while ( $slide->have_posts() ) {
			$slide->the_post();
			printf(
				'<div>
					<div class="header-slick-slider__item">
						<img class="header-slick-slider__item-image" src="%1$s" />
					</div>
				</div>',
				esc_url( get_post_meta( $slide->posts[ $post_count ]->ID, 'slider-image' )[0]['url'] ),
			);
			$post_count ++;
		}
		echo '</section>';

	} else {
		printf(
			'<img class="header-slick-slider__item-image" src="%1$s" />',
			esc_url( get_post_meta( $slide->posts[0]->ID, 'slider-image' )[0]['url'] ),
		);
	}
	?>
</div>
