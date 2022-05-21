<?php

return [
	'active'       => true,
	'type'         => 'cpt',
	'name'         => 'event',
	'features'     => [
		'dragAndDrop'   => true,
		'duplicate'     => true,
		'single_export' => true,
		'admin_cols'    => [
			'title',
			'professional-activities'  => [
				'taxonomy' => 'professional-activity',
			],
			'parliamentary-activities' => [
				'taxonomy' => 'parliamentary-activity',
			],
			'featured_image'           => [
				'title'          => __( 'Image', 'framework-demo' ),
				'featured_image' => '',
				'width'          => 50,
				'height'         => 50,
			],
		],
		'admin_filters' => [
			'professional-activities'  => [
				'taxonomy' => 'professional-activity',
			],
			'parliamentary-activities' => [
				'taxonomy' => 'parliamentary-activity',
			],
		],
	],
	'supports'     => [
		'title',
		'excerpt',
		'editor',
		'page-attributes',
		'thumbnail',
	],
	'labels'       => [
		'has_one'        => __( 'Event', 'framework-demo' ),
		'has_many'       => __( 'Events', 'framework-demo' ),
		'featured_image' => __( 'Event Cover', 'framework-demo' ),
		'text_domain'    => 'framework-demo',

		// optional, but better for translation
		'overrides'      => [
			'labels'        => [
				'name'                  => __( 'Events', 'framework-demo' ),
				'singular_name'         => __( 'Event', 'framework-demo' ),
				'menu_name'             => __( 'Events', 'framework-demo' ),
				'name_admin_bar'        => __( 'Event', 'framework-demo' ),
				'add_new'               => __( 'Add New', 'framework-demo' ),
				'add_new_item'          => __( 'Add New Event', 'framework-demo' ),
				'edit_item'             => __( 'Edit Event', 'framework-demo' ),
				'new_item'              => __( 'New Event', 'framework-demo' ),
				'view_item'             => __( 'View Event', 'framework-demo' ),
				'view_items'            => __( 'View Events', 'framework-demo' ),
				'search_items'          => __( 'Search Events', 'framework-demo' ),
				'not_found'             => __( 'No events found.', 'framework-demo' ),
				'not_found_in_trash'    => __( 'No events found in Trash.', 'framework-demo' ),
				'parent_item-colon'     => __( 'Parent Events:', 'framework-demo' ),
				'all_items'             => __( 'All Events', 'framework-demo' ),
				'archives'              => __( 'Event Archives', 'framework-demo' ),
				'attributes'            => __( 'Event Attributes', 'framework-demo' ),
				'insert_into_item'      => __( 'Insert into event', 'framework-demo' ),
				'uploaded_to_this_item' => __( 'Uploaded to this event', 'framework-demo' ),
				'featured_image'        => __( 'Featured Image', 'framework-demo' ),
				'set_featured_image'    => __( 'Set featured image', 'framework-demo' ),
				'remove_featured_image' => __( 'Remove featured image', 'framework-demo' ),
				'use_featured_image'    => __( 'Use featured image', 'framework-demo' ),
				'filter_items_list'     => __( 'Filter events list', 'framework-demo' ),
				'items_list_navigation' => __( 'Events list navigation', 'framework-demo' ),
				'items_list'            => __( 'Events list', 'framework-demo' ),
				'featured_image'        => __( 'Event Cover Image', 'framework-demo' ),
				'set_featured_image'    => __( 'Set Event Cover Image', 'framework-demo' ),
				'remove_featured_image' => __( 'Remove Event Cover', 'framework-demo' ),
				'use_featured_image'    => __( 'Use as Event Cover', 'framework-demo' ),
			],
			// you can use the placeholders {permalink}, {preview_url}, {date}
			'messages'      => [
				'post_updated'         => __( 'Event information updated. <a href="{permalink}" target="_blank">View Event</a>', 'framework-demo' ),
				'post_updated_short'   => __( 'Event info updated', 'framework-demo' ),
				'custom_field_updated' => __( 'Custom field updated', 'framework-demo' ),
				'custom_field_deleted' => __( 'Custom field deleted', 'framework-demo' ),
				'restored_to_revision' => __( 'Event content restored from revision', 'framework-demo' ),
				'post_published'       => __( 'Event Published', 'framework-demo' ),
				'post_saved'           => __( 'Event information saved.', 'framework-demo' ),
				'post_submitted'       => __( 'Event submitted. <a href="{preview_url}" target="_blank">Preview</a>', 'framework-demo' ),
				'post_schedulled'      => __( 'Event scheduled for {date}. <a href="{preview_url}" target="_blank">Preview</a>', 'framework-demo' ),
				'post_draft_updated'   => __( 'Event draft updated. <a href="{preview_url}" target="_blank">Preview</a>', 'framework-demo' ),
			],
			'bulk_messages' => [
				'updated_singular'   => __( 'Event updated. Yay!', 'framework-demo' ),
				// translators: %s is for number of events updated
				'updated_plural'     => __( '%s Events updated. Yay!', 'framework-demo' ),
				'locked_singular'    => __( 'Event not updated, somebody is editing it', 'framework-demo' ),
				// translators: %s is for number of events not updated
				'locked_plural'      => __( '%s Events not updated, somebody is editing them', 'framework-demo' ),
				'deleted_singular'   => __( 'Event permanetly deleted. Fahrenheit 451 team was here?', 'framework-demo' ),
				// translators: %s is for number of events permanently deleted
				'deleted_plural'     => __( '%s Events permanently deleted. Why? :(', 'framework-demo' ),
				'trashed_singular'   => __( 'Event moved to the trash. I\'m sad :(', 'framework-demo' ),
				// translators: %s is for number of events moved to the trash
				'trashed_plural'     => __( '%s Events moved to the trash. Why? :(', 'framework-demo' ),
				'untrashed_singular' => __( 'Event recovered from the trash. Well done!', 'framework-demo' ),
				// translators: %s is for number of events saved from the trash
				'untrashed_plural'   => __( '%s Events saved from the trash!', 'framework-demo' ),
			],
			// overrides some of the available button labels and placeholders
			'ui'            => [
				'enter_title_here' => __( 'Enter event name here', 'framework-demo' ),
			],
		],
	],
	'options'      => [
		'public'             => true,
		'publicly_queryable' => true,
		'show_in_rest'       => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'can_export'         => true,
		'capability_type'    => 'post',
		'menu_icon'          => 'dashicons-calendar-alt',
		'rewrite'            => [
			'slug'       => 'event',
			'with_front' => true,
			'feeds'      => true,
			'pages'      => true,
		],
	],
	'block_editor' => true,
	'meta'         => [
		'event_info' => [
			'id'       => 'information_metabox',
			'title'    => __( 'Information', 'framework-demo' ),
			'sections' => [
				'information' => [
					'title'  => __( 'Event', 'framework-demo' ),
					'desc'   => __( 'Information regarding the event', 'framework-demo' ),
					'icon'   => 'fa fa-file-text-o',
					'fields' => [
						'event-date'         => [
							'title'    => __( 'Date', 'framework-demo' ),
							'type'     => 'date',
							'settings' => [
								'dateFormat' => 'dd/mm/yy',
							],
							'desc'     => __( 'The date for this event.', 'framework-demo' ),
						],
						'event-local'        => [
							'title' => __( 'Local', 'framework-demo' ),
							'type'  => 'text',
							'desc'  => __( 'The local for this event.', 'framework-demo' ),
						],
						'event-publications' => [
							'type'        => 'select',
							'title'       => __( 'Publications', 'framework-demo' ),
							'placeholder' => __( 'Select publications', 'framework-demo' ),
							'options'     => 'posts',
							'multiple'    => true,
							'chosen'      => true,
							'query_args'  => [
								'post_type'      => 'publication',
								'posts_per_page' => -1,
							],
						],
						'event-values'       => [
							'type'        => 'select',
							'title'       => __( 'Values', 'framework-demo' ),
							'placeholder' => __( 'Select values', 'framework-demo' ),
							'options'     => 'posts',
							'multiple'    => true,
							'chosen'      => true,
							'query_args'  => [
								'post_type'      => 'value',
								'posts_per_page' => -1,
							],
						],
					],
				],
				'featured'    => [
					'title'  => __( 'Featured', 'framework-demo' ),
					'icon'   => 'fa fa-check-square',
					'fields' => [
						'is_featured' => [
							'title'   => __( 'Is Featured', 'framework-demo' ),
							'type'    => 'switcher',
							'label'   => __( 'Is Featured?', 'framework-demo' ),
							'default' => false,
						],
					],
				],
			],
		],
	],
];
