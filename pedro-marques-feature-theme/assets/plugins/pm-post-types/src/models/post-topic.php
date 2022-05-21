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
			'topics'         => [
				'taxonomy' => 'topics',
			],
			'topic-author'   => [
				'title'    => __( 'Author', 'pm-cpt' ),
				'meta_key' => 'topic-author',
			],
			'featured_image' => [
				'title'          => __( 'Image', 'pm-cpt' ),
				'featured_image' => '',
				'width'          => 50,
				'height'         => 50,
			],
		],
		'admin_filters' => [
			'topics' => [
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
		'has_one'        => __( 'Topic', 'pm-cpt' ),
		'has_many'       => __( 'Topics', 'pm-cpt' ),
		'featured_image' => __( 'Topic Cover', 'pm-cpt' ),
		'text_domain'    => 'pm-cpt',

		// optional, but better for translation
		'overrides'      => [
			'labels'        => [
				'name'                  => __( 'Topics', 'pm-cpt' ),
				'singular_name'         => __( 'Topic', 'pm-cpt' ),
				'menu_name'             => __( 'Topics', 'pm-cpt' ),
				'name_admin_bar'        => __( 'Topic', 'pm-cpt' ),
				'add_new'               => __( 'Add New', 'pm-cpt' ),
				'add_new_item'          => __( 'Add New Topic', 'pm-cpt' ),
				'edit_item'             => __( 'Edit Topic', 'pm-cpt' ),
				'new_item'              => __( 'New Topic', 'pm-cpt' ),
				'view_item'             => __( 'View Topic', 'pm-cpt' ),
				'view_items'            => __( 'View Topics', 'pm-cpt' ),
				'search_items'          => __( 'Search Topics', 'pm-cpt' ),
				'not_found'             => __( 'No topics found.', 'pm-cpt' ),
				'not_found_in_trash'    => __( 'No topics found in Trash.', 'pm-cpt' ),
				'parent_item-colon'     => __( 'Parent Topics:', 'pm-cpt' ),
				'all_items'             => __( 'All Topics', 'pm-cpt' ),
				'archives'              => __( 'Topic Archives', 'pm-cpt' ),
				'attributes'            => __( 'Topic Attributes', 'pm-cpt' ),
				'insert_into_item'      => __( 'Insert into topic', 'pm-cpt' ),
				'uploaded_to_this_item' => __( 'Uploaded to this topic', 'pm-cpt' ),
				'featured_image'        => __( 'Featured Image', 'pm-cpt' ),
				'set_featured_image'    => __( 'Set featured image', 'pm-cpt' ),
				'remove_featured_image' => __( 'Remove featured image', 'pm-cpt' ),
				'use_featured_image'    => __( 'Use featured image', 'pm-cpt' ),
				'filter_items_list'     => __( 'Filter topics list', 'pm-cpt' ),
				'items_list_navigation' => __( 'Topics list navigation', 'pm-cpt' ),
				'items_list'            => __( 'Topics list', 'pm-cpt' ),
				'featured_image'        => __( 'Topic Cover Image', 'pm-cpt' ),
				'set_featured_image'    => __( 'Set Topic Cover Image', 'pm-cpt' ),
				'remove_featured_image' => __( 'Remove Topic Cover', 'pm-cpt' ),
				'use_featured_image'    => __( 'Use as Topic Cover', 'pm-cpt' ),
			],
			// you can use the placeholders {permalink}, {preview_url}, {date}
			'messages'      => [
				'post_updated'         => __( 'Topic information updated. <a href="{permalink}" target="_blank">View Topic</a>', 'pm-cpt' ),
				'post_updated_short'   => __( 'Topic info updated', 'pm-cpt' ),
				'custom_field_updated' => __( 'Custom field updated', 'pm-cpt' ),
				'custom_field_deleted' => __( 'Custom field deleted', 'pm-cpt' ),
				'restored_to_revision' => __( 'Topic content restored from revision', 'pm-cpt' ),
				'post_published'       => __( 'Topic Published', 'pm-cpt' ),
				'post_saved'           => __( 'Topic information saved.', 'pm-cpt' ),
				'post_submitted'       => __( 'Topic submitted. <a href="{preview_url}" target="_blank">Preview</a>', 'pm-cpt' ),
				'post_schedulled'      => __( 'Topic scheduled for {date}. <a href="{preview_url}" target="_blank">Preview</a>', 'pm-cpt' ),
				'post_draft_updated'   => __( 'Topic draft updated. <a href="{preview_url}" target="_blank">Preview</a>', 'pm-cpt' ),
			],
			'bulk_messages' => [
				'updated_singular'   => __( 'Topic updated. Yay!', 'pm-cpt' ),
				// translators: %s is for number of topics updated
				'updated_plural'     => __( '%s Topics updated. Yay!', 'pm-cpt' ),
				'locked_singular'    => __( 'Topic not updated, somebody is editing it', 'pm-cpt' ),
				// translators: %s is for number of topics not updated
				'locked_plural'      => __( '%s Topics not updated, somebody is editing them', 'pm-cpt' ),
				'deleted_singular'   => __( 'Topic permanetly deleted. Fahrenheit 451 topic was here?', 'pm-cpt' ),
				// translators: %s is for number of topics permanently deleted
				'deleted_plural'     => __( '%s Topics permanently deleted. Why? :(', 'pm-cpt' ),
				'trashed_singular'   => __( 'Topic moved to the trash. I\'m sad :(', 'pm-cpt' ),
				// translators: %s is for number of topics moved to the trash
				'trashed_plural'     => __( '%s Topics moved to the trash. Why? :(', 'pm-cpt' ),
				'untrashed_singular' => __( 'Topic recovered from the trash. Well done!', 'pm-cpt' ),
				// translators: %s is for number of topics saved from the trash
				'untrashed_plural'   => __( '%s Topics saved from the trash!', 'pm-cpt' ),
			],
			// overrides some of the available button labels and placeholders
			'ui'            => [
				'enter_title_here' => __( 'Enter topic name here', 'pm-cpt' ),
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
			'title'    => __( 'Information', 'pm-cpt' ),
			'sections' => [
				'information' => [
					'title'  => __( 'Topic', 'pm-cpt' ),
					'desc'   => __( 'Information regarding the topic', 'pm-cpt' ),
					'icon'   => 'fa fa-file-text-o',
					'fields' => [
						'topic-author'       => [
							'title' => __( 'Author', 'pm-cpt' ),
							'type'  => 'text',
							'desc'  => __( 'The author of this topic.', 'pm-cpt' ),
						],
						'topic-file'         => [
							'title' => __( 'File', 'pm-cpt' ),
							'type'  => 'media',
							'desc'  => __( 'The file for this topic.', 'pm-cpt' ),
						],
						'topic-lead'         => [
							'title' => __( 'Lead', 'pm-cpt' ),
							'type'  => 'textarea',
							'desc'  => __( 'The lead for this topic.', 'pm-cpt' ),
						],
						'topic-dossiers' => [
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
						'topic-conclusion'   => [
							'title' => __( 'Conclusion', 'pm-cpt' ),
							'type'  => 'textarea',
							'desc'  => __( 'The conclusion for this topic.', 'pm-cpt' ),
						],
						'is_featured'        => [
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
