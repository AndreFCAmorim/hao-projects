<?php
return [
	[
		'type'         => 'category',
		'name'         => 'external-link-category',
		'associations' => [
			'external-link',
		],

		'labels'       => [
			'has_one'     => __( 'Category', 'pm-cpt' ),
			'has_many'    => __( 'Categories', 'pm-cpt' ),
			'text_domain' => 'pm-cpt',
		],

	],
];
