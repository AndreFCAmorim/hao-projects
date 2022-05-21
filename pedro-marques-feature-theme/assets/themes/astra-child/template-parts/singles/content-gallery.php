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
	<div class="gallery-single__item">

		<div class="gallery-single__item-image">
			<?php

				get_template_part( 'template-parts/singles/gallery/image' );


			?>
		</div>

	</div>
</article>
