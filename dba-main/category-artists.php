<?php

get_header();

echo unifield_child_get_page_header( 'ARTISTS', '/category/artists' );

get_template_part( 'template-parts/loop/artists' );

get_footer();
