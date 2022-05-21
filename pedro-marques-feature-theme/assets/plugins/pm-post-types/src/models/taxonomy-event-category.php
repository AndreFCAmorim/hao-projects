<?php
return [
	[
		'type'         => 'category',
		'name'         => 'event-category',
		'associations' => [
			'event',
		],

		'labels'       => [
			'has_one'     => __( 'Category', 'pm-cpt' ),
			'has_many'    => __( 'Categories', 'pm-cpt' ),
			'text_domain' => 'pm-cpt',
		],

	],
];
