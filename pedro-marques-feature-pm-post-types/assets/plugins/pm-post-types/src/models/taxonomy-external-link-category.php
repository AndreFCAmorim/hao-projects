<?php
return [
	[
		'type'         => 'category',
		'name'         => 'external-link-category',
		'associations' => [
			'external-link',
		],

		'labels'       => [
			'has_one'     => __( 'Category', 'framework-demo' ),
			'has_many'    => __( 'Categories', 'framework-demo' ),
			'text_domain' => 'framework-demo',
		],

	],
];
