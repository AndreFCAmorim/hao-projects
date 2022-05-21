<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<?php astra_entry_before(); ?>

<article
<?php
		echo astra_attr(
			'article-single',
			array(
				'id'    => 'post-' . get_the_id(),
				'class' => join( ' ', get_post_class() ),
			)
		);
		?>
>

	<?php astra_entry_top(); ?>

	<div class="topic-single__item">

		<div class="topic-single__item-image">
			<?php

				get_template_part( 'template-parts/singles/topic/featured-image' );

			?>
		</div>

		<div class="topic-single__item-content">
			<?php
				get_template_part( 'template-parts/singles/topic/author' );
				get_template_part( 'template-parts/singles/topic/lead' );
				get_template_part( 'template-parts/singles/topic/content' );
				get_template_part( 'template-parts/singles/topic/conclusion' );
				get_template_part( 'template-parts/singles/topic/file' );
			?>
		</div>

		<div class="topic-single__recent-activities">
			<?php

				get_template_part( 'template-parts/singles/topic/recent-activity' );

			?>
		</div>

		<div class="topic-single__dossier">
			<?php

				get_template_part( 'template-parts/singles/topic/dossier' );

			?>
		</div>


		<div class="topic-single__news">
			<?php

				get_template_part( 'template-parts/singles/topic/news' );

			?>
		</div>

	</div>

</article>
