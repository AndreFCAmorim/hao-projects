<?php
$cause_id = get_the_ID();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div id="cause">
		<div class="cause__left-to-right">
			<div class="cause__left-to-right_image">
				<?php

				if ( ! empty( get_the_post_thumbnail() ) ) {
					echo get_the_post_thumbnail( $cause_id, [ '500', '500' ], [ 'class' => 'cause__image' ] );
				} else {
					printf(
						'<img class="cause__image" src="%1$s">',
						get_stylesheet_directory_uri() . '/dist/images/no_image.jpg',
					);
				}

				?>
			</div>
			<div class="cause__left-to-right_item">
				<h3><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
				<div class="cause__content">
					<p><?php echo get_the_content(); ?></p>
				</div>
			</div>
		</div>
	</div>
</article>
