<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div class="container">
	<div class="page_content">
		<a target="_blank" href="https://dontbeafraid.bandcamp.com/album/ikonika-bodies-remixes">
			<img class="artists-header-image" src="<?php echo get_site_url(); ?>/wp-content/uploads/2021/04/DBA045XBANNER2X-copy.jpg">
		</a>

		<section class="artists">
			<?php
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo dba_get_category_posts( 4, 1, 'ASC', 8, 'grid' );
			?>
		</section>

		<?php
		printf(
			'<div class="artists-load-more-row">
				<a class="artists-load-more-row__button"
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
			4,
			2,
			100,
			'ASC',
			8,
			'grid',
			esc_html( __( 'Load more', 'unifield-child' ) ),
		);
		?>
	</div>
</div>
