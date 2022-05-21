<?php
get_header( 'home' );

get_template_part( 'template-parts/header/slider' );

get_template_part( 'template-parts/content/open' );

get_template_part( 'template-parts/front-page/topics' );

get_template_part( 'template-parts/front-page/recent-activity' );

get_template_part( 'template-parts/front-page/dossier' );

get_template_part( 'template-parts/front-page/news' );

get_template_part( 'template-parts/front-page/gallery' );

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		the_content();
	}
}

get_footer();
