<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package Unifield
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php
	$og_description = ogp_post_description();
	if ( $og_description ) :
		?>
		<meta property="og:description" content="<?php echo esc_attr( $og_description ); ?>" />
	<?php else : ?>
		<meta property="og:description" content="<?php bloginfo( 'description' ); ?>" />
	<?php endif ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php

?>
<div id="pageholder"
	<?php
	if ( get_theme_mod( 'box_layout' ) ) {
		echo 'class="boxlayout"';
	}
	?>
	>
	<div class="header
		<?php
		if ( ! is_front_page() && ! is_home() ) {
			echo 'headerinner';
		}
		?>
		">
		<div class="container">
			<div class="logo">
				<a href="/" class="custom-logo-link" rel="home" itemprop="url"><img width="140" height="147" src="https://cdn.statically.io/img/dontbeafraidrecordings.co.uk/wp-content/uploads/2021/02/DBA_logo.jpg" class="custom-logo" alt="Don’t Be Afraid" itemprop="logo"></a>
				<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
				<span><?php bloginfo( 'description' ); ?></span>
			</div><!-- logo -->
			<div class="hdrright">
				<div class="toggle mobile-title">
					<a class="toggleMenu" href="#"></a>
				</div><!-- toggle -->
				<!-- Mailing List Top Bar -->
				<div class="top-bar" id="headerBtns">
					<div class="join-top">
						<a href="/signup" target="_self">JOIN OUR MAILING LIST</a>
					</div>
					<?= unifield_child_get_social_icons() ?>
				</div>
				<div class="sitenav mobile-header">
					<?php wp_nav_menu( [ 'theme_location' => 'primary' ] ); ?>
					<div class="top-bar" id="headerBtn">
						<div class="join-tops">
							<a href="/signup" target="_self">MAILING LIST</a>
						</div>
						<?= unifield_child_get_social_icons() ?>

					</div>
				</div><!-- site-nav -->
			</div>
		<div class="clear"></div>
		</div><!-- container -->
	</div><!--.header -->
