<?php

return [
	'active'       => true,
	'type'         => 'cpt',
	'name'         => 'cause',
	'features'     => [
		'dragAndDrop'   => true,
		'duplicate'     => true,
		'single_export' => true,
		'admin_cols'    => [
			'title',
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
		'has_one'        => __( 'Cause', 'framework-demo' ),
		'has_many'       => __( 'Causes', 'framework-demo' ),
		'featured_image' => __( 'Cause Cover', 'framework-demo' ),
		'text_domain'    => 'framework-demo',

		// optional, but better for translation
		'overrides'      => [
			'labels'        => [
				'name'                  => __( 'Causes', 'framework-demo' ),
				'singular_name'         => __( 'Cause', 'framework-demo' ),
				'menu_name'             => __( 'Causes', 'framework-demo' ),
				'name_admin_bar'        => __( 'Cause', 'framework-demo' ),
				'add_new'               => __( 'Add New', 'framework-demo' ),
				'add_new_item'          => __( 'Add New Cause', 'framework-demo' ),
				'edit_item'             => __( 'Edit Cause', 'framework-demo' ),
				'new_item'              => __( 'New Cause', 'framework-demo' ),
				'view_item'             => __( 'View Cause', 'framework-demo' ),
				'view_items'            => __( 'View Causes', 'framework-demo' ),
				'search_items'          => __( 'Search Causes', 'framework-demo' ),
				'not_found'             => __( 'No causes found.', 'framework-demo' ),
				'not_found_in_trash'    => __( 'No causes found in Trash.', 'framework-demo' ),
				'parent_item-colon'     => __( 'Parent Causes:', 'framework-demo' ),
				'all_items'             => __( 'All Causes', 'framework-demo' ),
				'archives'              => __( 'Cause Archives', 'framework-demo' ),
				'attributes'            => __( 'Cause Attributes', 'framework-demo' ),
				'insert_into_item'      => __( 'Insert into cause', 'framework-demo' ),
				'uploaded_to_this_item' => __( 'Uploaded to this cause', 'framework-demo' ),
				'featured_image'        => __( 'Featured Image', 'framework-demo' ),
				'set_featured_image'    => __( 'Set featured image', 'framework-demo' ),
				'remove_featured_image' => __( 'Remove featured image', 'framework-demo' ),
				'use_featured_image'    => __( 'Use featured image', 'framework-demo' ),
				'filter_items_list'     => __( 'Filter causes list', 'framework-demo' ),
				'items_list_navigation' => __( 'Causes list navigation', 'framework-demo' ),
				'items_list'            => __( 'Causes list', 'framework-demo' ),
				'featured_image'        => __( 'Cause Cover Image', 'framework-demo' ),
				'set_featured_image'    => __( 'Set Cause Cover Image', 'framework-demo' ),
				'remove_featured_image' => __( 'Remove Cause Cover', 'framework-demo' ),
				'use_featured_image'    => __( 'Use as Cause Cover', 'framework-demo' ),
			],
			// you can use the placeholders {permalink}, {preview_url}, {date}
			'messages'      => [
				'post_updated'         => __( 'Cause information updated. <a href="{permalink}" target="_blank">View Cause</a>', 'framework-demo' ),
				'post_updated_short'   => __( 'Cause info updated', 'framework-demo' ),
				'custom_field_updated' => __( 'Custom field updated', 'framework-demo' ),
				'custom_field_deleted' => __( 'Custom field deleted', 'framework-demo' ),
				'restored_to_revision' => __( 'Cause content restored from revision', 'framework-demo' ),
				'post_published'       => __( 'Cause Published', 'framework-demo' ),
				'post_saved'           => __( 'Cause information saved.', 'framework-demo' ),
				'post_submitted'       => __( 'Cause submitted. <a href="{preview_url}" target="_blank">Preview</a>', 'framework-demo' ),
				'post_schedulled'      => __( 'Cause scheduled for {date}. <a href="{preview_url}" target="_blank">Preview</a>', 'framework-demo' ),
				'post_draft_updated'   => __( 'Cause draft updated. <a href="{preview_url}" target="_blank">Preview</a>', 'framework-demo' ),
			],
			'bulk_messages' => [
				'updated_singular'   => __( 'Cause updated. Yay!', 'framework-demo' ),
				// translators: %s is for number of causes updated
				'updated_plural'     => __( '%s Causes updated. Yay!', 'framework-demo' ),
				'locked_singular'    => __( 'Cause not updated, somebody is editing it', 'framework-demo' ),
				// translators: %s is for number of causes not updated
				'locked_plural'      => __( '%s Causes not updated, somebody is editing them', 'framework-demo' ),
				'deleted_singular'   => __( 'Cause permanetly deleted. Fahrenheit 451 team was here?', 'framework-demo' ),
				// translators: %s is for number of causes permanently deleted
				'deleted_plural'     => __( '%s Causes permanently deleted. Why? :(', 'framework-demo' ),
				'trashed_singular'   => __( 'Cause moved to the trash. I\'m sad :(', 'framework-demo' ),
				// translators: %s is for number of causes moved to the trash
				'trashed_plural'     => __( '%s Causes moved to the trash. Why? :(', 'framework-demo' ),
				'untrashed_singular' => __( 'Cause recovered from the trash. Well done!', 'framework-demo' ),
				// translators: %s is for number of causes saved from the trash
				'untrashed_plural'   => __( '%s Causes saved from the trash!', 'framework-demo' ),
			],
			// overrides some of the available button labels and placeholders
			'ui'            => [
				'enter_title_here' => __( 'Enter cause name here', 'framework-demo' ),
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
		'menu_icon'          => 'dashicons-bell',
		'rewrite'            => [
			'slug'       => __( 'cause', 'framework-demo' ),
			'with_front' => true,
			'feeds'      => true,
			'pages'      => true,
		],
	],
	'block_editor' => true,
	'meta'         => [
		'cause_info' => [
			'id'       => 'information_metabox',
			'title'    => __( 'Information', 'framework-demo' ),
			'sections' => [
				'information' => [
					'title'  => __( 'Cause', 'framework-demo' ),
					'desc'   => __( 'Information regarding the cause', 'framework-demo' ),
					'icon'   => 'fa fa-file-text-o',
					'fields' => [
						'is_featured' => [
							'title'   => __( 'Is Featured', 'framework-demo' ),
							'type'    => 'switcher',
							'label'   => __( 'Is Featured', 'framework-demo' ),
							'default' => 0,
						],
					],
				],
			],
		],
	],
];
