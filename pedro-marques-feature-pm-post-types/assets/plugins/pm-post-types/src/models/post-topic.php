<?php

return [
	'active'       => true,
	'type'         => 'cpt',
	'name'         => 'topic',
	'features'     => [
		'dragAndDrop'   => true,
		'duplicate'     => true,
		'single_export' => true,
		'admin_cols'    => [
			'title',
			'topic-author'   => [
				'title'    => __( 'Author', 'framework-demo' ),
				'meta_key' => 'topic-author',
			],
			'featured_image' => [
				'title'          => __( 'Image', 'framework-demo' ),
				'featured_image' => '',
				'width'          => 50,
				'height'         => 50,
			],
		],
		'admin_filters' => [],
	],
	'supports'     => [
		'title',
		'excerpt',
		'editor',
		'page-attributes',
		'thumbnail',
	],
	'labels'       => [
		'has_one'        => __( 'Topic', 'framework-demo' ),
		'has_many'       => __( 'Topics', 'framework-demo' ),
		'featured_image' => __( 'Topic Cover', 'framework-demo' ),
		'text_domain'    => 'framework-demo',

		// optional, but better for translation
		'overrides'      => [
			'labels'        => [
				'name'                  => __( 'Topics', 'framework-demo' ),
				'singular_name'         => __( 'Topic', 'framework-demo' ),
				'menu_name'             => __( 'Topics', 'framework-demo' ),
				'name_admin_bar'        => __( 'Topic', 'framework-demo' ),
				'add_new'               => __( 'Add New', 'framework-demo' ),
				'add_new_item'          => __( 'Add New Topic', 'framework-demo' ),
				'edit_item'             => __( 'Edit Topic', 'framework-demo' ),
				'new_item'              => __( 'New Topic', 'framework-demo' ),
				'view_item'             => __( 'View Topic', 'framework-demo' ),
				'view_items'            => __( 'View Topics', 'framework-demo' ),
				'search_items'          => __( 'Search Topics', 'framework-demo' ),
				'not_found'             => __( 'No topics found.', 'framework-demo' ),
				'not_found_in_trash'    => __( 'No topics found in Trash.', 'framework-demo' ),
				'parent_item-colon'     => __( 'Parent Topics:', 'framework-demo' ),
				'all_items'             => __( 'All Topics', 'framework-demo' ),
				'archives'              => __( 'Topic Archives', 'framework-demo' ),
				'attributes'            => __( 'Topic Attributes', 'framework-demo' ),
				'insert_into_item'      => __( 'Insert into topic', 'framework-demo' ),
				'uploaded_to_this_item' => __( 'Uploaded to this topic', 'framework-demo' ),
				'featured_image'        => __( 'Featured Image', 'framework-demo' ),
				'set_featured_image'    => __( 'Set featured image', 'framework-demo' ),
				'remove_featured_image' => __( 'Remove featured image', 'framework-demo' ),
				'use_featured_image'    => __( 'Use featured image', 'framework-demo' ),
				'filter_items_list'     => __( 'Filter topics list', 'framework-demo' ),
				'items_list_navigation' => __( 'Topics list navigation', 'framework-demo' ),
				'items_list'            => __( 'Topics list', 'framework-demo' ),
				'featured_image'        => __( 'Topic Cover Image', 'framework-demo' ),
				'set_featured_image'    => __( 'Set Topic Cover Image', 'framework-demo' ),
				'remove_featured_image' => __( 'Remove Topic Cover', 'framework-demo' ),
				'use_featured_image'    => __( 'Use as Topic Cover', 'framework-demo' ),
			],
			// you can use the placeholders {permalink}, {preview_url}, {date}
			'messages'      => [
				'post_updated'         => __( 'Topic information updated. <a href="{permalink}" target="_blank">View Topic</a>', 'framework-demo' ),
				'post_updated_short'   => __( 'Topic info updated', 'framework-demo' ),
				'custom_field_updated' => __( 'Custom field updated', 'framework-demo' ),
				'custom_field_deleted' => __( 'Custom field deleted', 'framework-demo' ),
				'restored_to_revision' => __( 'Topic content restored from revision', 'framework-demo' ),
				'post_published'       => __( 'Topic Published', 'framework-demo' ),
				'post_saved'           => __( 'Topic information saved.', 'framework-demo' ),
				'post_submitted'       => __( 'Topic submitted. <a href="{preview_url}" target="_blank">Preview</a>', 'framework-demo' ),
				'post_schedulled'      => __( 'Topic scheduled for {date}. <a href="{preview_url}" target="_blank">Preview</a>', 'framework-demo' ),
				'post_draft_updated'   => __( 'Topic draft updated. <a href="{preview_url}" target="_blank">Preview</a>', 'framework-demo' ),
			],
			'bulk_messages' => [
				'updated_singular'   => __( 'Topic updated. Yay!', 'framework-demo' ),
				// translators: %s is for number of topics updated
				'updated_plural'     => __( '%s Topics updated. Yay!', 'framework-demo' ),
				'locked_singular'    => __( 'Topic not updated, somebody is editing it', 'framework-demo' ),
				// translators: %s is for number of topics not updated
				'locked_plural'      => __( '%s Topics not updated, somebody is editing them', 'framework-demo' ),
				'deleted_singular'   => __( 'Topic permanetly deleted. Fahrenheit 451 topic was here?', 'framework-demo' ),
				// translators: %s is for number of topics permanently deleted
				'deleted_plural'     => __( '%s Topics permanently deleted. Why? :(', 'framework-demo' ),
				'trashed_singular'   => __( 'Topic moved to the trash. I\'m sad :(', 'framework-demo' ),
				// translators: %s is for number of topics moved to the trash
				'trashed_plural'     => __( '%s Topics moved to the trash. Why? :(', 'framework-demo' ),
				'untrashed_singular' => __( 'Topic recovered from the trash. Well done!', 'framework-demo' ),
				// translators: %s is for number of topics saved from the trash
				'untrashed_plural'   => __( '%s Topics saved from the trash!', 'framework-demo' ),
			],
			// overrides some of the available button labels and placeholders
			'ui'            => [
				'enter_title_here' => __( 'Enter topic name here', 'framework-demo' ),
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
		'menu_icon'          => 'dashicons-text-page',
		'rewrite'            => [
			'slug'       => 'topic',
			'with_front' => true,
			'feeds'      => true,
			'pages'      => true,
		],
	],
	'block_editor' => true,
	'meta'         => [
		'topic_info' => [
			'id'       => 'information_metabox',
			'title'    => __( 'Information', 'framework-demo' ),
			'sections' => [
				'information' => [
					'title'  => __( 'Topic', 'framework-demo' ),
					'desc'   => __( 'Information regarding the topic', 'framework-demo' ),
					'icon'   => 'fa fa-file-text-o',
					'fields' => [
						'topic-author'       => [
							'title' => __( 'Author', 'framework-demo' ),
							'type'  => 'text',
							'desc'  => __( 'The author of this topic.', 'framework-demo' ),
						],
						'topic-file'         => [
							'title' => __( 'File', 'framework-demo' ),
							'type'  => 'media',
							'desc'  => __( 'The file for this topic.', 'framework-demo' ),
						],
						'topic-lead'         => [
							'title' => __( 'Lead', 'framework-demo' ),
							'type'  => 'textarea',
							'desc'  => __( 'The lead for this topic.', 'framework-demo' ),
						],
						'topic-values'       => [
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
						'topic-publications' => [
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
						'topic-conclusion'   => [
							'title' => __( 'Conclusion', 'framework-demo' ),
							'type'  => 'textarea',
							'desc'  => __( 'The conclusion for this topic.', 'framework-demo' ),
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
