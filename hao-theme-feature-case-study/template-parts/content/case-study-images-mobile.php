<?php
$case_study_id = get_the_ID();

$gallery_str = get_post_meta( $case_study_id, 'gallery', true );

$gallery_arr = explode( ',', $gallery_str );



foreach ( $gallery_arr as $image_id ) {
	printf(
		'<div class="mobile-gallery__item">
			%1$s
		</div>',
		wp_get_attachment_image( $image_id, 'large', '', [ 'class' => 'mobile-gallery__image' ] ),
	);
}
