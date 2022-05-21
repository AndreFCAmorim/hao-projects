<?php

return [
	'active'       => true,
	'type'         => 'cpt',
	'name'         => 'publication',
	'features'     => [
		'dragAndDrop'   => true,
		'duplicate'     => true,
		'single_export' => true,
		'admin_cols'    => [
			'title',
			'publication-credit' => [
				'title'    => __( 'Credit', 'framework-demo' ),
				'meta_key' => 'publication-credit',
			],
			'publication-date'   => [
				'title'    => __( 'Date', 'framework-demo' ),
				'meta_key' => 'publication-date',
			],
			'publication-local'  => [
				'title'    => __( 'Local', 'framework-demo' ),
				'meta_key' => 'publication-local',
			],
			'featured_image'     => [
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
		'has_one'        => __( 'Publication', 'framework-demo' ),
		'has_many'       => __( 'Publications', 'framework-demo' ),
		'featured_image' => __( 'Publication Cover', 'framework-demo' ),
		'text_domain'    => 'framework-demo',

		// optional, but better for translation
		'overrides'      => [
			'labels'        => [
				'name'                  => __( 'Publications', 'framework-demo' ),
				'singular_name'         => __( 'Publication', 'framework-demo' ),
				'menu_name'             => __( 'Publications', 'framework-demo' ),
				'name_admin_bar'        => __( 'Publication', 'framework-demo' ),
				'add_new'               => __( 'Add New', 'framework-demo' ),
				'add_new_item'          => __( 'Add New Publication', 'framework-demo' ),
				'edit_item'             => __( 'Edit Publication', 'framework-demo' ),
				'new_item'              => __( 'New Publication', 'framework-demo' ),
				'view_item'             => __( 'View Publication', 'framework-demo' ),
				'view_items'            => __( 'View Publications', 'framework-demo' ),
				'search_items'          => __( 'Search Publications', 'framework-demo' ),
				'not_found'             => __( 'No publications found.', 'framework-demo' ),
				'not_found_in_trash'    => __( 'No publications found in Trash.', 'framework-demo' ),
				'parent_item-colon'     => __( 'Parent Publications:', 'framework-demo' ),
				'all_items'             => __( 'All Publications', 'framework-demo' ),
				'archives'              => __( 'Publication Archives', 'framework-demo' ),
				'attributes'            => __( 'Publication Attributes', 'framework-demo' ),
				'insert_into_item'      => __( 'Insert into publication', 'framework-demo' ),
				'uploaded_to_this_item' => __( 'Uploaded to this publication', 'framework-demo' ),
				'featured_image'        => __( 'Featured Image', 'framework-demo' ),
				'set_featured_image'    => __( 'Set featured image', 'framework-demo' ),
				'remove_featured_image' => __( 'Remove featured image', 'framework-demo' ),
				'use_featured_image'    => __( 'Use featured image', 'framework-demo' ),
				'filter_items_list'     => __( 'Filter publications list', 'framework-demo' ),
				'items_list_navigation' => __( 'Publications list navigation', 'framework-demo' ),
				'items_list'            => __( 'Publications list', 'framework-demo' ),
				'featured_image'        => __( 'Publication Cover Image', 'framework-demo' ),
				'set_featured_image'    => __( 'Set Publication Cover Image', 'framework-demo' ),
				'remove_featured_image' => __( 'Remove Publication Cover', 'framework-demo' ),
				'use_featured_image'    => __( 'Use as Publication Cover', 'framework-demo' ),
			],
			// you can use the placeholders {permalink}, {preview_url}, {date}
			'messages'      => [
				'post_updated'         => __( 'Publication information updated. <a href="{permalink}" target="_blank">View Publication</a>', 'framework-demo' ),
				'post_updated_short'   => __( 'Publication info updated', 'framework-demo' ),
				'custom_field_updated' => __( 'Custom field updated', 'framework-demo' ),
				'custom_field_deleted' => __( 'Custom field deleted', 'framework-demo' ),
				'restored_to_revision' => __( 'Publication content restored from revision', 'framework-demo' ),
				'post_published'       => __( 'Publication Published', 'framework-demo' ),
				'post_saved'           => __( 'Publication information saved.', 'framework-demo' ),
				'post_submitted'       => __( 'Publication submitted. <a href="{preview_url}" target="_blank">Preview</a>', 'framework-demo' ),
				'post_schedulled'      => __( 'Publication scheduled for {date}. <a href="{preview_url}" target="_blank">Preview</a>', 'framework-demo' ),
				'post_draft_updated'   => __( 'Publication draft updated. <a href="{preview_url}" target="_blank">Preview</a>', 'framework-demo' ),
			],
			'bulk_messages' => [
				'updated_singular'   => __( 'Publication updated. Yay!', 'framework-demo' ),
				// translators: %s is for number of publications updated
				'updated_plural'     => __( '%s Publications updated. Yay!', 'framework-demo' ),
				'locked_singular'    => __( 'Publication not updated, somebody is editing it', 'framework-demo' ),
				// translators: %s is for number of publications not updated
				'locked_plural'      => __( '%s Publications not updated, somebody is editing them', 'framework-demo' ),
				'deleted_singular'   => __( 'Publication permanetly deleted. Fahrenheit 451 team was here?', 'framework-demo' ),
				// translators: %s is for number of publications permanently deleted
				'deleted_plural'     => __( '%s Publications permanently deleted. Why? :(', 'framework-demo' ),
				'trashed_singular'   => __( 'Publication moved to the trash. I\'m sad :(', 'framework-demo' ),
				// translators: %s is for number of publications moved to the trash
				'trashed_plural'     => __( '%s Publications moved to the trash. Why? :(', 'framework-demo' ),
				'untrashed_singular' => __( 'Publication recovered from the trash. Well done!', 'framework-demo' ),
				// translators: %s is for number of publications saved from the trash
				'untrashed_plural'   => __( '%s Publications saved from the trash!', 'framework-demo' ),
			],
			// overrides some of the available button labels and placeholders
			'ui'            => [
				'enter_title_here' => __( 'Enter publication name here', 'framework-demo' ),
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
		'menu_icon'          => 'dashicons-book-alt',
		'rewrite'            => [
			'slug'       => 'publication',
			'with_front' => true,
			'feeds'      => true,
			'pages'      => true,
		],
	],
	'block_editor' => true,
	'meta'         => [
		'publication_info' => [
			'id'       => 'information_metabox',
			'title'    => __( 'Information', 'framework-demo' ),
			'sections' => [
				'information' => [
					'title'  => __( 'Publication', 'framework-demo' ),
					'desc'   => __( 'Information regarding the publication', 'framework-demo' ),
					'icon'   => 'fa fa-file-text-o',
					'fields' => [
						'publication-credit' => [
							'title' => __( 'Credit', 'framework-demo' ),
							'type'  => 'text',
							'desc'  => __( 'The author of this publication.', 'framework-demo' ),
						],
						'publication-date'   => [
							'title'    => __( 'Date', 'framework-demo' ),
							'type'     => 'date',
							'settings' => [
								'dateFormat' => 'dd/mm/yy',
							],
							'desc'     => __( 'The date of this publication.', 'framework-demo' ),
						],
						'publication-local'  => [
							'title' => __( 'Local', 'framework-demo' ),
							'type'  => 'text',
							'desc'  => __( 'The local of this publication.', 'framework-demo' ),
						],
						'publication-file'   => [
							'title' => __( 'File', 'framework-demo' ),
							'type'  => 'media',
							'desc'  => __( 'The file for this publication.', 'framework-demo' ),
						],
						'publication-values' => [
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
