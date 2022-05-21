<?php
return [
	[
		'type'         => 'category',
		'name'         => 'professional-activity',
		'associations' => [
			'event',
		],

		'labels'       => [
			'has_one'     => __( 'Professional Activity', 'framework-demo' ),
			'has_many'    => __( 'Professional Activities', 'framework-demo' ),
			'text_domain' => 'framework-demo',
		],

	],
];
