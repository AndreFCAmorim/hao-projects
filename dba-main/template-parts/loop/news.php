<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div class="container">
	<div class="page_content">
		<a target="_blank" href="https://dontbeafraid.bandcamp.com/album/ikonika-bodies-remixes">
			<img class="news-header-image" src="<?php echo get_site_url(); ?>/wp-content/uploads/2021/04/DBA045XBANNER2X-copy.jpg">
		</a>
		<section class="news">
			<?php
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo dba_get_category_posts( 5, 1, 'DESC', 5, 'row' );
			?>
		</section>

		<?php
		printf(
			'<div class="news-load-more-row">
				<a class="news-load-more-row__button" data-category-id="%1$s"
				data-next-page="%2$s"
				data-total-pages="%3$s"
				data-order="%4$s"
				data-posts-per-page="%5$s"
				data-mode="%6$s"
				>
					%7$s
				</a>
			</div>',
			5,
			2,
			100,
			'DESC',
			5,
			'row',
			esc_html( __( 'Load more', 'unifield-child' ) ),
		);

		?>
	</div>
</div>
