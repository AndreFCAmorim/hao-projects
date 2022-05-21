<?php
$case_study_id = get_the_ID();

echo get_the_post_thumbnail( $case_study_id, 'large', [ 'class' => 'case-study__featured-image' ] ); // Featured Image
