<?php
$case_study_id = get_the_ID();
?>
<div class="col-25">
<?php
$client_id = get_post_meta( $case_study_id, 'clients', true );
printf(
	'<div class="case-study__client">
		<a class="case-study__client-logos" href="%1$s">%2$s</a>
	</div><br>',
	esc_url( get_post_meta( $client_id, 'link', true ) ),
	get_the_post_thumbnail( $client_id, [ '100', '100' ], [ 'class' => 'client-image' ] ),
);
?>
</div>
<div class="col-25">
<?php
$project_date = get_post_meta( $case_study_id, 'project-date', true );
if ( ! empty( $project_date ) ) {
	printf(
		'<p class="case-study__date">%1$s</p>
		<br>',
		esc_html( $project_date )
	);
}
?>
</div>
<div class="col-25">
<?php
$services_list = wp_get_post_terms( $case_study_id, 'service', [ 'fields' => 'names' ] ); // Get services taxonomy array
if ( ! empty( $services_list ) ) {
	echo '<ul>';
	foreach ( $services_list as $name ) {
		printf(
			'<li>
				<a href="%1$s">%2$s</a>
			</li>',
			esc_url( get_term_link( $name, 'service' ) ),
			esc_html( $name ),
		);
	}
	echo '</ul>';
}

$project_link = get_post_meta( $case_study_id, 'project-link', true ); // Load into var to avoid redundancy
if ( ! empty( $project_link ) ) {
	printf(
		'<p class="case-study__link"><a href="%1$s">%2$s</a></p>',
		esc_url( $project_link ),
		esc_html( get_the_title() )
	);
}
?>
</div>
<div class="col-25">
<?php
$partners = get_post_meta( $case_study_id, 'partners', true ); // Load into array the partners IDs
if ( ! empty( $partners ) ) {
	foreach ( $partners as $partner_id ) {
		printf(
			'<div class="case-study__partners">
				<a class="case-study__partners-logos" href="%1$s">%2$s</a>
			</div>',
			esc_url( get_post_meta( $partner_id, 'link', true ) ),
			get_the_post_thumbnail( $partner_id, [ '50', '50' ], [ 'class' => 'partner-image' ] ),
		);
	}
}
?>
</div>
