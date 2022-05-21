<?php
return [
	[
		'type'         => 'category',
		'name'         => 'topics',
		'associations' => [
			'topic',
			'event',
			'dossier',
			'value',
		],

		'labels'       => [
			'has_one'     => __( 'Topic Category', 'pm-cpt' ),
			'has_many'    => __( 'Topic Categories', 'pm-cpt' ),
			'text_domain' => 'pm-cpt',
		],

	],
];
