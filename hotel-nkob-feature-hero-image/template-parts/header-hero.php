<?php
/**
 * The header for Astra Theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?><!DOCTYPE html>
<?php astra_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
<?php astra_head_top(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">

<?php wp_head(); ?>
<?php astra_head_bottom(); ?>
</head>

<body <?php astra_schema_body(); ?> <?php body_class(); ?>>
<?php astra_body_top(); ?>
<?php wp_body_open(); ?>
<div
<?php
	echo astra_attr(
		'site',
		[
			'id'    => 'page',
			'class' => 'hfeed site',
		]
	);
	?>
>
	<a class="skip-link screen-reader-text" href="#content"><?php echo esc_html( astra_default_strings( 'string-header-skip-link', false ) ); ?></a>
	<?php
	astra_header_before();
	?>
	<section class="hero" style="background: url(<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )[0]; ?>);">

		<?php astra_header(); ?>

		<div class="hero__content">

			<?php
			astra_the_title(
				'<h1 class="hero__content-title" ' . astra_attr(
					'article-title-content-page',
					[
						'class' => '',
					]
				) . '>',
				'</h1>'
			);
			?>

			<h5 class="hero__content-subtitle">
					<?php echo esc_html( wp_trim_words( get_the_excerpt(), 15, '...' ) ); ?>
			</h5>

		</div>

	</section>
	<?php

	astra_header_after();

	astra_content_before();
	?>
	<div id="content" class="site-content">
		<div class="ast-container">
		<?php astra_content_top(); ?>
