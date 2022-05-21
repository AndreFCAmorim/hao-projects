<?php

get_header();

echo unifield_child_get_page_header( 'NEWS', '/category/news' );

get_template_part( 'template-parts/loop/news' );

get_footer();
