<?php
$case_study_id = get_the_ID();

$gallery_str = get_post_meta( $case_study_id, 'gallery', true );

$gallery_arr = explode( ',', $gallery_str );


if ( $gallery_str ) {
	printf(
		'<a class="gallery__see-more">%1$s</a>',
		esc_html__( 'See More', 'hao' ),
	);
	?>

	<div id="gallery__modal" class="gallery__modal">
		<div class="gallery__modal-content">
			<div class="gallery__slideshow-container">
				<span class="gallery__modal-close">&times;</span>
				<?php
				$nr_image = 1;
				foreach ( $gallery_arr as $image_id ) {
					printf(
						'<div class="gallery__slides fade">
							%3$s
							<div class="gallery__numbertext">%1$s/%2$s</div>
						</div>',
						esc_html( $nr_image ),
						esc_html( count( $gallery_arr ) ),
						wp_get_attachment_image( $image_id, 'large', '', [ 'class' => 'gallery__image' ] ),
					);
					$nr_image++;
				}
				?>
				<!-- Next and previous buttons -->
				<a class="gallery__prev" onclick="plusSlides(-1)">&#10094;</a>
				<a class="gallery__next" onclick="plusSlides(1)">&#10095;</a>
			</div>
		</div>
	</div>

<?php } ?>
