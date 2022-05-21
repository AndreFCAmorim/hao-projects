<?php

get_header();

echo unifield_child_get_page_header( 'MAGAZINE', '/category/magazine' );

get_template_part( 'template-parts/loop/magazine' );

get_footer();
