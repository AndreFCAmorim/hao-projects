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

	<div class="dossier-single__item">

		<div class="dossier-single__item-content">
			<?php

				get_template_part( 'template-parts/singles/dossier/content' );

			?>
		</div>

		<div class="dossier-single__footer-content">
			<?php

				get_template_part( 'template-parts/singles/dossier/credit' );

				get_template_part( 'template-parts/singles/dossier/date' );

				get_template_part( 'template-parts/singles/dossier/local' );

				get_template_part( 'template-parts/singles/dossier/file' );

			?>
		</div>


	</div>

</article>
