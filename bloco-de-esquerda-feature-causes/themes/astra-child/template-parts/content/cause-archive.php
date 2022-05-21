<?php
$cause_id = get_the_ID();

$color_names = [
	'INFINITE',
	'ALIVE',
	'LUMINOUS',
	'CLEAR',
	'GOLDIE',
	'NIGHT',
	'FRESH',
];

$color_values = [
	'INFINITE' => '#5BCAF6',
	'ALIVE'    => '#3EE5D4',
	'LUMINOUS' => '#E6BE00',
	'CLEAR'    => '#DDCCAE',
	'GOLDIE'   => '#B49317',
	'NIGHT'    => '#768AAE',
	'FRESH'    => '#7481FE',
];

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( $count % 2 == 0 ) { ?>

		<div class="cause">
			<div class="cause__right-to-left">
				<div class="cause__right-to-left_item" style="background-color: <?php echo $color_values[ $color_names[ ( $count % 7 ) ] ]; ?>">
					<h3>
						<a class="cause__link" href="<?php the_permalink(); ?>">
							<?php echo get_the_title(); ?>
						</a>
					</h3>
					<div class="cause__exerpt">
						<p><?php echo get_the_excerpt(); ?></p>
					</div>
				</div>
				<div class="cause__right-to-left_image">
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
			</div>
		</div>

	<?php } else { ?>

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
				<div class="cause__left-to-right_item" style="background-color: <?php echo $color_values[ $color_names[ ( $count % 7 ) ] ]; ?>">
					<h3>
						<a class="cause__link" href="<?php the_permalink(); ?>">
							<?php echo get_the_title(); ?>
						</a>
					</h3>
					<div class="cause__exerpt">
						<p><?php echo get_the_excerpt(); ?></p>
					</div>
				</div>
			</div>
		</div>

	<?php } ?>

	<footer class="entry-footer default-max-width">
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
