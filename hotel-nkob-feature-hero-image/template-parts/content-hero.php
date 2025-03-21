<?php astra_entry_before(); ?>
<article
<?php
		echo astra_attr(
			'article-page',
			array(
				'id'    => 'post-' . get_the_id(),
				'class' => join( ' ', get_post_class() ),
			)
		);
		?>
>
	<?php astra_entry_top(); ?>
	<header class="entry-header hero-after-image__entry-header <?php astra_entry_header_class(); ?>">

		<?php
		astra_the_title(
			'<h1 class="entry-title hero-after-image__content-title" ' . astra_attr(
				'article-title-content-page',
				[
					'class' => '',
				]
			) . '>',
			'</h1>'
		);
		?>
	</header><!-- .entry-header -->
	<section class="hero-after-image">
		<div class="hero-after-image__content">

			<h5 class="hero-after-image__content-subtitle">
					<?php echo esc_html( wp_trim_words( get_the_excerpt(), 15, '...' ) ); ?>
			</h5>

		</div>
	</section>
	<div class="entry-content clear"
		<?php
				echo astra_attr(
					'article-entry-content-page',
					array(
						'class' => '',
					)
				);
				?>
	>

		<?php astra_entry_content_before(); ?>

		<?php the_content(); ?>

		<?php astra_entry_content_after(); ?>

		<?php
			wp_link_pages(
				array(
					'before'      => '<div class="page-links">' . esc_html( astra_default_strings( 'string-single-page-links-before', false ) ),
					'after'       => '</div>',
					'link_before' => '<span class="page-link">',
					'link_after'  => '</span>',
				)
			);
			?>

	</div><!-- .entry-content .clear -->

	<?php
		astra_edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'astra' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<footer class="entry-footer"><span class="edit-link">',
			'</span></footer><!-- .entry-footer -->'
		);
		?>

	<?php astra_entry_bottom(); ?>

</article><!-- #post-## -->

<?php astra_entry_after(); ?>
