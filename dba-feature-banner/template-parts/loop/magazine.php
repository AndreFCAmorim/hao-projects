<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div class="container">
	<div class="page_content">
		<?php
		$magazine_id = get_the_ID();
		$banner_url  = get_post_meta( $magazine_id, 'banner-url', true );

		if ( ! empty( $banner_url ) ) {
			$banner_src = wp_get_attachment_image_src( get_post_meta( $magazine_id, 'banner-image', true ), 'large' )[0];
			printf(
				'<a target="_blank" href="%1$s">
					<img class="magazine-header-image" src="%2$s">
				</a>',
				esc_url( $banner_url ),
				esc_url( $banner_src )
			);
		}
		?>
		<section class="magazine">
			<?php
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo dba_get_category_posts( 7, 1, 'DESC', 8, 'row' );
			?>
		</section>

		<?php
		printf(
			'<div class="magazine-load-more-row">
				<a class="magazine-load-more-row__button"
				data-category-id="%1$s"
				data-next-page="%2$s"
				data-total-pages="%3$s"
				data-order="%4$s"
				data-posts-per-page="%5$s"
				data-mode="%6$s"
				>
					%7$s
				</a>
			</div>',
			7,
			2,
			100,
			'DESC',
			8,
			'row',
			esc_html( __( 'Load more', 'unifield-child' ) ),
		);
		?>
	</div>
</div>
