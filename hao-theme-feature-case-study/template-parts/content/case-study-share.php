<?php
use HopeandOak\WP\Theme\Hao\Media;

$case_study_id   = get_the_ID();
$case_study_url  = get_post_permalink( $case_study_id );
$case_study_name = get_the_title( $case_study_id );
?>

<div class="share">
<p class="share__title"><?php echo esc_html__( 'Social Share: ', 'hao' ); ?></p>

<!-- Facebook -->
<a href="https://www.facebook.com/sharer.php?u=<?php echo $case_study_url ; ?>" target="_blank"><?php echo ( Media::get_svg( 'social-facebook', '<style>svg.svg-sprite{width:48px; height:48px;}</style>' ) ); ?></a>

<!-- Twitter -->
<a href="https://twitter.com/share?url=<?php echo $case_study_url; ?>&text=<?php esc_html( $case_study_name ); ?>" target="_blank"><?php echo Media::get_svg( 'social-twitter', '' ); ?></a>

<!-- LinkedIn -->
<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $case_study_url; ?>" target="_blank"><?php echo Media::get_svg( 'social-linkedin', '' ); ?></a>

<!-- Email -->
<a href="mailto:?Subject=<?php esc_html( $case_study_name ); ?>&Body=<?php echo $case_study_url; ?>"><?php echo Media::get_svg( 'social-mail', '' ); ?></a>
</div>
