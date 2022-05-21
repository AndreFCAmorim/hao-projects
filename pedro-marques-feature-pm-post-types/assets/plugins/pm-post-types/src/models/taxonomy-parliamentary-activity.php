<?php
return [
	[
		'type'         => 'category',
		'name'         => 'parliamentary-activity',
		'associations' => [
			'event',
		],

		'labels'       => [
			'has_one'     => __( 'Parlimentary Activity', 'framework-demo' ),
			'has_many'    => __( 'Parlimentary Activities', 'framework-demo' ),
			'text_domain' => 'framework-demo',
		],

	],
];
