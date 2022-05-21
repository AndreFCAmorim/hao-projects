<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div class="container">
	<div class="page_content">
		<a target="_blank" href="https://soundcloud.com/dontbeafraid/dba-podcast-015-odd-lust">
			<img class="podcasts-header-image" src="<?php echo get_site_url(); ?>/wp-content/uploads/2021/08/DBA-PODCAST-BANNER-15-ODD-LUST-01.jpg">
		</a>
		<section class="podcasts">
			<?php
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo dba_get_category_posts( 6, 1, 'DESC', 8, 'grid' );
			?>
		</section>

		<?php
		printf(
			'<div class="podcasts-load-more-row">
				<a class="podcasts-load-more-row__button"
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
			6,
			2,
			100,
			'DESC',
			8,
			'grid',
			esc_html( __( 'Load more', 'unifield-child' ) ),
		);
		?>
	</div>
</div>
