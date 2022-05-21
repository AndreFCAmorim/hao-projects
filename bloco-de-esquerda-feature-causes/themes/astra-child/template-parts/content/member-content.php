<?php
$member_id    = get_the_ID();
$email_meta   = get_post_meta( $member_id, 'member-email', true );
$socials_meta = get_post_meta( $member_id, 'member-social-networks', true );
$socials_html = '';
if ( ! empty( $socials_meta ) ) {
	foreach ( preg_split( "/((\r?\n)|(\r\n?))/", $socials_meta ) as $line ) {
		$socials_html .= sprintf(
			'<a href="%1$s" target="_blank">%2$s</a><br>',
			$line,
			parse_url( $line )['host']
		);
	}
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div id="member">
		<div class="member__left-to-right">
			<div class="member__left-to-right_image">
				<?php

				if ( ! empty( get_the_post_thumbnail() ) ) {
					echo get_the_post_thumbnail( $member_id, [ '250', '250' ], [ 'class' => 'member__image' ] );
				} else {
					printf(
						'<img class="member__image" src="%1$s">',
						get_stylesheet_directory_uri() . '/dist/images/no_image.jpg',
					);
				}

				?>
			</div>
			<div class="member__left-to-right_item">
				<h3><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
				<h4><?php echo '<q>' . get_post_meta( $member_id, 'member-quote', true ) . '</q>'; ?></h4>
				<div class="cause-content">
					<p><?php echo get_the_excerpt(); ?></p>
				</div>
				<div class="member__email">
					<?php
					if ( ! empty( $email_meta ) ) {
						printf(
							'<h4>%1$s</h4>
								<a href="mailto:%2$s">%2$s</a>',
							__( 'Email Address:', 'astra' ),
							get_post_meta( $member_id, 'member-email', true )
						);
					}
					?>
				</div>
				<div class="member__social-networks">
					<?php
					if ( ! empty( $socials_meta ) ) {
						printf(
							'<h4>%1$s</h4>',
							__( 'Social networks:', 'astra' )
						);
						echo $socials_html;
					}
					?>
				</div>
			</div>
		</div>
	</div>
</article>
