<?php while ( have_posts() ) {

	the_post(); ?>
	<article <?php post_class( 'col-md-offset-1' ); ?>>
		<header>
			<h1 class="entry-title tac"><?php the_title(); ?></h1>
		</header>
		<div class="entry-content ">
			<?php the_content(); ?>
		</div>
	</article>
<?php
}
