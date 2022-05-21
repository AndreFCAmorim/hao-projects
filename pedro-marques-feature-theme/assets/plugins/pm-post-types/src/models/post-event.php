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
			'event-category' => [
				'taxonomy' => 'event-category',
			],
			'topics'         => [
				'taxonomy' => 'topics',
			],
			'featured_image' => [
				'title'          => __( 'Image', 'pm-cpt' ),
				'featured_image' => '',
				'width'          => 50,
				'height'         => 50,
			],
		],
		'admin_filters' => [
			'event-category' => [
				'taxonomy' => 'event-category',
			],
			'topics'         => [
				'taxonomy' => 'topics',
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
		'has_one'        => __( 'Event', 'pm-cpt' ),
		'has_many'       => __( 'Events', 'pm-cpt' ),
		'featured_image' => __( 'Event Cover', 'pm-cpt' ),
		'text_domain'    => 'pm-cpt',

		// optional, but better for translation
		'overrides'      => [
			'labels'        => [
				'name'                  => __( 'Events', 'pm-cpt' ),
				'singular_name'         => __( 'Event', 'pm-cpt' ),
				'menu_name'             => __( 'Events', 'pm-cpt' ),
				'name_admin_bar'        => __( 'Event', 'pm-cpt' ),
				'add_new'               => __( 'Add New', 'pm-cpt' ),
				'add_new_item'          => __( 'Add New Event', 'pm-cpt' ),
				'edit_item'             => __( 'Edit Event', 'pm-cpt' ),
				'new_item'              => __( 'New Event', 'pm-cpt' ),
				'view_item'             => __( 'View Event', 'pm-cpt' ),
				'view_items'            => __( 'View Events', 'pm-cpt' ),
				'search_items'          => __( 'Search Events', 'pm-cpt' ),
				'not_found'             => __( 'No events found.', 'pm-cpt' ),
				'not_found_in_trash'    => __( 'No events found in Trash.', 'pm-cpt' ),
				'parent_item-colon'     => __( 'Parent Events:', 'pm-cpt' ),
				'all_items'             => __( 'All Events', 'pm-cpt' ),
				'archives'              => __( 'Event Archives', 'pm-cpt' ),
				'attributes'            => __( 'Event Attributes', 'pm-cpt' ),
				'insert_into_item'      => __( 'Insert into event', 'pm-cpt' ),
				'uploaded_to_this_item' => __( 'Uploaded to this event', 'pm-cpt' ),
				'featured_image'        => __( 'Featured Image', 'pm-cpt' ),
				'set_featured_image'    => __( 'Set featured image', 'pm-cpt' ),
				'remove_featured_image' => __( 'Remove featured image', 'pm-cpt' ),
				'use_featured_image'    => __( 'Use featured image', 'pm-cpt' ),
				'filter_items_list'     => __( 'Filter events list', 'pm-cpt' ),
				'items_list_navigation' => __( 'Events list navigation', 'pm-cpt' ),
				'items_list'            => __( 'Events list', 'pm-cpt' ),
				'featured_image'        => __( 'Event Cover Image', 'pm-cpt' ),
				'set_featured_image'    => __( 'Set Event Cover Image', 'pm-cpt' ),
				'remove_featured_image' => __( 'Remove Event Cover', 'pm-cpt' ),
				'use_featured_image'    => __( 'Use as Event Cover', 'pm-cpt' ),
			],
			// you can use the placeholders {permalink}, {preview_url}, {date}
			'messages'      => [
				'post_updated'         => __( 'Event information updated. <a href="{permalink}" target="_blank">View Event</a>', 'pm-cpt' ),
				'post_updated_short'   => __( 'Event info updated', 'pm-cpt' ),
				'custom_field_updated' => __( 'Custom field updated', 'pm-cpt' ),
				'custom_field_deleted' => __( 'Custom field deleted', 'pm-cpt' ),
				'restored_to_revision' => __( 'Event content restored from revision', 'pm-cpt' ),
				'post_published'       => __( 'Event Published', 'pm-cpt' ),
				'post_saved'           => __( 'Event information saved.', 'pm-cpt' ),
				'post_submitted'       => __( 'Event submitted. <a href="{preview_url}" target="_blank">Preview</a>', 'pm-cpt' ),
				'post_schedulled'      => __( 'Event scheduled for {date}. <a href="{preview_url}" target="_blank">Preview</a>', 'pm-cpt' ),
				'post_draft_updated'   => __( 'Event draft updated. <a href="{preview_url}" target="_blank">Preview</a>', 'pm-cpt' ),
			],
			'bulk_messages' => [
				'updated_singular'   => __( 'Event updated. Yay!', 'pm-cpt' ),
				// translators: %s is for number of events updated
				'updated_plural'     => __( '%s Events updated. Yay!', 'pm-cpt' ),
				'locked_singular'    => __( 'Event not updated, somebody is editing it', 'pm-cpt' ),
				// translators: %s is for number of events not updated
				'locked_plural'      => __( '%s Events not updated, somebody is editing them', 'pm-cpt' ),
				'deleted_singular'   => __( 'Event permanetly deleted. Fahrenheit 451 team was here?', 'pm-cpt' ),
				// translators: %s is for number of events permanently deleted
				'deleted_plural'     => __( '%s Events permanently deleted. Why? :(', 'pm-cpt' ),
				'trashed_singular'   => __( 'Event moved to the trash. I\'m sad :(', 'pm-cpt' ),
				// translators: %s is for number of events moved to the trash
				'trashed_plural'     => __( '%s Events moved to the trash. Why? :(', 'pm-cpt' ),
				'untrashed_singular' => __( 'Event recovered from the trash. Well done!', 'pm-cpt' ),
				// translators: %s is for number of events saved from the trash
				'untrashed_plural'   => __( '%s Events saved from the trash!', 'pm-cpt' ),
			],
			// overrides some of the available button labels and placeholders
			'ui'            => [
				'enter_title_here' => __( 'Enter event name here', 'pm-cpt' ),
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
		'hierarchical'       => true,
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
			'title'    => __( 'Information', 'pm-cpt' ),
			'sections' => [
				'information' => [
					'title'  => __( 'Event', 'pm-cpt' ),
					'desc'   => __( 'Information regarding the event', 'pm-cpt' ),
					'icon'   => 'fa fa-file-text-o',
					'fields' => [
						'event-date'            => [
							'title'    => __( 'Date', 'pm-cpt' ),
							'type'     => 'date',
							'settings' => [
								'dateFormat' => 'dd/mm/yy',
							],
							'desc'     => __( 'The date for this event.', 'pm-cpt' ),
						],
						'event-local'           => [
							'title' => __( 'Local', 'pm-cpt' ),
							'type'  => 'text',
							'desc'  => __( 'The local for this event.', 'pm-cpt' ),
						],
						'event-dossiers'    => [
							'type'        => 'select',
							'title'       => __( 'Dossiers', 'pm-cpt' ),
							'placeholder' => __( 'Select dossiers', 'pm-cpt' ),
							'options'     => 'posts',
							'multiple'    => true,
							'chosen'      => true,
							'query_args'  => [
								'post_type'      => 'dossier',
								'posts_per_page' => -1,
							],
						],
						'event-recent-activity' => [
							'title'   => __( 'Is Activity', 'pm-cpt' ),
							'type'    => 'switcher',
							'label'   => __( 'Is Activity', 'pm-cpt' ),
							'default' => false,
						],
						'is_featured'           => [
							'title'   => __( 'Is Featured', 'pm-cpt' ),
							'type'    => 'switcher',
							'label'   => __( 'Is Featured?', 'pm-cpt' ),
							'default' => false,
						],
					],
				],
			],
		],
	],
];
