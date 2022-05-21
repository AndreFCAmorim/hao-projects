<div id="stock__lists">
	<?php

	$args = array(
		'post_type'      => 'list',
		'posts_per_page' => 100,
	);

	$the_query = new \WP_Query( $args );
	/*
	if ( empty( $the_query ) ) {
		//return;
	}
	if ( ! $the_query->have_posts() ) {
		get_template_part( 'template-parts/content/content', 'none' );
		return;
	}
	*/
	$list_contents = '';
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		$buttons_markup = sprintf(
			'<button data-tableid="%1$s" type="button" class="js-show-support btn btn-info">%2$s</button>',
			esc_attr( get_the_ID() ),
			esc_html( get_the_title() )
		);

		$list_post_content = get_the_content();
		$list_post_content = apply_filters( 'the_content', $list_post_content );

		printf(
			'<div class="support__buttons">%1$s</div>',
			$buttons_markup
		);
		$list_contents .= sprintf(
			'<div class="%1$s support__list table table-striped js-support-list">%2$s</div>',
			esc_attr( get_the_ID() ),
			$list_post_content
		);


	}

	// Restore original Post Data
	wp_reset_postdata();

	if ( ! empty( $list_contents ) ) {
		$close_button = [
			'title' => __( 'Close Lists', 'impstock' ),
			'class' => 'js-hide-support',
		];
		printf(
			'<button type="button" class="%1$s btn btn-warning">%2$s</button>',
			esc_attr( $close_button['class'] ),
			esc_html( $close_button['title'] )
		);

		echo $list_contents;
	}

	?>
</div>
