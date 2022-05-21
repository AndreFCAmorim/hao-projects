<?php
use HopeandOak\WP\Theme\Hao\Templates\Partials\Related;


echo '<div class="related">';

printf(
	'<p class="related__title">%1$s</p>',
	esc_html__( 'Other Projects', 'hao' )
);

$related = new Related( 'case-study', get_the_ID() );
$related->setup_results( 4 );
$related->render();

echo '</div>';
